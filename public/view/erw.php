<?php


use App\Controller\SongUploadController;
#$valid_user = new SessionController;

#if (!$valid_user->isAllowed()) {
#    header("Location: /login?not_valid_user");
#    exit();
#}

use App\Model\SongUpload;

$song_list = new SongUpload;
$data = $song_list->displayAll();
?>


<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> :</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <style>
        .page {
            width: 100%;
            display: grid;
            justify-content: center;
        }

        .record {
            width: 150px;
            height: 90px;
            background-color: black;
        }
    </style>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">
            You are using an <strong>outdated</strong> browser. Please
            <a href="http://browsehappy.com/">upgrade your browser</a> to improve
            your experience.
            </p>
        <![endif]-->

    <h2 style="text-align: center;">Mixer</h2>
    <div class="page">
        <div class="music">
            <div class="record">
                <!-- Audio visualizer goes here -->
                <!-- MP3 player goes here-->
                <?php
                $count = count(array($data));
                for ($i = 0; $i < $count; $i++) {
                ?>
                    <img width="130" height="130" src="../../uploads/art/<?php echo $data[$i]['albumart_name']; ?>">
                <?php } ?>

                <img src="../../photo_2022-05-11_18-41-07.jpg" alt="" />
            </div>
            <div class="comments">
                <p>Generic Comment</p>
            </div>
        </div>
    </div>

</body>
<?php
var_dump($data);
?>

</html>