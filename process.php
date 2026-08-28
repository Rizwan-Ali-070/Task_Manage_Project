<?php
session_start();
include("db/connection.php");


if(isset($_POST['register'])){
    
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $error = "";
    if(empty($username)){
        $error = "Name is required.";
    } elseif(empty($email)){
        $error = "Email is required.";
    } elseif(empty($password)){
        $error = "Password is required.";
    }
    
    if(!empty($error)){
        header("Location: register.php?error=" . urlencode($error));
        exit();
    }
    
   
    $query = "INSERT INTO users(name, email, password) VALUES ('$username', '$email', '$password')";
    $result = mysqli_query($connection, $query);
    
    if($result){
        header("Location: index.html?success=Registration successful! Please login.");
        exit();
    } else {
        header("Location: register.php?error=Registration failed. Please try again.");
        exit();
    }
}


if (isset($_POST['login'])) {
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $error = "";
    
    if (empty($email)) {
        $error = "Email is required.";
    } elseif (empty($password)) {
        $error = "Password is required.";
    }
    
    if (!empty($error)) {
        header("Location: index.html?error=" . urlencode($error));
        exit();
    }
    
    
    $query = "SELECT id, name, password FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user) {
      
        if ($user['password'] == $password) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }
    
    if (!empty($error)) {
        header("Location: index.html?error=" . urlencode($error));
        exit();
    }
}
?>