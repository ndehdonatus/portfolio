<?php require "./config/config.php" ?>

    <?php

    if (isset($_GET['item_id'])) {
        $id = $_GET['item_id'];

        $select = $conn->query("SELECT * FROM home WHERE id = '$id'");
        $select->execute();
        $row = $select->fetch(PDO::FETCH_OBJ);

        unlink("uploads/" . $row->fileToUpload);



        $login = $conn->prepare("DELETE FROM home WHERE id = '$id'");
        $login->execute();

        Header("location:index.php");
    }
    ?>
