<?php
    session_start();
    include("../backendAll/connect.php");
?>
<?php
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        if (isset($_POST['addteacher'])) {
            $fnameteacheradd = filter_var($_POST['fnameteacheradd'], FILTER_SANITIZE_STRING);
            $lnameteacheradd = filter_var($_POST['lnameteacheradd'], FILTER_SANITIZE_STRING);
            $telteacheradd = filter_var($_POST['telteacheradd'], FILTER_SANITIZE_NUMBER_INT);
            $emailteacheradd = filter_var($_POST['emailteacheradd'], FILTER_SANITIZE_EMAIL,FILTER_VALIDATE_EMAIL);
            $natteahceradd = filter_var($_POST['natteahceradd'], FILTER_SANITIZE_STRING);
            $startteacheradd = filter_var($_POST['startteacheradd'], FILTER_SANITIZE_STRING);
            $subjteacheradd = implode(' , ',$_POST['subjteacheradd']);
            $usernameteacheradd = filter_var($_POST['usernameteacheradd'], FILTER_SANITIZE_STRING);
            $passteacheradd = filter_var($_POST['passteacheradd'], FILTER_SANITIZE_STRING);
            $addteachersql = "INSERT INTO `teachers` (username,pass,fname,lname,email,telephone,national_id,subjects,startingtime) VALUES ('$usernameteacheradd','$passteacheradd','$fnameteacheradd', '$lnameteacheradd','$emailteacheradd','$telteacheradd','$natteahceradd','$subjteacheradd','$startteacheradd');";
            if (mysqli_query($link, $addteachersql)) {
                $addteacherresult= 'Teacher Added successfully';
            } else {
                $addteacherresult = 'Something went wrong with adding a teacher';
            }
        } elseif (isset($_POST['editteacher'])) {
            $nationalteacheredit = filter_var($_POST['nationalteacheredit'], FILTER_SANITIZE_STRING);
            $fnameteacheredit = filter_var($_POST['fnameteacheredit'], FILTER_SANITIZE_STRING);
            $lnameteacheredit = filter_var($_POST['lnameteacheredit'], FILTER_SANITIZE_STRING);
            $telteacheredit = filter_var($_POST['telteacheredit'], FILTER_SANITIZE_STRING);
            $emailteacheredit = filter_var($_POST['emailteacheredit'], FILTER_SANITIZE_STRING);
            $startteacheredit = filter_var($_POST['startteacheredit'], FILTER_SANITIZE_STRING);
            $subjteacheredit = implode(' , ',$_POST['subjteacheredit']);
            $usernameteacheredit = filter_var($_POST['usernameteacheredit'], FILTER_SANITIZE_STRING);
            $passteacheredit = filter_var($_POST['passteacheredit'], FILTER_SANITIZE_STRING);
            $editteacherfinally = "UPDATE `teachers` SET `username` = '{$usernameteacheredit}', `pass` = '{$passteacheredit}', `fname` = '{$fnameteacheredit}', `lname` = '{$lnameteacheredit}', `email` = '{$emailteacheredit}', `telephone` = '{$telteacheredit}', `subjects` = '{$subjteacheredit}', `startingtime` = '{$startteacheredit}' WHERE `id` = {$nationalteacheredit};";
            if (mysqli_query($link,$editteacherfinally)) {
                $editteacherresult = "Teacher Edited Successfully";
            } else {
                $editteacherresult = 'Something went wrong with Editing a Teacher';
            }
        } elseif (isset($_POST['addstudent'])) {
            $fnamestudentadd = filter_var($_POST['fnamestudentadd'], FILTER_SANITIZE_STRING);
            $lnamestudentadd = filter_var($_POST['lnamestudentadd'], FILTER_SANITIZE_STRING);
            $bdatestudentadd = filter_var($_POST['bdatestudentadd'], FILTER_SANITIZE_STRING);
            $telstudentadd = filter_var($_POST['telstudentadd'], FILTER_SANITIZE_NUMBER_INT);
            $emailstudentadd = filter_var($_POST['emailstudentadd'], FILTER_SANITIZE_EMAIL,FILTER_VALIDATE_EMAIL);
            $natstudentadd = filter_var($_POST['natstudentadd'], FILTER_SANITIZE_STRING);
            $startstudentadd = filter_var($_POST['startstudentadd'], FILTER_SANITIZE_STRING);
            $subjstudentadd = implode(' , ',$_POST['subjstudentadd']);
            $usernamestudentadd = filter_var($_POST['usernamestudentadd'], FILTER_SANITIZE_STRING);
            $passstudentadd = filter_var($_POST['passstudentadd'], FILTER_SANITIZE_STRING);
            $add = "DELETE FROM `registeration` WHERE `registeration`.`email` = '{$emailstudentadd}';";
            mysqli_query($link, $add);
            $addstudentsql = "INSERT INTO `students` (username,pass,fname,lname,email,telephone,national_id,subjects,birthdate,startingtime) VALUES ('$usernamestudentadd','$passstudentadd','$fnamestudentadd', '$lnamestudentadd','$emailstudentadd','$telstudentadd','$natstudentadd','$subjstudentadd','$bdatestudentadd','$startstudentadd');";
            if (mysqli_query($link, $addstudentsql)) {
                $addstudentresult= 'Student Added successfully';
            } else {
                $addstudentresult = 'Something went wrong with adding a Studnet';
            }
        } elseif (isset($_POST['editstudent'])) {
            $nationalstudentedit = filter_var($_POST['nationalstudentedit'], FILTER_SANITIZE_STRING);
            $fnamestudentedit = filter_var($_POST['fnamestudentedit'], FILTER_SANITIZE_STRING);
            $lnamestudentedit = filter_var($_POST['lnamestudentedit'], FILTER_SANITIZE_STRING);
            $bdatestudentedit = filter_var($_POST['bdatestudentedit'], FILTER_SANITIZE_STRING);
            $telstudentedit = filter_var($_POST['telstudentedit'], FILTER_SANITIZE_STRING);
            $emailstudentedit = filter_var($_POST['emailstudentedit'], FILTER_SANITIZE_STRING);
            $subjstudentedit = implode(' , ',$_POST['subjstudentedit']);
            $startstudentedit = filter_var($_POST['startstudentedit'], FILTER_SANITIZE_STRING);
            $usernamestudentedit = filter_var($_POST['usernamestudentedit'], FILTER_SANITIZE_STRING);
            $passstudentedit = filter_var($_POST['passstudentedit'], FILTER_SANITIZE_STRING);
            $editstudentfinally = "UPDATE `students` SET `username` = '{$usernamestudentedit}', `pass` = '{$passstudentedit}', `fname` = '{$fnamestudentedit}', `lname` = '{$lnamestudentedit}', `email` = '{$emailstudentedit}', `telephone` = '{$telstudentedit}', `birthdate` = '{$bdatestudentedit}', `subjects` = '{$subjstudentedit}', `startingtime` = '{$startstudentedit}' WHERE `id` = {$nationalstudentedit};";
            if (mysqli_query($link,$editstudentfinally)) {
                $editstudentresult = "Student Edited Successfully";
            } else {
                $editstudentresult = 'Something went wrong with Editing a Student';
            }
        }
        $listteachersql1 = "SELECT * FROM `teachers`;";
        $listteacherquery1 = mysqli_query($link, $listteachersql1);
        $numberteacher1 = mysqli_num_rows($listteacherquery1);
        while ($fetchteacher1 = mysqli_fetch_assoc($listteacherquery1)) {
            if (isset($_POST["teacherdel{$fetchteacher1['id']}"])) {
                $deleteteachersql = "DELETE FROM `teachers` WHERE `teachers`.`id` = {$fetchteacher1['id']};";
                if (mysqli_query($link,$deleteteachersql)) {
                    $deleteteacherresult = "Teacher Deleted successfully";
                } else {
                    $deleteteacherresult = "Something Went wrong with Deleting a teacher";
                }
            }
        }
        $liststudentsql = "SELECT * FROM `students`;";
        $liststudentquery = mysqli_query($link, $liststudentsql);
        $numberstudent = mysqli_num_rows($liststudentquery);
        while ($fetchstudent = mysqli_fetch_assoc($liststudentquery)) {
            if (isset($_POST["studentdel{$fetchstudent['id']}"])) {
                $deletestudentsql = "DELETE FROM `students` WHERE `students`.`id` = {$fetchstudent['id']};";
                if (mysqli_query($link,$deletestudentsql)) {
                    $deletestudentresult = "student Deleted successfully";
                } else {
                    $deletestudentresult = "Something Went wrong with Deleting a student";
                }
            }
        }
        $listregistersql = "SELECT * FROM `registeration`;";
        $listregisterquery = mysqli_query($link, $listregistersql);
        $numberregister = mysqli_num_rows($listregisterquery);
        while ($fetchregister = mysqli_fetch_assoc($listregisterquery)) {
            if (isset($_POST["decline{$fetchregister['id']}"])) {
                $deleteregissql = "DELETE FROM `registeration` WHERE `registeration`.`id` = {$fetchregister['id']};";
                if (mysqli_query($link,$deleteregissql)) {
                    $deleteregisresult = "Resgisteration Deleted successfully";
                } else {
                    $deleteregisresult = "Something Went wrong with Deletation a Resgisteration";
                }
            }
        }
        $listnotifsql = "SELECT * FROM `notifications`;";
        $listnotifquery = mysqli_query($link, $listnotifsql);
        $numbernotif = mysqli_num_rows($listnotifquery);
        while ($fetchnotif = mysqli_fetch_assoc($listnotifquery)) {
            if (isset($_POST["notifdel{$fetchnotif['id']}"])) {
                $deletenotifsql = "DELETE FROM `notifications` WHERE `notifications`.`id` = {$fetchnotif['id']};";
                if (mysqli_query($link,$deletenotifsql)) {
                    $deletenotifresult = "Notification Deleted successfully";
                } else {
                    $deletenotifresult = "Something Went wrong with Deletation a Notification";
                }
            }
        }
        if (isset($_POST['addnotif'])) {
            $messagenotif = filter_var($_POST['messagenotiadd'], FILTER_SANITIZE_STRING);
            $personnotif = filter_var($_POST['selectpersonnotif'], FILTER_SANITIZE_STRING);
            if (substr($personnotif, 0, 7) == 'teacher') {
                $teachernotifsql = "SELECT fname,lname,national_id FROM `teachers` WHERE id = {$personnotif[7]};";
                $teachernotifquery = mysqli_query($link,$teachernotifsql);;
                $teachernotifassoc = mysqli_fetch_assoc($teachernotifquery);
                $teachernotiffname = $teachernotifassoc['fname'];
                $teachernotiflname = $teachernotifassoc['lname'];
                $teachernotifnational = $teachernotifassoc['national_id'];
                $notifteachersql = "INSERT INTO `notifications` (fullname,kind,national_id,messa) VALUES ('$teachernotiffname $teachernotiflname','teacher','$teachernotifnational','$messagenotif');";
                $notifteacherquery = mysqli_query($link,$notifteachersql);
                if ($notifteacherquery) {
                    $notifresult = "Notification Sent Successfully";
                } else {
                    $notifresult = "Something went wrong with sending a notification";
                }
            } elseif (substr($personnotif, 0, 7) == 'student') {
                $studentnotifsql = "SELECT fname,lname,national_id FROM `students` WHERE id = {$personnotif[7]};";
                $studentnotifquery = mysqli_query($link,$studentnotifsql);;
                $studentnotifassoc = mysqli_fetch_assoc($studentnotifquery);
                $studentnotiffname = $studentnotifassoc['fname'];
                $studentnotiflname = $studentnotifassoc['lname'];
                $studentnotifnational = $studentnotifassoc['national_id'];
                $notifstudentsql = "INSERT INTO `notifications` (fullname,kind,national_id,messa) VALUES ('$studentnotiffname $studentnotiflname','student','$studentnotifnational','$messagenotif');";
                $notifstudentquery = mysqli_query($link,$notifstudentsql);
                if ($notifstudentquery) {
                    $notifresult = "Notification Sent Successfully";
                } else {
                    $notifresult = "Something went wrong with sending a notification";
                }
            }
        }
        if (isset($_POST['addsubj'])) {
            $subjinp = filter_var($_POST['subjinp'], FILTER_SANITIZE_STRING);
            $threechar = substr($subjinp,0,3);
            $subjaddsql = "INSERT INTO `subjects` (valuesubject,subjects) VALUES ('{$threechar}','{$subjinp}');";
            if (mysqli_query($link,$subjaddsql)) {
                $subjresult = "Subject added successfully";
            } else {
                $subjresult = "Something went wrong with adding a subject";
            }
        } elseif (isset($_POST['delsubj'])) {
            $selectdelsubj = filter_var($_POST['selectdelsubj'], FILTER_SANITIZE_STRING);
            $subjdelsql = "DELETE FROM `subjects` WHERE `subjects`.`valuesubject` = '{$selectdelsubj}';";
            if (mysqli_query($link,$subjdelsql)) {
                $subjresult = "Subject Deleted successfully";
            } else {
                $subjresult = "Something went wrong with Deleting a subject";
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
    <title>Admin Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../fontawesome-free-5.15.3-web/css/fontawesome.css">
    <link rel="stylesheet" href="../fontawesome-free-5.15.3-web/css/brands.css">
    <link rel="stylesheet" href="../fontawesome-free-5.15.3-web/css/solid.css">
    <link rel="stylesheet" href="../css/admin.css">
    <style>
        #deleteteacher1 {
            height: 100%;
        }
        .tab3 {
            font-family: Arial, Helvetica, sans-serif;
            /* border-collapse: collapse; */
            border-spacing: 0;
            height: 100%;
            width: 99%;
            background-color: white;
            margin-left: 10px;
        }
        .tab3 caption {
            border: 1px solid;
            width: 150px;
            height: 25px;
            text-align: center;
        }
        .tab3 thead tr {
            display: block;
        }
        .tab3 thead tr th {
            width: 480px;
        }
        .tab3 tr:nth-child(even){background-color: #f2f2f2;}
        .tab3 tbody tr:hover {background-color: #ddd;}
        .tab3 th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
        .tab3 tbody {
            display: block;
            height: 430px;
            overflow: auto;
            width: 100%;
        }
        .tab3 tbody tr td {
            width: 480px;
            max-width: 480px;
            overflow-x: auto;
            /* text-align: center; */
        }
        .tab3 td,.tab3 th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .divul {
            display: flex;
            flex-flow: column;
            justify-content: left;
            width: 100%;
            height: 100%;
        }
        .ulreg {
            height: 100%;
        }
        .ulreg li {
            display: flex;
            flex-flow: column;
            justify-content: flex-start;
            width: 100%;
            height: 280px;
            background-color: #EBFEFF;
            /* padding-bottom: 10px; */
        }
        .ulreg li:nth-child(even) {
            background-color: #C2F2F2;
        }
        .ulreg li:hover {
            background-color: #ddd;
        }
        .infoless {
            height: 100px;
            display: flex;
        }
        .infoness {
            height: 150px;
            width: 100%;
        }
        .namereg {
            width: 60%;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            padding-left: 40px;
            cursor: pointer;
        }
        .app {
            margin-left: auto;
            padding-right: 100px;
            width: 40%;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
        .approve {
            color: #fff;
            background-color: #00FFC2;
            border-color: #00FFC2;
            height: 30px;
            width: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .approve:hover {
            color: #fff;
            background-color: #218838;
            border-color: #218838;
            cursor: pointer;
        }
        .decline {
            color: #fff;
            background-color: #FF002B;
            border-color: #FF002B;
            height: 30px;
            width: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .decline:hover {
            color: #fff;
            background-color: #c82333;
            border-color: #bd2130;
            cursor: pointer;
        }
        .allinfo {
            height: 100%;
        }
        .allname,.birthdate,.alltel,.allemail,.allsub,.alltext {
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .alllabel {
            font-size: 20px;
            padding-right: 20px;
        }
        .wholename,.birthdate1,.wholetel,.wholeemail {
            height: 70%;
            width: 300px;
        }
        .allsub p {
            height: 90%;
            width: 300px;
            background-color: #eee;
            overflow-y: scroll;
        }
        #messa {
            height: 90%;
            width: 300px;
        }
        .tab {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            border-spacing: 0;
            height: 100%;
            width: 99%;
            background-color: white;
            margin-left: 10px;
        }
        .tab caption {
            border: 1px solid;
            width: 150px;
            height: 25px;
            text-align: center;
        }
        .tab thead tr {
            display: block;
        }
        .tab thead tr th {
            width: 232px;
        }
        .tab td,.tab th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .tab tr:nth-child(even){background-color: #f2f2f2;}
        .tab tbody tr:hover {background-color: #ddd;}
        .tab th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
        .tab tbody {
            display: block;
            height: 430px;
            overflow: auto;
            width: 100%;
        }
        .tab tbody tr td {
            width: 232px;
            max-width: 232px;
            overflow-x: auto;
        }
        .selectperson {
            height: 15%;
            display: flex;
            flex-direction: column;
            width: 100%;
            align-items: center;
        }
        .selectperson label {
            margin-bottom: 5px;
            background-color: #5C91B6;
            width: 150px;
            text-align: center;
            border-radius: 10px;
        }
        .selectperson select {
            width: 300px;
            height: 70%;
            background-color: #eee;
            border: 1px solid #eee;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="menu">
            <div class="heading">
                <h2>Welcome <?php echo $_SESSION['user'] ?></h2>
            </div>
            <div class="menuContent">
                <ul>
                    <li onclick="this.parentElement.children[0].style.backgroundColor = 'white';this.parentElement.children[1].style.backgroundColor = '#FAF9FE';this.parentElement.children[2].style.backgroundColor = '#FAF9FE';this.parentElement.children[3].style.backgroundColor = '#FAF9FE';listteacher()" id="tchr"><p>Teachers</p></li>
                    <li onclick="this.parentElement.children[0].style.backgroundColor = '#FAF9FE';this.parentElement.children[1].style.backgroundColor = 'white';this.parentElement.children[2].style.backgroundColor = '#FAF9FE';this.parentElement.children[3].style.backgroundColor = '#FAF9FE';liststudent()" id="studs"><p>Students</p></li>
                    <!-- <li onclick="addStudent()" id="adstud">Add a Student</li>
                    <li onclick="addTeacher()">Add a Teacher</li>
                    <li onclick="delStudent()" id="dlstud">Delete/Edit a Student</li>
                    <li onclick="delTeacher()">Delete/Edit a Teacher</li> -->
                    <li onclick="this.parentElement.children[0].style.backgroundColor = '#FAF9FE';this.parentElement.children[1].style.backgroundColor = '#FAF9FE';this.parentElement.children[2].style.backgroundColor = 'white';this.parentElement.children[3].style.backgroundColor = '#FAF9FE';registers()" id="regs"><p>Registerations</p></li>
                    <li onclick="this.parentElement.children[0].style.backgroundColor = '#FAF9FE';this.parentElement.children[1].style.backgroundColor = '#FAF9FE';this.parentElement.children[2].style.backgroundColor = '#FAF9FE';this.parentElement.children[3].style.backgroundColor = 'white';listnotif()" id="notifs"><p>Notifications</p></li>
                    <!-- <li onclick="addNotif()" id="adnoti">Add a Notif.</li> -->
                    <hr>
                </ul>
            </div>
            <div class="logout">
                <div class="log-out">
                    <a href="../backendAll/logout.php">Log Out</a>
                </div>
                <div class="sett">
                    <p onclick="addsubject()">Settings</p>
                </div>
            </div>
        </div>
        <div class="model" id="modal">
                <?php
                    if (isset($_POST['addteacher'])) {
                        echo $addteacherresult;
                    } elseif (isset($_POST['addstudent'])) {
                        echo $addstudentresult;
                    } elseif (isset($_POST['editteacher'])) {
                        echo $editteacherresult;
                    } elseif (isset($_POST['editstudent'])) {
                        echo $editstudentresult;
                    } elseif (isset($_POST['addnotif'])) {
                        echo $notifresult;
                    } elseif (isset($_POST['addsubj']) or isset($_POST['delsubj'])) {
                        echo $subjresult;
                    }
                    // $sql = "SELECT * FROM `subjects`;";
                    // $query = mysqli_query($link, $sql);
                    // echo "<select>";
                    // while ($sql1 = mysqli_fetch_assoc($query)) {
                        
                    //      for ($i=0; $i < count($sql1); $i++) { 
                    //         echo "<option>{$sql1['subjects']}</option>";
                        // }
                        
                    // }
                    // echo "</select>";
                ?>
            <!-- <div id="deletestudent">
                <div id="buttons">
                    <button id="btn1">Delete</button>
                    <button id="btn2">Edit</button>
                </div>
            </div> -->
        </div>
    </div>
    <!-- <script>
        document.getElementById("btn1").addEventListener("click", function(event){
            event.preventDefault();
        });
        document.getElementById("btn2").addEventListener("click", function(event){
            event.preventDefault();
        });
    </script> -->
    <script>
        let modal = document.getElementById("modal");
        let conte = document.getElementById("conte");
        let studs = document.getElementById("studs");
        function addsubject(){
            modal.innerHTML = `
                <div id="addsubject" style="height: 100%;">
                    <div class="head1">
                        <div class="menubar">
                            <ul>
                                <li><p onclick="addsubject()">Add a Subject</p></li>
                                <li><p onclick="deletesubject()">Delete a Subject</p></li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="content1">
                        <form action="admin.php" method="POST" style="height: 100%;display:flex;flex-direction: column;justify-content: center;">
                            <div class="subjadd" style="display: flex;flex-direction: column;align-items: center;">
                                <label for="addsubj" style="font-size: 25px;">Add a Subject</label>
                                <input style="width:400px;height: 40px;margin: 10px 0;" required type="text" name="subjinp" id="addsubj">
                            </div>
                            <div class="substud">
                                <input class="btn" type="submit" value="Submit" name="addsubj">    
                            </div>
                        </form>
                    </div>
                </div>
            `;
        }
        function deletesubject(){
            modal.innerHTML = `
                <div id="delsubject" style="height: 100%;">
                    <div class="head1">
                        <div class="menubar">
                            <ul>
                                <li><p onclick="addsubject()">Add a Subject</p></li>
                                <li><p onclick="deletesubject()">Delete a Subject</p></li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="content1">
                        <form action="admin.php" method="POST" style="height: 100%;display:flex;flex-direction: column;justify-content: center;">
                            <div class="subjadd" style="display: flex;flex-direction: column;align-items: center;">
                                <label for="delsubj" style="font-size: 25px;">Delete a Subject</label>
                                <select style="width:400px;height: 40px;margin: 10px 0;font-size: 15px;" required name="selectdelsubj" id="selectdelsubj">
                                    <option value=""></option>
                                    <?php
                                        $listsubjectsql = "SELECT * FROM `subjects`;";
                                        $listsubjectquery = mysqli_query($link, $listsubjectsql);
                                        $numberteacher = mysqli_num_rows($listsubjectquery);
                                        while ($fetchsubject = mysqli_fetch_assoc($listsubjectquery)) {
                                            echo "
                                                <option value='{$fetchsubject['valuesubject']}'>{$fetchsubject['subjects']}</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="substud">
                                <input class="btn" type="submit" value="Delete" name="delsubj">    
                            </div>
                        </form>
                    </div>
                </div>
            `;
        }
        function registers(){
            modal.innerHTML = `
            <div id="register">
                <div style="margin-right: 0;width: 100%;justify-content: center;" class="head1">
                    <div style="margin-right: 0;width: 100%;justify-content: center;" class="teach">
                        <h1 style="width: 197px;">Registerations</h1>
                    </div>
                </div>
                <div class="content1" style="overflow-y: scroll;">
                    <form action="admin.php" method="POST">
                        <div class="divul">
                            <ul class="ulreg">
                                <?php
                                    $listregistersql = "SELECT * FROM `registeration`;";
                                    $listregisterquery = mysqli_query($link, $listregistersql);
                                    $numberregister = mysqli_num_rows($listregisterquery);
                                    while ($fetchregister = mysqli_fetch_assoc($listregisterquery)) {
                                        echo "
                                            <li id='li{$fetchregister['id']}' style='height:100px;'>
                                                <div class='infoless'>
                                                    <div id='namereg{$fetchregister['id']}' class='namereg'>
                                                        {$fetchregister['fname']} {$fetchregister['lname']}
                                                    </div>
                                                    <div class='app'>
                                                        <p onclick='addstudent{$fetchregister['id']}()' class='approve'>Approve</p>
                                                        <button name='decline{$fetchregister['id']}' class='decline'>Delete</button>
                                                    </div>
                                                </div>
                                                <div id='infoness{$fetchregister['id']}' class='infoness' style='display:none;'>
                                                    <div class='allinfo'>
                                                        <div style='display:flex;justify-content:center;'>
                                                            <div class='allname all'>
                                                                <label class='alllabel' for='wholename'>Full Name: </label>
                                                                <input disabled type='text' name='wholename' id='wholename1' value='{$fetchregister['fname']} {$fetchregister['lname']}' class='wholename'>
                                                            </div>
                                                            <div class='birthdate all'>
                                                                <label class='alllabel' for='birthdate'>Birthdate: </label>
                                                                <input disabled type='date' name='birthdate' id='birthdate1' value='{$fetchregister['birthdate']}' class='birthdate1'>
                                                            </div>
                                                        </div>
                                                        <div style='display:flex;justify-content:center;'>
                                                            <div class='alltel all'>
                                                                <label class='alllabel' for='wholetel'>Telephone: </label>
                                                                <input disabled type='tel' name='wholetel' id='wholetel' value='{$fetchregister['telephone']}' class='wholetel'>
                                                            </div>
                                                            <div class='allemail all'>
                                                                <label class='alllabel' for='wholeemail'>Email: </label>
                                                                <input disabled type='email' name='wholeemail' id='wholeemail' value='{$fetchregister['email']}' class='wholeemail'>
                                                            </div>
                                                        </div>
                                                        <div style='display:flex;justify-content:center;'>
                                                            <div class='alltext all'>
                                                                <label class='alllabel' for='textarea'>Message: </label>
                                                                <textarea name='messa' id='messa' value='' disabled>{$fetchregister['message']}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        ";
                                    }
                                ?>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
            `;
            <?php 
                $listregistersql = "SELECT * FROM `registeration`;";
                $listregisterquery = mysqli_query($link, $listregistersql);
                $numberregister = mysqli_num_rows($listregisterquery);
                echo "$(document).ready(function(){";
                while ($fetchregister = mysqli_fetch_assoc($listregisterquery)) {
                    echo "
                        $('#namereg{$fetchregister['id']}').click(function(){
                            if ($('#infoness{$fetchregister['id']}').css('display') == 'none') {
                                $('#infoness{$fetchregister['id']}').slideDown(function(){
                                    $('#li{$fetchregister['id']}').css('height', '280px');
                                });
                            } else {if ($('#infoness{$fetchregister['id']}').css('display') == 'block') {
                                $('#infoness{$fetchregister['id']}').slideUp(function(){
                                    $('#li{$fetchregister['id']}').css('height', '100px');
                                });
                            }}
                        });
                    ";
                }
                echo "})";
            ?>
        }
        <?php
            $listregistersql = "SELECT * FROM `registeration`;";
            $listregisterquery = mysqli_query($link, $listregistersql);
            $numberregister = mysqli_num_rows($listregisterquery);
            while ($fetchregister = mysqli_fetch_assoc($listregisterquery)) {
                echo "function addstudent{$fetchregister['id']}(){
                    addstudent();
                    studs.parentElement.children[0].style.backgroundColor = '#FAF9FE';studs.parentElement.children[1].style.backgroundColor = 'white';studs.parentElement.children[2].style.backgroundColor = '#FAF9FE';studs.parentElement.children[3].style.backgroundColor = '#FAF9FE';
                    document.getElementById('fnamestudentadd').value = '{$fetchregister['fname']}';
                    document.getElementById('lnamestudentadd').value = '{$fetchregister['lname']}';
                    document.getElementById('bdatestudentadd').value = '{$fetchregister['birthdate']}';
                    document.getElementById('telstudentadd').value = '{$fetchregister['telephone']}';
                    document.getElementById('emailstudentadd').value = '{$fetchregister['email']}';";
                echo "}";
            }
        ?>
        function listteacher(){
            modal.innerHTML = `
            <div id="teachers">
                <div class="head1" style="height:14%;">
                    <div class="menubar">
                        <ul>
                            <li><p onclick="addteacher()">Add a Teacher</p></li>
                            <li><p onclick="editteacher()">Edit a Teacher</p></li>
                            <li><p onclick="delteacher()">Delete a Teacher</p></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="content1">
                    <table class="tab1" style="height:95%;">
                        <caption>Number: <span style="font-size:20px;"><?php
                            $listteachersql = "SELECT * FROM `teachers`;";
                            $listteacherquery = mysqli_query($link, $listteachersql);
                            $numberteacher = mysqli_num_rows($listteacherquery);
                            echo $numberteacher; 
                         ?></span></caption>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>username</th>
                                <th>password</th>
                                <th>Name</th>
                                <th>Telephone</th>
                                <th>email</th>
                                <th>National ID</th>
                                <th>subject</th>
                                <th>Starting Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listteachersql = "SELECT * FROM `teachers`;";
                            $listteacherquery = mysqli_query($link, $listteachersql);
                            $numberteacher = mysqli_num_rows($listteacherquery);
                            while ($fetchteacher = mysqli_fetch_assoc($listteacherquery)) {
                                echo "
                                <tr>
                                    <td>{$fetchteacher['id']}</td>
                                    <td>{$fetchteacher['username']}</td>
                                    <td>{$fetchteacher['pass']}</td>
                                    <td>{$fetchteacher['fname']} {$fetchteacher['lname']}</td>
                                    <td>{$fetchteacher['telephone']}</td>
                                    <td>{$fetchteacher['email']}</td>
                                    <td>{$fetchteacher['national_id']}</td>
                                    <td>{$fetchteacher['subjects']}</td>
                                    <td>{$fetchteacher['startingtime']}</td>
                                </tr>
                                ";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            `;
        }
        function addteacher(){
            modal.innerHTML = `
            <div id="addTeacher">
                <div class="head1">
                    <div class="menubar">
                        <ul>
                            <li><p onclick="addteacher()">Add a Teacher</p></li>
                            <li><p onclick="editteacher()">Edit a Teacher</p></li>
                            <li><p onclick="delteacher()">Delete a Teacher</p></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="content1" id="conte">
                    <form style="padding-top:40px;" action="admin.php" method="POST">
                        <div class="name">
                            <div class="all">
                                <label for="fname">First Name: </label>
                                <input type="text" required name="fnameteacheradd" id="fnameteacheradd">
                            </div>
                            <div class="all">
                                <label for="lname">Last Name: </label>
                                <input type="text" required name="lnameteacheradd" id="lnameteacheradd">
                            </div>
                        </div>
                        <div class="con">
                            <div class="all">
                                <label for="tel">TelePhone: </label>
                                <input type="tel" required name="telteacheradd" id="telteacheradd">
                            </div>
                            <div class="all">
                                <label for="email">Email: </label>
                                <input type="email" required name="emailteacheradd" id="emailteacheradd">
                            </div>
                        </div>
                        <div class="num">
                            <div class="all">
                                <label for="nat">National ID: </label>
                                <input type="text" required name="natteahceradd" id="natteacheradd">
                            </div>
                            <div class="all">
                                <label for="starttime">Starting Time: </label>
                                <input type="date" required name="startteacheradd" id="startteacheradd">
                            </div>
                        </div>
                        <div class="subb">
                            <div class="subj">
                                <label for="subj">Subjects to be teached: </label>
                                <select multiple name="subjteacheradd[]" id="subjectteacheradd">
                                    <?php
                                        $listsubjectsql = "SELECT * FROM `subjects`;";
                                        $listsubjectquery = mysqli_query($link, $listsubjectsql);
                                        $numberteacher = mysqli_num_rows($listsubjectquery);
                                        while ($fetchsubject = mysqli_fetch_assoc($listsubjectquery)) {
                                            echo "
                                                <option value='{$fetchsubject['valuesubject']}'>{$fetchsubject['subjects']}</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <hr style="margin:35px 0 20px 0;">
                        <div class="users">
                            <div class="all">
                                <label for="username">Username: </label>
                                <input type="text" required name="usernameteacheradd" id="usernameteacheradd">
                            </div>
                            <div class="all">
                                <label for="pass">Password: </label>
                                <input type="password" required name="passteacheradd" id="passteacheradd">
                                <span class="fas fa-eye" onclick="showpass2()" id="eye"></span>
                            </div>
                        </div>
                        <div class="substud">
                            <input class="btn" type="submit" value="Submit" name="addteacher">    
                        </div>
                    </form>
                </div>
            </div>
            `;
        }
        function delteacher(){
            modal.innerHTML = `
            <div id="deleteteacher1">
                <div class="head1" style="height:14%;">
                    <div class="menubar">
                        <ul>
                            <li><p onclick="addteacher()">Add a Teacher</p></li>
                            <li><p onclick="editteacher()">Edit a Teacher</p></li>
                            <li><p onclick="delteacher()">Delete a Teacher</p></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="content1">
                    <form action="admin.php" method="POST">
                        <table class="tab3" style="height:95%;">
                            <caption>Number: <span style="font-size:20px;"><?php
                                $listteachersql = "SELECT * FROM `teachers`;";
                                $listteacherquery = mysqli_query($link, $listteachersql);
                                $numberteacher = mysqli_num_rows($listteacherquery);
                                echo $numberteacher; 
                            ?></span></caption>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody style="height:406px;">
                                <?php
                                    $listteachersql = "SELECT * FROM `teachers`;";
                                    $listteacherquery = mysqli_query($link, $listteachersql);
                                    $numberteacher = mysqli_num_rows($listteacherquery);
                                    while ($fetchteacher = mysqli_fetch_assoc($listteacherquery)) {
                                        echo "
                                        <tr>
                                            <td>{$fetchteacher['fname']} {$fetchteacher['lname']}</td>
                                            <td style='display:flex;justify-content:center;'><input type='submit' value='Delete' style='width:100px;background-color:#F30000;border:1px solid #F30000;cursor:pointer;' name='teacherdel{$fetchteacher['id']}'></td>
                                        </tr>
                                        ";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            `;
        }
        function editteacher(){
            modal.innerHTML = `
            <div id="editteacher">
                <div class="head1">
                    <div class="menubar">
                        <ul>
                            <li><p onclick="addteacher()">Add a Teacher</p></li>
                            <li><p onclick="editteacher()">Edit a Teacher</p></li>
                            <li><p onclick="delteacher()">Delete a Teacher</p></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="content1">
                    <form action="admin.php" method="POST">
                        <div class="national">
                            <div class="nationalnumber" id="national">
                                <label for="national">National ID: </label>
                                <select onchange="teacherchange()" required name="nationalteacheredit" id="nationalteacheredit">
                                    <option value=""></option>
                                    <?php
                                        $listteachersql = "SELECT * FROM `teachers`;";
                                        $listteacherquery = mysqli_query($link, $listteachersql);
                                        $numberteacher = mysqli_num_rows($listteacherquery);
                                        while ($fetchteacher = mysqli_fetch_assoc($listteacherquery)) {
                                            echo "
                                                <option value='{$fetchteacher['id']}'>{$fetchteacher['national_id']}</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="name">
                            <div class="all">
                                <label for="fname">First Name: </label>
                                <input required value="" type="text" name="fnameteacheredit" id="fnameteacheredit">
                            </div>
                            <div class="all">
                                <label for="lname">Last Name: </label>
                                <input required value="" type="text" name="lnameteacheredit" id="lnameteacheredit">
                            </div>
                        </div>
                        <div class="con">
                            <div class="all">
                                <label for="tel">TelePhone: </label>
                                <input required value="" type="tel" name="telteacheredit" id="telteacheredit">
                            </div>
                            <div class="all">
                                <label for="email">Email: </label>
                                <input required value="" type="email" name="emailteacheredit" id="emailteacheredit">
                            </div>
                        </div>
                        <div class="num">
                            <div class="all">
                                <label for="starttime">Starting Time: </label>
                                <input required value="" type="date" name="startteacheredit" id="startteacheredit">
                            </div>
                            <div class="subj" id="su">
                                <label for="subj">Subjects to be teached: </label>
                                <select required multiple name="subjteacheredit[]" id="subjectteacheredit">
                                    <?php
                                        $listsubjectsql = "SELECT * FROM `subjects`;";
                                        $listsubjectquery = mysqli_query($link, $listsubjectsql);
                                        $numberteacher = mysqli_num_rows($listsubjectquery);
                                        while ($fetchsubject = mysqli_fetch_assoc($listsubjectquery)) {
                                            echo "
                                                <option value='{$fetchsubject['valuesubject']}'>{$fetchsubject['subjects']}</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <hr style="margin:35px 0 20px 0;">
                        <div class="users">
                            <div class="all">
                                <label for="username">Username: </label>
                                <input required value="" type="text" name="usernameteacheredit" id="usernameteacheredit">
                            </div>
                            <div class="all">
                                <label for="pass">Password: </label>
                                <input required value="" type="password" name="passteacheredit" id="passteacheredit">
                                <span class="fas fa-eye" onclick="showpass1()" id="eye"></span>
                            </div>
                        </div>
                        <div class="substud">
                            <input class="btn" type="submit" value="Edit" name="editteacher">    
                        </div>
                    </form>
                </div>
            </div>
            `;
        }
        function teacherchange(){
        <?php
            $listteachersql = "SELECT * FROM `teachers`;";
            $listteacherquery = mysqli_query($link, $listteachersql);
            $numberteacher = mysqli_num_rows($listteacherquery);
            while ($fetchteacher = mysqli_fetch_assoc($listteacherquery)) {
                $subjectteacher = explode(' , ',$fetchteacher['subjects']);
                $subjectteachernum = count($subjectteacher);
                $listsubjectsql = "SELECT * FROM `subjects`;";
                $listsubjectquery = mysqli_query($link, $listsubjectsql);
                $numbersubject = mysqli_num_rows($listsubjectquery);
                while ($listsubject = mysqli_fetch_assoc($listsubjectquery)) {
                    foreach ($subjectteacher as $key) {
                        if ($key == $listsubject['valuesubject']) {
                            echo "
                                if (document.getElementById('nationalteacheredit').value == {$fetchteacher['id']}) {
                                    for (var i of document.getElementById('subjectteacheredit').children) {
                                        if (i.value == '{$key}') {
                                            i.setAttribute('selected','selected')
                                        }
                                    }
                                }
                            ";
                        }
                    }
                }
                // while ($fetchsubject = mysqli_fetch_assoc($listsubjectquery)) {
                    
                // }
                echo "
                    if (document.getElementById('nationalteacheredit').value == {$fetchteacher['id']}) {
                        document.getElementById('fnameteacheredit').value = '{$fetchteacher['fname']}';
                        document.getElementById('lnameteacheredit').value = '{$fetchteacher['lname']}';
                        document.getElementById('telteacheredit').value = '{$fetchteacher['telephone']}';
                        document.getElementById('emailteacheredit').value = '{$fetchteacher['email']}';
                        document.getElementById('startteacheredit').value = '{$fetchteacher['startingtime']}';
                        document.getElementById('usernameteacheredit').value = '{$fetchteacher['username']}';
                        document.getElementById('passteacheredit').value = '{$fetchteacher['pass']}';
                    }
                ";
            }
        ?>
        }
        function addstudent(){
            modal.innerHTML = `
            <div id="addStudent">
                <div class="head1">
                    <div class="menubar">
                        <ul>
                            <li><p onclick="addstudent()">Add a Student</p></li>
                            <li><p onclick="editstudent()">Edit a Student</p></li>
                            <li><p onclick="delstudent()">Delete a Student</p></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="content1">
                    <form action="admin.php" method="POST">
                        <div class="name">
                            <div class="all">
                                <label for="fname">First Name: </label>
                                <input required type="text" name="fnamestudentadd" id="fnamestudentadd">
                            </div>
                            <div class="all">
                                <label for="lname">Last Name: </label>
                                <input required type="text" name="lnamestudentadd" id="lnamestudentadd">
                            </div>
                        </div>
                        <div class="dt">
                            <div class="all">
                                <label for="bdate">Birth Date: </label>
                                <input required type="date" name="bdatestudentadd" id="bdatestudentadd">
                            </div>
                        </div>
                        <div class="con">
                            <div class="all">
                                <label for="tel">TelePhone: </label>
                                <input required type="tel" name="telstudentadd" id="telstudentadd">
                            </div>
                            <div class="all">
                                <label for="email">Email: </label>
                                <input required type="email" name="emailstudentadd" id="emailstudentadd">
                            </div>
                        </div>
                        <div class="num">
                            <div class="all">
                                <label for="nat">National ID: </label>
                                <input required type="text" name="natstudentadd" id="natstudentadd">
                            </div>
                            <div class="all">
                                <label for="starttime">Starting Time: </label>
                                <input required type="date" name="startstudentadd" id="startstudentadd">
                            </div>
                        </div>
                        <div class="subb">
                            <div class="subj">
                                <label for="subj">Subjects: </label>
                                <select multiple name="subjstudentadd[]" id="subjstudentadd">
                                    <?php
                                        $listsubjectsql = "SELECT * FROM `subjects`;";
                                        $listsubjectquery = mysqli_query($link, $listsubjectsql);
                                        $numberteacher = mysqli_num_rows($listsubjectquery);
                                        while ($fetchsubject = mysqli_fetch_assoc($listsubjectquery)) {
                                            echo "
                                                <option value='{$fetchsubject['valuesubject']}'>{$fetchsubject['subjects']}</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <hr style="margin:35px 0 5px 0;">
                        <div class="users">
                            <div class="all">
                                <label for="username">Username: </label>
                                <input required type="text" name="usernamestudentadd" id="usernamestudentadd">
                            </div>
                            <div class="all">
                                <label for="pass">Password: </label>
                                <input required type="password" name="passstudentadd" id="passstudentadd">
                                <span class="fas fa-eye" onclick="showpass3()" id="eye"></span>
                            </div>
                        </div>
                        <div class="substud">
                            <input class="btn" type="submit" value="Submit" name="addstudent">    
                        </div>
                    </form>
                </div>
            </div>
            `;
        }
        function delstudent(){
            modal.innerHTML = `
            <div id="deletestudent1">
                <div class="head1" style="height:14%;">
                    <div class="menubar">
                        <ul>
                            <li><p onclick="addstudent()">Add a Student</p></li>
                            <li><p onclick="editstudent()">Edit a Student</p></li>
                            <li><p onclick="delstudent()">Delete a Student</p></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="content1">
                    <form action="admin.php" method="POST">
                        <table class="tab3" style="height:95%;">
                            <caption>Number: <span style="font-size:20px;"><?php
                                $liststudentsql = "SELECT * FROM `students`;";
                                $liststudentquery = mysqli_query($link, $liststudentsql);
                                $numberstudent = mysqli_num_rows($liststudentquery);
                                echo $numberstudent; 
                            ?></span></caption>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody style="height:406px;">
                                <?php
                                    $liststudentsql = "SELECT * FROM `students`;";
                                    $liststudentquery = mysqli_query($link, $liststudentsql);
                                    $numberstudent = mysqli_num_rows($liststudentquery);
                                    while ($fetchstudent = mysqli_fetch_assoc($liststudentquery)) {
                                        echo "
                                        <tr>
                                            <td>{$fetchstudent['fname']} {$fetchstudent['lname']}</td>
                                            <td style='display:flex;justify-content:center;'><input type='submit' value='Delete' style='width:100px;background-color:#F30000;border:1px solid #F30000;cursor:pointer;' name='studentdel{$fetchstudent['id']}'></td>
                                        </tr>
                                        ";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            `;
        }
        function editstudent(){
            modal.innerHTML = `
            <div id="editstudent">
                <div class="head1">
                    <div class="menubar">
                        <ul>
                            <li><p onclick="addstudent()">Add a Student</p></li>
                            <li><p onclick="editstudent()">Edit a Student</p></li>
                            <li><p onclick="delstudent()">Delete a Student</p></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="content1">
                    <form action="" method="POST">
                        <div class="national">
                            <div class="nationalnumber" id="national">
                                <label for="national">National ID: </label>
                                <select onchange="studentchange()" name="nationalstudentedit" id="nationalstudentedit">
                                    <option value=""></option>
                                    <?php
                                        $liststudentsql = "SELECT * FROM `students`;";
                                        $liststudentquery = mysqli_query($link, $liststudentsql);
                                        $numberstudent = mysqli_num_rows($liststudentquery);
                                        while ($fetchstudent = mysqli_fetch_assoc($liststudentquery)) {
                                            echo "
                                                <option value='{$fetchstudent['id']}'>{$fetchstudent['national_id']}</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="name">
                            <div class="all">
                                <label for="fname">First Name: </label>
                                <input required value="" type="text" name="fnamestudentedit" id="fnamestudentedit">
                            </div>
                            <div class="all">
                                <label for="lname">Last Name: </label>
                                <input required value="" type="text" name="lnamestudentedit" id="lnamestudentedit">
                            </div>
                        </div>
                        <div class="dt">
                            <div class="all">
                                <label for="bdate">Birth Date: </label>
                                <input required value="" type="date" name="bdatestudentedit" id="bdatestudentedit">
                            </div>
                        </div>
                        <div class="con">
                            <div class="all">
                                <label for="tel">TelePhone: </label>
                                <input required value="" type="tel" name="telstudentedit" id="telstudentedit">
                            </div>
                            <div class="all">
                                <label for="email">Email: </label>
                                <input required value="" type="email" name="emailstudentedit" id="emailstudentedit">
                            </div>
                        </div>
                        <div class="num">
                            <div class="subj">
                                <label for="subj">Subjects: </label>
                                <select required multiple name="subjstudentedit[]" id="subjectstudentedit">
                                    <?php
                                        $listsubjectsql = "SELECT * FROM `subjects`;";
                                        $listsubjectquery = mysqli_query($link, $listsubjectsql);
                                        $numberteacher = mysqli_num_rows($listsubjectquery);
                                        while ($fetchsubject = mysqli_fetch_assoc($listsubjectquery)) {
                                            echo "
                                                <option value='{$fetchsubject['valuesubject']}'>{$fetchsubject['subjects']}</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="all">
                                <label for="starttime">Starting Time: </label>
                                <input required type="date" value="" name="startstudentedit" id="startstudentedit">
                            </div>
                        </div>
                        <hr style="margin:35px 0 5px 0;">
                        <div class="users">
                            <div class="all">
                                <label for="username">Username: </label>
                                <input required type="text" value="" name="usernamestudentedit" id="usernamestudentedit">
                            </div>
                            <div class="all">
                                <label for="pass">Password: </label>
                                <input required type="password" value="" name="passstudentedit" id="passstudentedit">
                                <span class="fas fa-eye" onclick="showpass4()" id="eye"></span>
                            </div>
                        </div>
                        <div class="substud">
                            <input class="btn" type="submit" value="Edit" name="editstudent">
                        </div>
                    </form>
                </div>
            </div>
            `;
        }
        function studentchange(){
        <?php
            $liststudentsql = "SELECT * FROM `students`;";
            $liststudentquery = mysqli_query($link, $liststudentsql);
            $numberstudent = mysqli_num_rows($liststudentquery);
            while ($fetchstudent = mysqli_fetch_assoc($liststudentquery)) {
                $subjectstudent = explode(' , ',$fetchstudent['subjects']);
                $subjectstudentnum = count($subjectstudent);
                $listsubjectsql = "SELECT * FROM `subjects`;";
                $listsubjectquery = mysqli_query($link, $listsubjectsql);
                $numbersubject = mysqli_num_rows($listsubjectquery);
                while ($listsubject = mysqli_fetch_assoc($listsubjectquery)) {
                    foreach ($subjectstudent as $key) {
                        if ($key == $listsubject['valuesubject']) {
                            echo "
                                if (document.getElementById('nationalstudentedit').value == {$fetchstudent['id']}) {
                                    for (var i of document.getElementById('subjectstudentedit').children) {
                                        if (i.value == '{$key}') {
                                            i.setAttribute('selected','selected')
                                        }
                                    }
                                }
                            ";
                        }
                    }
                }
                // while ($fetchsubject = mysqli_fetch_assoc($listsubjectquery)) {
                    
                // }
                echo "
                    if (document.getElementById('nationalstudentedit').value == {$fetchstudent['id']}) {
                        document.getElementById('fnamestudentedit').value = '{$fetchstudent['fname']}';
                        document.getElementById('lnamestudentedit').value = '{$fetchstudent['lname']}';
                        document.getElementById('telstudentedit').value = '{$fetchstudent['telephone']}';
                        document.getElementById('emailstudentedit').value = '{$fetchstudent['email']}';
                        document.getElementById('startstudentedit').value = '{$fetchstudent['startingtime']}';
                        document.getElementById('usernamestudentedit').value = '{$fetchstudent['username']}';
                        document.getElementById('passstudentedit').value = '{$fetchstudent['pass']}';
                        document.getElementById('bdatestudentedit').value = '{$fetchstudent['birthdate']}';
                    }
                ";
            }
        ?>
        }
        function liststudent(){
            modal.innerHTML = `
            <div id="students">
                <div class="head1">
                    <div class="menubar">
                        <ul>
                            <li><p onclick="addstudent()">Add a Student</p></li>
                            <li><p onclick="editstudent()">Edit a Student</p></li>
                            <li><p onclick="delstudent()">Delete a Student</p></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="content1">
                    <table class="tab2" style="height:95%;">
                        <caption>Number: <span style="font-size:20px;"><?php
                            $liststudentsql = "SELECT * FROM `students`;";
                            $liststudentquery = mysqli_query($link, $liststudentsql);
                            $numberstudent = mysqli_num_rows($liststudentquery);
                            echo $numberstudent;
                         ?></span></caption>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>username</th>
                                <th>password</th>
                                <th>Name</th>
                                <th>Birth Date</th>
                                <th>Telephone</th>
                                <th>Subjects</th>
                                <th>email</th>
                                <th>National ID</th>
                                <th>Starting time</th>
                            </tr>
                        </thead>
                        <tbody style="height:406px;">
                            <?php
                                $liststudentsql = "SELECT * FROM `students`;";
                                $liststudentquery = mysqli_query($link, $liststudentsql);
                                $numberstudent = mysqli_num_rows($liststudentquery);
                                while ($fetchstudent = mysqli_fetch_assoc($liststudentquery)) {
                                    echo "
                                    <tr>
                                        <td>{$fetchstudent['id']}</td>
                                        <td>{$fetchstudent['username']}</td>
                                        <td>{$fetchstudent['pass']}</td>
                                        <td>{$fetchstudent['fname']} {$fetchstudent['lname']}</td>
                                        <td>{$fetchstudent['birthdate']}</td>
                                        <td>{$fetchstudent['telephone']}</td>
                                        <td>{$fetchstudent['subjects']}</td>
                                        <td>{$fetchstudent['email']}</td>
                                        <td>{$fetchstudent['national_id']}</td>
                                        <td>{$fetchstudent['startingtime']}</td>
                                    </tr>
                                    ";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            `;
        }
        function addnotif(){
            modal.innerHTML = `
            <div id="addnotific">
                <div style="margin-right: 0;width: 100%;justify-content: center;flex-flow: row;" class="head1">
                    <div class="menubar">
                        <ul>
                            <li><p onclick="addnotif()">Add a Notif</p></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="content1">
                    <form class="form3" action="admin.php" method="POST">
                        <div class="textare2">
                            <label for="textarea">Message </label>
                            <textarea required name="messagenotiadd" id="messagenotiadd" cols="40" rows="10"></textarea>
                        </div>
                        <div class="selectstudteach">
                            <div class="selectteach">
                                <p onclick="listallteachernotif()" class="btn allteach">Teacher</p>
                            </div>
                            <div class="selectstud">
                                <p onclick="listallstudentnotif()" class="btn allteach">Student</p>
                            </div>
                        </div>
                        <div class="selectperson" id="showperson">
                            <label for="selectperson">Select Person </label>
                            <select required name="selectpersonnotif" id="selectpersonnotif">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="submit1">
                            <input class="btn allsub" name="addnotif" type="submit" value="Send">
                        </div>
                    </form>
                </div>
            </div>
            `;
        }
        function listallteachernotif(){
            <?php
                $listteachersql = "SELECT * FROM `teachers`;";
                $listteacherquery = mysqli_query($link, $listteachersql);
                $numberteacher = mysqli_num_rows($listteacherquery);
                echo "
                    document.getElementById('showperson').innerHTML = `
                    <label for='selectperson'>Select Person </label>
                    <select required name='selectpersonnotif' id='selectpersonnotif'>
                ";
                while ($fetchteacher = mysqli_fetch_assoc($listteacherquery)) {
                    echo "<option value='teacher{$fetchteacher['id']}'>{$fetchteacher['fname']} {$fetchteacher['lname']}</option>";
                }
                echo "</select>
                `";
            ?>
        }
        function listallstudentnotif(){
            <?php
                $liststudentsql = "SELECT * FROM `students`;";
                $liststudentquery = mysqli_query($link, $liststudentsql);
                $numberstudent = mysqli_num_rows($liststudentquery);
                echo "
                    document.getElementById('showperson').innerHTML = `
                    <label for='selectperson'>Select Person </label>
                    <select required name='selectpersonnotif' id='selectpersonnotif'>
                ";
                while ($fetchstudent = mysqli_fetch_assoc($liststudentquery)) {
                    echo "<option value='student{$fetchstudent['id']}'>{$fetchstudent['fname']} {$fetchstudent['lname']}</option>";
                }
                echo "</select>
                `";
            ?>
        }
        function listnotif(){
            modal.innerHTML = `
            <div id="notific">
                <div style="margin-right: 0;width: 100%;justify-content: center;flex-flow: row;" class="head1">
                    <div class="menubar">
                        <ul>
                            <li><p onclick="addnotif()">Add a Notif</p></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="content1">
                    <form action="admin.php" method="POST">
                        <table class="tab">
                            <caption>Number: <span style="font-size:20px;"><?php
                                $listnotifsql = "SELECT * FROM `notifications`;";
                                $listnotifquery = mysqli_query($link, $listnotifsql);
                                $numbernotif = mysqli_num_rows($listnotifquery);
                                echo $numbernotif;
                            ?></span></caption>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Teacher/Student</th>
                                    <th>message</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $listnotifsql = "SELECT * FROM `notifications`;";
                                    $listnotifquery = mysqli_query($link, $listnotifsql);
                                    $numbernotif = mysqli_num_rows($listnotifquery);
                                    while ($fetchnotif = mysqli_fetch_assoc($listnotifquery)) {
                                        echo "
                                        <tr>
                                            <td>{$fetchnotif['fullname']}</td>
                                            <td>{$fetchnotif['kind']}</td>
                                            <td>{$fetchnotif['messa']}</td>
                                            <td style='display:flex;justify-content:center;'><input type='submit' value='Delete' style='width:100px;background-color:#F30000;border:1px solid #F30000;cursor:pointer;' name='notifdel{$fetchnotif['id']}'></td>
                                        </tr>
                                        ";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            `;
        }
        function showpass1(){
            document.getElementById('passteacheredit').setAttribute('type','text');
        }
        function showpass2(){
            document.getElementById('passteacheradd').setAttribute('type','text');
        }
        function showpass3(){
            document.getElementById('passstudentadd').setAttribute('type','text');
        }
        function showpass4(){
            document.getElementById('passstudentedit').setAttribute('type','text');
        }
        /* $(document).ready(function(){
            $("button").click(function(){
                $("#pa").slideToggle();
            });
        }); */
    </script>
</body>
</html>