<?php

    private static function ListUsers($users=array()):bool{
        $success = false;
        echo "<ul>";
        foreach ($users as $user) {
            echo "<li>".$user->getName()."</li>";
            echo "<li>".$user->getPassword()."</li>";
            echo "<li>".$user->getEmail()."</li>";
            $success = true;
        }
        echo "</ul>";

        return $success;
    }





?>