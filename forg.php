<?php
    session_start();
    include("backendAll/connect.php");
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        if (isset($_POST['submitForg'])) {
            $email1 = filter_var($_POST['email1'], FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL);
            $natid = filter_var($_POST['natid'], FILTER_SANITIZE_STRING);
            $chose = filter_var($_POST['user2'], FILTER_SANITIZE_STRING);
            if (($chose == 'teacher') && (trim($email1)) && (trim($natid))) {
                $teacher1 = "SELECT * FROM `teachers` WHERE email = '{$email1}' and national_id = '{$natid}';";
                $result1 = mysqli_query($link, $teacher1);
                $user12 = mysqli_fetch_assoc($result1);
                if ($user12) {
                    $theUser = $user12['username'];
                    $thePass = $user12['pass'];
                    $to = $email1;
                    $subject = 'Forget Password';
                    $message = 'Hello there
                    your username is ' . $theUser . "
                    and Your Password is " . $thePass;
                    $headers = 'From:contact.operawork@gmail.com' . "\r\n";
                    mail($to, $subject, $message, $headers);
                    header("Location: index.php");
                    $errorlog1 = '';
                } else {
                    $errorlog1 = '<div style="height: 40px;width: 100%;background-color: red;">Your email or/and national ID isn\'t/aren\'t correct. Please be sure that National ID and email are correct and matching in our database</div>';
                }
            } elseif (($chose == 'student') && (trim($email1)) && (trim($natid))) {
                $student1 = "SELECT * FROM `students` WHERE email = '{$email1}' and national_id = '{$natid}';";
                $result1 = mysqli_query($link, $student1);
                $user12 = mysqli_fetch_assoc($result1);
                if ($user12) {
                    $theUser = $user12['username'];
                    $thePass = $user12['pass'];
                    $to = $email1;
                    $subject = 'Forget Password';
                    $message = 'Hello there
                    your username is ' . $theUser . "
                    and Your Password is " . $thePass;
                    $headers = 'From:contact.operawork@gmail.com' . "\r\n";
                    mail($to, $subject, $message, $headers);
                    header("Location: index.php");
                    $errorlog1 = '';
                } else {
                    $errorlog1 = '<div style="height: 40px;width: 100%;background-color: red;">Your email or/and national ID isn\'t/aren\'t correct. Please be sure that National ID and email are correct and matching in our database</div>';
                }
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
    <title>forget password</title>
    <link rel="stylesheet" href="css/forg.css">
</head>
<body>
    <div id="forget-password">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h1>Forget Password</h1>
            <div class="texts">
                <label for="email">Email: </label>
                <input type="email" required placeholder="Type Your Email" name="email1" id="email1">
                <label for="natid">National ID: </label>
                <input type="text" required placeholder="Type Your National ID" name="natid" id="natid">
            </div>
            <div class="radios">
                <input type="radio" name="user2" value="teacher" id="teacher1" required>
                <label for="teacher">Teacher</label>
                <input type="radio" name="user2" value="student" id="student1" required>
                <label for="student">Student</label>
            </div>
            <div class="subs">
                <input type="submit" name="submitForg" value="Send">
            </div>
            <div class="info">
                (We will send you an email with your Username and Password)
                <?php
                    if (isset($_POST['submitForg'])) {
                        echo $errorlog1;
                    }
                ?>
            </div>
        </form>
    </div>
</body>
</html>