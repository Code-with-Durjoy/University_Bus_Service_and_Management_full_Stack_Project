<?php
    $hostname="localhost";
    $dbuser ="root";
    $dbpassword="";
    $dbname="login_reg";
    $conn=mysqli_connect($hostname,$dbuser,$dbpassword,$dbname);
    if(!$conn){
        die("something went wrong!");
    }



?>