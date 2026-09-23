
<?php

session_start();
include("database.php");

$error = "";
$message = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users Table</title>

  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-purple-200 min-h-screen py-8">

<div class="h-8 w-8  rounded-2xl shadow-lg flex items-center py-5 ml-5 mr-10">

  
 <?php
    if (isset($_SESSION['fullname'])) {

        $user = $_SESSION['fullname'];

        $message = "Hi {$user}<br>You are welcome";
    }
    ?>


   

  </div>

</div>

<?php if ($error): ?>

    <span style="color:red; font-size:20px;">
        <?= $error; ?>
    </span>

<?php endif; ?>


<?php if ($message): ?>

    <span style="color:green; font-size:20px;">
        <?= $message; ?>
    </span>

<?php endif; ?>


<div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

    <!-- Header -->
    <div class="px-8 py-6 border-b border-gray-200 flex justify-between items-center bg-gray-50">

        <h2 class="text-2xl font-bold text-gray-800">
            Customers List
        </h2>

        <a href="invoice.php"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl font-medium flex items-center gap-2 transition">

            Invoices Status

        </a>

    </div>


    <!-- Table -->
    <div class="overflow-x-auto">

        <table class="w-full bg-gray-400">

            <thead>

                <tr class="bg-gray-50 border-b-2 border-gray-200">

                    <th class="px-6 py-4 text-left text-md font-bold text-gray-600">
                        S/N
                    </th>

                    <th class="px-6 py-4 text-left text-md font-bold text-gray-600">
                        Fullname
                    </th>

                    <th class="px-6 py-4 text-left text-md font-bold text-gray-600">
                        Phone Number
                    </th>

                    <th class="px-6 py-4 text-left text-md font-bold text-gray-600">
                        Email
                    </th>

                    <th class="px-6 py-4 text-left text-md font-bold text-gray-600">
                        Physical Address
                    </th>

                    <th class="px-6 py-4 text-lg font-bold text-gray-600">
                        Actions
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-gray-500 border-gray-500">

            <?php

            // Pull customers from database
            $sql = "SELECT * FROM customers";

            $result = mysqli_query($conn, $sql);

            if ($result) {

                $count = 1;

                while ($row = mysqli_fetch_assoc($result)) {

                    $id = $row['id'];
                    $fullname = $row['fullname'];
                    $phone_no = $row['phonenumber'];
                    $email = $row['email'];
                    $physicaladdress = $row['physicaladdress'];

            ?>

                    <tr class="bg-gray-50 border-b border-gray-200">

                        <td class="px-6 py-4">
                            <?= $count++; ?>
                        </td>

                        <td class="px-6 py-4">
                            <?= htmlspecialchars($fullname); ?>
                        </td>

                        <td class="px-6 py-4">
                            <?= htmlspecialchars($phone_no); ?>
                        </td>

                        <td class="px-6 py-4">
                            <?= htmlspecialchars($email); ?>
                        </td>

                        <td class="px-6 py-4">
                            <?= htmlspecialchars($physicaladdress); ?>
                        </td>

                        <td class="px-6 py-4">

                            <form action="update.php"
                                  method="post"
                                  style="display:inline;">

                                <input type="hidden"
                                       name="customer_id"
                                       value="<?= $id; ?>">

                                <button type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition">

                                    Edit

                                </button>

                            </form>

                        </td>

                    </tr>

            <?php

                }

            }

            ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>

