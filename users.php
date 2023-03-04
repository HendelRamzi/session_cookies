<?php

    function get_users(){
        //get the users from the file
        $file = "db.txt";
        $content = json_decode(file_get_contents($file) , true);
        return $content;
    }

    function add_user($user){
        $users  = get_users() ;


        // put the new user in the session.
        array_push($users , $user) ;

        // Update the database file.
        file_put_contents("db.txt" , json_encode($users));
    }