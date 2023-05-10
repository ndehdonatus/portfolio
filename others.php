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
    <link rel="stylesheet" href="other.css">
</head>

<body>

    <?php require "./config/config.php" ?>

    <?php

    if (isset($_POST["submit"])) {
        if (
            $_FILES["fileToUpload"]["name"] == ""
            or $_POST["myname"] == ""
            or $_POST["mymessage"] == ""

        ) {
            echo "All fields are required";
        } else {

            $fileToUpload   =  $_FILES["fileToUpload"]["name"];
            $myname         =  $_POST["myname"];
            $mymessage      =  $_POST["mymessage"];

            $dir = "uploads/" . basename($fileToUpload);


            $insert = $conn->prepare("INSERT INTO other(fileToUpload, myname,mymessage )VALUES(:fileToUpload, :myname,:mymessage)");

            $insert->execute([

                ":fileToUpload" => $fileToUpload,
                ":myname"       => $myname,
                ":mymessage"    => $mymessage,
            ]);

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $dir)) {
                echo "The file " . htmlspecialchars(basename($fileToUpload)) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }

            Header("location:slide.php");
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
                    <input required type="text" id="myname" name="myname">
                </div>
                <br>
                <div class="form">
                    <textarea name="mymessage" cols="25" rows="10">Comment</textarea>
                </div>
                <br>
                <div class="form">
                    <input type="submit" id="submit" name="submit" value="Send">
                </div>

            </form>
        </div>


        <!-- <a href="./slide.php">Go to slide</a> -->
    </div>

</body>

</html>