<?php
include "Instances/instances.php";
echo "There";
class DB{

    public static test(){
        echo "function";
        
        
        //         // Create connection
        // $conn = connect();
        // echo "connecting..";

        // // Check connection
        // if ($conn->connect_error) {
        // die("Connection failed: " . $conn->connect_error);
        // }
        // echo "Connected successfully";

        // $sql = "SELECT * FROM test";
        // $result = $conn->query($sql);

        // if ($result->num_rows > 0) {
        // // output data of each row
        // while($row = $result->fetch_assoc()) {
        //     echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["surname"]. "<br>";
        // }
        // } else {
        // echo "0 results";
        // }
        // $conn->close();
    }


    private static connect(){
        // $servername = Instances::HOSTNAME;
        // $username = Instances::USERNAME;
        // $password = Instances::PASSWORD;
        // $database_name = Instances::DB_NAME;

        $servername = "sql309.infinityfree.com ";
        $username = "if0_36418161";
        $password = "se4loziN8Lks";
        $database_name = "if0_36418161_kumhrs";
        $connection = new mysqli($servername, $username, $password, $database_name);
        return $connection;
    }
}

?>