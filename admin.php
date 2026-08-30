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

<div h-8 w-8 bg-yellow-300 rounded-2xl shadow-lg flex items-center py-5 ml-5 mr-10>
  <div text-xl text-bold >
 <?php
  
if(isset($_SESSION['fullname']))
  {
     $user = $_SESSION['fullname'];
     $message ="Hi {$user}<br>You are welcome"; 
  }
  ?>

  </div>
 
</div>

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


  <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
    
    <!-- Header -->
      <div class="px-8 py-6 border-b border-gray-200 flex justify-between items-center bg-gray-50">
      <h2 class="text-2xl font-bold text-gray-800">Customers List</h2>
      <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl font-medium flex items-center gap-2 transition"><a href="invoice.php">Invoices Status</a>
         
      </button>
      </div>

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="w-full bg-gray-400">
        <thead>
          <tr class="bg-gray-50 border-b-2 items-center border-gray-200">
            <th class="px-6 py-4 text-left text-md font-bold text-gray-600">S/N</th>
            <th class="px-6 py-4 text-left text-md font-bold text-gray-600">Fullname</th>
            <th class="px-6 py-4 text-left text-md font-bold text-gray-600">Phone Number</th>
            <th class="px-6 py-4 text-left text-md font-bold text-gray-600">Email</th>
            <th class="px-6 py-4 text-left text-md font-bold text-gray-600">Password</th>
            <th class="px-6 py-4 text-left text-md font-bold text-gray-600">Physical Address</th>
            <th class="px-6 py-4  text-lg font-bold text-gray-600">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-500  border-gray-500 "   >

        <?php
        //pull customers from database and display it to the Admin pages
        $sql = "SELECT * FROM customers;";
        $result = mysqli_query($conn , $sql);

        if($result)
          {
            $count=1;
            while($row = mysqli_fetch_assoc($result))
              {
                $id = $row['id'];
                $fullname = $row['fullname'];
                $password = $row['password'];
                $phone_no = $row['phonenumber'];
                $email = $row['email'];
                $physicaladdress=$row['physicaladdress'];

                 echo'<tr class="bg-gray-50 border-b border-gray-200">
                 <td >'.$count++.'</td>
                 <td >'.$fullname.'</td>
                  <td >'.$phone_no.'</td>
                   <td >'.$email.'</td>
                 <td >'.$password.'</td>
                 <td >'.$physicaladdress.'</td>
                 <td> 
                 <form action="update.php" method="post" style="display:inline;">
                 <input type="hidden" name="customer_id" value="'.$id.'">
                 <button style="background-color:blue;color:white;padding:10px;margin: 5px;border-radius:5px;width: 60px;x;height: 40px;px;">Edit</button>
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

