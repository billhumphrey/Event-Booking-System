<?php
// db.php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'kasarani_ems';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$eventCount = $conn->query("SELECT COUNT(*) as total FROM events")->fetch_assoc()['total'];
$registrationCount = $conn->query("SELECT COUNT(*) as total FROM tickets")->fetch_assoc()['total'];
$paymentSum = $conn->query("SELECT SUM(amount) as total FROM payments")->fetch_assoc()['total'];
$activeUsers = $conn->query("SELECT COUNT(*) as total FROM users WHERE status = 'active'")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kasarani EMS - Dashboard</title>
  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f6f8;
      color: #333;
      display: flex;
      height: 100vh;
      overflow: hidden;
    }
    .sidebar {
      width: 250px;
      background-color: #2c3e50;
      color: #ecf0f1;
      display: flex;
      flex-direction: column;
      padding: 20px;
    }
    .sidebar h2 {
      margin: 0 0 30px 0;
      font-weight: 700;
      font-size: 1.8em;
      text-align: center;
      letter-spacing: 2px;
    }
    .sidebar nav a {
      color: #bdc3c7;
      text-decoration: none;
      padding: 12px 15px;
      margin-bottom: 10px;
      border-radius: 5px;
      font-weight: 600;
      display: block;
      transition: background-color 0.3s ease;
    }
    .sidebar nav a:hover,
    .sidebar nav a.active {
      background-color: #2980b9;
      color: #fff;
    }
    .main-content {
      flex: 1;
      padding: 30px 40px;
      overflow-y: auto;
    }
    .header {
      font-size: 1.6em;
      font-weight: 700;
      margin-bottom: 30px;
      color: #34495e;
    }
    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 25px;
    }
    .card {
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .card h3 {
      margin: 0 0 12px 0;
      font-weight: 700;
      color: #2980b9;
    }
    .card p {
      font-size: 2em;
      font-weight: 700;
      margin: 0;
      color: #2c3e50;
      text-align: center;
    }
    .welcome {
      margin-top: 40px;
      padding: 25px;
      background-color: #d6eaf8;
      border-radius: 8px;
      color: #2c3e50;
      font-size: 1.2em;
      text-align: center;
      font-weight: 600;
      box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
    }
    @media (max-width: 700px) {
      body { flex-direction: column; }
      .sidebar {
        width: 100%;
        flex-direction: row;
        overflow-x: auto;
        padding: 10px;
      }
      .sidebar h2 {
        flex: 1;
        text-align: left;
        font-size: 1.3em;
        margin: 0 10px 0 0;
      }
      .sidebar nav {
        display: flex;
        gap: 10px;
      }
      .sidebar nav a {
        padding: 10px 15px;
        margin-bottom: 0;
      }
      .main-content {
        padding: 20px;
        height: calc(100vh - 60px);
      }
      .cards {
        grid-template-columns: 1fr 1fr;
      }
    }
  </style>
</head>
<body>

  <aside class="sidebar">
    <h2>Kasarani EMS</h2>
    <nav>
      <a href="dashboard.php" class="active">Dashboard</a>
      <a href="events.php">Events</a>
      <a href="bookings.php">Bookings</a>
      <a href="payments.php">Payments</a>
      <a href="users.php">Users</a>
      <a href="settings.php">Settings</a>
      <a href="logout.php">Logout</a>
    </nav>
  </aside>

  <main class="main-content">
    <div class="header">Dashboard</div>

    <div class="cards">
      <div class="card">
        <h3>Upcoming Events</h3>
        <p><?= $eventCount ?></p>
      </div>
      <div class="card">
        <h3>Registrations</h3>
        <p><?= $registrationCount ?></p>
      </div>
      <div class="card">
        <h3>Payments Received</h3>
        <p>KES <?= number_format($paymentSum) ?></p>
      </div>
      <div class="card">
        <h3>Active Users</h3>
        <p><?= $activeUsers ?></p>
      </div>
    </div>

    <section class="welcome">
      Welcome to the Kasarani Event Management System dashboard! Monitor events, registrations, payments, and users here.
    </section>
  </main>

</body>
</html>   