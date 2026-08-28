<?php
session_start();
include("db/connection.php");

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

$task_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM task WHERE id = '$task_id' AND user_id = '$user_id'";
$result = mysqli_query($connection, $query);
$task = mysqli_fetch_assoc($result);

if(!$task){
    header("Location: dashboard.php?error=Task not found");
    exit();
}

if(isset($_POST['update_task'])){
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $priority = mysqli_real_escape_string($connection, $_POST['priority']);
    $status = mysqli_real_escape_string($connection, $_POST['status']);
    
    
    $update_query = "UPDATE task SET 
                     title = '$title',
                     description = '$description',
                     priority = '$priority',
                     status = '$status'
                     WHERE id = '$task_id' AND user_id = '$user_id'";
    
    if(mysqli_query($connection, $update_query)){
        header("Location: dashboard.php?success=Task updated successfully!");
    } else {
        header("Location: dashboard.php?error=Failed to update task.");
    }
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 500px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: inline-block;
            width: 100px;
            font-weight: bold;
        }
        .form-group input, 
        .form-group textarea, 
        .form-group select {
            width: calc(100% - 110px);
            padding: 8px;
            border: 2px solid #ddd;
            border-radius: 5px;
        }
        .form-group textarea {
            height: 60px;
        }
        .btn {
            padding: 10px 30px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background: #0056b3;
        }
        .cancel {
            padding: 10px 30px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .cancel:hover {
            background: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Task</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Title:</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
            </div>
            <div class="form-group">
                <label>Description:</label>
                <textarea name="description"><?php echo htmlspecialchars($task['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label>Priority:</label>
                <select name="priority">
                    <option value="Low" <?php echo $task['priority'] == 'Low' ? 'selected' : ''; ?>>Low</option>
                    <option value="Medium" <?php echo $task['priority'] == 'Medium' ? 'selected' : ''; ?>>Medium</option>
                    <option value="High" <?php echo $task['priority'] == 'High' ? 'selected' : ''; ?>>High</option>
                </select>
            </div>
            <div class="form-group">
                <label>Status:</label>
                <select name="status">
                    <option value="Pending" <?php echo $task['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="In Progress" <?php echo $task['status'] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="Completed" <?php echo $task['status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
            <div style="text-align: center; margin-top: 20px;">
                <button type="submit" name="update_task" class="btn">Update Task</button>
                <a href="dashboard.php" class="cancel">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>