<?php
if (isset($_POST['username']) && isset($_POST['password']) and isset($_POST['submit'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "pw";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? and password = ?");
    $stmt->bind_param('ss', $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Cu session start e mai safe
        session_start();
        $_SESSION["username"] = $_POST['username'];
        $_SESSION["password"] = $_POST['password'];
//        setcookie("userN", $_POST['username']);
//        setcookie("password", $_POST['password']);
        header('Location:uploadPhoto.php');
    } else {
        echo "<p>Date greșite!</p><br>";
    }
}