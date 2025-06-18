<?php

require_once 'db.php';

$ticket = null;
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ticketId = trim($_POST['ticketId'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($ticketId && $email) {
        $stmt = $conn->prepare("SELECT * FROM tickets WHERE ticket_id = ? AND email = ?");
        $stmt->bind_param("ss", $ticketId, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $ticket = $result->fetch_assoc();
        } else {
            $error = "No ticket found with that Ticket ID and Email.";
        }

        $stmt->close();
    } else {
        $error = "Please provide both Ticket ID and Email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Retrieve Ticket</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #eef2f5;
      padding: 20px;
      margin: 0;
    }
    .container {
      max-width: 700px;
      background: #fff;
      margin: 40px auto;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #2c3e50;
    }
    .ticket-box {
      margin-top: 25px;
      padding: 20px;
      background: #ecf0f1;
      border-left: 5px solid #2980b9;
      border-radius: 5px;
    }
    .error {
      background: #f8d7da;
      color: #721c24;
      border-left: 5px solid #f5c6cb;
      padding: 15px;
      margin-top: 20px;
      border-radius: 5px;
    }
    .back-link {
      margin-top: 20px;
      display: inline-block;
      color: #2980b9;
      text-decoration: none;
    }
    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
<div class="container">
  <h2>Your Ticket</h2>

  <?php if ($error): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
  <?php elseif ($ticket): ?>
    <div class="ticket-box">
      <p><strong>Ticket ID:</strong> <?= htmlspecialchars($ticket['ticket_id']) ?></p>
      <p><strong>Name:</strong> <?= htmlspecialchars($ticket['name']) ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($ticket['email']) ?></p>
      <p><strong>Event:</strong> <?= htmlspecialchars($ticket['event']) ?></p>
      <p><strong>Date Issued:</strong> <?= htmlspecialchars($ticket['issued_at']) ?></p>
    </div>
  <?php else: ?>
    <p>Enter your Ticket ID and Email above to retrieve your ticket.</p>
  <?php endif; ?>

  <a href="ticket.html" class="back-link">&larr; Back to Ticket Page</a>
</div>
</body>
</html>
