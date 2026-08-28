<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            width: 450px;
        }
        
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
        }
        
        fieldset {
            border: 2px solid #f5576c;
            border-radius: 8px;
            padding: 25px;
        }
        
        legend {
            color: #f5576c;
            font-weight: bold;
            font-size: 18px;
            padding: 0 10px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
            box-sizing: border-box;
        }
        
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #f5576c;
            outline: none;
        }
        
        .btn-register {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
        }
        
        .btn-register:hover {
            transform: scale(1.02);
        }
        
        .login-link {
            text-align: center;
            margin-top: 15px;
            color: #555;
        }
        
        .login-link a {
            color: #f5576c;
            text-decoration: none;
            font-weight: bold;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
    
        .alert {
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.5s ease;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 2px solid #f5c6cb;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 2px solid #c3e6cb;
        }
        
        .alert-icon {
            font-size: 20px;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2> Registration</h2>
        
        <fieldset>
            <legend>Register Here...</legend>
            
            <?php 
            
            if (isset($_GET['error'])) {
                echo '<div class="alert alert-error">';
                echo '<span class="alert-icon"></span>';
                echo '<span>' . htmlspecialchars($_GET['error']) . '</span>';
                echo '</div>';
            }
            
            
            if (isset($_GET['success'])) {
                echo '<div class="alert alert-success">';
                echo '<span class="alert-icon"></span>';
                echo '<span>' . htmlspecialchars($_GET['success']) . '</span>';
                echo '</div>';
            }
            ?>

            <form method="POST" action="process.php">
                <div class="form-group">
                    <label> Full Name:</label>
                    <input type="text" name="name" placeholder="Enter Your Full Name" required>
                </div>
                
                <div class="form-group">
                    <label> Email:</label>
                    <input type="email" name="email" placeholder="Enter Your Email" required>
                </div>
                
                <div class="form-group">
                    <label> Password:</label>
                    <input type="password" name="password" placeholder="Minimum 6 characters" required>
                </div>
                
                <button type="submit" name="register" class="btn-register">Register</button>
                
                <div class="login-link">
                    Already have an account? <a href="index.html">Login Here</a>
                </div>
            </form>
        </fieldset>
    </div>
</body>
</html>