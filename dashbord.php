<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['role']) && $_SESSION['role'] === "admin") {
    header("Location: invoice.php"); // invoice.php
    exit();
}

include("database.php");

$customer_id = $_SESSION['customer_id'];
$fullname     = $_SESSION['fullname'];

// Fetch only this customer's invoices
$sql = "SELECT * FROM invoice WHERE customer_id = '$customer_id' ORDER BY start_date DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-purple-100 min-h-screen">

  <!-- Header -->
  <div class="bg-white shadow-md">
    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-2xl font-bold text-gray-800">
        Welcome, <?= htmlspecialchars($fullname) ?>
      </h1>
      <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-xl font-medium transition">
        Logout
      </a>
    </div>
  </div>

  <!-- Main Content -->
  <div class="max-w-6xl mx-auto mt-10 px-4">
    
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
      
      <!-- Title -->
      <div class="px-8 py-6 border-b border-gray-200 bg-gray-50">
        <h2 class="text-2xl font-bold text-gray-800">My Invoices</h2>
      </div>

      <!-- Table -->
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="bg-gray-50 border-b-2 border-gray-200">
              <th class="px-6 py-4 text-left text-sm font-bold text-gray-600">#</th>
              <th class="px-6 py-4 text-left text-sm font-bold text-gray-600">Description</th>
              <th class="px-6 py-4 text-left text-sm font-bold text-gray-600">Amount</th>
              <th class="px-6 py-4 text-left text-sm font-bold text-gray-600">Start Date</th>
              <th class="px-6 py-4 text-left text-sm font-bold text-gray-600">Expire Date</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">

            <?php
            if (mysqli_num_rows($result) > 0) {
                $count = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <tr class="hover:bg-gray-50">
                      <td class="px-6 py-4">' . $count++ . '</td>
                      <td class="px-6 py-4">' . htmlspecialchars($row['description']) . '</td>
                      <td class="px-6 py-4 font-semibold text-green-600">' . number_format($row['amount'], 2) . '</td>
                      <td class="px-6 py-4">' . htmlspecialchars($row['start_date']) . '</td>
                      <td class="px-6 py-4">' . htmlspecialchars($row['expire_date']) . '</td>
                    </tr>';
                }
            } else {
                echo '
                <tr>
                  <td colspan="5" class="px-6 py-10 text-center text-gray-500 text-lg">
                    No invoices found for your account.
                  </td>
                </tr>';
            }
            ?>

          </tbody>
        </table>
      </div>
    </div>

  </div>

</body>
</html>