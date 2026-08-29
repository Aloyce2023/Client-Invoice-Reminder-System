<?php

include"database.php";

$id=$_POST['customer_id'];


if(isset($_POST['customer_id']))
    {
        $id=$_POST['customer_id'];
        $sql = "DELETE FROM `customers` WHERE id = $id";
        $result = mysqli_query($conn , $sql);

        if($result)
            {
                header('location: invoice.php');
            }
            else{
                die("Error".mysqli_connect_error());
            }
    }




?>
