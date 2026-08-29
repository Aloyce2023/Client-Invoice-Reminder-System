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

 <?php if($error):?>
        <span style="color:red; font-size:20px;">
          <?= $error; ?>
        </span>
        <?php endif;?>

        <?php if($message):?>
        <span style="color:green; font-size:20px;">
          <?= $message; ?>
        </span>
        <?php endif;?>


  <div class="max-w-6xl mx-auto bg-white sm:w-full rounded-2xl shadow-lg overflow-hidden">
    
    <!-- Header -->
      <div class="px-8 py-6 border-b border-gray-200 flex justify-between items-center bg-gray-50">
      <h2 class="text-2xl font-bold text-gray-800">Invoices Lists</h2>
      <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl font-medium flex items-center gap-2 transition"><a href="admin.php">Add New Invoice</a>
         
      </button>
      </div>

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="bg-gray-50 border-b-2 items-center border-gray-200">
            <th class="px-6 py-4 text-left text-md font-bold text-gray-600">ID</th>
            <th class="px-6 py-4 text-left text-md font-bold text-gray-600">fullname</th>
            <th class="px-6 py-4 text-left text-md font-bold text-gray-600">Email</th>
            <th class="px-6 py-4 text-left text-md font-bold text-gray-600">phonenumber</th>
            <th class="px-6 py-4 text-left text-md font-bold text-gray-600">Description</th>
            <th class="px-6 py-4 text-left text-md font-bold text-gray-600">Amount</th>
            <th class="px-6 py-4 text-left text-md font-bold text-gray-600">Created_at</th>
            <th class="px-6 py-4 text-left text-md font-bold text-gray-600">Expired_at</th>
            <th class="px-6 py-4  text-lg font-bold text-gray-600">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-500  border-gray-500 "   >

        <?php
        //pull data from database and display it to the website
        $sql ="SELECT customer_id, fullname ,phonenumber,email,description,amount,start_date,expire_date FROM customers INNER JOIN invoice ON customers.id = invoice.customer_id;";
        $result = mysqli_query($conn , $sql);

        if($result)
          {
            while($row = mysqli_fetch_assoc($result))
              {
                $id = $row['customer_id'];
                $fullname = $row['fullname'];
                $phonenumber = $row['phonenumber'];
                $description = $row['description'];
                $email = $row['email'];
                $amount=$row['amount'];
                $startdate=$row['start_date'];
                $expiredate=$row['expire_date'];


                 echo'<tr class="bg-gray-50 border-b border-gray-200">
                 <td >'.$id.'</td>
                 <td >'.$fullname.'</td>
                 <td >'.$email.'</td>
                 <td >'.$phonenumber.'</td>
                 <td >'.$description.'</td>
                 <td >'.$amount.'</td>
                 <td >'.$startdate.'</td>
                 <td >'.$expiredate.'</td>
                 
                 <td> 
                 <form action="delete.php" method="post">
                 <input type="hidden"   name="customer_id" value="'.$id.'">
                 <button style="background-color:red;color:white;border-radius:10px;margin:10px;padding:10px;">delete</button>
                 </form>

                 <form action="dashbord.php" method="post">
                 <input type="hidden"   name="customer_id" value="'.$id.'">
                 <button style="background-color:green;color:white;border-radius:10px;margin:10px;padding:10px;">Save</button>
                 </form>
                 
                  </td>

          </tr>';

               
              }
          }
        ?>
      
      <!-- Data will be inserted here dynamically -->
        </tbody>
      </table>
    </div>

    <!-- Footer -->
   
  </div>

</body>
</html>