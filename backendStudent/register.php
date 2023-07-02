<?php
    session_start();
    include("../backendAll/connect.php");
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        if (isset($_POST['submit_name'])) {
            $fname_name = filter_var($_POST['fname_name'], FILTER_SANITIZE_STRING);
            $lname_name = filter_var($_POST['lname_name'], FILTER_SANITIZE_STRING);
            $birthdate_name = filter_var($_POST['birthdate_name'], FILTER_SANITIZE_STRING);
            $email_name = filter_var($_POST['email_name'], FILTER_SANITIZE_STRING);
            $tel_name = filter_var($_POST['tel_name'], FILTER_SANITIZE_STRING);
            $message_name = filter_var($_POST['message_name'], FILTER_SANITIZE_STRING);
            $add_regis_sql = "INSERT INTO `registeration` (fname,lname,birthdate,telephone,email,message) VALUES ('$fname_name','$lname_name','$birthdate_name', '$tel_name','$email_name','$message_name');";
            if (mysqli_query($link, $add_regis_sql)) {
                header("Location: ../index.php");
            } else {
                $add_regis_result = 'Something went wrong with adding a teacher';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre Registeration</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../fontawesome-free-5.15.3-web/css/fontawesome.css">
    <link rel="stylesheet" href="../fontawesome-free-5.15.3-web/css/brands.css">
    <link rel="stylesheet" href="../fontawesome-free-5.15.3-web/css/solid.css">
    <link rel="stylesheet" href="../css/regis.css">
</head>
<body>
    <div id="pre_regis">
        <form action="register.php" method="POST">
            <h1>Pre Registeration</h1>
            <div class="full_name">
                <div class="fname_class">
                    <label for="fname">First Name</label>
                    <input required type="text" name="fname_name" id="fname_id">
                </div>
                <div class="lname_class">
                    <label for="lname">Last Name</label>
                    <input required type="text" name="lname_name" id="lname_id">
                </div>
            </div>
            <div class="birth_date">
                <div class="birthdate_class">
                    <label for="birthdate">BirthDate</label>
                    <input required type="date" name="birthdate_name" id="birthdate_id">
                </div>
            </div>
            <div class="contact">
                <div class="email_class">
                    <label for="email">Email</label>
                    <input required type="email" name="email_name" id="email_id">
                </div>
                <div class="tel_class">
                    <label for="tel">Telephone</label>
                    <input required type="text" name="tel_name" id="tel_id">
                </div>
            </div>
            <div class="messa">
                <div class="messa_class">
                    <label for="message">Message</label>
                    <textarea required name="message_name" id="message_id" cols="62" rows="10"></textarea>
                </div>
            </div>
            <div class="submit">
                <div class="submit_class">
                    <input class="btn suball" type="submit" name="submit_name" value="Submit">
                </div>
            </div>
        </form>
    </div>
</body>
</html>