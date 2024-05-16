
<?php

class DatabaseManager {
    private $host = "localhost";
    private $db_name = "kumhrs";
    private $username = "c306";
    private $password = "c306";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
        } catch(Exception $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function runQuery($sql, $params = []) {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die("MySQL prepare error: " . $this->conn->error);
        }

        if (!empty($params)) {
            $types = str_repeat('s', count($params)); // Assuming all parameters are strings for simplicity
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();

        if ($stmt->error) {
            die("Execute error: " . $stmt->error);
        }

        return $stmt;
    }

    public function getPassword($email) {
        // Prepare the SQL statement to prevent SQL injection
        $sql = "SELECT password FROM Person WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        
        if (!$stmt) {
            die('Prepare failed: ' . $this->conn->error);
        }

        // Bind the input parameter to the prepared statement
        $stmt->bind_param('s', $email);

        // Execute the query
        $stmt->execute();

        // Bind the result variable
        $stmt->bind_result($name);

        // Fetch the result
        $result = $stmt->fetch();

        if ($result) {
            // Close the statement
            $stmt->close();
            return $name; // Return the name fetched from database
        } else {
            // Close the statement
            $stmt->close();
            return null; // Return null if no result found
        }
    }

    public function isDoctor($email){
        $sql = "SELECT doctor_id FROM Person JOIN Doctor ON Person.rid = Doctor.rid WHERE Person.email = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt){
            die('Prepare failed'.$this->conn->error);
        }

        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($did);
        $result = $stmt->fetch();

        if($result){
            return true;
            $stmt->close();
        }else{
            return false;
            $stmt->close();
        }
    }

    public function close() {
        $this->conn->close();
    }
    public function getUsersInfo($email){
        $sql = "SELECT rid, name, gender FROM Person WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt){
            die('Prepare failed'.$this->conn->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($rid, $name, $gender);
        $result = $stmt->fetch();
        $stmt->close();
        return ["rid"=>$rid, "name"=>$name, "gender"=>$gender];
    }

    public function getPatientPresc($rid){
        $sql = "SELECT DISTINCT medicine_name, dosage, quantity, tpd, tpu, note, adate
        FROM MedicineDetail as MD
        JOIN PrescriptionMedicine as PM ON MD.mid = PM.mid
        JOIN Prescription as P ON P.prescription_id = PM.prescription_id
        JOIN Appointment as A ON A.aid = P.aid
        WHERE A.patient_id = ?";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param('s', $rid); // 's' indicates the type is a string

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();
        $results = [];
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($results, $row);
            }

        } 
        
        return $results;
    }

    //Functions for appointment below
    public function getAllClinics(){
        $sql = "SELECT DISTINCT dname FROM Department";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $results = [];
        if($result -> num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($results, $row);
            }
        }
        return $results;
    }

    public function getHospitals($clinic_name){
        $sql = "SELECT DISTINCT H.hname
        FROM Hospital H
        JOIN Department D ON H.hospital_id = D.hospital_id
        JOIN Doctor Dr ON D.department_id = Dr.department_id
        WHERE D.dname = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $clinic_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $results = [];
        if($result -> num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($results, $row);
            }
        }
        return $results;
    }

    public function getDoctors($clinic, $hospital){
        $sql = "SELECT DISTINCT name
        FROM Person as P
        JOIN Doctor as Dr ON P.rid = Dr.rid
        JOIN Department as Dep ON Dr.department_id = Dep.department_id
        JOIN Hospital as H ON H.hospital_id = Dep.hospital_id
        WHERE Dep.dname = ? AND H.hname = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $clinic, $hospital);
        $stmt->execute();
        $result = $stmt->get_result();
        $results = [];
        if($result -> num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($results, $row);
            }
        }
        return $results;
    }

    public function getAvaliableAppointmentDates($clinic, $hospital, $doctor){
        $sql = "SELECT A.adate as date
        FROM Appointment A
        JOIN Doctor D ON A.doctor_id = D.doctor_id
        JOIN Person P ON D.rid = P.rid
        JOIN Department Dept ON D.department_id = Dept.department_id
        JOIN Hospital H ON Dept.hospital_id = H.hospital_id
        WHERE P.name = ? AND Dept.dname = ? AND H.hname = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sss', $doctor, $clinic, $hospital);
        $stmt->execute();
        $result = $stmt->get_result();
        $results = [];
        if($result -> num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($results, $row);
            }
        }
        return $results;
    }

    public function getNonavailableAppoitmentTimes($clinic, $hospital, $doctor, $date){
        $sql = "SELECT A.atime as time
        FROM Appointment A
        JOIN Doctor D ON A.doctor_id = D.doctor_id
        JOIN Person P ON D.rid = P.rid
        JOIN Department Dept ON D.department_id = Dept.department_id
        JOIN Hospital H ON Dept.hospital_id = H.hospital_id
        WHERE P.name = ? AND Dept.dname = ? AND H.hname = ? AND A.adate = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssss', $doctor, $clinic, $hospital, $date);
        $stmt->execute();
        $result = $stmt->get_result();
        $results = [];
        if($result -> num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($results, $row);
            }
        }
        return $results;
    }

    public function makeAppointment($pid, $date, $time, $doctor){
        // Prepare SQL with proper explicit JOINs and corrected logic
        $sql = "INSERT INTO Appointment (aid, patient_id, doctor_id, adate, status, atime)
        SELECT MAX(A.aid) + 1, ?, D.doctor_id, ?, 'Scheduled', ?
        FROM Appointment A, Doctor D
        JOIN Person P ON D.rid = P.rid
        WHERE P.name = ?";
    
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            // Handle possible preparation errors
            echo "Error preparing statement: " . $this->conn->error;
            return false;
        }
    
        $stmt->bind_param('isss', $pid, $date, $time, $doctor); // Assuming $pid is an integer
        if (!$stmt->execute()) {
            // Handle executing errors
            echo "Execution error: " . $stmt->error;
            return false;
        }
    
        // Since it's an INSERT statement, no need to fetch rows, just return success or the number of affected rows
        return $stmt->affected_rows;
    }
    
    //Functions for Appointment Above
    
    public function getAppointments($rid){
        $sql = "SELECT 
            H.haddress AS address,
            D.dname AS dname,
            H.hname AS hname,
            P.name AS pname,
            A.adate AS date,
            A.atime AS time
        FROM 
            Appointment A
            JOIN Doctor Dr ON A.doctor_id = Dr.doctor_id
            JOIN Person P ON Dr.rid = P.rid
            JOIN Department D ON Dr.department_id = D.department_id
            JOIN Hospital H ON D.hospital_id = H.hospital_id
        WHERE 
            A.patient_id = ?
        ORDER BY date ASC, time ASC"; 
    
            $stmt = $this->conn->prepare($sql);
            if (!$stmt){
                die('Prepare failed'.$this->conn->error);
            }

            $stmt = $this->conn->prepare($sql);

            $stmt->bind_param('s', $rid); // 's' indicates the type is a string

            // Execute the query
            $stmt->execute();
            $result = $stmt->get_result();
            $results = [];
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    array_push($results, $row);
                }

            } 
            
        return $results;
    }

    public function getDoctorAppointments($rid){
        $sql = "SELECT D.dname as dname, H.hname as hname, P.name as pname, A.adate as date, A.atime as time 
        FROM  Person as P, Patient as Pa, Appointment as A, Doctor as Do, Department as D, Hospital as H
        WHERE 
            Do.rid = ?
        AND A.doctor_id = Do.doctor_id 
        AND Do.department_id = D.department_id 
        AND D.hospital_id = H.hospital_id
        AND Pa.rid = P.rid
        AND A.patient_id = Pa.patient_id 
        ORDER BY date ASC"; 


        $stmt = $this->conn->prepare($sql);
        if (!$stmt){
            die('Prepare failed'.$this->conn->error);
        }

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param('s', $rid); // 's' indicates the type is a string

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();
        $results = [];
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($results, $row);
            }

        } 
        
    return $results;
    }

    
}





?>
