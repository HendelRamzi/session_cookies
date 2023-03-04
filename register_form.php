<?php
    session_start();


    global $error_div ;


    // Check if the user_exist session is set
    if(isset($_SESSION['user_exist'])){
        // Create the warning
        $error_div = '
            <div class="w-8/12 h-14 bg-red-400 rounded-md mb-3">
                <div class="w-full h-full flex justify-center items-center">
                    <p class="text-slate-900 text-base">User already exist.</p>
                </div>
            </div>
        ' ;

        unset($_SESSION['user_exist']);
    }
?>



<div class="h-full w-10/12">
    <div class="h-full w-full flex flex-col justify-center items-center ">
        <?php if(isset($error_div)) { ?>
                <?php echo $error_div ?>
            <?php }?>
        <div>
            <h1 class="text-3xl text-center mb-5 w-full">Register</h1>
            <form action="./register_page.php" method="POST" class="grid grid-cols-2 gap-5 justify-items-center ">
                <div class="">
                    <label class="block mt-3 ml-1" for="email">Email</label>
                    <input class=" border rounded-md h-14 pl-3 mt-3" name="email" type="email" id="email" placeholder="Enter your email" required/>
                </div>
                <div class="">
                    <label class="block mt-3 ml-1" for="firstname">Firstname</label>
                    <input class=" border rounded-md h-14 pl-3 mt-3" name="firstname" type="text" id="firstname" placeholder="Enter your firstname" required/>
                </div>
                <div class="">
                    <label class="block mt-3 ml-1" for="lastname">Lastname</label>
                    <input class=" border rounded-md h-14 pl-3 mt-3" name="lastname" type="text" id="lastname" placeholder="Enter your lastname" required/>
                </div>
                <div class="">
                    <label class="block mt-3 ml-1" for="psw">Password</label>
                    <input class=" border rounded-md h-14 pl-3 mt-3" name="password" type="password" id="psw" placeholder="Enter your password" required/>
                </div>
                <input type="submit" value="Submit" class="col-span-2 w-11/12  h-14 rounded-md mt-3 bg-teal-100 hover:bg-teal-300">
            </form>
        </div>
    </div>
</div>