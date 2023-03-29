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

    $login = $conn->query("SELECT*FROM home");
    $login->execute();
    $rows = $login->fetchAll(PDO::FETCH_OBJ);




    ?>
    <?php

    $_fileToUpload   = $_SESSION["fileToUpload"];
    $_myname         = $_SESSION["myname"];
    $_organ          = $_SESSION["organ"];
    $_depart         = $_SESSION["depart"];
    $_myfunction     = $_SESSION["myfunction"];
    $_gender         = $_SESSION["gender"];
    $_mymessage      = $_SESSION["mymessage"];


    ?>


    <div class="wrapper">
        <div class="container">

            <h2>welcome <?php echo  $_myname ?> </h2>
            <a class="btn" href="./form.php">
                <= form page</a>

                    <div class="main">
                        <h2>Profile Picture</h2>

                    </div>

                    <?php foreach ($rows as $row) : ?>
                        <a class="item" href="./detail.php?item_id=<?php echo $row->id; ?>">
                            <div class="item">
                                <div class="image">
                                    <img class="item_img" src="./uploads/<?php echo $row->fileToUpload ?>" alt=""></img>
                                </div>

                                <div class="name">
                                    <p><?php echo $row->myname ?></p>
                                </div>
                            </div>

                        </a>
                    <?php endforeach; ?>
        </div>
    </div>
    </div>

</body>

</html>