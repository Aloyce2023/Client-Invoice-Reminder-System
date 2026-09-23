
<?php

session_start();
require("database.php");

$message = "";
$error = "";



$customer_id = 0;

if (isset($_POST['customer_id'])) {
    $customer_id = (int)$_POST['customer_id'];
}

if ($customer_id <= 0) {
    $error = "Invalid customer selected.";
}


//CREATE INVOICE

if (isset($_POST["update"]) && $customer_id > 0) {

    $description = trim($_POST['description'] ?? '');
    $amount = trim($_POST['amount'] ?? '');
    $start_date = $_POST['start_date'] ?? '';
    $expire_date = $_POST['expire_date'] ?? '';


    // VALIDATION
    

    if (
        empty($description) ||
        empty($amount) ||
        empty($start_date) ||
        empty($expire_date)
    ) {

        $error = "Please fill all fields.";

    } elseif (!is_numeric($amount)) {

        $error = "Amount must be a valid number.";

    } elseif ($expire_date < $start_date) {

        $error = "Expire date cannot be before the start date.";

    } else {


        // ESCAPE VALUES
      

        $description = mysqli_real_escape_string(
            $conn,
            $description
        );

        $amount = mysqli_real_escape_string(
            $conn,
            $amount
        );

        $start_date = mysqli_real_escape_string(
            $conn,
            $start_date
        );

        $expire_date = mysqli_real_escape_string(
            $conn,
            $expire_date
        );


        // INSERT INVOICE
        

        $sql = "
            INSERT INTO invoice
            (
                description,
                amount,
                start_date,
                expire_date,
                customer_id
            )
            VALUES
            (
                '$description',
                '$amount',
                '$start_date',
                '$expire_date',
                '$customer_id'
            )
        ";


        $result = mysqli_query($conn, $sql);


        if ($result) {


            
            // GET NEW INVOICE ID
            

            $invoice_id = mysqli_insert_id($conn);


            
          // CREATE REMINDERS
            

            $reminder_days = [7, 3, 1, 0];

            $all_reminders_created = true;


            foreach ($reminder_days as $days) {


                // CALCULATE SCHEDULE DATE
                

                if ($days > 0) {

                    $schedule_date = date(
                        "Y-m-d H:i:s",
                        strtotime(
                            $expire_date . " -" . $days . " days"
                        )
                    );

                    $reminder_type = "Before Expiry";

                } else {

                    $schedule_date = $expire_date . " 00:00:00";

                    $reminder_type = "Expiry Date";

                }


                // ESCAPE VALUES
                

                $reminder_type = mysqli_real_escape_string(
                    $conn,
                    $reminder_type
                );

                $schedule_date = mysqli_real_escape_string(
                    $conn,
                    $schedule_date
                );


                
                // INSERT REMINDER
                

                $reminderSql = "
                    INSERT INTO reminder
                    (
                        invoice_id,
                        channel,
                        reminder_type,
                        day_before,
                        schedule_date,
                        sent_at
                    )
                    VALUES
                    (
                        '$invoice_id',
                        'email',
                        '$reminder_type',
                        '$days',
                        '$schedule_date',
                        NULL
                    )
                ";


                $reminderResult = mysqli_query(
                    $conn,
                    $reminderSql
                );


                if (!$reminderResult) {

                    $all_reminders_created = false;

                    $error = "Invoice was created, but a reminder could not be created: "
                           . mysqli_error($conn);

                    break;
                }

            }


        // SUCCESS
            

            if ($all_reminders_created) {

                $message = "Invoice created successfully. "
                         . "7-day, 3-day, 1-day and expiry-day reminders "
                         . "were created.";

            }


        } else {

            $error = "Failed to create invoice: "
                   . mysqli_error($conn);

        }

    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Create Invoice</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-purple-200 min-h-screen flex items-center justify-center py-10">


<div class="w-full max-w-2xl px-4">


    <div class="bg-white rounded-2xl shadow-lg p-8">


        <!-- Header -->

        <div class="mb-6">

            <h2 class="text-3xl font-bold text-gray-800">

                Create Invoice

            </h2>

            <p class="text-gray-600 mt-2">

                Create an invoice and automatically schedule reminders.

            </p>

        </div>


        <!-- Error -->

        <?php if ($error): ?>

            <div class="bg-red-100 border border-red-300
                        text-red-700 px-4 py-3
                        rounded-xl mb-6">

                <?= htmlspecialchars($error); ?>

            </div>

        <?php endif; ?>


        <!-- Success -->

        <?php if ($message): ?>

            <div class="bg-green-100 border border-green-300
                        text-green-700 px-4 py-3
                        rounded-xl mb-6">

                <?= htmlspecialchars($message); ?>

            </div>

        <?php endif; ?>


        <!-- Form -->

        <form method="POST" class="space-y-6">


            <!-- Customer ID -->

            <input
                type="hidden"
                name="customer_id"
                value="<?= htmlspecialchars($customer_id); ?>"
            >


            <!-- Description -->

            <div>

                <label class="block text-sm font-medium
                              text-gray-700 mb-2">

                    Invoice Description

                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="w-full px-4 py-3
                           border border-gray-300
                           rounded-xl
                           focus:outline-none
                           focus:ring-2
                           focus:ring-blue-500"
                    placeholder="Enter invoice description"
                ><?= htmlspecialchars($_POST['description'] ?? ''); ?></textarea>

            </div>


            <!-- Amount -->

            <div>

                <label class="block text-sm font-medium
                              text-gray-700 mb-2">

                    Amount

                </label>

                <input
                    type="number"
                    step="0.01"
                    name="amount"
                    value="<?= htmlspecialchars($_POST['amount'] ?? ''); ?>"
                    class="w-full px-4 py-3
                           border border-gray-300
                           rounded-xl
                           focus:outline-none
                           focus:ring-2
                           focus:ring-blue-500"
                    placeholder="Enter invoice amount"
                >

            </div>


            <!-- Start Date -->

            <div>

                <label class="block text-sm font-medium
                              text-gray-700 mb-2">

                    Start Date

                </label>

                <input
                    type="date"
                    name="start_date"
                    value="<?= htmlspecialchars(
                        $_POST['start_date'] ?? date('Y-m-d')
                    ); ?>"
                    class="w-full px-4 py-3
                           border border-gray-300
                           rounded-xl
                           focus:outline-none
                           focus:ring-2
                           focus:ring-blue-500"
                >

            </div>


            <!-- Expire Date -->

            <div>

                <label class="block text-sm font-medium
                              text-gray-700 mb-2">

                    Expire Date

                </label>

                <input
                    type="date"
                    name="expire_date"
                    value="<?= htmlspecialchars(
                        $_POST['expire_date'] ?? ''
                    ); ?>"
                    class="w-full px-4 py-3
                           border border-gray-300
                           rounded-xl
                           focus:outline-none
                           focus:ring-2
                           focus:ring-blue-500"
                >

            </div>


            <!-- Reminder Information -->

            <div class="bg-blue-50 border border-blue-200
                        rounded-xl p-4">

                <h3 class="font-bold text-blue-800 mb-2">

                    Automatic Email Reminders

                </h3>

                <p class="text-sm text-blue-700">

                    The system will create these reminders:

                </p>

                <ul class="list-disc list-inside
                           text-sm text-blue-700 mt-2 space-y-1">

                    <li>7 days before expiry</li>

                    <li>3 days before expiry</li>

                    <li>1 day before expiry</li>

                    <li>On the expiry date</li>

                </ul>

            </div>


            <!-- Submit -->

            <button
                type="submit"
                name="update"
                class="w-full bg-blue-600
                       hover:bg-blue-700
                       text-white
                       font-semibold
                       py-3.5
                       rounded-xl
                       transition"
            >

                Create Invoice & Schedule Reminders

            </button>


            <!-- Back -->

            <a
                href="invoice.php"
                class="block text-center
                       bg-gray-200
                       hover:bg-gray-300
                       text-gray-800
                       font-semibold
                       py-3
                       rounded-xl"
            >

                Back to Invoices

            </a>


        </form>


    </div>

</div>


</body>

</html>
```
