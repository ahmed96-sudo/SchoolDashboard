<?php
    session_start();
    include("../backendAll/connect.php");
?>
<?php
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        if (isset($_POST['addnotif'])) {
            $addnotifselectsubjectname = filter_var($_POST['addnotifselectsubjectname'], FILTER_SANITIZE_STRING);
            $addnotifnational_id = $_SESSION['national'];
            $textareaaddnotif = filter_var($_POST['textareaaddnotif'], FILTER_SANITIZE_STRING);
            $addnotifteachersql = "INSERT INTO `notif_teacher` (subjects,national_id,messagee) VALUES ('$addnotifselectsubjectname','$addnotifnational_id','$textareaaddnotif');";
            if (mysqli_query($link, $addnotifteachersql)) {
                $addnotifteacherresult= 'Notification Added successfully';
            } else {
                $addnotifteacherresult = 'Something went wrong with adding a Notification';
            }
        } elseif (isset($_POST['uploadvideomp4'])) {
            $addvideomp4subj = filter_var($_POST['addvideomp4subj'], FILTER_SANITIZE_STRING);
            $add_videomp4_national = $_SESSION['national'];
            $videomp4name = $_FILES['videomp4']['name'];
            $videomp4destination = '../uploads_videos/' . $videomp4name;
            $videomp4extention = pathinfo($videomp4name, PATHINFO_EXTENSION);
            $videomp4file = $_FILES['videomp4']['tmp_name'];
            if (!in_array($videomp4extention , ['mp4', 'mkv'])) {
                $videomp4result = "your video extention must be .mp4 or .mkv";
            } else {
                if (move_uploaded_file($videomp4file, $videomp4destination)) {
                    $addvideomp4sql = "INSERT INTO `upload_videos_mp4` (video_name, national_id , subjects) VALUES ('$videomp4name', '$add_videomp4_national', '$addvideomp4subj');";
                    if (mysqli_query($link, $addvideomp4sql)) {
                        $videomp4result = "Your Video has been uploaded";
                    }
                } else {
                    $videomp4result = "Failed to uplaod the video";
                }
            }
        } elseif ((isset($_POST['uploadvideourl']))) {
            $add_video_url_subj = filter_var($_POST['add_video_url_subj'], FILTER_SANITIZE_STRING);
            $add_video_url_national = $_SESSION['national'];
            $video_url = $_POST['videourl'];
            $video_url_sql = "INSERT INTO `upload_videos_url` (video_url, national_id, subjects) VALUES ('$video_url', '$add_video_url_national', '$add_video_url_subj');";
            if (mysqli_query($link, $video_url_sql)) {
                $video_url_result = "Your Url has been uploaded";
            } else {
                $video_url_result = "Failed to uplaod the Url";
            }
        } elseif ((isset($_POST['uploadpdf']))) {
            $add_pdf_subj = filter_var($_POST['add_pdf_subj'], FILTER_SANITIZE_STRING);
            $add_pdf_national = $_SESSION['national'];
            $pdfs_name = $_FILES['pdfs']['name'];
            $pdf_destination = '../uploads_pdf/' . $pdfs_name;
            $pdf_extention = pathinfo($pdfs_name, PATHINFO_EXTENSION);
            $pdf_file = $_FILES['pdfs']['tmp_name'];
            if (!in_array($pdf_extention , ['pdf', 'docx'])) {
                $pdf_result = "your document extention must be .pdf or .docx";
            } else {
                if (move_uploaded_file($pdf_file, $pdf_destination)) {
                    $add_pdf_sql = "INSERT INTO `upload_pdf` (pdf_name, national_id , subjects) VALUES ('$pdfs_name', '$add_pdf_national', '$add_pdf_subj');";
                    if (mysqli_query($link, $add_pdf_sql)) {
                        $pdf_result = "Your document has been uploaded";
                    }
                } else {
                    $pdf_result = "Failed to uplaod the document";
                }
            }
        } 
        $upload_videos_url_del_sql = "SELECT * FROM `upload_videos_url`;";
        $upload_videos_url_del_query = mysqli_query($link, $upload_videos_url_del_sql);
        $upload_videos_url_del_number = mysqli_num_rows($upload_videos_url_del_query);
        while ($fetch_upload_videos_url_del = mysqli_fetch_assoc($upload_videos_url_del_query)) {
            if (isset($_POST["video_url_del{$fetch_upload_videos_url_del['id']}"])) {
                $upload_videos_url_delete_sql = "DELETE FROM `upload_videos_url` WHERE `upload_videos_url`.`id` = {$fetch_upload_videos_url_del['id']};";
                if (mysqli_query($link,$upload_videos_url_delete_sql)) {
                    $upload_videos_url_delete_result = "Lecture Deleted successfully";
                } else {
                    $upload_videos_url_delete_result = "Something Went wrong with Deleting a Lecture";
                }
            }
        }
        $upload_videos_mp4_del_sql = "SELECT * FROM `upload_videos_mp4`;";
        $upload_videos_mp4_del_query = mysqli_query($link, $upload_videos_mp4_del_sql);
        $upload_videos_mp4_del_number = mysqli_num_rows($upload_videos_mp4_del_query);
        while ($fetch_upload_videos_mp4_del = mysqli_fetch_assoc($upload_videos_mp4_del_query)) {
            if (isset($_POST["video_mp4_del{$fetch_upload_videos_mp4_del['id']}"])) {
                $unlink_file_sql = "SELECT video_name FROM `upload_videos_mp4` WHERE id = {$fetch_upload_videos_mp4_del['id']}";
                $unlink_file_query = mysqli_query($link, $unlink_file_sql);
                $unlink_file_result = mysqli_fetch_row($unlink_file_query);
                unlink('../uploads_videos/'.$unlink_file_result['video_name'] );
                $upload_videos_mp4_delete_sql = "DELETE FROM `upload_videos_mp4` WHERE `upload_videos_mp4`.`id` = {$fetch_upload_videos_mp4_del['id']};";
                if (mysqli_query($link,$upload_videos_mp4_delete_sql)) {
                    $upload_videos_mp4_delete_result = "Lecture Deleted successfully";
                } else {
                    $upload_videos_mp4_delete_result = "Something Went wrong with Deleting a Lecture";
                }
            }
        }
        $upload_pdf_del_sql = "SELECT * FROM `upload_pdf`;";
        $upload_pdf_del_query = mysqli_query($link, $upload_pdf_del_sql);
        $upload_pdf_del_number = mysqli_num_rows($upload_pdf_del_query);
        while ($fetch_upload_pdf_del = mysqli_fetch_assoc($upload_pdf_del_query)) {
            if (isset($_POST["pdf_del{$fetch_upload_pdf_del['id']}"])) {
                $unlink_pdf_sql = "SELECT pdf_name FROM `upload_pdf` WHERE id = {$fetch_upload_pdf_del['id']}";
                $unlink_pdf_query = mysqli_query($link, $unlink_pdf_sql);
                $unlink_pdf_result = mysqli_fetch_row($unlink_pdf_query);
                unlink('../uploads_videos/'.$unlink_pdf_result['pdf_name'] );
                $upload_pdf_delete_sql = "DELETE FROM `upload_pdf` WHERE `upload_pdf`.`id` = {$fetch_upload_pdf_del['id']};";
                if (mysqli_query($link,$upload_pdf_delete_sql)) {
                    $upload_pdf_delete_result = "Lecture Deleted successfully";
                } else {
                    $upload_pdf_delete_result = "Something Went wrong with Deleting a Lecture";
                }
            }
        }
        $notif_teacher_del_sql = "SELECT * FROM `notif_teacher`;";
        $notif_teacher_del_query = mysqli_query($link, $notif_teacher_del_sql);
        $notif_teacher_del_number = mysqli_num_rows($notif_teacher_del_query);
        while ($fetch_notif_teacher_del = mysqli_fetch_assoc($notif_teacher_del_query)) {
            if (isset($_POST["delnotif{$fetch_notif_teacher_del['id']}"])) {
                $notif_teacher_delete_sql = "DELETE FROM `notif_teacher` WHERE `notif_teacher`.`id` = {$fetch_notif_teacher_del['id']};";
                if (mysqli_query($link,$notif_teacher_delete_sql)) {
                    $notif_teacher_delete_result = "Notification Deleted successfully";
                } else {
                    $notif_teacher_delete_result = "Something Went wrong with Deleting a Notification";
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
    <title>Teacher Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../fontawesome-free-5.15.3-web/css/fontawesome.css">
    <link rel="stylesheet" href="../fontawesome-free-5.15.3-web/css/brands.css">
    <link rel="stylesheet" href="../fontawesome-free-5.15.3-web/css/solid.css">
    <link rel="stylesheet" href="../css/doctor.css">
    <style>
        .tab2 {
            font-family: Arial, Helvetica, sans-serif;
            /* border-collapse: collapse; */
            border-spacing: 0;
            height: 94%;
            width: 99%;
            background-color: white;
            margin-left: 10px;
        }
        .tab2 caption {
            border: 1px solid;
            width: 150px;
            height: 25px;
            text-align: center;
        }
        .tab2 thead tr {
            display: block;
        }
        .tab2 thead tr th {
            width: 310px;
        }
        .tab2 tr:nth-child(even){background-color: #f2f2f2;}
        .tab2 tbody tr:hover {background-color: #ddd;}
        .tab2 th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
        .tab2 tbody {
            display: block;
            height: 400px;
            overflow: auto;
            width: 100%;
        }
        .tab2 tbody tr td {
            width: 310px;
            max-width: 310px;
            height: 30px;
            max-height: 30px;
            overflow: auto;
        }
        .tab2 td,.tab2 th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .tab3 {
            font-family: Arial, Helvetica, sans-serif;
            /* border-collapse: collapse; */
            border-spacing: 0;
            height: 94%;
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
            height: 400px;
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
        .teach {
            margin-right: auto;
            height: 100%;
            width: 20%;
            display: flex;
            align-items: center;
        }
        .teach h1 {
            text-transform: capitalize;
            padding: 10px;
            margin-left: 10px;
            border-radius: 10px;
            background-color: #5C91B6;
            width: 125px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="menu">
            <div class="heading">
                <h2>Welcome <?php echo $_SESSION['name'] ?></h2>
            </div>
            <div class="menuContent">
                <ul>
                    <li onclick="this.parentElement.children[0].style.backgroundColor = 'white';this.parentElement.children[1].style.backgroundColor = '#FAF9FE';this.parentElement.children[2].style.backgroundColor = '#FAF9FE';students()" id="studs"><p>Students</p></li>
                    <li onclick="this.parentElement.children[0].style.backgroundColor = '#FAF9FE';this.parentElement.children[1].style.backgroundColor = 'white';this.parentElement.children[2].style.backgroundColor = '#FAF9FE';notif()" id="noti"><p>Notifications</p></li>
                    <!-- <li onclick="addStudent()" id="adstud">Add a Student</li>
                    <li onclick="addTeacher()">Add a Teacher</li>
                    <li onclick="delStudent()" id="dlstud">Delete/Edit a Student</li>
                    <li onclick="delTeacher()">Delete/Edit a Teacher</li> -->
                    <li onclick="this.parentElement.children[0].style.backgroundColor = '#FAF9FE';this.parentElement.children[1].style.backgroundColor = '#FAF9FE';this.parentElement.children[2].style.backgroundColor = 'white';admin()" id="regs"><p>Administrator</p></li>
                    <!-- <li onclick="this.parentElement.children[0].style.backgroundColor = '#FAF9FE';this.parentElement.children[1].style.backgroundColor = '#FAF9FE';this.parentElement.children[2].style.backgroundColor = '#FAF9FE';this.parentElement.children[3].style.backgroundColor = 'white';" id="notifs"><p>Questions</p></li> -->
                    <!-- <li onclick="addNotif()" id="adnoti">Add a Notif.</li> -->
                </ul>
            </div>
            <hr>
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
            <?php
                if (isset($_POST['addnotif'])) {
                    echo $addnotifteacherresult;
                } elseif (isset($_POST['uploadvideomp4'])) {
                    echo $videomp4result;
                } elseif (isset($_POST['uploadvideourl'])) {
                    echo $video_url_result;
                } elseif ((isset($_POST['uploadpdf']))) {
                    echo $pdf_result;
                }
            ?>
        </div>
    </div>
    <script>
        let modal = document.getElementById("modal");
        function students(){
            modal.innerHTML = `
            <div id="students">
                <div class="selectsubjectclass head1" style="display:flex;align-items: center;justify-content: center;">
                    <select onchange="subjchange()" name="selectsubjectname1" id="selectsubjectid1" style="width:190px;height: 30px;padding-left: 10px;color: #707070;">
                        <option value="">Select Subject</option>
                        <?php
                            $national = $_SESSION['national'];
                            $listsubjectteachersql = "SELECT subjects FROM `teachers` WHERE national_id = '{$national}';";
                            $listsubjectteacherquery = mysqli_query($link, $listsubjectteachersql);
                            $teachersubj = explode(' , ', mysqli_fetch_assoc($listsubjectteacherquery)['subjects']);
                            $arrayforsubj = array();
                            foreach ($teachersubj as $k) {
                                $subjectallsql = "SELECT * FROM `subjects` WHERE valuesubject = '$k';";
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
                <div id='thestudenttable' class="liststudentsclass content1">
                    <table class="tab3">
                        <caption>Number: <span style="font-size:20px;">0</span></caption>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            `;
        }
        function subjchange(){
            <?php
                $national = $_SESSION['national'];
                $listsubjectteachersql = "SELECT subjects FROM `teachers` WHERE national_id = '{$national}';";
                $listsubjectteacherquery = mysqli_query($link, $listsubjectteachersql);
                $teachersubj = explode(' , ', mysqli_fetch_assoc($listsubjectteacherquery)['subjects']);
                foreach ($teachersubj as $key) {
                    echo "
                        if (document.getElementById('selectsubjectid1').value == '{$key}') {
                            document.getElementById('thestudenttable').innerHTML = `
                                <table class='tab3'>
                                    <caption>Number: <span style='font-size:20px;' id='capt'>0</span></caption>
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Name</th>
                                        </tr>
                                    </thead>
                                    <tbody id='thebody'>
                    ";
                    $liststudentsql = "SELECT * FROM `students`;";
                    $liststudentquery = mysqli_query($link, $liststudentsql);
                    $numberstudent = mysqli_num_rows($liststudentquery);
                    while ($fetchstudent = mysqli_fetch_assoc($liststudentquery)) {
                        $subjstudent = explode(' , ', $fetchstudent['subjects']);
                        foreach ($subjstudent as $ky) {
                            if ($ky == $key) {
                                echo "
                                    <tr>
                                        <td>{$fetchstudent['id']}</td>
                                        <td>{$fetchstudent['fname']} {$fetchstudent['lname']}</td>
                                    </tr>
                                ";
                            }
                        }
                    }
                    echo "
                                
                                </tbody>
                            </table>`
                            document.getElementById('capt').innerHTML = document.getElementById('thebody').childElementCount;
                        }
                    ";
                }
            ?>
        }
        function notif(){
            modal.innerHTML = `
            <div id="notiflec">
                <div class="head1 noticlasshead">
                    <div class="menubar">
                        <ul>
                            <li><p onclick='addnotif()' style="text-align: center;">Add a Notifications</p></li>
                            <li><p onclick="addlecture()">Add a Lecture</p></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="content1 noticlasscontent">
                    <form action="doctor.php" method="POST">
                        <div class="divul">
                            <ul class="ulnoti">
                                <?php
                                    $list_notif_teachersql = "SELECT * FROM `notif_teacher`;";
                                    $list_notif_teacher_query = mysqli_query($link, $list_notif_teachersql);
                                    $number_notif = mysqli_num_rows($list_notif_teacher_query);
                                    while ($fetch_notif_teacher = mysqli_fetch_assoc($list_notif_teacher_query)) {
                                        if ($_SESSION['national'] == $fetch_notif_teacher['national_id']) {
                                            echo "
                                                <li style='height: 100px;'>
                                                    <div class='infoless'>
                                                        <div class='namenoti'>
                                                            <caption>Message: </caption>
                                                            <textarea disabled name='messagenotif' id='messagenotif' cols='40' rows='5'>{$fetch_notif_teacher['messagee']}</textarea>
                                                            <p class='subjnotif'>Subject: {$fetch_notif_teacher['subjects']}</p>
                                                        </div>
                                                        <div class='app'>
                                                            <button name='delnotif{$fetch_notif_teacher['id']}' class='decline'>Delete</button>
                                                        </div>
                                                    </div>
                                                </li>
                                            ";
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
            `;
        }
        function addnotif(){
            modal.innerHTML = `
            <div id="addnotif">
                <div class="head1 noticlasshead">
                    <div class="menubar">
                        <ul>
                            <li><p onclick='addnotif()' style="text-align: center;">Add a Notifications</p></li>
                            <li><p onclick="addlecture()">Add a Lecture</p></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="content1 noticlasscontent">
                    <form action="doctor.php" method="POST">
                        <div class="selectsubjectclass" style="display:flex;align-items: center;justify-content: center;height:80px;margin-bottom: -10px;">
                            <select name="addnotifselectsubjectname" id="addnotifselectsubjid" style="width:190px;height: 30px;padding-left: 10px;color: #707070;">
                                <option value="">Select Subject</option>
                                <?php
                                    $national = $_SESSION['national'];
                                    $listsubjectteachersql = "SELECT subjects FROM `teachers` WHERE national_id = '{$national}';";
                                    $listsubjectteacherquery = mysqli_query($link, $listsubjectteachersql);
                                    $teachersubj = explode(' , ', mysqli_fetch_assoc($listsubjectteacherquery)['subjects']);
                                    $arrayforsubj = array();
                                    foreach ($teachersubj as $k) {
                                        $subjectallsql = "SELECT * FROM `subjects` WHERE valuesubject = '$k';";
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
                        <div class="messagenotif">
                            <label for="message">Message</label>
                            <textarea name="textareaaddnotif" id="textareaaddnotif" cols="60" rows="10"></textarea>
                        </div>
                        <div class="submit1">
                            <input class="allsub btn" name="addnotif" type="submit" value="Send">
                        </div>
                    </form>
                </div>
            </div>
            `;
        }
        function videomp4(){
            modal.innerHTML = `
            <div id="addlecture">
                <div class="head1 lecclasshead">
                    <div class="menubar">
                        <ul>
                            <li><p onclick="addnotif()" style="text-align: center;">Add a Notifications</p></li>
                            <li><p onclick="addlecture()">Add a Lecture</p></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="content1 lecclasscontent">
                    <form action="doctor.php" method="POST" enctype='multipart/form-data'>
                        <div class="lecsupload">
                            <div class="linksforlec">
                                <div class="menubar">
                                    <ul>
                                        <li><p onclick='videomp4()'>Video(MP4)</p></li>
                                        <li><p onclick='videourl()'>Video(URL)</p></li>
                                        <li><p onclick='pdf()'>PDF</p></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="listlec" id="modall">
                                <div id="videomp4div">
                                    <div class="selectsubjectclass" style="display:flex;align-items: center;justify-content: center;height:15%;">
                                        <select required name="addvideomp4subj" id="addvideomp4subj" style="width:190px;height: 30px;padding-left: 10px;color: #707070;">
                                            <option value="">Select Subject</option>
                                            <?php
                                                $national = $_SESSION['national'];
                                                $listsubjectteachersql = "SELECT subjects FROM `teachers` WHERE national_id = '{$national}';";
                                                $listsubjectteacherquery = mysqli_query($link, $listsubjectteachersql);
                                                $teachersubj = explode(' , ', mysqli_fetch_assoc($listsubjectteacherquery)['subjects']);
                                                $arrayforsubj = array();
                                                foreach ($teachersubj as $k) {
                                                    $subjectallsql = "SELECT * FROM `subjects` WHERE valuesubject = '$k';";
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
                                    <div class="divforvideo">
                                        <input required type="file" name="videomp4" id="videomp4">
                                        <button style="width:190px;" class="btn" name="uploadvideomp4" id="uploadvideomp4" type="submit">Upload Video(MP4)</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            `;
        }
        function videourl() {
            modal.innerHTML = `
            <div id="addlecture">
                <div class="head1 lecclasshead">
                    <div class="menubar">
                        <ul>
                            <li><p onclick="addnotif()" style="text-align: center;">Add a Notifications</p></li>
                            <li><p onclick="addlecture()">Add a Lecture</p></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="content1 lecclasscontent">
                    <form action="doctor.php" method="POST" enctype='multipart/form-data'>
                        <div class="lecsupload">
                            <div class="linksforlec">
                                <div class="menubar">
                                    <ul>
                                        <li><p onclick='videomp4()'>Video(MP4)</p></li>
                                        <li><p onclick='videourl()'>Video(URL)</p></li>
                                        <li><p onclick='pdf()'>PDF</p></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="listlec" id="modall">
                                <div id="videourldiv">
                                    <div class="selectsubjectclass" style="display:flex;align-items: center;justify-content: center;height:15%;">
                                        <select required name="add_video_url_subj" id="add_video_url_subj" style="width:190px;height: 30px;padding-left: 10px;color: #707070;">
                                            <option value="">Select Subject</option>
                                            <?php
                                                $national = $_SESSION['national'];
                                                $listsubjectteachersql = "SELECT subjects FROM `teachers` WHERE national_id = '{$national}';";
                                                $listsubjectteacherquery = mysqli_query($link, $listsubjectteachersql);
                                                $teachersubj = explode(' , ', mysqli_fetch_assoc($listsubjectteacherquery)['subjects']);
                                                $arrayforsubj = array();
                                                foreach ($teachersubj as $k) {
                                                    $subjectallsql = "SELECT * FROM `subjects` WHERE valuesubject = '$k';";
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
                                    <div class="divforvideo">
                                        <input placeholder="Type the URL" required type="url" name="videourl" id="videourl">
                                        <input style="width: 180px;" class="btn" name="uploadvideourl" id="uploadvideourl" type="submit" value="Upload Video(URL)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            `;
        }
        function pdf(){
            modal.innerHTML = `
            <div id="addlecture">
                <div class="head1 lecclasshead">
                    <div class="menubar">
                        <ul>
                            <li><p onclick="addnotif()" style="text-align: center;">Add a Notifications</p></li>
                            <li><p onclick="addlecture()">Add a Lecture</p></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="content1 lecclasscontent">
                    <form action="doctor.php" method="POST" enctype='multipart/form-data'>
                        <div class="lecsupload">
                            <div class="linksforlec">
                                <div class="menubar">
                                    <ul>
                                        <li><p onclick='videomp4()'>Video(MP4)</p></li>
                                        <li><p onclick='videourl()'>Video(URL)</p></li>
                                        <li><p onclick='pdf()'>PDF</p></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="listlec" id="modall">
                                <div id="pdfdiv">
                                    <div class="selectsubjectclass" style="display:flex;align-items: center;justify-content: center;height:15%;">
                                        <select required name="add_pdf_subj" id="add_pdf_subj" style="width:190px;height: 30px;padding-left: 10px;color: #707070;">
                                            <option value="">Select Subject</option>
                                            <?php
                                                $national = $_SESSION['national'];
                                                $listsubjectteachersql = "SELECT subjects FROM `teachers` WHERE national_id = '{$national}';";
                                                $listsubjectteacherquery = mysqli_query($link, $listsubjectteachersql);
                                                $teachersubj = explode(' , ', mysqli_fetch_assoc($listsubjectteacherquery)['subjects']);
                                                $arrayforsubj = array();
                                                foreach ($teachersubj as $k) {
                                                    $subjectallsql = "SELECT * FROM `subjects` WHERE valuesubject = '$k';";
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
                                    <div class="divforpdf">
                                        <input required type="file" name="pdfs" id="pdfs">
                                        <button class="btn" name="uploadpdf" id="uploadpdf" type="submit">Upload PDF</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            `;
        }
        function addlecture(){
            modal.innerHTML = `
            <div id="addlecture">
                <div class="head1 lecclasshead">
                    <div class="menubar">
                        <ul>
                            <li><p onclick="addnotif()" style="text-align: center;">Add a Notifications</p></li>
                            <li><p onclick="addlecture()">Add a Lecture</p></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="content1 lecclasscontent">
                    <form action="doctor.php" method="POST">
                        <div class="lecsupload">
                            <div class="linksforlec">
                                <div class="menubar">
                                    <ul>
                                        <li><p onclick='videomp4()'>Video(MP4)</p></li>
                                        <li><p onclick='videourl()'>Video(URL)</p></li>
                                        <li><p onclick='pdf()'>PDF</p></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="listlec" id="modall">
                                <table class="tab2" style="height: 93%;">
                                    <caption>Number: <span id='thespan' style="font-size:20px;">0</span></caption>
                                    <thead>
                                        <tr>
                                            <th>Lecture</th>
                                            <th>Subject</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody style="height: 320px;" id='tbodynum'>
                                    <?php
                                        $list_videos_mp4_sql = "SELECT * FROM `upload_videos_mp4`;";
                                        $list_videos_mp4_query = mysqli_query($link, $list_videos_mp4_sql);
                                        $number_videos_mp4 = mysqli_num_rows($list_videos_mp4_query);
                                        while ($fetch_videos_mp4 = mysqli_fetch_assoc($list_videos_mp4_query)) {
                                            if ($_SESSION['national'] == $fetch_videos_mp4['national_id']) {
                                                echo "
                                                    <tr>
                                                        <td>{$fetch_videos_mp4['video_name']}</td>
                                                        <td>{$fetch_videos_mp4['subjects']}</td>
                                                        <td style='text-align: center;'><input type='submit' value='Delete' style='width:100px;background-color:#F30000;border:1px solid #F30000;cursor:pointer;' name='video_mp4_del{$fetch_videos_mp4['id']}'></td>
                                                    </tr>
                                                ";
                                            }
                                        }
                                    ?>
                                    <?php
                                        $list_videos_url_sql = "SELECT * FROM `upload_videos_url`;";
                                        $list_videos_url_query = mysqli_query($link, $list_videos_url_sql);
                                        $number_videos_url = mysqli_num_rows($list_videos_url_query);
                                        while ($fetch_videos_url = mysqli_fetch_assoc($list_videos_url_query)) {
                                            if ($_SESSION['national'] == $fetch_videos_url['national_id']) {
                                                echo "
                                                    <tr>
                                                        <td>{$fetch_videos_url['video_url']}</td>
                                                        <td>{$fetch_videos_url['subjects']}</td>
                                                        <td style='text-align: center;'><input type='submit' value='Delete' style='width:100px;background-color:#F30000;border:1px solid #F30000;cursor:pointer;' name='video_url_del{$fetch_videos_url['id']}'></td>
                                                    </tr>
                                                ";
                                            }
                                        }
                                    ?>
                                    <?php
                                        $list_pdf_sql = "SELECT * FROM `upload_pdf`;";
                                        $list_pdf_query = mysqli_query($link, $list_pdf_sql);
                                        $number_pdf = mysqli_num_rows($list_pdf_query);
                                        while ($fetch_pdf = mysqli_fetch_assoc($list_pdf_query)) {
                                            if ($_SESSION['national'] == $fetch_pdf['national_id']) {
                                                echo "
                                                    <tr>
                                                        <td>{$fetch_pdf['pdf_name']}</td>
                                                        <td>{$fetch_pdf['subjects']}</td>
                                                        <td style='text-align: center;'><input type='submit' value='Delete' style='width:100px;background-color:#F30000;border:1px solid #F30000;cursor:pointer;' name='pdf_del{$fetch_pdf['id']}'></td>
                                                    </tr>
                                                ";
                                            }
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            `;
            document.getElementById('thespan').innerHTML = document.getElementById('tbodynum').childElementCount;
        }
        function admin(){
            modal.innerHTML = `
            <div id="register" style='height: 100%;'>
                <div style="margin-right: 0;width: 100%;justify-content: center;" class="head1">
                    <div style="margin-right: 0;width: 100%;justify-content: center;" class="teach">
                        <h1 style="width: 280px;">Admin Notifications</h1>
                    </div>
                </div>
                <div class="content1" style="overflow-y: scroll;">
                    <form action="doctor.php" method="POST">
                        <div class="divul">
                            <ul class="ulnoti">
                                <?php
                                    $national_teacher = $_SESSION['national'];
                                    $fullname_sql = "SELECT fname,lname FROM `teachers`WHERE national_id = '{$national_teacher}';";
                                    $fullname_query = mysqli_query($link,$fullname_sql);
                                    $fullname_fetch = mysqli_fetch_assoc($fullname_query);
                                    $list_notif_sql = "SELECT * FROM `notifications` WHERE kind = 'teacher' AND fullname = '{$fullname_fetch['fname']} {$fullname_fetch['lname']}';";
                                    $list_notif_query = mysqli_query($link, $list_notif_sql);
                                    $number_notif = mysqli_num_rows($list_notif_query);
                                    while ($fetchnotif = mysqli_fetch_assoc($list_notif_query)) {
                                        echo "
                                            <li style='height: 100px;'>
                                                <div class='infoless' style='justify-content: center;'>
                                                    <div style='padding-left: 0;display: flex;align-items: center;'>
                                                        <caption>Message: </caption>
                                                        <textarea style='margin-right: 0;' disabled id='messagenotif' cols='40' rows='5'>{$fetchnotif['messa']}</textarea>
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
        /* <form action="admin.php" method="POST">
            <div class="divul">
                <ul class="ulreg">
                    <?php
                        /* $listregistersql = "SELECT * FROM `registeration`;";
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
                        } */
                    ?>
                </ul>
            </div>
        </form> */
        <?php
            /* $liststudentsql = "SELECT * FROM 'students';";
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
            } */
        ?>
        <?php
            /* $liststudentsql = "SELECT * FROM 'students';";
            $liststudentquery = mysqli_query($link, $liststudentsql);
            $numberstudent = mysqli_num_rows($liststudentquery);
            echo $numberstudent; */
        ?>
    </script>
</body>
</html>