<?php
    session_start() ;
    require('./users.php');

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        // handle POST requests
        // This section will handle all the POST requests.

        // When the user logout we remove the user_auth session variable
        unset($_SESSION["user_auth"]);

        // And we destroy the session.
        session_destroy();

        // Then we redirect to the login page.
        header("location: http://localhost");
        exit();

    }else{
        // handle GET requests

        $welcome_div ;

        // Check if the user is logged in
        if(isset($_SESSION['user_auth'])){


            $users = get_users(); // List of all the users.

            // This flash session will tell the navigation.php
            // To display the dashboard top navigation bar.
            $_SESSION['dash_nav'] = true ;


            if( isset( $_SESSION['user_created'] ) ){

                // It's a new created user
                // user_created is a flash session created by register_form.php
                // To let the dashboard.php page know that the current auth user is a new one.

                $welcome_div = '
                <div class="error-div h-14 w-6/12 bg-indigo-300	 rounded-md mb-3">
                    <div class="h-full w-full flex justify-center items-center">
                        <p>Welcome '.$_SESSION['user_auth']["firstname"].' '.$_SESSION['user_auth']['lastname'].' you are a new user.</p>
                    </div>
                </div>
            ';
            }else{

                // If the user_created flash session is not set
                // That mean that the current auth user is an old one.

                $welcome_div = '
                    <div class="error-div h-14 w-6/12 bg-green-300 rounded-md mb-3">
                        <div class="h-full w-full flex justify-center items-center">
                            <p> <p>Welcome back '.$_SESSION['user_auth']["lastname"].' '.$_SESSION['user_auth']['firstname'].'.</p>
                        </div>
                    </div>
                ';
            }



        }else{
            //This block of code will be executed if a non authnticated user
            //try to access the dashboard page.

            // Created the flash session to let the index.php page know
            // That the acctual user tried to access the dashboard page.
            $_SESSION['no_auth'] = true;


            header("location: http://localhost");
            exit();
        }
    }





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
        <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>

    <header class="flex justify-center items-center h-24">
        <?php require("./navigation.php") ?>
    </header>
    <div class="w-screen flex justify-center items-center mt-5">
        <?php if(isset($welcome_div)) { ?>
                <?php echo $welcome_div?>
            <?php }?>
    </div>

    <section class="w-screen  flex items-center justify-center" style="height: calc(100vh - 6rem );">
            <div class="table-container w-10/12 h-full grid grid-cols-3 justify-items-center place-content-around bg-slate-50 place-items-stretch	rounded-md" >
                <div class="capitalize">Firstname</div>
                <div class="capitalize">Lastname</div>
                <div class="capitalize">email</div>

                <?php foreach($users as $user){?>
                        <div class="uppercase"><?php echo $user['lastname'] ?></div>
                        <div class="capitalize"><?php echo $user['firstname'] ?></div>
                        <div><?php echo $user['email'] ?></div>
                    <?php } ?>

            </div>
    </section>

</body>
</html>