<?php

session_start();

$successMessage = '';
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ticketId = trim($_POST['ticketId'] ?? '');
    $approvalStatus = $_POST['approvalStatus'] ?? '';

    if (!empty($ticketId) && in_array($approvalStatus, ['approved', 'rejected'])) {
        
        $successMessage = "Ticket ID <strong>" . htmlspecialchars($ticketId) . "</strong> has been <strong>" . htmlspecialchars($approvalStatus) . "</strong>.";
    } else {
        $errorMessage = "Please fill all fields correctly.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kasarani Event Management - Approve Ticket</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f3f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .approval-container {
      background: white;
      padding: 30px 35px;
      border-radius: 8px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.1);
      width: 360px;
    }
    h2 {
      text-align: center;
      color: #34495e;
      margin-bottom: 25px;
      font-weight: 700;
    }
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #2c3e50;
    }
    input[type="text"],
    select {
      width: 100%;
      padding: 10px 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 1em;
      box-sizing: border-box;
      transition: border-color 0.3s ease;
    }
    input[type="text"]:focus,
    select:focus {
      border-color: #2980b9;
      outline: none;
    }
    button {
      width: 100%;
      padding: 12px;
      background-color: #2761ae;
      color: white;
      font-size: 18px;
      font-weight: 700;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #212c91;
    }
    .message {
      text-align: center;
      margin-bottom: 20px;
      padding: 10px;
      border-radius: 6px;
      font-size: 0.95em;
    }
    .success {
      background-color: #e0f9e0;
      color: #2d7a2d;
    }
    .error {
      background-color: #fbe3e3;
      color: #b03e3e;
    }
  </style>
</head>
<body>

  <div class="approval-container">
    <h2>Approve Ticket</h2>

    <?php if ($successMessage): ?>
      <div class="message success"><?php echo $successMessage; ?></div>
    <?php elseif ($errorMessage): ?>
      <div class="message error"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <label for="ticketId">Ticket ID</label>
      <input type="text" id="ticketId" name="ticketId" placeholder="Enter Ticket ID" required />

      <label for="approvalStatus">Approval Status</label>
      <select id="approvalStatus" name="approvalStatus" required>
        <option value="" disabled selected>-- Select Status --</option>
        <option value="approved">Approve</option>
        <option value="rejected">Reject</option>
      </select>

      <button type="submit">Submit</button>
    </form>
  </div>

</body>
</html>
