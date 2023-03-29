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

    <div class="wrapper">
        <div class="container">
            <div class="greet">
                <a class="btn" href="./index.php">
                    < back to items</a>
            </div>


            <div class="details_items">
                <div class="main">
                    <a class="item" href="./link.php?item_id=<?php echo $row->id; ?>">
                        <img class="item_img" src="./uploads/<?php echo $row->fileToUpload ?>"> </a>
                </div>
                <div class="details_info">

                    <h4>Gender      : <?php echo $row->gender ?></h4>
                    <h4>Names       : <?php echo $row->myname ?></h4>
                    <h4>Organization: <?php echo $row->organ ?></h4>
                    <h4>Department  : <?php echo $row->depart ?> department</h4>
                    <h4>Unit        : <?php echo $row->unit ?></h4>
                    <h4>Function    : <?php echo $row->myfunction ?></h4>
                </div>
            </div>

            <h4><?php echo $row->mymessage ?></h4>




            <div class="greet">
                <a class="btn" href="./update.php?item_id=<?php echo $row->id; ?>"> update item</a>
                <a class="btn" href="./delete.php?item_id=<?php echo $row->id; ?>">delete item</a>
            </div>
        </div>

    </div>
    </div>




</body>

</html>