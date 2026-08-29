<?php
session_start();
$message = "";
$error = "";
$hashed ="";


          // Form Validation

if(isset($_POST["submit"]))
  {
    $fullname = trim($_POST['fullname']);
    $phonenumber =trim($_POST['phonenumber']);
    $email = strtolower($_POST['email']);
    $password = trim($_POST['password']);
    $physicaladdress =trim($_POST['physicaladdress']);
    $role = trim($_POST['role']);


    if(empty($_POST['fullname'])||empty($_POST['phonenumber'])||empty($_POST['email'])||empty($_POST['password'])||empty($_POST['physicaladdress']))
      {
        $error ="Please fill all credential!";
      }
      else{
        include("database.php");

      // Data sents to the database 


      $user = filter_var($_POST['fullname'],FILTER_SANITIZE_SPECIAL_CHARS);
      $sanitize_email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
      $hashed = password_hash($password , PASSWORD_BCRYPT);
      $sql="INSERT INTO customers(fullname ,phonenumber,email,password,physicaladdress,role) VALUES ('$user' , '$phonenumber','$sanitize_email','$hashed','$physicaladdress','$role');";
       $result =mysqli_query($conn,$sql);
       if($result)
        {
          $message="Hi you data recorded successfull!";
        }
        else
          {
            $error="Query Failed";
          }



      }

  }





?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-green-500 min-h-screen flex items-center justify-center">

  <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Register Account</h2>
    
    <form class="space-y-6" method = "post">
      
      <!-- Full name -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Fullname</label>
        <div class="relative">
          <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
            
          </span>
          <input 
            type="text" name ="fullname" 
            class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
            
            >
        </div>
      </div>

      <!-- Phone Number -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
        <div class="relative">
          <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
            
          </span>
          <input 
            type="text"  name = "phonenumber"
            class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
            
          >
        </div>
      </div>

      <!-- Email -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
        <div class="relative">
          <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
            
          </span> 
          <input 
            type="text" name="email" 
            class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
        </div>
      </div>

      <!-- Password -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
        <div class="relative">
          <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
          
          </span>
          <input 
            type="password" name="password" 
            class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
          
        </div>
      </div>

      <!-- Physical Address -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Physical Address</label>
        <div class="relative">
          <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
          
          </span>
          <input 
            type="text" name="physicaladdress" 
            class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
          
        </div>
      </div>


      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
        <div class="relative">
          <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
          
          </span>
          <input 
            type="text" name="role" 
            class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
          
        </div>
      </div>


      <!-- Submit Button -->
      <button 
        type="submit" name="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3.5 rounded-xl transition duration-300 text-lg">
        submit
      </button><br>

      <p class="text-center text-sm text-gray-500 mt-4">
        Already have an account? 
        <a href="login.php" class="text-blue-600 hover:underline font-medium">Sign in</a>
      </p>


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

    
    </form>
  </div>

</body>
</html>