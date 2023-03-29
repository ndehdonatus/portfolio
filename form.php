<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="form.css">
</head>

<body>

    <?php require "./config/config.php" ?>

    <?php

    if (isset($_POST["submit"])) {
        if (
            $_FILES["fileToUpload"]["name"] == ""
            or $_POST["myname"] == ""
            or $_POST["organ"] == ""
            or $_POST["depart"] == ""
            or $_POST["unit"] == ""
            or $_POST["myfunction"] == ""
            or $_POST["gender"] == ""
            or $_POST["mymessage"] == ""


        ) {
            echo "All fields are required";
        } else {

            $fileToUpload   =  $_FILES["fileToUpload"]["name"];
            $myname         =  $_POST["myname"];
            $organ          =  $_POST["organ"];
            $depart         =  $_POST["depart"];
            $unit           =  $_POST["unit"];
            $myfunction       =  $_POST["myfunction"];
            $gender         =  $_POST["gender"];
            $mymessage        =  $_POST["mymessage"];


            $dir = "uploads/" . basename($fileToUpload);


            $insert = $conn->prepare("INSERT INTO home(fileToUpload, myname, organ,depart, unit, myfunction, gender, mymessage )VALUES(:fileToUpload, :myname, :organ, :depart, :unit, :myfunction, :gender, :mymessage)");

            $insert->execute([

                ":fileToUpload" => $fileToUpload,
                ":myname"       => $myname,
                ":organ"        => $organ,
                ":depart"       => $depart,
                ":unit"         => $unit,
                ":myfunction"   => $myfunction,
                ":gender"       => $gender,
                ":mymessage"    => $mymessage,

            ]);

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $dir)) {
                echo "The file " . htmlspecialchars(basename($fileToUpload)) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }

            Header("location:index.php");
        }
    }
    ?>

    <?php
    if (isset($_POST["submit"])) {
        if (
            $_FILES["fileToUpload"]["name"] == ""
            or $_POST["myname"] == ""
            or $_POST["organ"] == ""
            or $_POST["depart"] == ""
            or $_POST["unit"] == ""
            or $_POST["myfunction"] == ""
            or $_POST["gender"] == ""
            or $_POST["mymessage"] == ""
        ) {
            // echo "All fields are required";
        } else {

            $login = $conn->query("SELECT * FROM home WHERE myname = '$myname'");

            $login->execute();

            $row = $login->FETCH(PDO::FETCH_ASSOC);

            $_SESSION["fileToUpload"] = $row["fileToUpload"];
            $_SESSION["myname"]       = $row["myname"];
            $_SESSION["organ"]        = $row["organ"];
            $_SESSION["depart"]       = $row["depart"];
            $_SESSION["unit"]       = $row["unit"];
            $_SESSION["myfunction"]   = $row["myfunction"];
            $_SESSION["gender"]       = $row["gender"];
            $_SESSION["mymessage"]    = $row["mymessage"];

            Header("location:index.php");
        }
    }
    ?>

    <div class="wrapper">
        <div class="container">

            <form method="POST" enctype="multipart/form-data">
                <div class="form">
                    <label for="fileToUpload"></label>
                    <input type="file" id="fileToUpload" name="fileToUpload">
                </div>

                <div class="form">
                    <label for="myname">Names</label>
                    <input type="text" id="myname" name="myname">
                </div>

                <div class="form">
                    <label for="organ">Organization</label>
                    <input type="text" id="organ" name="organ">
                </div>

                <div class="form">
                    <label for="depart">Department</label>
                    <input type="text" id="depart" name="depart">
                </div>

                <div class="form">
                    <label for="unit">Unit</label>
                    <input type="text" id="unit" name="unit">
                </div>

                <div class="form">
                    <label for="myfunction">Function</label>
                    <input type="text" id="myfunction" name="myfunction">
                </div>
                <div class="gender">
                    <h2>Select your gender</h2>
                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female">female</label>

                    <input type="radio" id="male" name="gender" value="male">
                    <label for="male">male</label>

                    <input type="radio" id="others" name="gender" value="others">
                    <label for="others">others</label>
                </div>
                <div  class="form">
                    <textarea name="mymessage" cols="25" rows="10">Comment</textarea>
                </div>
                <div class="form">
                    <input type="submit" id="submit" name="submit" value="Send">
                </div>

                <div class="link">
                    <a href="./index.php">Go to index page</a>
                </div>

            </form>
        </div>
    </div>
</body>

</html>