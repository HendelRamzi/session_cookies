<?php
    session_start();


    require('./users.php') ;

    // Check if user already exist
    if(isset($_SESSION['user_auth'])){
        // IF the user already logged in, redirect directly to the dashboard
        header("location: http://localhost/dashboard.php");
        exit();
    }


    $user_exist = false ;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // handle the POST requests.

        if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password'])){
            // All fields are here.

            // get the list of all the users.
            $users = get_users();


            // See if the user already exist or not.
            foreach($users as $user){
                if ($user['email'] === $_POST['email']){
                    $user_exist = true ;
                }
            }

            if($user_exist){
                // the user already exist.
                // This flash session is sent to the register_form.php file
                // to warn the user that, the credentials already exist for another user.
                $_SESSION['user_exist'] = $user_exist ;
            }else{
                //user do not exist.


                $new_user  = array(
                    'firstname' => $_POST['firstname'],
                    'lastname' => $_POST['lastname'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password']
                ) ;


                // add the new user to the users array.
                add_user($new_user) ;

                // Flash session created to notify the dashboard.php file
                // that this user is new.
                $_SESSION['user_created'] = true;


                //log in the new user.
                $_SESSION['user_auth'] = $new_user ;

                // Redirect to the dashboard.php page.
                header("location: http://localhost/dashboard.php");
                exit();
            }

        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <header class="flex justify-center items-center h-24">
        <?php require("./navigation.php") ?>
    </header>

    <section class="w-screen flex justify-center items-cente" style="height: calc(100vh - 6rem );">
        <?php require('./register_form.php')?>
    </section>


</body>
</html>