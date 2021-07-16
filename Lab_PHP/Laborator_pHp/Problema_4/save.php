<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pw";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$req = $_REQUEST["save"];
$req = explode("-", $req);
$sql = "INSERT INTO `utilizatori`(`username`, `pass`, `email`) VALUES ('$req[0]','$req[1]','$req[2]')";
if ($conn->query($sql) === TRUE) {
    echo "Inregistrat in baza de date";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}