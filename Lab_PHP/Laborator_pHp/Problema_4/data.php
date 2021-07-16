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


require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$username = $_GET["user"];
$password = $_GET["pass"];
$email = $_GET["email"];

$sql = "SELECT * FROM `utilizatori` WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if ($result != false && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Bine ați venit, rău ați nimerit!";
    }
} else {
    $mailer = new PHPMailer();
    $mailer->isSMTP();
    $mailer->Host = "smtp.gmail.com";
    $mailer->SMTPAuth = "true";
    $mailer->SMTPSecure = "tls";
    $mailer->Port = "587";
    $mailer->Username = "programare.web213@gmail.com";
    $mailer->Password = "sukaflashlong";
    $mailer->Subject = "Ati fost inregistrat cu succes";
    try {
        $mailer->setFrom("programare.web213@gmail.com");
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    $mailer->Body = "http://127.0.0.1/pw/Laborator_pHp/Problema_4/save.php?save=" . $username . "-" . $password . "-" . $email;
    try {
        $mailer->addAddress($email);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    try {
        if ($mailer->Send()) {
            echo "check your email";
        } else {
            echo "email invalid";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

$conn->close();
