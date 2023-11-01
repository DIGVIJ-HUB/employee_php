<?php

function home()
{
    // DB Connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "employee";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM emp";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    //DB connection close
    $conn->close();
    include('./views/form.php');
}

function submitForm()
{
    // DB Connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "employee";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST["emp_name"];
    $email = $_POST["emp_email"];
    $code = $_POST["emp_code"];
    $phone = $_POST["emp_phone"];

    // Store
    $sql = "INSERT INTO emp (emp_code, emp_name,emp_phone,emp_email,created_at) VALUES ('$code', '$name','$phone','$email', CURRENT_TIMESTAMP)";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Employee data added sucessfully');
            window.location.href = '/';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    //DB connection close
    $conn->close();
}

function editForm()
{
    // DB Connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "employee";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_POST["id"];
    $name = $_POST["emp_name"];
    $email = $_POST["emp_email"];
    $code = $_POST["emp_code"];
    $phone = $_POST["emp_phone"];

    // Edit
    $sql = "UPDATE emp SET emp_code='$code', emp_name='$name',emp_phone='$phone',emp_email='$email' WHERE id=$id";


    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Employee data edited sucessfully');
            window.location.href = '/';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    //DB connection close
    $conn->close();
}
