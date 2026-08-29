<?php
session_start();
require("database.php");
$message = "";
$error = "";
$id =$_POST['customer_id'];
   



if(isset($_POST["update"]))
  {
    
    $description = trim($_POST['description']);
    $amount = trim($_POST['amount']);
    $expiredate=Date("Y-m-d");
    $customer_id = $_POST['customer_id'];


    if(empty($_POST['description'])||empty($_POST['amount'])||empty($_POST['expire_date']))
        {
            $error="Please fill all field!";
        }
        else{
            $sql ="INSERT INTO invoice(description ,amount,expire_date,customer_id) VALUES('$description','$amount','$expiredate','$id') ;";

            $result = mysqli_query($conn,$sql);
        
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
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    
    
    <form class="space-y-6" method = "post">
      <h2 class="text-3xl my-5 mt-5">Update customers Account</h2>


     

      <input type ="hidden" name ="customer_id" value="<?php echo $id;?>">
      
      
      <!-- Invoice Description -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Invoice Description</label>
        <div class="relative">
          <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
          
          </span>
          
            <textarea name="description" cols="40" rows="5"  class="text-center"></textarea>
          
        </div>
      </div>


      <!-- Amount -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
        <div class="relative">
          <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
          
          </span>
          <input 
            type="text" name="amount" 
            class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
          
        </div>
      </div>

      <!-- Expire date -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Expire Date</label>
        <div class="relative">
          <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
          
          </span>
          <input 
            type="date" name="expire_date" 
            class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
          
        </div>
      </div>


      <!-- Submit Button -->
      <button 
        type="submit" name="update"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3.5 rounded-xl transition duration-300 text-lg">
        update
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


    
        


