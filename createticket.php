<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $eventName = htmlspecialchars(trim($_POST['eventName']));
  $userName = htmlspecialchars(trim($_POST['userName']));
  $userEmail = htmlspecialchars(trim($_POST['userEmail']));
  $ticketType = htmlspecialchars($_POST['ticketType']);


  $successMessage = "Ticket for '$eventName' created successfully for $userName ($ticketType).";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kasarani Event Management - Create Ticket</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #eef2f7;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }
    .ticket-form-container {
      background: white;
      padding: 30px 40px;
      border-radius: 8px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      max-width: 400px;
      width: 100%;
    }
    h2 {
      text-align: center;
      color: #34495e;
      margin-bottom: 30px;
      font-weight: 700;
    }
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #2c3e50;
    }
    input[type="text"],
    input[type="email"],
    select {
      width: 100%;
      padding: 10px 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1em;
      box-sizing: border-box;
      transition: border-color 0.3s ease;
    }
    input[type="text"]:focus,
    input[type="email"]:focus,
    select:focus {
      border-color: #2980b9;
      outline: none;
    }
    button {
      width: 100%;
      padding: 14px;
      background-color: #2980b9;
      border: none;
      border-radius: 7px;
      color: white;
      font-size: 18px;
      font-weight: 700;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #21689a;
    }
    .success {
      background-color: #d4edda;
      color: #155724;
      padding: 12px;
      border-radius: 5px;
      margin-bottom: 20px;
      text-align: center;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="ticket-form-container">
    <h2>Create Ticket</h2>

    <?php if (!empty($successMessage)): ?>
      <div class="success"><?php echo $successMessage; ?></div>
    <?php endif; ?>

    <form action="create_ticket.php" method="POST">
      <label for="eventName">Event Name</label>
      <input type="text" id="eventName" name="eventName" placeholder="Enter event name" required />

      <label for="userName">Your Full Name</label>
      <input type="text" id="userName" name="userName" placeholder="Enter your full name" required />

      <label for="userEmail">Email Address</label>
      <input type="email" id="userEmail" name="userEmail" placeholder="Enter your email" required />

      <label for="ticketType">Ticket Type</label>
      <select id="ticketType" name="ticketType" required>
        <option value="" disabled selected>Select ticket type</option>
        <option value="standard">Standard</option>
        <option value="vip">VIP</option>
        <option value="student">Student</option>
      </select>

      <button type="submit">Create Ticket</button>
    </form>
  </div>

</body>
</html>
