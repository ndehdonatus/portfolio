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
    <link rel="stylesheet" href="link.css">
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
            <div class="greet">
                <a class="btn" href="./index.php">
                    < back to items</a>
                        <a class="btn" href="./update.php?item_id=<?php echo $row->id; ?>"> update item</a>
                        <a class="btn" href="./form.php">
                            < back to form</a>
            </div>


            <div class="details_items">
                <a class="item" href="./link.php?item_id=<?php echo $row->id; ?>">
                    <img class="item_img" src="./uploads/<?php echo $row->fileToUpload ?>" >


                    <p>Welcome to <strong><?php echo $_myname ?></strong>'s link site</p>
                </a>

            </div>

            <div "link">
                <a href="https://instagram.com" target="_blank"><i class="uil uil-instagram"></i>Instagram</a>
                <br>
                <a href="https://twitter.com" target="_blank"><i class="uil uil-instagram"></i>Twitter</a>
                <br>
                <a href="https://facebook.com" target="_blank"><i class="uil uil-instagram"></i>Facebook</a>
                <br>
                <a href="https://wwwnwrfundforhealth.organ" target="_blank"><i class="uil uil-instagram"></i>NWRFHP(PIG)BAMENDA</a>
            </div>

            <?php
            // define variables and set to empty values

            $nameErr = $emailErr = $genderErr = $websiteErr = "";
            $username = $email = $gender = $comment = $website = "";



            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["username"])) {
                    $nameErr = "Name is required";
                } else {
                    $username = test_input($_POST["username"]);
                    // check if name only contains letters and whitespace
                    if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
                        $nameErr = "Only letters and white space allowed";
                    }
                }

                if (empty($_POST["email"])) {
                    $emailErr = "Email is required";
                } else {
                    $email = test_input($_POST["email"]);
                    // check if e-mail address is well-formed
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $emailErr = "Invalid email format";
                    }
                }

                if (empty($_POST["website"])) {
                    $website = "";
                } else {
                    $website = test_input($_POST["website"]);
                    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
                    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
                        $websiteErr = "Invalid URL";
                    }
                }

                if (empty($_POST["comment"])) {
                    $comment = "";
                } else {
                    $comment = test_input($_POST["comment"]);
                }

                if (empty($_POST["gender"])) {
                    $genderErr = "Gender is required";
                } else {
                    $gender = test_input($_POST["gender"]);
                }

                if (
                    $username
                    and $email
                    and  $gender
                ) {
                    $insert = $conn->prepare("INSERT INTO my_user(username, email, gender, comment, website) VALUES(:username, :email, :gender, :comment, :website)");
                    $insert->execute([
                        ":username" => $username,
                        ":email" => $email,
                        ":gender" => $gender,
                        ":comment" => $comment,
                        ":website" => $website,
                    ]);
                    Header("location:success.php");
                }
            }

            function test_input($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                <h2>Get in touch</h2>
                <div class="label">
                    <label for="name">Name: </label>
                    <span class="error">* <?php echo $nameErr; ?></span>

                    <input type="text" id="name" name="username">
                </div>

                <div class="label">
                    <label for="email">E-mail: </label>
                    <span class="error">* <?php echo $emailErr; ?></span>

                    <input type="text" id="email" name="email">
                </div>


                <div class="label">
                    <label for="comment">Comment:</label>

                    <textarea id="comment" name="comment" rows="5" cols="40"></textarea>
                </div>

                <div class="label">
                    <label> Gender:</label>
                    <span class="error">* <?php echo $genderErr; ?></span>

                    <div class="gender">
                        <div class="option">
                            <input type="radio" name="gender" id="female" value="female">
                            <label for="female">Female</label>
                        </div>
                        <div class="option">
                            <input type="radio" name="gender" id="male" value="male">
                            <label for="male">Male</label>
                        </div>
                        <div class="option">
                            <input type="radio" name="gender" id="other" value="other">
                            <label for="other">Others</label>
                        </div>
                    </div>
                </div>
                <div>
                    <input type="submit" name="submit" value="Submit">
                </div>
            </form>



            <!-- <form action="https://www.jazzman.com/action_page.php" target='_blank">

            </form -->


        </div>

    </div>



</body>

</html>