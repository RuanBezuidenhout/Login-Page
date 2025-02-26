<?php
include_once('connection.php');
//function to remove spaces, backslashes and special characters
function test_input($data) {

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//request method to submit data via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $stmt = $conn->prepare("SELECT * FROM admin_login_table");
    $stmt->execute();
    $users = $stmt->fetchAll();

    //check if credentials are matching
    foreach($users as $user) {
        if(($user['username'] == $username) &&
            ($user['password'] == $password)) {
                header("location: adminpage.php");
        }
        else {
            echo "<script language='javascript'>";
            echo "alert('INCORRECT INFORMATION')";
            echo "</script>";
            die();
        }
    }
}
?>
