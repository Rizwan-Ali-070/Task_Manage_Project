<?php
session_start();
include("db/connection.php");


if(!isset($_SESSION['user_id'])){
    header("Location: index.html");
    exit();
}


$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM task WHERE user_id = '$user_id' ORDER BY id DESC";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Tasks</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .header h1 {
            color: #333;
        }
        .header h1 span {
            color: #667eea;
        }
        .logout-btn {
            background: #dc3545;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        .logout-btn:hover {
            background: #c82333;
        }
        
        
        .task-form {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
            border: 2px solid #667eea;
        }
        .task-form h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: inline-block;
            width: 120px;
            font-weight: bold;
            color: #555;
        }
        .form-group input, 
        .form-group textarea, 
        .form-group select {
            width: calc(100% - 130px);
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-group textarea {
            height: 60px;
            resize: vertical;
        }
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #667eea;
            outline: none;
        }
        .submit-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 40px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        .submit-btn:hover {
            opacity: 0.9;
        }
        
        .tasks-section h2 {
            color: #333;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th {
            background: #667eea;
            color: white;
            padding: 12px;
            text-align: left;
        }
        table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        table tr:hover {
            background: #f5f5f5;
        }
        .status-pending {
            color: #ff9800;
            font-weight: bold;
        }
        .status-inprogress {
            color: #2196F3;
            font-weight: bold;
        }
        .status-completed {
            color: #4CAF50;
            font-weight: bold;
        }
        .priority-high {
            color: #dc3545;
            font-weight: bold;
        }
        .priority-medium {
            color: #ff9800;
            font-weight: bold;
        }
        .priority-low {
            color: #4CAF50;
            font-weight: bold;
        }
        .btn {
            padding: 5px 12px;
            border-radius: 3px;
            text-decoration: none;
            font-size: 12px;
            display: inline-block;
            margin: 2px;
        }
        .btn-complete {
            background: #28a745;
            color: white;
        }
        .btn-edit {
            background: #007bff;
            color: white;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        .btn-complete:hover {
            background: #218838;
        }
        .btn-edit:hover {
            background: #0056b3;
        }
        .btn-delete:hover {
            background: #c82333;
        }
        .no-tasks {
            text-align: center;
            padding: 30px;
            color: #999;
            font-size: 18px;
        }
        
       
        .alert {
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 2px solid #c3e6cb;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 2px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
       
        <div class="header">
            <h1>Welcome <span><?php echo htmlspecialchars($_SESSION['name']); ?></span></h1>
            <a href="logout.php" class="logout-btn"> Logout</a>
        </div>
        
        
        <?php if(isset($_GET['success'])){ ?>
            <div class="alert alert-success"> <?php echo htmlspecialchars($_GET['success']); ?></div>
        <?php } ?>
        
        <?php if(isset($_GET['error'])){ ?>
            <div class="alert alert-error"> <?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php } ?>
        
        <div class="task-form">
            <h2> Create New Task</h2>
            <form method="POST" action="add_task.php">
                <div class="form-group">
                    <label>Title:</label>
                    <input type="text" name="title" placeholder="Enter task title..." required>
                </div>
                <div class="form-group">
                    <label>Description:</label>
                    <textarea name="description" placeholder="Enter task description..."></textarea>
                </div>
                <div class="form-group">
                    <label>Priority:</label>
                    <select name="priority" required>
                        <option value="Low">Low</option>
                        <option value="Medium" selected>Medium</option>
                        <option value="High">High</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status:</label>
                    <select name="status" required>
                        <option value="Pending">Pending</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
                <div style="text-align: center;">
                    <button type="submit" name="submit_task" class="submit-btn"> Add Task</button>
                </div>
            </form>
        </div>
        
      
        <div class="tasks-section">
            <h2> My Tasks</h2>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($result) > 0){ ?>
                        <?php $count = 1; while($task = mysqli_fetch_assoc($result)){ ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo htmlspecialchars($task['title']); ?></td>
                                <td><?php echo htmlspecialchars($task['description']); ?></td>
                                <td class="priority-<?php echo strtolower($task['priority']); ?>">
                                    <?php echo htmlspecialchars($task['priority']); ?>
                                </td>
                            
                              
                                <td>
                                  <?php 
                                     $status = isset($task['status']) && !empty($task['status']) ? $task['status'] : 'Pending';
                                     echo htmlspecialchars($status);
                                   ?>
                                </td>

                                <td><?php echo date('d-m-Y', strtotime($task['created_at'])); ?></td>
                                <td>
                                    <?php if(isset($task['status']) && $task['status'] != 'Completed'){ ?>
                                        <a href="update_status.php?id=<?php echo $task['id']; ?>" class="btn btn-complete"> Complete</a>
                                    <?php } ?>
                                    <a href="edit_task.php?id=<?php echo $task['id']; ?>" class="btn btn-edit"> Edit</a>
                                    <a href="delete_task.php?id=<?php echo $task['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                 <?php }else{ ?>
                        <tr>
                            <td colspan="7" class="no-tasks"> No tasks found. Create your first task above!</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>