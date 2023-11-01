<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employee";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM emp WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Data deleted successfully');</script>";
    echo "<script>window.location.href='/';</script>";
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
