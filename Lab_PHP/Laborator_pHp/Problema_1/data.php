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

$locPlecare = $_GET["plecare"];
$locSosire = $_GET["sosire"];
if (!empty($_GET["legatura"])) {
    $legatura = $_GET["legatura"];
} else {
    $legatura = "off";
}


/**
 * @param mixed $legatura
 * @param mixed $locPlecare
 * @param mixed $locSosire
 * @param mysqli $conn
 */
function load_curse(mixed $legatura, mixed $locPlecare, mixed $locSosire, mysqli $conn): void
{
    if ($legatura == "off") {
        $sql = "SELECT * FROM `trains` WHERE localitate_plecare = '$locPlecare' AND localitate_sosire = '$locSosire'";
        $result = mysqli_query($conn, $sql);
        if ($result !== false && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultNrTren = $row["id_tren"];
                $resultTipTren = $row["tip_tren"];
                $resultLocPlecare = $row["localitate_plecare"];
                $resultOraSosire = $row["localitate_sosire"];
                $restultOraPlecare = $row["ora_plecare"];
                $resultOraSosire = $row["ora_sosire"];
                $record = "Trenul cu numarul $resultNrTren $resultTipTren pleaca din $resultLocPlecare la ora $restultOraPlecare si ajunge in $locSosire la ora $resultOraSosire" . '<br>';
                echo $record;
            }
        } else {
            echo "Nu exista nici o cursa de la $locPlecare la $locSosire fara legatura!";
        }
    } else {
        $sql = "SELECT * FROM `trains` A INNER JOIN `trains` B ON A.localitate_sosire = B.localitate_plecare WHERE A.localitate_plecare = '$locPlecare' AND B.localitate_sosire = '$locSosire'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            $rowc = 0;
            while ($row = $result->fetch_array(MYSQLI_NUM)) {
                $record = "Trenul cu numarul $row[0] $row[1] pleaca din $row[2] la ora $row[4] si ajunge in $row[3] la ora $row[5]" . "<br>";
                $record .= "Trenul cu numarul $row[6] $row[7] pleaca din $row[8] la ora $row[10] si ajunge in $row[9] la ora $row[11].";
                echo $record;
            }
        } else {
            echo "Nu exista nici o cursa de la $locPlecare la $locSosire cu legatura!";
        }
    }
}

load_curse($legatura, $locPlecare, $locSosire, $conn);
