
<?php


session_start();
include("database.php");

// Total customers
$customerQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM customers");
$totalCustomers = mysqli_fetch_assoc($customerQuery)['total'];

// Total invoices
$invoiceQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM invoice");
$totalInvoices = mysqli_fetch_assoc($invoiceQuery)['total'];

// Expired invoices
$expiredQuery = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM invoice
     WHERE expire_date < NOW()"
);
$expiredInvoices = mysqli_fetch_assoc($expiredQuery)['total'];

// Invoices expiring within 7 days
$soonQuery = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM invoice
     WHERE expire_date >= NOW()
       AND expire_date <= DATE_ADD(NOW(), INTERVAL 7 DAY)"
);
$expiringSoon = mysqli_fetch_assoc($soonQuery)['total'];

// Sent reminders
$sentQuery = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM reminder
     WHERE sent_at IS NOT NULL"
);
$sentReminders = mysqli_fetch_assoc($sentQuery)['total'];

// Pending reminders
$pendingQuery = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM reminder
     WHERE sent_at IS NULL"
);
$pendingReminders = mysqli_fetch_assoc($pendingQuery)['total'];


// Expiring soon invoices
$soonInvoices = mysqli_query(
    $conn,
    "SELECT
        i.id,
        i.description,
        i.amount,
        i.expire_date,
        c.fullname AS customer_name,
        c.email
     FROM invoice i
     INNER JOIN customers c
        ON i.customer_id = c.id
     WHERE i.expire_date >= NOW()
       AND i.expire_date <= DATE_ADD(NOW(), INTERVAL 7 DAY)
     ORDER BY i.expire_date ASC"
);


// Expired invoices
$expiredList = mysqli_query(
    $conn,
    "SELECT
        i.id,
        i.description,
        i.amount,
        i.expire_date,
        c.fullname AS customer_name,
        c.email
     FROM invoice i
     INNER JOIN customers c
        ON i.customer_id = c.id
     WHERE i.expire_date < NOW()
     ORDER BY i.expire_date DESC"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reports - Client Invoice Reminder System</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-purple-200 min-h-screen py-8">

<div class="max-w-7xl mx-auto px-4">

    <!-- Header -->
     <div class="mb-6 flex items-center justify-between">
    
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            Invoice Reminder Report
        </h2>
        <p class="text-sm text-gray-500">
            View and export client invoice reminders
        </p>
    </div>

    <a href="export_pdf.php"
       class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
        📄 Download PDF
    </a>

</div>
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">

        <div class="flex justify-between items-center">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Reports Dashboard
                </h1>

                <p class="text-gray-600 mt-1">
                    Client Invoice Reminder System
                </p>
            </div>

            <div class="flex gap-3">

                <a href="reminder_management.php"
                   class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-xl">
                    Reminder Management
                </a>

                <a href="invoice.php"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl">
                    Invoices
                </a>

            </div>

        </div>

    </div>


    <!-- Statistics Cards -->

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

        <!-- Customers -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <p class="text-gray-500">Total Customers</p>

            <h2 class="text-4xl font-bold text-blue-600 mt-2">
                <?= $totalCustomers; ?>
            </h2>
        </div>


        <!-- Invoices -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <p class="text-gray-500">Total Invoices</p>

            <h2 class="text-4xl font-bold text-purple-600 mt-2">
                <?= $totalInvoices; ?>
            </h2>
        </div>


        <!-- Expiring Soon -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <p class="text-gray-500">Expiring Within 7 Days</p>

            <h2 class="text-4xl font-bold text-orange-500 mt-2">
                <?= $expiringSoon; ?>
            </h2>
        </div>


        <!-- Expired -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <p class="text-gray-500">Already Expired</p>

            <h2 class="text-4xl font-bold text-red-600 mt-2">
                <?= $expiredInvoices; ?>
            </h2>
        </div>


        <!-- Sent -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <p class="text-gray-500">Reminders Sent</p>

            <h2 class="text-4xl font-bold text-green-600 mt-2">
                <?= $sentReminders; ?>
            </h2>
        </div>


        <!-- Pending -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <p class="text-gray-500">Pending Reminders</p>

            <h2 class="text-4xl font-bold text-yellow-600 mt-2">
                <?= $pendingReminders; ?>
            </h2>
        </div>

    </div>


    <!-- Expiring Soon -->

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">

        <div class="px-6 py-5 bg-gray-50 border-b">
            <h2 class="text-2xl font-bold text-gray-800">
                Invoices Expiring Within 7 Days
            </h2>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-4 text-left">Invoice</th>
                        <th class="px-6 py-4 text-left">Customer</th>
                        <th class="px-6 py-4 text-left">Email</th>
                        <th class="px-6 py-4 text-left">Amount</th>
                        <th class="px-6 py-4 text-left">Expiry Date</th>

                    </tr>

                </thead>

                <tbody class="divide-y">

                <?php if (mysqli_num_rows($soonInvoices) > 0): ?>

                    <?php while ($row = mysqli_fetch_assoc($soonInvoices)): ?>

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">
                                <?= htmlspecialchars($row['description']); ?>
                            </td>

                            <td class="px-6 py-4">
                                <?= htmlspecialchars($row['customer_name']); ?>
                            </td>

                            <td class="px-6 py-4">
                                <?= htmlspecialchars($row['email']); ?>
                            </td>

                            <td class="px-6 py-4">
                                <?= number_format($row['amount'], 2); ?>
                            </td>

                            <td class="px-6 py-4 text-orange-600 font-semibold">
                                <?= htmlspecialchars($row['expire_date']); ?>
                            </td>

                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="5"
                            class="px-6 py-8 text-center text-gray-500">
                            No invoices are expiring within 7 days.
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>


    <!-- Expired Invoices -->

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <div class="px-6 py-5 bg-gray-50 border-b">

            <h2 class="text-2xl font-bold text-red-600">
                Already Expired Invoices
            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-4 text-left">Invoice</th>
                        <th class="px-6 py-4 text-left">Customer</th>
                        <th class="px-6 py-4 text-left">Email</th>
                        <th class="px-6 py-4 text-left">Amount</th>
                        <th class="px-6 py-4 text-left">Expiry Date</th>

                    </tr>

                </thead>

                <tbody class="divide-y">

                <?php if (mysqli_num_rows($expiredList) > 0): ?>

                    <?php while ($row = mysqli_fetch_assoc($expiredList)): ?>

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">
                                <?= htmlspecialchars($row['description']); ?>
                            </td>

                            <td class="px-6 py-4">
                                <?= htmlspecialchars($row['customer_name']); ?>
                            </td>

                            <td class="px-6 py-4">
                                <?= htmlspecialchars($row['email']); ?>
                            </td>

                            <td class="px-6 py-4">
                                <?= number_format($row['amount'], 2); ?>
                            </td>

                            <td class="px-6 py-4 text-red-600 font-semibold">
                                <?= htmlspecialchars($row['expire_date']); ?>
                            </td>

                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="5"
                            class="px-6 py-8 text-center text-gray-500">
                            No expired invoices.
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>

<?php
mysqli_close($conn);
?>

