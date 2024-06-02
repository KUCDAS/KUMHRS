
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
        $sql = "SELECT A.aid AS aid,medicine_name, dosage, quantity, tpd, tpu, note, A.adate as date FROM MedicineDetail as MD JOIN PrescriptionMedicine as PM ON MD.mid = PM.mid JOIN Prescription as P ON P.prescription_id = PM.prescription_id JOIN Appointment as A ON A.aid = P.aid JOIN Patient as Pa ON Pa.patient_id = A.patient_id JOIN Person as Pe ON Pe.rid = Pa.rid WHERE Pe.rid = ? ORDER BY A.aid ASC";
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

    public function getTopThreeHospitals(){
        $sql = "SELECT H.hospital_id, H.hname as hname, COUNT(*) AS appointment_count
        FROM APPOINTMENT A
        JOIN DOCTOR AS DO ON A.doctor_id = DO.doctor_id
        JOIN DEPARTMENT AS DEP ON DO.department_id = DEP.department_id
        JOIN HOSPITAL AS H ON DEP.hospital_id = H.hospital_id
        GROUP BY H.hospital_id
        ORDER BY appointment_count DESC
        LIMIT 3";
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

    public function getTopDepartments(int $num){
        $sql = "SELECT DEP.department_id, DEP.dname, COUNT(*) AS appointment_count
        FROM APPOINTMENT A
        JOIN DOCTOR AS DO ON A.doctor_id = DO.doctor_id
        JOIN DEPARTMENT AS DEP ON DO.department_id = DEP.department_id
        JOIN HOSPITAL AS H ON DEP.hospital_id = H.hospital_id
        GROUP BY DEP.department_id
        ORDER BY appointment_count DESC
        LIMIT ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $num);
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

    public function getTopPatients(int $rid, int $num){
        $sql = "SELECT PE.rid, PE.name, COUNT(*) AS count
        FROM APPOINTMENT A
        JOIN DOCTOR AS DO ON A.doctor_id = DO.doctor_id
        JOIN DEPARTMENT DEP ON DO.department_id = DEP.department_id
        JOIN HOSPITAL H ON DEP.hospital_id = H.hospital_id
        JOIN PATIENT PA ON A.patient_id = PA.patient_id
        JOIN PERSON PE ON PA.rid = PE.rid
        WHERE H.hospital_id IN(SELECT H2.hospital_id FROM Person AS P2
                       JOIN DOCTOR AS Doc ON P2.rid = Doc.rid
                       JOIN Department AS De ON Doc.department_id = De.department_id
                       JOIN Hospital AS H2 ON De.hospital_id = H2.hospital_id
                       WHERE P2.rid = ?)
        GROUP BY PE.rid 
        ORDER BY count DESC
        LIMIT ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $rid,$num);
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

    public function getTopDoctors(int $rid, int $limit){
        $sql = "SELECT DO.doctor_id, PE.name as name, COUNT(*) as appointment_count
        FROM APPOINTMENT A
        JOIN DOCTOR AS DO ON A.doctor_id = DO.doctor_id
        JOIN DEPARTMENT AS DEP ON DO.department_id = DEP.department_id
        JOIN HOSPITAL AS H ON DEP.hospital_id = H.hospital_id
        JOIN PERSON AS PE ON DO.rid = PE.rid
        WHERE H.hospital_id IN(SELECT H2.hospital_id FROM Person AS P2
                       JOIN DOCTOR AS Doc ON P2.rid = Doc.rid
                       JOIN Department AS De ON Doc.department_id = De.department_id
                       JOIN Hospital AS H2 ON De.hospital_id = H2.hospital_id
                       WHERE P2.rid = ?)
        GROUP BY DO.doctor_id
        LIMIT ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $rid, $limit);
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

    public function getTopMedicines(int $limit){
        $sql = "SELECT MD.mid, MD.medicine_name as medicine_name, COUNT(*) as prescription_count
        FROM MedicineDetail MD
        JOIN PrescriptionMedicine PM ON MD.mid = PM.mid
        JOIN Prescription PR ON PM.prescription_id = PR.prescription_id
        JOIN Appointment A ON PR.aid = A.aid
        WHERE A.adate > DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)
        GROUP BY medicine_name
        ORDER BY prescription_count DESC
        LIMIT ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $limit);
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

    public function getMostVisitedHospital(int $rid, int $limit){
        $sql = "SELECT H.hospital_id AS id, H.hname AS name, COUNT(*) AS count
        FROM Hospital AS H
        JOIN Department AS Dep ON Dep.hospital_id = H.hospital_id
        JOIN Doctor AS Dr ON Dr.department_id = Dep.department_id
        JOIN Appointment AS A ON A.doctor_id = Dr.doctor_id
        JOIN Patient AS Pat ON Pat.patient_id = A.patient_id
        JOIN Person AS Per ON Per.rid = Pat.rid
        WHERE Per.rid = ?
        GROUP BY H.hospital_id
        ORDER BY count DESC
        LIMIT ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $rid, $limit);
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

    public function getAllHospitals(){
        $sql = "SELECT H.hname AS hospital_name FROM Hospital as H";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $hospitals = [];
        while($row = $result -> fetch_assoc()){
            array_push($hospitals, $row);
        }
        return $hospitals;
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
    
        $stmt->bind_param('ssss', $pid, $date, $time, $doctor); // Assuming $pid is an integer
        if (!$stmt->execute()) {
            // Handle executing errors
            echo "Execution error: " . $stmt->error;
            return false;
        }
    
        // Since it's an INSERT statement, no need to fetch rows, just return success or the number of affected rows
        return $stmt->affected_rows;
    }

    public function addPatient($rid){
        $sql="INSERT INTO Patient(patient_id, rid) 
        SELECT MAX(patient_id)+1, ?
        FROM Patient";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $rid);
        $stmt->execute();
        $stmt->close();
    }

    public function getPatientId($rid){
        $sql="
        SELECT patient_id FROM Patient WHERE rid = ?
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $rid);
        $stmt->execute();
        $result = $stmt -> get_result();
        $stmt->close();
        if ($result -> num_rows > 0){
            $row = $result->fetch_assoc();
            return $row['patient_id'];
        }else{
            $this->addPatient($rid);
            $this->getPatientId($rid);
        }
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
        $sql = "SELECT D.dname as dname, H.hname as hname, P.name as pname, A.adate as date, A.atime as time, A.aid as aid
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
    public function getIssuedPrescription($rid){
        $sql = "SELECT A.aid AS aid, Pe.name AS pname, Md.medicine_name AS medicinaNames, A.adate AS date FROM Prescription Pr , PrescriptionMedicine Pm , MedicineDetail Md, Appointment A,Patient Pa, Person Pe, Person Pdoc , Doctor Do WHERE Pr.prescription_id = Pm.prescription_id AND Pm.mid = Md.mid AND Pr.aid = A.aid AND A.patient_id = Pa.patient_id AND Pa.rid = Pe.rid AND A.doctor_id = Do.doctor_id AND Pdoc.rid = Do.rid AND Pdoc.rid = ? ORDER BY A.aid";
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

    public function getPrescriptionInfo($aid){
        $sql = "SELECT A.adate AS adate,Md.medicine_name AS medicine_name, Md.dosage AS dosage, Md.quantity AS quantity, Md.tpd AS tpd, Md.tpu AS tpu, Md.note AS note 
        FROM PrescriptionMedicine Pm , MedicineDetail Md, Appointment A, Prescription Pr
        WHERE Pm.mid = Md.mid AND Pr.prescription_id = Pm.prescription_id AND Pr.aid = A.aid AND A.aid = ? ORDER BY Pm.mid";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param('s', $aid); // 's' indicates the type is a string

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

    public function getPatientAndDoctorInfo($aid){
        $sql = "SELECT Pe.name AS pname, Pdoc.name AS dname FROM Prescription Pr , Appointment A,Patient Pa, Person Pe, Person Pdoc , Doctor Do WHERE Pr.aid = A.aid AND A.patient_id = Pa.patient_id AND Pa.rid = Pe.rid AND A.doctor_id = Do.doctor_id AND Pdoc.rid = Do.rid AND Pr.aid = ?";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param('s', $aid); // 's' indicates the type is a string

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

    public function getPrescriptionID($aid){
        $sql = "SELECT Pr.prescription_id AS id FROM Prescription Pr WHERE Pr.aid = ?";
        $stmt = $this->conn->prepare($sql);

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param('s', $aid); // 's' indicates the type is a string

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

    public function isPresccriptionWritten($aid){
        $sql = "SELECT Pr.prescription_id AS id FROM Prescription Pr WHERE Pr.aid = ?";
        $stmt = $this->conn->prepare($sql);

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param('s', $aid); // 's' indicates the type is a string

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
        
        if(count($results) > 0){
            return true;
        }else{
            return false;
        }
    }
    // public function checkMedicineExist($medicine_name,$dosage,$quantity,$tpd,$tpu,$note){
    //     $sql = "SELECT mid FROM MedicineDetail WHERE medicine_name = ? AND dosage = ? AND quantity = ? AND tpd = ? AND tpu = ? AND note = ?";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bind_param('ssssss', $medicine_name,$dosage,$quantity,$tpd,$tpu,$note);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $results = [];
    //     if ($result->num_rows > 0) {
    //         // Output data of each row
    //         while($row = $result->fetch_assoc()) {
    //             array_push($results, $row);
    //         }

    //     } 
    //     if(count($results) > 0){
    //         return $results[0]['mid'];
    //     }else{
    //         return -1;
    //     }
    // }

    public function insertMedicine($medicine_name,$dosage,$quantity,$tpd,$tpu,$note){
        $sql = "INSERT INTO MedicineDetail (mid,medicine_name, dosage, quantity, tpd, tpu, note) 
        SELECT MAX(mid)+1,?,?,?,?,?,?
        FROM MedicineDetail";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssss', $medicine_name,$dosage,$quantity,$tpd,$tpu,$note);
        $stmt->execute();
        $stmt->close();

        $sql = "INSERT INTO PrescriptionMedicine (prescription_id,mid)
        SELECT MAX(prescription_id), MAX(mid)
        FROM Prescription, MedicineDetail
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $stmt->close();
        // $sql = "SELECT MAX(mid)
        // FROM MedicineDetail";
        // $stmt = $this->conn->prepare($sql);
        // $stmt->execute();
        // $stmt->bind_result($maxMid);
        // $stmt->close();
        // return $maxMid;
    }

    public function insertPrescription($aid){
        $sql = "INSERT INTO Prescription(prescription_id, aid)
        SELECT MAX(prescription_id)+1, ?
        FROM Prescription
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $aid);
        $stmt->execute();
        $stmt->close();
    }

    public function validUser($email,$insnumber){
        $sql = "SELECT rid FROM Person WHERE email = ? OR insnumber = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $email,$insnumber);
        $stmt->execute();
        $result = $stmt->get_result();
        $results = [];
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($results, $row);
            }

        } 
        if(count($results) > 0){
            return false;
        }else{
            return true;
        }
    }
    public function insertPerson($name,$email,$gender,$bdate,$insnumber,$address,$pnumber,$password){

        if($this -> validUser($email,$insnumber)){
        $sql = "INSERT INTO Person (rid, name, email,gender,bdate,insnumber,address,pnumber,password) 
        SELECT MAX(rid)+1 ,?,?,?,?,?,?,?,? FROM Person";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssssss', $name,$email,$gender,$bdate,$insnumber,$address,$pnumber,$password);
        $stmt->execute();
        $stmt->close();

        return $this -> getRid($email);
        }else{
            return $this -> getRid($email);
        }
    }

    public function insertHospital($hname,$hadress){
        $sql = "INSERT INTO Hospital (hospital_id,hname,haddress)
        SELECT MAX(hospital_id)+1,?,? FROM Hospital";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $hname,$hadress);
        $stmt->execute();
        $stmt->close();

        //return last added hospital id
        $sql = "SELECT MAX(hospital_id) FROM Hospital";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $results = [];
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($results, $row);
            }

        }
        return $results[0]['MAX(hospital_id)'];
    }

    public function insertDepartment($dname,$hid){
        $sql = "INSERT INTO Department (department_id,dname,hospital_id)
        SELECT MAX(department_id)+1,?,? FROM Department";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $dname,$hid);
        $stmt->execute();
        $stmt->close();

        $sql = "SELECT MAX(department_id) FROM Department";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $results = [];
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($results, $row);
            }

        }

        return $results[0]['MAX(department_id)'];
    }

    public function isHospitalExist($hname){
        $sql = "SELECT hospital_id FROM Hospital WHERE hname = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $hname);
        $stmt->execute();
        $result = $stmt->get_result();
        $results = [];
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($results, $row);
            }

        } 
        if(count($results) > 0){
            return $results[0]['hospital_id'];
        }else{
            return -1;
        }
    }


    public function isDepartmentExist($dname,$hid){
        $sql = "SELECT department_id FROM Department WHERE dname = ? AND hospital_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $dname,$hid);
        $stmt->execute();
        $result = $stmt->get_result();
        $results = [];
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($results, $row);
            }

        }
        if(count($results) > 0){
            return $results[0]['department_id'];
        }else{
            return -1;
        }

    }

    public function getRid($email){
        $sql = "SELECT rid FROM Person WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $results = [];
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($results, $row);
            }
            return $results[0]['rid'];
        }
        return -1;
        
    }

    public function insertDoctor($name,$email,$gender,$bdate,$insnumber,$address,$pnumber,$password,$hname,$hadress,$dname){
        $rid = $this->insertPerson($name,$email,$gender,$bdate,$insnumber,$address,$pnumber,$password);

        $hid = $this -> isHospitalExist($hname);
        if($hid == -1){
            $hid = $this -> insertHospital($hname,$hadress);
        }

        $did = $this -> isDepartmentExist($dname,$hid);
        if($did == -1){
            $did = $this ->  insertDepartment($dname,$hid);
        }

        echo "\nrid:";
        echo $rid;
        echo "\nhid:";
        echo $did;

        $sql = "INSERT INTO Doctor (doctor_id,rid,department_id) 
        SELECT MAX(doctor_id)+1,?,? FROM Doctor";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $rid,$did);
        $stmt->execute();
        $stmt->close();

        $sql =  "SELECT MAX(doctor_id) FROM Doctor";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $results = [];
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($results, $row);
            }
        }
        return $results[0]['MAX(doctor_id)'];
    }

    


    
}





?>
