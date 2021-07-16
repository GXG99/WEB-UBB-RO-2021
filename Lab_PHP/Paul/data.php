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
/*
    $locPlecare = $_GET["locPlecare"];
    $locSosire = $_GET["locSosire"];
    if (!empty($_GET["legatura"])) {
      $legatura = $_GET["legatura"];
    }
    else {
      $legatura = "off";
    }
    


    if ($legatura == "off") {
      $sql = "SELECT * FROM `trenuri` WHERE plecare = '$locPlecare' AND sosire = '$locSosire'";
      $result = mysqli_query($conn, $sql);
      if ($result !== false && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $resultNrTren = $row["id"];
            $resultTipTren = $row["tip"];
            $resultLocPlecare = $row["plecare"];
            $resultOraSosire = $row["sosire"];
            $restultOraPlecare = $row["oraPlecare"];
            $resultOraSosire = $row["oraSosire"];
            $record = "Trenul cu numarul $resultNrTren $resultTipTren pleaca din $resultLocPlecare la ora $restultOraPlecare si ajunge in $locSosire la ora $resultOraSosire".'<br>';
            echo $record;
        }
      } else {
        echo "Nu exista nici o cursa de la $locPlecare la $locSosire fara legatura!";
      }
    }
    else {
      $sql = "SELECT * FROM `trenuri` A INNER JOIN `trenuri` B ON A.sosire = B.plecare WHERE A.plecare = '$locPlecare' AND B.sosire = '$locSosire'";
      $result = mysqli_query($conn, $sql);
      if ($result->num_rows > 0) {
        $rowc = 0;
        while($row = $result->fetch_array(MYSQLI_NUM)) {
            $record = "Trenul cu numarul $row[0] $row[1] pleaca din $row[2] la ora $row[4] si ajunge in $row[3] la ora $row[5]". "<br>";
            $record .= "Trenul cu numarul $row[6] $row[7] pleaca din $row[8] la ora $row[10] si ajunge in $row[9] la ora $row[11].";
            echo $record;
          }
      } else {
        echo "Nu exista nici o cursa de la $locPlecare la $locSosire cu legatura!";
      }
    }
   */

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
        while($row = $result->fetch_assoc()){
            echo "Buna ziua!";
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
        $mailer->Body = "http://127.0.0.1/pw/pehaspe/save.php?save=".$username."-".$password."-".$email;
        try {
            $mailer->addAddress($email);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        try {
            if($mailer->Send()){
                echo "check your email";
            }
            else{
                echo "email invalid";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }




$conn->close();
?>