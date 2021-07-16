<?php
session_start();
$us = $_SESSION["userN"];
if ($us != null) {
    header("Logation:index.html");
}
echo "<p> Username: $us </p> ";
echo "<p>Selecteaza poza dorita</p> ";
echo '<form method="post" enctype="multipart/form-data"><input type="file" name="image" id="image"><br><input type="submit" name="upload" value="Incarca"><br></form><br>';

echo '<form method="post">';
userImages();
echo '<input type="submit" name="delete" value="Sterge"><br>';
echo '</form><br><p>Profiluri: </p><br>';
showFriends();


if (isset($_POST['upload'])) {
    if (getimagesize($_FILES['image']['tmp_name']) == FALSE) {
        echo 'Please select an image!';
    } else {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "pw";
        $conn = new mysqli($servername, $username, $password, $database);
        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $img_name = $_FILES['image']['name'];
        $file_loc = $_FILES['image']['tmp_name'];
        $folder = "images/";
        $new_img_name = strtolower($img_name);
        $final_file = str_replace('', '-', $new_img_name);
        $userN = $_COOKIE['userN'];
        if (move_uploaded_file($file_loc, $folder.$final_file)) {
            $sql = "insert into images (username, img_name) VALUES ('$userN','$final_file')";
            if (!mysqli_query($conn, $sql))
                echo "ERROR UPLOADS";
        } else {
            echo "ERROR UPLOADS";
        }
    }
}

if (isset($_POST['delete'])) {
    if ($_POST['whatToDelete'] != 'Delete Image') {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "pw";
        $conn = new mysqli($servername, $username, $password, $database);
        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("DELETE FROM images WHERE img_name = ? AND username = ?");
        $stmt->bind_param('ss', $_POST['whatToDelete'], $us);
        $stmt->execute();
    }
}


function userImages()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "pw";
    $conn = new mysqli($servername, $username, $password, $database);

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //echo $_COOKIE['userN'];
    $stmt = $conn->prepare("SELECT img_name FROM images where username = ?");
    $stmt->bind_param('s', $_COOKIE['userN']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo '<select name="whatToDelete">';
        echo '<option selected value="Delete Image">Alege imagine de sters</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['img_name'] . '">' . $row['img_name'] . ' </option>';
        }
        echo '</select>';
    }

}

function showFriends()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "pw";
    $conn = new mysqli($servername, $username, $password, $database);
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT username FROM users");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<a href="profile.php?profile=' . $row['username'] . '">' . $row['username'] . '</a> <br>';
        }
    }
}