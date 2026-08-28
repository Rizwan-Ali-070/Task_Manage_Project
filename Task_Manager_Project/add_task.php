<?php
session_start();
include("db/connection.php");

if(!isset($_SESSION['user_id'])){
    header("Location: index.html");
    exit();
}

if(isset($_POST['submit_task'])){
    $user_id = $_SESSION['user_id'];
    
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $priority = mysqli_real_escape_string($connection, $_POST['priority']);
    $status = mysqli_real_escape_string($connection, $_POST['status']);
    
    $query = "INSERT INTO task (user_id, title, description, priority, status) 
              VALUES ('$user_id', '$title', '$description', '$priority', '$status')";
    
    if(mysqli_query($connection, $query)){
        header("Location: dashboard.php?success=Task added successfully!");
    } else {
        header("Location: dashboard.php?error=Failed to add task: " . mysqli_error($connection));
    }
    exit();
}
?>