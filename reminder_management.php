
<?php

session_start();
include("database.php");

$message = "";
$error = "";

// Delete reminder
if (isset($_POST['delete_reminder'])) {

    $reminder_id = (int)$_POST['reminder_id'];

    $deleteSql = "DELETE FROM reminder WHERE id = ?";
    $stmt = mysqli_prepare($conn, $deleteSql);

    mysqli_stmt_bind_param($stmt, "i", $reminder_id);

    if (mysqli_stmt_execute($stmt)) {
        $message = "Reminder deleted successfully.";
    } else {
        $error = "Failed to delete reminder.";
    }

    mysqli_stmt_close($stmt);
}


// Get reminders
$sql = "
    SELECT
        r.id AS reminder_id,
        r.invoice_id,
        r.channel,
        r.reminder_type,
        r.day_before,
        r.schedule_date,
        r.sent_at,

        i.description,
        i.amount,
        i.expire_date,

        c.fullname AS customer_name,
        c.email AS customer_email

    FROM reminder AS r

    INNER JOIN invoice AS i
        ON r.invoice_id = i.id

    INNER JOIN customers AS c
        ON i.customer_id = c.id

    ORDER BY r.schedule_date ASC
";

$result = mysqli_query($conn, $sql);

if (!$result) {
    $error = "Query failed: " . mysqli_error($conn);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Reminder Management</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-purple-200 min-h-screen py-8">


<div class="max-w-7xl mx-auto px-4">


    <!-- Header -->

    <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">

        <div class="flex justify-between items-center">

            <div>

                <h1 class="text-3xl font-bold text-gray-800">
                    Reminder Management
                </h1>

                <p class="text-gray-600 mt-1">
                    View and manage invoice reminders
                </p>

            </div>


            <div class="flex gap-3">

                <a href="reports.php"
                   class="bg-purple-600 hover:bg-purple-700
                          text-white px-5 py-2 rounded-xl">

                    Reports

                </a>


                <a href="invoice.php"
                   class="bg-blue-600 hover:bg-blue-700
                          text-white px-5 py-2 rounded-xl">

                    Invoices

                </a>

            </div>

        </div>

    </div>


    <!-- Messages -->

    <?php if ($message): ?>

        <div class="bg-green-100 border border-green-300
                    text-green-700 px-5 py-4 rounded-xl mb-6">

            <?= htmlspecialchars($message); ?>

        </div>

    <?php endif; ?>


    <?php if ($error): ?>

        <div class="bg-red-100 border border-red-300
                    text-red-700 px-5 py-4 rounded-xl mb-6">

            <?= htmlspecialchars($error); ?>

        </div>

    <?php endif; ?>


    <!-- Reminder Table -->

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">


        <div class="px-6 py-5 bg-gray-50 border-b">

            <h2 class="text-2xl font-bold text-gray-800">

                All Reminders

            </h2>

        </div>


        <div class="overflow-x-auto">


            <table class="w-full">


                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-4 py-4 text-left">
                            S/N
                        </th>

                        <th class="px-4 py-4 text-left">
                            Customer
                        </th>

                        <th class="px-4 py-4 text-left">
                            Email
                        </th>

                        <th class="px-4 py-4 text-left">
                            Invoice
                        </th>

                        <th class="px-4 py-4 text-left">
                            Amount
                        </th>

                        <th class="px-4 py-4 text-left">
                            Type
                        </th>

                        <th class="px-4 py-4 text-left">
                            Days
                        </th>

                        <th class="px-4 py-4 text-left">
                            Channel
                        </th>

                        <th class="px-4 py-4 text-left">
                            Schedule
                        </th>

                        <th class="px-4 py-4 text-left">
                            Status
                        </th>

                        <th class="px-4 py-4 text-left">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y">


                <?php if ($result && mysqli_num_rows($result) > 0): ?>


                    <?php

                    $count = 1;

                    while ($row = mysqli_fetch_assoc($result)):

                    ?>


                    <tr class="hover:bg-gray-50">


                        <!-- Number -->

                        <td class="px-4 py-4">

                            <?= $count++; ?>

                        </td>


                        <!-- Customer -->

                        <td class="px-4 py-4 font-medium">

                            <?= htmlspecialchars(
                                $row['customer_name']
                            ); ?>

                        </td>


                        <!-- Email -->

                        <td class="px-4 py-4">

                            <?= htmlspecialchars(
                                $row['customer_email']
                            ); ?>

                        </td>


                        <!-- Invoice -->

                        <td class="px-4 py-4">

                            <?= htmlspecialchars(
                                $row['description']
                            ); ?>

                        </td>


                        <!-- Amount -->

                        <td class="px-4 py-4">

                            <?= number_format(
                                $row['amount'],
                                2
                            ); ?>

                        </td>


                        <!-- Type -->

                        <td class="px-4 py-4">

                            <?php

                            if ($row['day_before'] > 0) {

                                echo "Before Expiry";

                            } else {

                                echo "Expiry Date";

                            }

                            ?>

                        </td>


                        <!-- Days -->

                        <td class="px-4 py-4">

                            <?php

                            if ($row['day_before'] > 0) {

                                echo $row['day_before']
                                    . " day(s)";

                            } else {

                                echo "Today";

                            }

                            ?>

                        </td>


                        <!-- Channel -->

                        <td class="px-4 py-4">

                            <span class="bg-blue-100
                                         text-blue-700
                                         px-3 py-1
                                         rounded-full">

                                <?= htmlspecialchars(
                                    $row['channel']
                                ); ?>

                            </span>

                        </td>


                        <!-- Schedule -->

                        <td class="px-4 py-4">

                            <?= htmlspecialchars(
                                $row['schedule_date']
                            ); ?>

                        </td>


                        <!-- Status -->

                        <td class="px-4 py-4">

                            <?php if ($row['sent_at'] !== null): ?>


                                <span class="bg-green-100
                                             text-green-700
                                             px-3 py-1
                                             rounded-full">

                                    Sent

                                </span>


                                <div class="text-xs text-gray-500 mt-1">

                                    <?= htmlspecialchars(
                                        $row['sent_at']
                                    ); ?>

                                </div>


                            <?php else: ?>


                                <span class="bg-yellow-100
                                             text-yellow-700
                                             px-3 py-1
                                             rounded-full">

                                    Pending

                                </span>


                            <?php endif; ?>

                        </td>


                        <!-- Action -->

                        <td class="px-4 py-4">


                            <form method="POST"
                                  onsubmit="return confirm(
                                      'Are you sure you want to delete this reminder?'
                                  );">


                                <input
                                    type="hidden"
                                    name="reminder_id"
                                    value="<?= $row['reminder_id']; ?>"
                                >


                                <button
                                    type="submit"
                                    name="delete_reminder"
                                    class="bg-red-600
                                           hover:bg-red-700
                                           text-white
                                           px-3 py-2
                                           rounded-lg">

                                    Delete

                                </button>


                            </form>


                        </td>


                    </tr>


                    <?php endwhile; ?>


                <?php else: ?>


                    <tr>

                        <td colspan="11"
                            class="px-6 py-10
                                   text-center
                                   text-gray-500">

                            No reminders found.

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

