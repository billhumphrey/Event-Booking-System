<?php
require_once 'db.php';


$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $event = $_POST['event'] ?? '';

    if ($fullname && $email && $phone && $event) {
        $stmt = $conn->prepare("INSERT INTO registrations (fullname, email, phone, event_type, registered_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssss", $fullname, $email, $phone, $event);

        if ($stmt->execute()) {
            $success = "Registration successful!";
        } else {
            $error = "Error saving registration: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error = "Please fill in all fields correctly.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kasarani Event Management - Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            background: white;
            margin: 50px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #34495e;
        }
        input, select {
            width: 100%;
            padding: 8px 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            margin-top: 25px;
            width: 100%;
            padding: 10px;
            background-color: #2740ae;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #244a83;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #7f8c8d;
        }
        .message {
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            font-weight: bold;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Event Registration</h2>

    <?php if ($success): ?>
        <div class="message success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="message error"><?= $error ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required />

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required />

        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" placeholder="e.g. +254712345678" pattern="^\+254\d{9}$" title="Phone number must start with +254 followed by 9 digits" required />

        <label for="event">Select Event</label>
        <select id="event" name="event" required>
            <option value="">-- Choose an event --</option>
            <option value="music_concert">Music concert</option>
            <option value="sport_match">Sport match</option>
            <option value="conference">Conference</option>
        </select>

        <button type="submit">Register</button>
    </form>

    <div class="footer">
        &copy; 2025 Kasarani Event Management System
    </div>
</div>

</body>
</html>
