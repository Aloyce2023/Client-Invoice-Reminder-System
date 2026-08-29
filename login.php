 <?php
session_start();
$message = "";
$error = "";
$hashed ="";


          // Form Validation

if(isset($_POST["login"]))
  {
    $fullname = trim($_POST['fullname']);
    $password = trim($_POST['password']);
    

    if(empty($_POST['fullname'])||empty($_POST['password']))
      {
        $error ="Please fill all credential!";
      }
      else{
        include("database.php");

      // Fetch username and password and check if they match with credential
      $sql = "SELECT * FROM customers WHERE fullname ='$fullname';";
      $result = mysqli_query($conn,$sql);


      if($result)
        {

      if(mysqli_num_rows($result)>0)
        {
          $row = mysqli_fetch_assoc($result);

          // Check the password of user is match to that of the database


           if(password_verify($password ,$row['password']))
            {
               //create session

               $_SESSION['customer_id']=$row['id'];
               $_SESSION['fullname'] = $row['fullname'];
                 $_SESSION['role'] = $row['role'];



                 //redirect based on the role

                 if($row['role']=="admin")
                  {
                    header('Location: Admin.php');
                    exit();
                  }
                  else{
                    header('Location:dashbord.php');
                    exit();
                  }



                  


            }
            else{
              $error="Invalid Password!";
            }
        }
        else{
          $error="User not found!";
        }




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
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Login Account</h2>
    
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

     

      <!-- Submit Button -->
      <button 
        type="submit" name="login"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3.5 rounded-xl transition duration-300 text-lg">
        submit
      </button><br>

      

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