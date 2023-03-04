<?php

    session_start();
    require("./users.php") ;


    // Check if user already exist
    if(isset($_SESSION['user_auth'])){
        // redirect directly to the dashboard
        header("location: http://localhost/dashboard.php");
        exit();
    }


    $error_div ;

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        // handle POST requests

        if(isset($_POST['email']) && isset($_POST['password']) ){
            // all credentials here

            // Check if the user exist.

            $new_user = array(
                'email' => $_POST['email'],
                'password' => $_POST['password']
            );


            // Get the List of all the users
            $users = get_users();


            $user_exist = false;
            foreach($users as $user){
                if($user['email'] == $new_user['email'] && $user['password'] == $new_user['password']){
                    // The email:password match an existing user in the database.

                    // The user exist
                    $user_exist = true ;

                    // we login the user.
                    // In a real application you would probably only store the ID of the current logged in user
                    $_SESSION['user_auth'] = $user ;

                    //redirect to the dashboard page
                    header("location: http://localhost/dashboard.php");
                    exit();
                }
            }

            if( ! $user_exist ){
                // user do not exist.
                // This condition is true if we search in all the users and we don't find a eamil:password match
                // So that mean that the user does not exist.
                $error_div = '
                    <div class="error-div h-14 w-6/12 bg-red-400 rounded-md mb-3">
                        <div class="h-full w-full flex justify-center items-center">
                            <p>email or password incorrect !</p>
                        </div>
                    </div>
                ';
            }

        } else{
            // fields are missing
            $error_div = '
            <div class="error-div h-14 w-6/12 bg-red-400 rounded-md mb-3">
                <div class="h-full w-full flex justify-center items-center">
                    <p>Please fill all the required fields.</p>
                </div>
            </div>
        ';
        }
    }else{

        // HANDLE GET REQUEST
        // In this section we handle the GET request.


        if(isset($_SESSION['no_auth'])){
            //this flash session is created by dahsboard.php when
            //no authenticated user try access dashboard.

            $error_div = '
                <div class="error-div h-14 w-6/12 bg-red-400 rounded-md mb-3">
                    <div class="h-full w-full flex justify-center items-center">
                        <p>you\'re not logged in to access the dashboard !</p>
                    </div>
                </div>
            ';

            unset($_SESSION['no_auth']) ;
        }

    }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <header class="flex justify-center items-center h-24">
        <?php require("./navigation.php") ?>
    </header>
    <div class="w-screen flex justify-center items-center mt-5">
        <?php if(isset($error_div)) { ?>
                <?php echo $error_div?>
            <?php }?>
    </div>
    <section class="w-screen flex justify-center " style="height: calc(100vh - 6rem );">
        <?php require('./login_form.php')?>
    </section>


</body>
</html>