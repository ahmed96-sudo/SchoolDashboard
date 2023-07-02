<?php
    session_start();
    include("../backendAll/connect.php");

    $national_student2 = $_SESSION['national_stud'];
    $listsubjectstudentsql = "SELECT subjects FROM `students` WHERE national_id = '{$national_student2}';";
    $listsubjectstudentquery = mysqli_query($link, $listsubjectstudentsql);
    $studentsubj = explode(' , ', mysqli_fetch_assoc($listsubjectstudentquery)['subjects']);
    foreach ($studentsubj as $key) {
        $listmp4sql = "SELECT * FROM `upload_videos_mp4` WHERE subjects = '{$key}';";
        $listmp4query = mysqli_query($link, $listmp4sql);
        $numberstudent = mysqli_num_rows($listmp4query);
        while ($fetchmp4 = mysqli_fetch_assoc($listmp4query)) {
            if (isset($_POST["openmp4{$fetchmp4['id']}"])) {
                $path1 = '../uploads_videos/';
                $file1 = $fetchmp4['video_name'];
                $filepath1 = $path1.$file1;
                $_SESSION['video'] = $filepath1;
                header("Location: opening.php");
            } elseif (isset($_POST["downloadmp4{$fetchmp4['id']}"])) {
                $path2 = '../uploads_videos/';
                $file2 = $fetchmp4['video_name'];
                $filepath2 = $path2.$file2;
                header("Content-Type: application/octet-stream");
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=" . basename($filepath2));
                header("Expires: 0");
                header("Cache-Control: must-revalidate");
                header("Pragma: public");
                header("Content-Length: " . filesize($filepath2));
                readfile($filepath2);
            }
        }
        $listurlsql = "SELECT * FROM `upload_videos_url` WHERE subjects = '{$key}';";
        $listurlquery = mysqli_query($link, $listurlsql);
        $numberstudent = mysqli_num_rows($listurlquery);
        while ($fetchurl = mysqli_fetch_assoc($listurlquery)) {
            if (isset($_POST["openurl{$fetchurl['id']}"])) {
                $_SESSION['video'] = $fetchurl['video_url'];
                header("Location: opening.php");
            }
        }
        $listpdfsql = "SELECT * FROM `upload_pdf` WHERE subjects = '{$key}';";
        $listpdfquery = mysqli_query($link, $listpdfsql);
        $numberstudent = mysqli_num_rows($listpdfquery);
        while ($fetchpdf = mysqli_fetch_assoc($listpdfquery)) {
            if (isset($_POST["openpdf{$fetchpdf['id']}"])) {
                $_SESSION['path'] = '../uploads_pdf/';
                $_SESSION['file'] = $fetchpdf['pdf_name'];
                $_SESSION['filepath'] = '../uploads_pdf/'.$fetchpdf['pdf_name'];
                header("Location: pdf.php");
            } elseif (isset($_POST["downloadpdf{$fetchpdf['id']}"])) {
                $path2 = '../uploads_pdf/';
                $file2 = $fetchpdf['pdf_name'];
                $filepath2 = $path2.$file2;
                header("Content-Type: application/octet-stream");
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=" . basename($filepath2));
                header("Expires: 0");
                header("Cache-Control: must-revalidate");
                header("Pragma: public");
                header("Content-Length: " . filesize($filepath2));
                readfile($filepath2);
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
    <title>Student DashBoard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../fontawesome-free-5.15.3-web/css/fontawesome.css">
    <link rel="stylesheet" href="../fontawesome-free-5.15.3-web/css/brands.css">
    <link rel="stylesheet" href="../fontawesome-free-5.15.3-web/css/solid.css">
    <link rel="stylesheet" href="../css/student.css">
</head>
<body>
    <div class="container">
        <div class="menu">
            <div class="heading">
                <h2>Welcome <?php echo $_SESSION['fname'] ?></h2>
            </div>
            <div class="menuContent">
                <ul>
                    <li onclick="this.parentElement.children[0].style.backgroundColor = 'white';this.parentElement.children[1].style.backgroundColor = '#FAF9FE';list_admin()" id="tchr"><p>Administrator</p></li>
                    <li onclick="this.parentElement.children[0].style.backgroundColor = '#FAF9FE';this.parentElement.children[1].style.backgroundColor = 'white';list_teacher()" id="studs"><p>Teachers</p></li>
                    <!-- <li onclick="addStudent()" id="adstud">Add a Student</li>
                    <li onclick="addTeacher()">Add a Teacher</li>
                    <li onclick="delStudent()" id="dlstud">Delete/Edit a Student</li>
                    <li onclick="delTeacher()">Delete/Edit a Teacher</li> -->
                    <!-- <li onclick="this.parentElement.children[0].style.backgroundColor = '#FAF9FE';this.parentElement.children[1].style.backgroundColor = '#FAF9FE';this.parentElement.children[2].style.backgroundColor = 'white';this.parentElement.children[3].style.backgroundColor = '#FAF9FE';registers()" id="regs"><p>Registerations</p></li> -->
                    <!-- <li onclick="this.parentElement.children[0].style.backgroundColor = '#FAF9FE';this.parentElement.children[1].style.backgroundColor = '#FAF9FE';this.parentElement.children[2].style.backgroundColor = '#FAF9FE';this.parentElement.children[3].style.backgroundColor = 'white';listnotif()" id="notifs"><p>Notifications</p></li> -->
                    <!-- <li onclick="addNotif()" id="adnoti">Add a Notif.</li> -->
                    <hr>
                </ul>
            </div>
            <div class="logout">
                <div class="log-out">
                    <a href="../backendAll/logout.php">Log Out</a>
                </div>
                <div class="sett">
                    <p>Settings</p>
                </div>
            </div>
        </div>
        <div class="model" id="modal">
            
        </div>
    </div>
    <div class="popup" id="pop_up">
        
    </div>
    <script>
        let modal = document.getElementById("modal");
        function list_admin() {
            modal.innerHTML = `
            <div id="admin" style='height: 100%;'>
                <div style="margin-right: 0;width: 100%;justify-content: center;" class="head1">
                    <div style="margin-right: 0;width: 100%;justify-content: center;" class="teach">
                        <h1 style="width: 280px;">Admin Notifications</h1>
                    </div>
                </div>
                <div class="content1" style="overflow-y: scroll;">
                    <form action="student.php" method="POST">
                        <div class="divul">
                            <ul class="ulnoti">
                                <?php
                                    $national_student = $_SESSION['national_stud'];
                                    $list_notif_sql = "SELECT * FROM notifications WHERE kind = 'student' AND national_id = '{$national_student}';";
                                    $list_notif_query = mysqli_query($link, $list_notif_sql);
                                    $number_notif = mysqli_num_rows($list_notif_query);
                                    while ($fetchnotif = mysqli_fetch_assoc($list_notif_query)) {
                                        echo "
                                            <li style='height: 100px;'>
                                                <div class='infoless' style='justify-content: center;cursor: auto;'>
                                                    <div style='padding-left: 0;display: flex;align-items: center;'>
                                                        <caption>Message: </caption>
                                                        <textarea style='margin-left: 10px;' disabled id='messagenotif' cols='40' rows='5'>{$fetchnotif['messa']}</textarea>
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
        }
        function list_teacher(){
            modal.innerHTML = `
            <div id="notif_lecs_teacher" style="height: 100%;">
                <div class="head1 noticlasshead">
                    <div class="menubar">
                        <ul>
                            <li><p onclick='list_teacher()' style="text-align: center;">Notifications</p></li>
                            <li><p onclick="lecture()">Lectures</p></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="content1 noticlasscontent" style="overflow-y: scroll;">
                    <form action="student.php" method="POST">
                        <div class="subj_select_notif">
                            <select onchange="subjchange1()" name="selectsubjectname1" id="selectsubjectid1" style="width:190px;height: 30px;padding-left: 10px;color: #707070;">
                                <option value="">Select Subject</option>
                                <?php
                                    $national_stud = $_SESSION['national_stud'];
                                    $listsubjectstudentsql = "SELECT subjects FROM students WHERE national_id = '{$national_stud}';";
                                    $listsubjectstudentquery = mysqli_query($link, $listsubjectstudentsql);
                                    $studentsubj = explode(' , ', mysqli_fetch_assoc($listsubjectstudentquery)['subjects']);
                                    $arrayforsubj = array();
                                    foreach ($studentsubj as $k) {
                                        $subjectallsql = "SELECT * FROM subjects WHERE valuesubject = '$k';";
                                        $subjectallquery = mysqli_query($link, $subjectallsql);
                                        $subjectallsubj = mysqli_fetch_assoc($subjectallquery)['subjects'];
                                        array_push($arrayforsubj, $subjectallsubj);
                                    }
                                    foreach ($arrayforsubj as $ke) {
                                        $three = substr($ke,0,3);
                                        echo "
                                        <option value='{$three}'>{$ke}</option>
                                    ";
                                     }
                                ?>
                            </select>
                        </div>
                        <hr>
                        <div class="divul">
                            <ul id='ulnoti' class="ulnoti">
                                <li style='height: 100px;'>
                                    <div class='infoless' style='justify-content: center;cursor: auto;'>
                                        <div style='padding-left: 0;display: flex;align-items: center;'>
                                            <caption>Message: </caption>
                                            <textarea style='margin-left: 10px;' disabled id='messagenotif' cols='40' rows='5'></textarea>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
            `;
        }
        function subjchange1(){
            <?php
                $national_student1 = $_SESSION['national_stud'];
                $listsubjectstudentsql = "SELECT subjects FROM `students` WHERE national_id = '{$national_student1}';";
                $listsubjectstudentquery = mysqli_query($link, $listsubjectstudentsql);
                $studentsubj = explode(' , ', mysqli_fetch_assoc($listsubjectstudentquery)['subjects']);
                foreach ($studentsubj as $key) {
                    echo "
                        if (document.getElementById('selectsubjectid1').value == '{$key}') {
                            document.getElementById('ulnoti').innerHTML = `
                    ";
                    $liststudentsql = "SELECT * FROM `notif_teacher` WHERE subjects = '{$key}';";
                    $liststudentquery = mysqli_query($link, $liststudentsql);
                    $numberstudent = mysqli_num_rows($liststudentquery);
                    while ($fetchstudent = mysqli_fetch_assoc($liststudentquery)) {
                        echo "
                        <li style='height: 100px;'>
                            <div class='infoless' style='justify-content: center;cursor: auto;'>
                                <div style='padding-left: 0;display: flex;align-items: center;'>
                                    <caption>Message: </caption>
                                    <textarea style='margin-left: 10px;' disabled id='messagenotif' cols='40' rows='5'>{$fetchstudent['messagee']}</textarea>
                                </div>
                            </div>
                        </li>
                        ";
                    }
                    echo "
                               `
                        }
                    ";
                }
            ?>
        }
        function lecture() {
            modal.innerHTML = `
            <div id="notif_lecs_teacher" style="height: 100%;">
                <div class="head1 noticlasshead">
                    <div class="menubar">
                        <ul>
                            <li><p onclick='list_teacher()' style="text-align: center;">Notifications</p></li>
                            <li><p onclick="lecture()">Lectures</p></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="content1 noticlasscontent" style="overflow-y: scroll;">
                    <form action="student.php" method="POST">
                        <div class="subj_select_notif">
                            <select onchange="subjchange2()" name="selectsubjectname2" id="selectsubjectid2" style="width:190px;height: 30px;padding-left: 10px;color: #707070;">
                                <option value="">Select Subject</option>
                                <?php
                                    $national_stud = $_SESSION['national_stud'];
                                    $listsubjectstudentsql = "SELECT subjects FROM students WHERE national_id = '{$national_stud}';";
                                    $listsubjectstudentquery = mysqli_query($link, $listsubjectstudentsql);
                                    $studentsubj = explode(' , ', mysqli_fetch_assoc($listsubjectstudentquery)['subjects']);
                                    $arrayforsubj = array();
                                    foreach ($studentsubj as $k) {
                                        $subjectallsql = "SELECT * FROM subjects WHERE valuesubject = '$k';";
                                        $subjectallquery = mysqli_query($link, $subjectallsql);
                                        $subjectallsubj = mysqli_fetch_assoc($subjectallquery)['subjects'];
                                        array_push($arrayforsubj, $subjectallsubj);
                                    }
                                    foreach ($arrayforsubj as $ke) {
                                        $three = substr($ke,0,3);
                                        echo "
                                        <option value='{$three}'>{$ke}</option>
                                    ";
                                     }
                                ?>
                            </select>
                        </div>
                        <hr>
                        <div class="divul">
                            <ul id='ulreg' class="ulreg">
                                
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
            `;
        }
        function subjchange2(){
            <?php
                $national_student2 = $_SESSION['national_stud'];
                $listsubjectstudentsql = "SELECT subjects FROM `students` WHERE national_id = '{$national_student2}';";
                $listsubjectstudentquery = mysqli_query($link, $listsubjectstudentsql);
                $studentsubj = explode(' , ', mysqli_fetch_assoc($listsubjectstudentquery)['subjects']);
                foreach ($studentsubj as $key) {
                    echo "
                        if (document.getElementById('selectsubjectid2').value == '{$key}') {
                            document.getElementById('ulreg').innerHTML = `
                    ";
                    $listmp4sql = "SELECT * FROM `upload_videos_mp4` WHERE subjects = '{$key}';";
                    $listmp4query = mysqli_query($link, $listmp4sql);
                    $numberstudent = mysqli_num_rows($listmp4query);
                    while ($fetchmp4 = mysqli_fetch_assoc($listmp4query)) {
                        $subjsql1 = "SELECT subjects FROM subjects WHERE valuesubject = '{$fetchmp4['subjects']}';";
                        $subjquery1 = mysqli_query($link, $subjsql1);
                        $subjresult1 = mysqli_fetch_assoc($subjquery1);
                        echo "
                        <li id='li' style='height:100px;'>
                            <div class='infoless' onclick='showmp4pop{$fetchmp4['id']}()'>
                                <div id='namereg' class='namereg'>
                                    {$fetchmp4['video_name']}
                                </div>
                                <div class='app'>
                                    <p class='approve'>Subject: {$subjresult1['subjects']}</p>
                                </div>
                            </div>
                        </li>
                        ";
                    }
                    $listurlsql = "SELECT * FROM `upload_videos_url` WHERE subjects = '{$key}';";
                    $listurlquery = mysqli_query($link, $listurlsql);
                    $numberstudent = mysqli_num_rows($listurlquery);
                    while ($fetchurl = mysqli_fetch_assoc($listurlquery)) {
                        $subjsql2 = "SELECT subjects FROM subjects WHERE valuesubject = '{$fetchurl['subjects']}';";
                        $subjquery2 = mysqli_query($link, $subjsql2);
                        $subjresult2 = mysqli_fetch_assoc($subjquery2);
                        echo "
                        <li id='li' style='height:100px;'>
                            <div class='infoless' onclick='showurlpop{$fetchurl['id']}()'>
                                <div id='namereg' class='namereg'>
                                    {$fetchurl['video_url']}
                                </div>
                                <div class='app'>
                                    <p class='approve'>Subject: {$subjresult2['subjects']}</p>
                                </div>
                            </div>
                        </li>
                        ";
                    }
                    $listpdfsql = "SELECT * FROM `upload_pdf` WHERE subjects = '{$key}';";
                    $listpdfquery = mysqli_query($link, $listpdfsql);
                    $numberstudent = mysqli_num_rows($listpdfquery);
                    while ($fetchpdf = mysqli_fetch_assoc($listpdfquery)) {
                        $subjsql3 = "SELECT subjects FROM subjects WHERE valuesubject = '{$fetchpdf['subjects']}';";
                        $subjquery3 = mysqli_query($link, $subjsql3);
                        $subjresult3 = mysqli_fetch_assoc($subjquery3);
                        echo "
                        <li id='li' style='height:100px;'>
                            <div class='infoless' onclick='showpdfpop{$fetchpdf['id']}()'>
                                <div id='namereg' class='namereg'>
                                    {$fetchpdf['pdf_name']}
                                </div>
                                <div class='app'>
                                    <p class='approve'>Subject: {$subjresult3['subjects']}</p>
                                </div>
                            </div>
                        </li>
                        ";
                    }
                    echo "
                               `
                        }
                    ";
                }
            ?>
        }
        let pop_up = document.getElementById('pop_up');
        <?php
                $national_student2 = $_SESSION['national_stud'];
                $listsubjectstudentsql = "SELECT subjects FROM `students` WHERE national_id = '{$national_student2}';";
                $listsubjectstudentquery = mysqli_query($link, $listsubjectstudentsql);
                $studentsubj = explode(' , ', mysqli_fetch_assoc($listsubjectstudentquery)['subjects']);
                foreach ($studentsubj as $key) {
                    $listmp4sql = "SELECT * FROM `upload_videos_mp4` WHERE subjects = '{$key}';";
                    $listmp4query = mysqli_query($link, $listmp4sql);
                    $numberstudent = mysqli_num_rows($listmp4query);
                    while ($fetchmp4 = mysqli_fetch_assoc($listmp4query)) {
                        $subjsql1 = "SELECT subjects FROM subjects WHERE valuesubject = '{$fetchmp4['subjects']}';";
                        $subjquery1 = mysqli_query($link, $subjsql1);
                        $subjresult1 = mysqli_fetch_assoc($subjquery1);
                        $name_teacher_sql1 = "SELECT fname,lname FROM teachers WHERE national_id = '{$fetchmp4['national_id']}';";
                        $name_teacher_query1 = mysqli_query($link, $name_teacher_sql1);
                        $name_teacher_result1 = mysqli_fetch_assoc($name_teacher_query1);
                        $fname_teacher1 = $name_teacher_result1['fname'];
                        $lname_teacher1 = $name_teacher_result1['lname'];
                        echo "
                            function showmp4pop{$fetchmp4['id']}(){
                                pop_up.style.display = 'block';
                                pop_up.innerHTML = `
                                    <div class='popup_content'>
                                        <form action='student.php' method='POST'>
                                            <div class='info_pop'>
                                                <p class='firpara' style='height: 100px;'>Name of the Video: {$fetchmp4['video_name']}</p>
                                                <p class='firpara'>Name of the teacher: {$fname_teacher1} {$lname_teacher1}</p>
                                                <p class='firpara'>Subject: {$subjresult1['subjects']}</p>
                                            </div>
                                            <div class='btns_pop'>
                                                <input type='submit' class='open' value='Open' name='openmp4{$fetchmp4['id']}'>
                                                <input style='margin: 0;' type='submit' class='open' value='Download' name='downloadmp4{$fetchmp4['id']}'>
                                            </div>
                                        </form>
                                    </div>
                                `;
                                window.onclick = function(event){
                                    if (event.target == pop_up) {
                                        pop_up.style.display = 'none';
                                    }
                                }
                            }
                        ";
                    }
                    $listurlsql = "SELECT * FROM `upload_videos_url` WHERE subjects = '{$key}';";
                    $listurlquery = mysqli_query($link, $listurlsql);
                    $numberstudent = mysqli_num_rows($listurlquery);
                    while ($fetchurl = mysqli_fetch_assoc($listurlquery)) {
                        $subjsql2 = "SELECT subjects FROM subjects WHERE valuesubject = '{$fetchurl['subjects']}';";
                        $subjquery2 = mysqli_query($link, $subjsql2);
                        $subjresult2 = mysqli_fetch_assoc($subjquery2);
                        $name_teacher_sql2 = "SELECT fname,lname FROM teachers WHERE national_id = '{$fetchurl['national_id']}';";
                        $name_teacher_query2 = mysqli_query($link, $name_teacher_sql2);
                        $name_teacher_result2 = mysqli_fetch_assoc($name_teacher_query2);
                        $fname_teacher2 = $name_teacher_result2['fname'];
                        $lname_teacher2 = $name_teacher_result2['lname'];
                        echo "
                            function showurlpop{$fetchurl['id']}(){
                                pop_up.style.display = 'block';
                                pop_up.innerHTML = `
                                    <div class='popup_content'>
                                        <form action='student.php' method='POST'>
                                            <div class='info_pop'>
                                                <p class='firpara' style='height: 100px;'>URL of the Video: {$fetchurl['video_url']}</p>
                                                <p class='firpara'>Name of the teacher: {$fname_teacher2} {$lname_teacher2}</p>
                                                <p class='firpara'>Subject: {$subjresult2['subjects']}</p>
                                            </div>
                                            <div class='btns_pop'>
                                                <input type='submit' class='open' value='Open' name='openurl{$fetchurl['id']}'>
                                            </div>
                                        </form>
                                    </div>
                                `;
                                window.onclick = function(event){
                                    if (event.target == pop_up) {
                                        pop_up.style.display = 'none';
                                    }
                                }
                            }
                        ";
                    }
                    $listpdfsql = "SELECT * FROM `upload_pdf` WHERE subjects = '{$key}';";
                    $listpdfquery = mysqli_query($link, $listpdfsql);
                    $numberstudent = mysqli_num_rows($listpdfquery);
                    while ($fetchpdf = mysqli_fetch_assoc($listpdfquery)) {
                        $subjsql3 = "SELECT subjects FROM subjects WHERE valuesubject = '{$fetchpdf['subjects']}';";
                        $subjquery3 = mysqli_query($link, $subjsql3);
                        $subjresult3 = mysqli_fetch_assoc($subjquery3);
                        $name_teacher_sql3 = "SELECT fname,lname FROM teachers WHERE national_id = '{$fetchpdf['national_id']}';";
                        $name_teacher_query3 = mysqli_query($link, $name_teacher_sql3);
                        $name_teacher_result3 = mysqli_fetch_assoc($name_teacher_query3);
                        $fname_teacher3 = $name_teacher_result3['fname'];
                        $lname_teacher3 = $name_teacher_result3['lname'];
                        echo "
                            function showpdfpop{$fetchpdf['id']}(){
                                pop_up.style.display = 'block';
                                pop_up.innerHTML = `
                                    <div class='popup_content'>
                                        <form action='student.php' method='POST'>
                                            <div class='info_pop'>
                                                <p class='firpara' style='height: 100px;'>Name of the PDF: {$fetchpdf['pdf_name']}</p>
                                                <p class='firpara'>Name of the teacher: {$fname_teacher3} {$lname_teacher3}</p>
                                                <p class='firpara'>Subject: {$subjresult3['subjects']}</p>
                                            </div>
                                            <div class='btns_pop'>
                                                <input type='submit' class='open' value='Open' name='openpdf{$fetchpdf['id']}'>
                                                <input style='margin: 0;' type='submit' class='open' value='Download' name='downloadpdf{$fetchpdf['id']}'>
                                            </div>
                                        </form>
                                    </div>
                                `;
                                window.onclick = function(event){
                                    if (event.target == pop_up) {
                                        pop_up.style.display = 'none';
                                    }
                                }
                            }
                        ";
                    }
                }
            ?>
    </script>
</body>
</html>