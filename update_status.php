<?php
session_start();
include("db/connection.php");

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

if(isset($_GET['id'])){
    $task_id = $_GET['id'];
    
  
    $check = "SELECT status FROM task WHERE id = '$task_id'";
    $check_result = mysqli_query($connection, $check);
    $task = mysqli_fetch_assoc($check_result);
    
    if($task){
       
        $query = "UPDATE task SET status = 'Completed' WHERE id = '$task_id'";
        
        if(mysqli_query($connection, $query)){
          
            $verify = "SELECT status FROM task WHERE id = '$task_id'";
            $verify_result = mysqli_query($connection, $verify);
            $verified = mysqli_fetch_assoc($verify_result);
            
            if($verified['status'] == 'Completed'){
                header("Location: dashboard.php?success=Task Completed! ");
            } else {
                header("Location: dashboard.php?error=Status is: " . $verified['status']);
            }
        } else {
            header("Location: dashboard.php?error=" . mysqli_error($connection));
        }
    } else {
        header("Location: dashboard.php?error=Task not found!");
    }
    exit();
} else {
    header("Location: dashboard.php");
    exit();
}
?>