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
    <link rel="stylesheet" href="index.css">

</head>

<body>

    <?php require "./config/config.php" ?>

    <?php

    if (isset($_GET['item_id'])) {
        $id = $_GET['item_id'];

        $login = $conn->query("SELECT * FROM home WHERE id = '$id'");
        $login->execute();
        $row = $login->fetch(PDO::FETCH_OBJ);
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

            unlink("uploads/" . $row->fileToUpload);
            $dir = "uploads/" . basename($fileToUpload);

            $update = $conn->prepare("UPDATE home SET fileToUpload = :fileToUpload, myname = :myname, organ = :organ, depart = :depart, unit = :unit, myfunction = :myfunction, gender = :gender, mymessage = :mymessage WHERE id = '$id'");


            $update->execute([

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
                echo "sorry, there was an error uploading your file.";
            }
            Header("location:detail.php?item_id=$row->id");
        }
    }
    ?>

    <div class="wrapper">
        <div class="container">
            <h2>Update items</h2>
            <a class="item" href="./link.php?item_id=<?php echo $row->id; ?>">Go back to link</a>
            <form method="POST" action="update.php?item_id=<?php echo $id ?>" enctype="multipart/form-data">
                <div class="form">
                    <label for="fileToUpload"></label>
                    <input type="file" value="<?php echo $row->fileToUpload ?>" name="fileToUpload" id="fileToUpload">
                </div>

                <div class="form">
                    <label for="myname">names</label>
                    <input type="text" value="<?php echo $row->myname ?>" id="myname" name="myname">
                </div>

                <div class="form">
                    <label for="organ">Organization</label>
                    <input type="text" value="<?php echo $row->organ ?>" id="organ" name="organ">
                </div>

                <div class="form">
                    <label for="depart">Department</label>
                    <input type="text" value="<?php echo $row->depart ?>" id="depart" name="depart">
                </div>

                <div class="form">
                    <label for="unit">Unit</label>
                    <input type="text" value="<?php echo $row->unit ?>" id="unit" name="unit">
                </div>

                <div class="form">
                    <label for="myfunction">Function</label>
                    <input type="text" value="<?php echo $row->myfunction ?>" id="myfunction" name="myfunction">
                </div>

                <div class="gender">
                    <h2>Select your gender</h2>
                    <input type="radio" value="<?php echo $row->gender ?>" id="female" name="gender" value="female">
                    <label for="female">female</label>

                    <input type="radio" value="<?php echo $row->gender ?>" id="male" name="gender" value="male">
                    <label for="male">male</label>

                    <input type="radio" value="<?php echo $row->gender ?>" id="others" name="gender" value="others">
                    <label for="others">others</label>
                </div>

                <div class="form">
                    <textarea name="mymessage" value="<?php echo $row->$mymessage ?>" cols="25" rows="10">Comment</textarea>
                </div>

                <div class="form">
                    <input type="submit" id="submit" name="submit" value="Send">
                </div>
            </form>
        </div>
    </div>

</body>

</html>