<?php
// Include database connection
require_once 'db.php';

$success = "";
$error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $paymentMethod = $_POST['paymentMethod'] ?? '';
    $cardname = trim($_POST['cardname'] ?? '');
    $cardnumber = trim($_POST['cardnumber'] ?? '');
    $expdate = $_POST['expdate'] ?? '';
    $amount = $_POST['amount'] ?? 0;

    // Basic validation
    if ($paymentMethod && $cardname && $cardnumber && $expdate && $amount > 0) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO payments (payment_method, name, national_id, date_created, amount, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssssd", $paymentMethod, $cardname, $cardnumber, $expdate, $amount);

        if ($stmt->execute()) {
            $success = "Payment submitted successfully!";
        } else {
            $error = "Database error: " . $stmt->error;
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
  <title>Kasarani Event Management - Payment</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eef2f7;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 500px;
      background: white;
      margin: 60px auto;
      padding: 30px 40px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 25px;
    }
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #34495e;
    }
    input, select {
      width: 100%;
      padding: 10px 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 1em;
      box-sizing: border-box;
    }
    button {
      width: 100%;
      padding: 12px;
      background-color: #27ae60;
      color: white;
      font-size: 18px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #219150;
    }
    .footer {
      text-align: center;
      margin-top: 20px;
      font-size: 0.9em;
      color: #7f8c8d;
    }
    .message {
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 20px;
      text-align: center;
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
  <h2>Kasarani Event Payment</h2>

  <?php if ($success): ?>
    <div class="message success"><?= $success ?></div>
  <?php elseif ($error): ?>
    <div class="message error"><?= $error ?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <label for="paymentMethod">Payment Method</label>
    <select id="paymentMethod" name="paymentMethod" required>
      <option value="" disabled selected>-- Select Payment Method --</option>
      <option value="credit_card">Credit Card</option>
      <option value="mobile_money">Mobile Money (e.g. M-Pesa)</option>
      <option value="paypal">PayPal</option>
      <option value="bank_transfer">Bank Transfer</option>
    </select>

    <label for="cardname">Full Name</label>
    <input type="text" id="cardname" name="cardname" placeholder="Your Full Name" required />

    <label for="cardnumber">National ID</label>
    <input type="text" id="cardnumber" name="cardnumber" placeholder="Your National ID" pattern="\d{6,}" title="Enter a valid ID number" required />

    <label for="expdate">Date Created</label>
    <input type="month" id="expdate" name="expdate" min="2025-06" required />

    <label for="amount">Amount (KES)</label>
    <input type="number" id="amount" name="amount" placeholder="Enter amount" min="1" required />

    <button type="submit">Pay Now</button>
  </form>
</div>

<div class="footer">
  &copy; 2025 Kasarani Event Management System
</div>

</body>
</html>
