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
    <link rel="stylesheet" href="other.css">
    <link rel="stylesheet" href="delete.css">
</head>

<body>


    <div class="header">
        <ol>
            <li><a href="#imaging">Imaging</a></li>
            <li><a href="#quotes">Quotes</a></li>
            <li><a href="#info">Information</a></li>
            <li><a href="#admin">Administration</a></li>
            <li><a href="#others">Others</a></li>
        </ol>
    </div>
    <div class="wrapper">

        <?php require "./config/config.php" ?>

        <?php

        $login = $conn->query("SELECT*FROM other");
        $login->execute();
        $rows = $login->fetchAll(PDO::FETCH_OBJ);

        ?>

        <div class="container">
            <div id="imaging">
                <h1>Imaging</h1>
                <?php foreach ($rows as $row) : ?>
                    <a class="item" href="./detail.php?item_id=<?php echo $row->id; ?>">
                        <div class="slides fade">
                            <div class="image">
                                <div class="imagenumber">1/4</div>
                                <img class="item_img" src="./uploads/<?php echo $row->fileToUpload ?>" alt=""></img>
                            </div>

                            <div class="name">
                                <p><?php echo $row->myname ?></p>
                                <p><?php echo $row->mymessage ?></p>
                            </div>
                        </div>

                    </a>
                <?php endforeach; ?>
            </div>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

            <div class="del">
                <a href="./others.php">Go back to others</a>
                <a class="btn" href="./deletes.php?item_id=<?php echo $row->id; ?>">delete item</a>
            </div>
        </div>

        <div class="main">
            <div id="quotes">
                <h1>Quotations</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque dicta tenetur debitis esse sed minus est ratione asperiores sit iste? Veniam, nemo. Soluta id, neque dicta dolore quidem aspernatur perspiciatis ipsam asperiores provident nisi expedita officia quaerat quos culpa aliquam, iste sed odio voluptatum, mollitia alias voluptate consequuntur dolorem. Ad quas nesciunt eum repellat cum veritatis repudiandae fugiat totam animi quis ipsum laborum, eos voluptatum illo ipsa reprehenderit cupiditate modi numquam a perspiciatis. Obcaecati minima tempora, officia suscipit nostrum adipisci amet omnis dolorum laborum beatae odit corporis earum commodi sint quisquam blanditiis facere saepe, ipsam aliquam, accusamus quia facilis corrupti?</p>
            </div>
        </div>
        <div class="main">
            <div id="info">
                <h1>Information</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque dicta tenetur debitis esse sed minus est ratione asperiores sit iste? Veniam, nemo. Soluta id, neque dicta dolore quidem aspernatur perspiciatis ipsam asperiores provident nisi expedita officia quaerat quos culpa aliquam, iste sed odio voluptatum, mollitia alias voluptate consequuntur dolorem. Ad quas nesciunt eum repellat cum veritatis repudiandae fugiat totam animi quis ipsum laborum, eos voluptatum illo ipsa reprehenderit cupiditate modi numquam a perspiciatis. Obcaecati minima tempora, officia suscipit nostrum adipisci amet omnis dolorum laborum beatae odit corporis earum commodi sint quisquam blanditiis facere saepe, ipsam aliquam, accusamus quia facilis corrupti?</p>
            </div>
        </div>
        <div class="main">
            <div id="admin">
                <h1>Administration</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque dicta tenetur debitis esse sed minus est ratione asperiores sit iste? Veniam, nemo. Soluta id, neque dicta dolore quidem aspernatur perspiciatis ipsam asperiores provident nisi expedita officia quaerat quos culpa aliquam, iste sed odio voluptatum, mollitia alias voluptate consequuntur dolorem. Ad quas nesciunt eum repellat cum veritatis repudiandae fugiat totam animi quis ipsum laborum, eos voluptatum illo ipsa reprehenderit cupiditate modi numquam a perspiciatis. Obcaecati minima tempora, officia suscipit nostrum adipisci amet omnis dolorum laborum beatae odit corporis earum commodi sint quisquam blanditiis facere saepe, ipsam aliquam, accusamus quia facilis corrupti?</p>
            </div>
        </div>
        <div class="main">
            <div id="others">
                <h1>Others</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque dicta tenetur debitis esse sed minus est ratione asperiores sit iste? Veniam, nemo. Soluta id, neque dicta dolore quidem aspernatur perspiciatis ipsam asperiores provident nisi expedita officia quaerat quos culpa aliquam, iste sed odio voluptatum, mollitia alias voluptate consequuntur dolorem. Ad quas nesciunt eum repellat cum veritatis repudiandae fugiat totam animi quis ipsum laborum, eos voluptatum illo ipsa reprehenderit cupiditate modi numquam a perspiciatis. Obcaecati minima tempora, officia suscipit nostrum adipisci amet omnis dolorum laborum beatae odit corporis earum commodi sint quisquam blanditiis facere saepe, ipsam aliquam, accusamus quia facilis corrupti?</p>
            </div>
        </div>
    </div>
    <script src="./other.js"></script>
</body>

</html>