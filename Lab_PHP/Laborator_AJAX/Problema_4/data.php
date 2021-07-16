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


    //ex 1
 /*
    $departure = $_REQUEST["plecare"];
    $sql = "SELECT s2 FROM statii WHERE s1 = '$departure' ";
    $result = mysqli_query($conn, $sql);

    if ($result !== false && $result->num_rows > 0) {
        // output data of each row
        $locations = array();
        while($row = $result->fetch_assoc()) {
            array_push($locations, $row["s2"]);
        }
        echo (implode(',', $locations));
      } else {
        echo "";
      }
 */

    //ex2
/*
    $req = $_REQUEST["persoane"];
    $sql = "select * from persoane where id>$req and id<=$req+4";
    $result = mysqli_query($conn, $sql);

    if ($result !== false && $result->num_rows > 0) {
        // output data of each row
        $persons = array();
        while($row = $result->fetch_assoc()) {
            $idk = $row["nume"].'-'.$row["prenume"].'-'.$row["telefon"].'-'.$row["email"];
            array_push($persons, $idk);
        }
        echo (implode(',', $persons));
    } else {
        echo "";
    }
*/

//session_start();

function winner($arr){
    if($arr[0]+$arr[1]+$arr[2] == 3){
        return 1;
    }
    else if ($arr[0]+$arr[1]+$arr[2] == 15){
        return 2;
    }

    if($arr[3]+$arr[4]+$arr[5] == 3){
        return 1;
    }
    else if ($arr[3]+$arr[4]+$arr[5] == 15){
        return 2;
    }

    if($arr[6]+$arr[7]+$arr[8] == 3){
        return 1;
    }
    else if ($arr[6]+$arr[7]+$arr[8] == 15){
        return 2;
    }


    if($arr[0]+$arr[3]+$arr[6] == 3){
        return 1;
    }
    else if ($arr[0]+$arr[3]+$arr[4] == 15){
        return 2;
    }

    if($arr[1]+$arr[4]+$arr[7] == 3){
        return 1;
    }
    else if ($arr[1]+$arr[4]+$arr[7] == 15){
        return 2;
    }

    if($arr[2]+$arr[5]+$arr[8] == 3){
        return 1;
    }
    else if ($arr[2]+$arr[5]+$arr[8] == 15){
        return 2;
    }

    if($arr[0]+$arr[4]+$arr[8] == 3){
        return 1;
    }
    else if ($arr[0]+$arr[4]+$arr[8] == 15){
        return 2;
    }

    if($arr[2]+$arr[4]+$arr[6] == 3){
        return 1;
    }
    else if ($arr[2]+$arr[4]+$arr[6] == 15){
        return 2;
    }

    return 0;


}

$req = $_REQUEST["mutare"];
$spl = file_get_contents("x0");
$spl = explode("-",$spl);
$joc = array(0,0,0,0,0,0,0,0,0);
for($i=0;$i<9;$i++){
    $joc[$i]=$spl[$i];
}

if( $joc[$req] == 0){
    $joc[$req] = 1;
    if(winner($joc)==1){
        file_put_contents("x0","0-0-0-0-0-0-0-0-0");
        echo("human");
        return;
    }

    if(winner($joc)==2){
        file_put_contents("x0","0-0-0-0-0-0-0-0-0");
        echo("pc");
        return;
    }

    $randIndex = array_rand($joc);
    $semafor = 0;
    for($i=0;$i<9;$i++){
        if($joc[$i] == 0){
            $semafor=1;
            break;
        }
    }

    while($joc[$randIndex] != 0 && $semafor==1){
        $randIndex = array_rand($joc);
    }
    if($semafor==0){
        file_put_contents("x0","0-0-0-0-0-0-0-0-0");
        echo("draw");
        return;

    }
    else {
        $joc[$randIndex]=5;
        if(winner($joc)==2){
            file_put_contents("x0","0-0-0-0-0-0-0-0-0");
            echo("pc");
            //return;
        } else
        echo($randIndex);
    }
}
else{

    echo("invalid");
}
file_put_contents("x0",implode("-",$joc));

?>