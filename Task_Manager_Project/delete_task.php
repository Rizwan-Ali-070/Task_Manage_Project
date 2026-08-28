<?php
session_start();
include("db/connection.php");

if(!isset($_SESSION['user_id'])){
    header("Location: index.html");
    exit();
}

if(isset($_GET['id'])){
    $task_id = mysqli_real_escape_string($connection, $_GET['id']);
    $user_id = $_SESSION['user_id'];
    
  
    $query = "DELETE FROM task WHERE id = '$task_id' AND user_id = '$user_id'";
    
    if(mysqli_query($connection, $query)){
        header("Location: dashboard.php?success=Task deleted successfully");
    } else {
        header("Location: dashboard.php?error=Failed to delete task");
    }
} else {
    header("Location: dashboard.php");
}
?>