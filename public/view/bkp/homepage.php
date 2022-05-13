<?php
use App\Controller\SessionController;
use App\Controller\SongUploadController;

$valid_user = new SessionController;

if(!$valid_user->isAllowed()) {
    header("Location: /login");
    exit();
}

$song_list = new SongUploadController;
$data = $song_list->displaySongs();
?>


<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Mixer</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <style>
        .page{
            width: 100%;
            display: grid;
            justify-content: center;
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
    <a href='/logout'>Logout</a>
    <div class="page">
        <div class="music">
            <div class="record">
            <!-- Audio visualizer goes here -->
            <!-- MP3 player goes here-->
            <?php
            $count = count(array($data));
            for ($i = 0; $i <= $count; $i++) {
            ?>
                <button> <img width="130" height="130" src="/public/uploads/art/<?php echo $data[$i]['albumart_name']?>">
            <?php } ?>
                </button>

            <div class="comments">
                <p>Generic Comment</p>
            </div>
        </div>
    </div>

</body>
</html>
