<?php
include('config.php');

// Get POST data
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$firstname = $_POST['firstname'] ?? '';
$lastname = $_POST['lastname'] ?? '';
$middlename = $_POST['middlename'] ?? '';
$birthday = $_POST['birthday'] ?? '';
$address = $_POST['address'] ?? '';
$mobile = $_POST['mobile'] ?? '';
$password = $_POST['password'] ?? ''; // Get the password

// Hash the password before storing it
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare the SQL statement
$sql = "INSERT INTO users (username, email, firstname, lastname, middlename, birthday, address, mobile, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssss", $username, $email, $firstname, $lastname, $middlename, $birthday, $address, $mobile, $hashed_password);

$success = $stmt->execute();

if ($success) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error adding user.']);
}
?>