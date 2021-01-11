<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

$name = '';
$location = '';
$id_number = '';
$birthday = '';

if (isset($_POST['save'])){
    $name = $_POST['name'];
    $location = $_POST['location'];
    $ID = $_POST['id'];
    $birthday = $_POST['birthday'];

    $mysqli->query("INSERT INTO data (name, location, id_number, birthday) VALUES('$name', '$location', '$ID', '$birthday')") or
        die($mysqli->error);

    $_SESSION['message'] = "data saved successfully";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "data deleted successfully";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    if(count($result)==1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
        $id = $row['id'];
        $birthday = $row['birthday'];
    }
}