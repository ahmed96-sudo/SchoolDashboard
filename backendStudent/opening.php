<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opening File</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        html,body {
            padding: 0;
            margin: 0;
            height: 100%;
            width: 100%;
        }
        .container {
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container video {
            height: 500px;
            width: 600px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
            session_start();
            include("../backendAll/connect.php");
            if (isset($_SESSION['video'])) {
                echo "
                <video controls src='{$_SESSION['video']}'></video>
                ";
            }
        ?>
    </div>
</body>
</html>