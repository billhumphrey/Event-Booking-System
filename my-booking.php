<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM tickets WHERE user_id = ? ORDER BY id DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$booking = $result->fetch_assoc();

if (!$booking) {
  die("No bookings found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Booking - Kasarani Event Management</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f2f6fa;
      margin: 0;
      padding: 20px;
    }
    .booking-container {
      max-width: 600px;
      background: white;
      margin: 40px auto;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 6px 16px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 25px;
    }
    .booking-details {
      line-height: 1.8;
      font-size: 1.1em;
      color: #34495e;
    }
    .label {
      font-weight: 600;
      color: #2980b9;
    }
    .status {
      padding: 6px 12px;
      display: inline-block;
      border-radius: 5px;
      font-weight: bold;
      background-color: #d4edda;
      color: #155724;
    }
    .btn {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 16px;
      background-color: #2980b9;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }
    .btn:hover {
      background-color: #21689a;
    }
  </style>
</head>
<body>

  <div class="booking-container">
    <h2>My Booking</h2>

    <div class="booking-details">
      <p><span class="label">Event Name:</span> <?= htmlspecialchars($booking['event_name']) ?></p>
      <p><span class="label">Date:</span> <?= date("F j, Y", strtotime($booking['event_date'])) ?></p>
      <p><span class="label">Venue:</span> <?= htmlspecialchars($booking['venue']) ?></p>
      <p><span class="label">Ticket Type:</span> <?= htmlspecialchars($booking['ticket_type']) ?></p>
      <p><span class="label">Ticket ID:</span> <?= htmlspecialchars($booking['ticket_id']) ?></p>
      <p><span class="label">Status:</span> <span class="status"><?= ucfirst($booking['status']) ?></span></p>
    </div>

    <a class="btn" href="download-ticket.php?ticket_id=<?= urlencode($booking['ticket_id']) ?>">Download Ticket</a>
  </div>

</body>
</html>
