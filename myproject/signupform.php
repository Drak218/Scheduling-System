<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'config.php';

    $username = $_POST['email'];  
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];

    $sql = "INSERT INTO users (`username`, `email`, `password`, `lastname`, `firstname`, `middlename`, `birthday`, `address`, `mobile`, `date_created`)
            VALUES ('$username', '$email', '$password', '$lastname', '$firstname', '$middlename', '$birthday', '$address', '$mobile', NOW())";

    if ($conn->query($sql) === TRUE) {
        header("Location: index1.php?signup_success=1");
        exit(); 
    } else {
        echo "<div class='alert alert-danger text-center'>Error: " . $conn->error . "</div>";
    }

    $conn->close();
}
?>