<?php
?>

<!DOCTYPE html>
<html>
    <head>
          <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Client Invoice Reminder</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    </head>
    <body class="bg-white">
        <!--Navigation Bar-->
        <div class="  grid fixed top-0 mt-0 sm:grid-cols-3 grid-cols-3 h-20 bg-white shadow-xl items-center w-full  sm:gap-60 gap-5 ">

           <div class="  w-11 h-11 bg-blue-600 rounded-xl m-5
                            flex items-center justify-center shadow-lg">

                    <i class="fa-solid fa-file-invoice-dollar
                              text-white text-lg"></i>

                </div>
                              

            

            <div class="hidden lg:flex items-center gap-8">
                <ul class="hover:text-blue-500  font-bold"><a href="#">Home</a></ul>
                <ul class="hover:text-blue-500 font-bold"><a href="#">How it works</a></ul>
                <ul class="hover:text-blue-500 font-bold"><a href="#">About</a></ul>
                <ul class="hover:text-blue-500 font-bold"><a href="#">Contacts</a></ul>
            </div>
            <div class="flex gap-5">
                <ul class="hover:rounded-lg py-2 px-3  hover:bg-black hover:text-white font-bold text">login</ul>
                <ul class="hover:rounded-lg py-2 px-3 hover:bg-blue-500 hover:text-white font-bold">Register</ul>
            </div>
        
        </div>
        

        <!--Features-->

        <div class="flex items-center flex-col gap-2 mx-10 mt-20">
            <h2 class="text-center font-bold m-10 text-md text-blue-300">Powerful Features</h2>
            <p class="text-3xl font-bold mt-0">Everything You Need to Manage Invoices</p>
            <p class="mt-4 text-gray-600">
                Keep your clients, invoices and payment information
                organized in one convenient place.
            </p>
        </div>

        <div class="grid ml-10 sm:grid-cols-4 grid-cols-1 h-90 bg-white items-center w-full gap-4">
            <!--Div 1-->
            <div class="flex items-center  flex-col gap-3 w-70 h-60 rounded-lg p-7  border border-gray-100 px-10 text-center  hover:shadow-xl ">
                <div class="w-14 h-14 bg-orange-100 rounded-xl
                            flex items-center justify-center">

                    <i class="fa-solid fa-bell text-orange-600 text-xl"></i>

                </div>
                <h3 class="mt-5 text-xl font-bold text-gray-900">
                    Invoice Reminders
                </h3>

                <p class="mt-3 text-gray-600 leading-relaxed">
                    Stay informed about upcoming payment deadlines
                    and overdue invoices.
                </p>
            </div>


            <!--Div 2-->


            <div class="flex items-center  w-70 h-60 md:h-90 rounded-lg flex-col gap-3 p-7  border border-gray-100 px-10 text-center  hover:shadow-xl ">
                <div class="w-14 h-14 bg-green-100 rounded-xl
                            flex items-center justify-center">

                    <i class="fa-solid fa-chart-pie text-green-600 text-xl"></i>

                </div>

                <h3 class="mt-5 text-xl font-bold text-gray-900">
                    Payment Tracking
                </h3>

                <p class="mt-3 text-gray-600 leading-relaxed">
                    Easily identify paid, pending and overdue invoices.
                </p>
            </div>

            <!--Div 3-->


            <div class="flex items-center  w-70 h-60 md:h-90 rounded-lg  flex-col gap-3 p-7  border border-gray-100 px-10 text-center  hover:shadow-xl ">
                 <div class="w-14 h-14 bg-green-100 rounded-xl
                            flex items-center justify-center">

                    <i class="fa-solid fa-chart-pie text-green-600 text-xl"></i>

                </div>

                <h3 class="mt-5 text-xl font-bold text-gray-900">
                    Payment Tracking
                </h3>

                <p class="mt-3 text-gray-600 leading-relaxed">
                    Easily identify paid, pending and overdue invoices.
                </p>
            </div>
            <!--Div 4-->
            <div class="flex items-center w-70 h-60 md:h-90 rounded-lg  gap-3 p-7 flex-col gap-3 border border-gray-100 px-10 text-center  hover:shadow-xl ">

                 <div class="w-14 h-14 bg-blue-100 rounded-xl
                            flex items-center justify-center">

                    <i class="fa-solid fa-users text-blue-600 text-xl"></i>

                </div>

                <h3 class="mt-5 text-xl font-bold text-gray-900">
                    Client Management
                </h3>

                <p class="mt-3 text-gray-600 leading-relaxed">
                    Store and manage your client information in an
                    organized and accessible way.
                </p>



            </div>
        </div>
        <!--How it work system-->
    
        </div>









    </body>
</html>