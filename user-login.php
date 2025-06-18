<?php
session_start();
require_once 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (!empty($email) && !empty($password)) {
    
        $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];

                
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "User not found.";
        }

        $stmt->close();
    } else {
        $error = "Please enter both email and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Error</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f8f8;
      padding: 40px;
      text-align: center;
    }
    .error-box {
      background: #ffe6e6;
      color: #b30000;
      display: inline-block;
      padding: 20px 30px;
      border-radius: 8px;
      border-left: 6px solid #e60000;
    }
    a {
      display: block;
      margin-top: 20px;
      color: #2980b9;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="error-box">
    <strong>Error:</strong> <?= isset($error) ? htmlspecialchars($error) : 'Something went wrong.' ?>
  </div>
  <a href="login.html">← Back to Login</a>
</body>
</html>
