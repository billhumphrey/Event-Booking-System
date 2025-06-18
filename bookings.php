<?php
$bookings = [
    [
        'id' => 'KAS-2025-1045',
        'event' => 'Music Concert',
        'name' => 'Jane Mwangi',
        'email' => 'jane@example.com',
        'ticket' => 'VIP',
        'status' => 'confirmed'
    ],
    [
        'id' => 'KAS-2025-1072',
        'event' => 'Sports Match',
        'name' => 'Peter Otieno',
        'email' => 'petero@example.com',
        'ticket' => 'Standard',
        'status' => 'pending'
    ],
    [
        'id' => 'KAS-2025-1098',
        'event' => 'Conference',
        'name' => 'Mary Wairimu',
        'email' => 'maryw@example.com',
        'ticket' => 'Student',
        'status' => 'cancelled'
    ],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bookings - Kasarani Event Management</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f7f9fc;
      margin: 0;
      padding: 20px;
    }
    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #2c3e50;
    }
    .table-container {
      max-width: 1000px;
      margin: 0 auto;
      overflow-x: auto;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    th, td {
      padding: 14px 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #2980b9;
      color: white;
    }
    tr:hover {
      background-color: #f1f1f1;
    }
    .status {
      padding: 6px 10px;
      border-radius: 4px;
      font-weight: 600;
    }
    .confirmed {
      background-color: #d4edda;
      color: #155724;
    }
    .pending {
      background-color: #fff3cd;
      color: #856404;
    }
    .cancelled {
      background-color: #f8d7da;
      color: #721c24;
    }
  </style>
</head>
<body>

  <h2>All Bookings - Kasarani EMS</h2>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>Booking ID</th>
          <th>Event</th>
          <th>User Name</th>
          <th>Email</th>
          <th>Ticket Type</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($bookings as $booking): ?>
        <tr>
          <td><?php echo htmlspecialchars($booking['id']); ?></td>
          <td><?php echo htmlspecialchars($booking['event']); ?></td>
          <td><?php echo htmlspecialchars($booking['name']); ?></td>
          <td><?php echo htmlspecialchars($booking['email']); ?></td>
          <td><?php echo htmlspecialchars($booking['ticket']); ?></td>
          <td>
            <span class="status <?php echo htmlspecialchars($booking['status']); ?>">
              <?php echo ucfirst($booking['status']); ?>
            </span>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</body>
</html>
