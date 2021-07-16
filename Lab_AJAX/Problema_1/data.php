<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "trains";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $departure = $_REQUEST["departure"];
    $sql = "SELECT second_city FROM cities WHERE first_city = '$departure' ";
    $result = mysqli_query($conn, $sql);

    if ($result !== false && $result->num_rows > 0) {
        // output data of each row
        $locations = array();
        while($row = $result->fetch_assoc()) {
            array_push($locations, $row["second_city"]);
        }
        echo (implode(',', $locations));
      } else {
        echo "";
      }
?>