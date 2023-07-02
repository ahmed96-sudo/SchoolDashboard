<?php
    session_start();
    include("backendAll/connect.php");
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        if (isset($_POST['submit'])) {
            $user1 = filter_var($_POST['username1'], FILTER_SANITIZE_STRING);
            $pass1 = filter_var($_POST['password1'], FILTER_SANITIZE_STRING);
            $chose = filter_var($_POST['user'], FILTER_SANITIZE_STRING);
            if (($chose == 'admin') && (trim($user1)) && (trim($pass1))) {
                $admin1 = "SELECT * FROM `admin` WHERE username= '{$user1}';";
                $result1 = mysqli_query($link, $admin1);
                $user12 = mysqli_fetch_assoc($result1);
                if ($user12) {
                    $theUser = $user12['username'];
                    $thePass = $user12['password'];
                    if (($theUser == $user1) && ($thePass == $pass1)) {
                        $_SESSION['user'] = $theUser;
                        header("Location: backendAdmin/admin.php");
                        $errorlog1 = '';
                    } else {
                        $errorlog1 = 'Your Admin password wasn\'t right ';
                    }
                } else {
                    $errorlog1 = 'Your Admin password or Username wasn\'t right ';
                }
            } elseif ($chose == 'teacher' && (trim($user1)) && (trim($pass1))) {
                $teacher1 = "SELECT * FROM `teachers` WHERE username= '{$user1}';";
                $result1 = mysqli_query($link, $teacher1);
                $user12 = mysqli_fetch_assoc($result1);
                if ($user12) {
                    $theUser = $user12['username'];
                    $thePass = $user12['pass'];
                    $theEmail = $user12['email'];
                    $theSubj = $user12['subject'];
                    $thename = $user12['fname'];
                    $national = $user12['national_id'];
                    if (($theUser == $user1) && ($thePass == $pass1)) {
                        $_SESSION['user'] = $theUser;
                        $_SESSION['email'] = $theEmail;
                        $_SESSION['subj'] = $theSubj;
                        $_SESSION['name'] = $thename;
                        $_SESSION['national'] = $national;
                        header("Location: backendDoctor/doctor.php");
                        $errorlog1 = '';
                    } else {
                        $errorlog1 = 'Your Teacher password wasn\'t right';
                    }
                } else {
                    $errorlog1 = 'Your Teacher Username or password wasn\'t right';
                }
            } elseif ($chose == 'student' && (trim($user1)) && (trim($pass1))) {
                $student1 = "SELECT * FROM `students` WHERE username= '{$user1}';";
                $result1 = mysqli_query($link, $student1);
                $user12 = mysqli_fetch_assoc($result1);
                if ($user12) {
                    $theUser = $user12['username'];
                    $thename1 = $user12['fname'];
                    $thePass = $user12['pass'];
                    $theEmail = $user12['email'];
                    $thenational = $user12['national_id'];
                    if (($theUser == $user1) && ($thePass == $pass1)) {
                        $_SESSION['user'] = $theUser;
                        $_SESSION['fname'] = $thename1;
                        $_SESSION['email'] = $theEmail;
                        $_SESSION['national_stud'] = $thenational;
                        header("Location: backendStudent/student.php");
                        $errorlog1 = '';
                    } else {
                        $errorlog1 = 'Your Student password wasn\'t right';
                    }
                } else {
                    $errorlog1 = 'Your Student Username or password wasn\'t right';
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
    <title>Management School</title>
    <link rel="stylesheet" href="fontawesome-free-5.15.3-web/css/fontawesome.css">
    <link rel="stylesheet" href="fontawesome-free-5.15.3-web/css/brands.css">
    <link rel="stylesheet" href="fontawesome-free-5.15.3-web/css/solid.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="formAll">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h1>Sign In</h1>
            <div class="firstInput">
                <span class="fas fa-users"></span>
                <input class="" placeholder="Username" type="text" name="username1" required>
            </div>
            <div class="secondInput">
                <span class="fas fa-lock"></span>
                <input type="password" class="" placeholder="Password" name="password1" required>
            </div>
            <div class="radios">
                <input type="radio" onclick="showforg3()" name="user" value="admin" id="admin" required>
                <label for="admin">Admin</label>
                <input type="radio" onclick="showforg1()" name="user" value="teacher" id="teacher" required>
                <label for="teacher">Teacher</label>
                <input type="radio" onclick="showforg2()" name="user" value="student" id="student" required>
                <label for="student">Student</label>
            </div>
            <div class="subs">
                <input type="submit" name="submit" value="Sign In">
            </div>
            <div class="forg" id="forg">
                <a href="forg.php">Forget Password</a>
            </div>
            <div class="studregister" id="stud">
                <a href="backendStudent/register.php">New Registeration</a>
            </div>
            <div>
                <?php
                    if (isset($_POST['submit'])) {
                        echo $errorlog1;
                    }
                ?>
            </div>
        </form>
    </div>
    <script src="js/index.js"></script>
</body>
</html>