<?php
$host = 'localhost';
$username = 'your_username';
$password = 'your_password';
$database = 'your_database';

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$fullName = $_POST['fullName'];
$email = $_POST['email'];
$gender = $_POST['gender'];

$errors = array();
if (empty($fullName)) {
    $errors[] = "Full Name is required.";
}if (empty($email)) {
    $errors[] = "Email Address is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid Email Address.";
}if (empty($gender)) {
    $errors[] = "Gender is required.";
}if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
    exit;
}

$sql = "INSERT INTO students (full_name, email, gender) VALUES ('$fullName', '$email', '$gender')";
if (mysqli_query($conn, $sql)) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>