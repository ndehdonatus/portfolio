<?php
try{

    $host     =    "localhost";

    $dbname   =    "portfolio";

    $user     =     "root";

    $pass     =      "";

    $conn = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
    $conn ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){
    echo $e->getMessage();
}

// if($conn==true){
//     echo "connection working";
// }else{
//     echo "connection error";
// }

?>