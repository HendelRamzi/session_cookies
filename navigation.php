<?php if(isset($_SESSION['dash_nav'])){ ?>
    <nav class="navigation-container w-10/12 h-24 flex bg-teal-50 px-3 rounded-md mt-4 ">
                <div class="h-full w-1/4" >
                    <div class="h-full w-full flex justify-start items-center">
                        <h1>Authentification System</h1>
                    </div>
                </div>
                <div class="h-full w-3/4" >
                    <form action="./dashboard.php" method="post" class="h-full w-full flex items-center justify-end">
                        <input type="submit" value="logout" class="mr-5 hover:cursor-pointer">
                    </form>
                </div>
            </nav>
    <?php }else { ?>
            <nav class="navigation-container w-10/12 h-24 flex bg-teal-50 px-3 rounded-md mt-4 ">
                <div class="h-full w-1/4" >
                    <div class="h-full w-full flex justify-start items-center">
                        <h1>Authentification System</h1>
                    </div>
                </div>
                <div class="h-full w-3/4" >
                    <ul class="h-full w-full flex items-center justify-end ">
                        <li class="mr-5"><a href="./index.php">log in</a></li>
                        <li><a href="./register_page.php">Register</a></li>
                    </ul>
                </div>
            </nav>

        <?php } ?>
