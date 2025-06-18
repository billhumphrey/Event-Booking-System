<?php
$successMessage = '';
$errorMessage = '';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $event   = trim($_POST['event'] ?? '');
    $date    = $_POST['date'] ?? '';
    $tickets = intval($_POST['tickets'] ?? 0);

    if (
        $name && filter_var($email, FILTER_VALIDATE_EMAIL) && $phone &&
        $event && $date && $tickets > 0
    ) {
        $successMessage = "Booking successful for <strong>" . htmlspecialchars($event) . "</strong> on <strong>" . htmlspecialchars($date) . "</strong>.";
    } else {
        $errorMessage = "Please fill out the form correctly.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Book Event</title>
  <style>
    body {
      font-family: Arial;
      background-color: #f9f9f9;
    }
    form {
      background: #152466;
      padding: 20px;
      width: 300px;
      margin: 40px auto;
      box-shadow: 0 0 10px #615959;
      color: white;
    }
    input, select, button {
      width: 100%;
      padding: 8px;
      margin: 8px 0;
      box-sizing: border-box;
    }
    .error {
      color: red;
      font-size: 0.9em;
      margin-top: 10px;
    }
    .success {
      background: #d4edda;
      color: #155724;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 5px;
    }
    h2 {
      text-align: center;
    }
  </style>
</head>
<body>

<form method="POST" action="">
  <h2>Book Event</h2>

  <?php if ($successMessage): ?>
    <div class="success"><?php echo $successMessage; ?></div>
  <?php elseif ($errorMessage): ?>
    <div class="error"><?php echo $errorMessage; ?></div>
  <?php endif; ?>

  <input type="text" name="name" id="name" placeholder="Full Name" required value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
  <input type="email" name="email" id="email" placeholder="Email Address" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
  <input type="tel" name="phone" id="phone" placeholder="Phone Number" required value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">

  <select name="event" id="event" required>
    <option value="">-- Select Event --</option>
    <option value="Music Concert" <?php if ($_POST['event'] ?? '' === 'Music Concert') echo 'selected'; ?>>Music Concert</option>
    <option value="Sports Match" <?php if ($_POST['event'] ?? '' === 'Sports Match') echo 'selected'; ?>>Sports Match</option>
    <option value="Conference" <?php if ($_POST['event'] ?? '' === 'Conference') echo 'selected'; ?>>Conference</option>
  </select>

  <input type="date" name="date" id="date" required value="<?php echo htmlspecialchars($_POST['date'] ?? ''); ?>">
  <input type="number" name="tickets" id="tickets" placeholder="Number of Tickets" required value="<?php echo htmlspecialchars($_POST['tickets'] ?? ''); ?>">

  <button type="submit">Book Now</button>
</form>

</body>
</html>
