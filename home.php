
<!DOCTYPE html>
<html>
    <head>
          <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Client Invoice Reminder</title>

    <!-- Tailwind links -->
    <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    </head>
    <body class="bg-white">
        <!--Navigation Bar-->
        <div class="  grid fixed top-0 mt-0 right-0 left-0 sm:grid-cols-3 grid-cols-3 h-20 bg-white shadow-xl items-center w-full  sm:gap-60 gap-5 ">

        <div class="flex items-center   h-11 sm:w-60 w-40"> 

           <div class="  w-11 h-11 bg-blue-600 rounded-xl m-5 hover:bg-black animate-pulse
                            flex items-center justify-center  shadow-lg">

                    <i class="fa-solid fa-file-invoice-dollar
                              text-white text-lg"></i>          
                </div>
                <h2 class="font-bold text-xl text-black">Client Invoice</h2>
        </div>


                <!--href links-->


            <div class="hidden lg:flex items-center gap-8">
                <ul class="hover:text-blue-500  font-bold"><a href="#">Home</a></ul>
                <ul class="hover:text-blue-500 font-bold"><a href="#">How it works</a></ul>
                <ul class="hover:text-blue-500 font-bold"><a href="#">About</a></ul>
                <ul class="hover:text-blue-500 font-bold"><a href="#">Contacts</a></ul>
            </div>
            <div class="flex gap-5">
                <a href="login.php" class="hover:rounded-lg py-2 px-3  hover:bg-black hover:text-white font-bold text">login</a>
                <a  href="index.php" class="hover:rounded-lg py-2 px-3 hover:bg-blue-500 hover:text-white font-bold">Register</a>
            </div>
        
        </div>
        

        <!--Features-->

        <div class="flex items-center flex-col gap-2 mx-10 mt-20">
            <h2 class="text-center font-bold m-10 text-md text-blue-600">POWERFULL FEATURES</h2>
            <p class="font-bold text-2xl mt-0 ml-5 sm:text-5xl">Everything You Need to Manage Invoices</p>
            <p class="mt-4 text-gray-600 ml-5">
                Keep your clients, invoices and payment information
                organized in one convenient place.
            </p>
        </div>

        <div class="grid ml-10 sm:grid-cols-4 grid-cols-1 h-90 bg-white  items-center w-full gap-4">
            <!--Div 1-->
            <div class="flex items-center m-3 flex-col gap-3 w-70 h-100 rounded-lg p-7  border border-gray-100 px-10 text-center  hover:shadow-xl ">
                <div class="w-14 h-14 bg-orange-100 rounded-xl
                            flex items-center justify-center">

                    <i class="fa-solid fa-bell text-orange-600 text-xl"></i>

                </div>
                <h3 class="mt-5 text-xl font-bold text-gray-900">
                   Client Management
                </h3>

                <p class="mt-3 text-gray-600 leading-relaxed">
                    Store and manage your client information in an
                    organized and accessible way.
                </p>
            </div>


            <!--Div 2-->


           <div class="flex items-center m-3 flex-col gap-3 w-70 h-100 rounded-lg p-7  border border-gray-100 px-10 text-center  hover:shadow-xl">

                <div class="w-14 h-14 bg-purple-100 rounded-xl
                            flex items-center justify-center">

                    <i class="fa-solid fa-file-invoice-dollar
                              text-purple-600 text-xl"></i>

                </div>

                <h3 class="mt-5 text-xl font-bold text-gray-900">
                  Invoice Management
                </h3>

                <p class="mt-3 text-gray-600 leading-relaxed">
                  Create, organize and monitor invoices without
                    complicated spreadsheets.
                </p>

            </div>

            <!--Div 3-->


            <div class="flex items-center  w-70 h-100 rounded-lg  flex-col gap-3 p-7  border border-gray-100 px-10 text-center  hover:shadow-xl ">
                 <div class="w-14 h-14 bg-green-100 rounded-xl
                            flex items-center justify-center">

                    <i class="fa-solid fa-chart-pie text-green-600 text-xl"></i>

                </div>

                <h3 class="mt-5 text-xl font-bold text-gray-900">
                   Invoice Reminders
                </h3>

                <p class="mt-3 text-gray-600 leading-relaxed">
                    Stay informed about upcoming payment deadlines
                    and overdue invoices.
                </p>
            </div>
            <!--Div 4-->
            <div class="flex items-center w-70 h-100 rounded-lg  gap-3 p-7 flex-col  border border-gray-100 px-10 text-center  hover:shadow-xl ">

                 <div class="w-14 h-14 bg-blue-100 rounded-xl
                            flex items-center justify-center">

                    <i class="fa-solid fa-users text-blue-600 text-xl"></i>

                </div>

                <h3 class="mt-5 text-xl font-bold text-gray-900">
                  Payment Tracking
                </h3>

                <p class="mt-3 text-gray-600 leading-relaxed">
                    Easily identify paid, pending and overdue invoices.
                </p>



            </div>
        </div>

        <!--How it work system-->

        <div class="flext items-center justify-center flex-col gap-4 bg-gray-100 w-full">

        <div class="flex items-center justify-center mt-4">
            <h2 class="  justify-center font-bold text-4xl m-5">How it works</h2>
        </div>
    
        <div class="grid  sm:grid-cols-4 grid-cols-1 h-90  items-center w-full gap-4">
            <!--step 1-->

             <!--Div 1-->
            <div class="flex items-center m-3 flex-col gap-3 w-70 h-100 rounded-lg p-7  border border-gray-100 px-10 text-center   ">
                <div class="w-14 h-14 bg-blue-400 rounded-full
                            flex items-center justify-center">

                    <h2 class="text-white font-bold text-xl">1</h2>

                </div>
                <h3 class="mt-5 text-xl font-bold text-gray-900">
                      Client Registration
                </h3>

                <p class="mt-3 text-gray-600 leading-relaxed">
                     Register client and keep their information
                </p>
            </div>
            <!--Div 2-->


            <div class="flex items-center m-3 flex-col gap-3 w-70 h-100 rounded-lg p-7  border border-gray-100 px-10 text-center   ">
                <div class="w-14 h-14 bg-blue-400 rounded-full
                            flex items-center justify-center">

                    <h2 class="text-white font-bold text-xl">2</h2>

                </div>
                <h3 class="mt-5 text-xl font-bold text-gray-900">
                    Manage Clients
                </h3>

                <p class="mt-3 text-gray-600 leading-relaxed">
                     Manages the clients information
                </p>
            </div>

            <!--Div 3-->


            <div class="flex items-center m-3 flex-col gap-3 w-70 h-100 rounded-lg p-7  border border-gray-100 px-10 text-center   ">
                <div class="w-14 h-14 bg-blue-400 rounded-full
                            flex items-center justify-center">

                    <h2 class="text-white font-bold text-xl">3</h2>

                </div>
                <h3 class="mt-5 text-xl font-bold text-gray-900">
                      Set Invoice
                </h3>

                <p class="mt-3 text-gray-600 leading-relaxed">
                    Record the invoice amount , due date and clients detail
                </p>
            </div>


            <!--Div 4-->

            <div class="flex items-center m-3 flex-col gap-3 w-70 h-100 rounded-lg p-7  border border-gray-100 px-10 text-center   ">
                <div class="w-14 h-14 bg-blue-400 rounded-full
                            flex items-center justify-center">

                    <h2 class="text-white font-bold text-xl">4</h2>

                </div>
                <h3 class="mt-5 text-xl font-bold text-gray-900">
                    Set Reminder
                </h3>

                <p class="mt-3 text-gray-600 leading-relaxed">
                     Keeps tracks of importants payments deadlines.
                </p>
            </div>

        </div>


           <!--Footer Section-->







       <div class="flex flex-col items-center gap-5 bg-black">       
        <div class="grid m-5 sm:grid-cols-3 grid-cols-1  justify-between items-center w-full gap-10">

        <!--left contents-->
            <div class="flex items-center  flex-col gap-3 w-70 h-100 rounded-lg p-7  px-10 text-center   ">
                 <div class="flex items-center h-11 sm:w-60 w-40"> 

                 <div class="  w-11 h-11 bg-blue-600 rounded-xl hover:bg-black 
                            flex items-center justify-center m-2 shadow-lg">

                    <i class="fa-solid fa-file-invoice-dollar
                              text-white text-lg"></i>          
                </div>
                <h2 class="font-bold text-xl text-white">Client Invoice</h2>
                </div>
        
                <p class="mt-3 text-gray-600 leading-relaxed">
                    A simple platform for managing client invoices,
                    tracking payments and staying on top of reminders.

                </p>
                  
            </div>

            <!--Center Section-->

            <div class="flex items-center m-3 flex-col gap-3 w-70 h-100 rounded-lg p-7   px-10 text-center   ">
                 <div>

                <h3 class="text-white font-bold mb-5">
                    Quick Links
                </h3>

                <div class="space-y-3">

                    <a href="#home" class="block hover:text-white text-gray-400 transition">
                        Home
                    </a>

                    <a href="#features" class="block hover:text-white text-gray-400 transition">
                        Features
                    </a>

                    <a href="#how-it-works" class="block hover:text-white text-gray-400 transition">
                        How It Works
                    </a>            

                </div>

            </div>
            </div>


            <!--Right section-->
            <div class="flex items-center m-3 flex-col gap-3 w-70 h-100 rounded-lg p-7 px-10 text-center   ">
                <div>

                <h3 class="text-white font-bold mb-5">
                    Account
                </h3>

                <div class="space-y-3">

                    <a href="login.php"
                       class="block hover:text-white text-gray-400 transition">
                        Login
                    </a>

                    <a href="index.php"
                       class="block hover:text-white text-gray-400 transition">
                        Register
                    </a>

                </div>  
                </div>

           </div>
      
        </div>
        <!--Copy right sections-->

          <div class="border-t border-gray-400 w-full mt-10 pt-7
                    flex 
                    justify-center gap-3 text-sm">

            <p class="text-white items-center ">
                © 2026 Client Invoice Reminder. All rights reserved.
            </p>     

        </div>

       </div>


       
           

           

    </body>
</html>