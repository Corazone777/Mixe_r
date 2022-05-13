<?php
use App\Controller\SessionController;

$valid_user = new SessionController;

if (!$valid_user->isAllowed()) {
    header("Location: /login?not_valid_user");
    exit();
}

use App\Model\SongUpload;

$song_list = new SongUpload;
$data = $song_list->displayAll();
?>


<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Homepage</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="stylesheet" href="../resources/css/style_org.css">
</head>

<body>
    <?php
    if (isset($_POST['main_song'])) {
        list($artx, $songx) = explode('|', $_POST['main_song']);
    ?>

        <br>
        <br>
        <div id="player">
            <img class="main_song" width="200" height="200" src="/public/uploads/art/<?php echo $artx; ?>">

            <audio crossOrigin="anonymus" id="audio" controls class="music_player">
                <source src="/public/uploads/music/<?php echo $songx; ?>" type="audio/mpeg">
            </audio>
            <canvas id='canvas' width="550" height="350"></canvas>

            <script src="/resources/js/audio_visualizer.js"></script>

        </div>
    <?php
    } else {
    ?>

        <<?php } ?>

            <br>
            <a href="/upload"> Upload your song</a>
            <br>
            <h2 style="text-align: center;">Mixer</h2>
            <div class="page">
                <div class="music">
                    <div class="record">
                        <!-- Audio visualizer goes here -->
                        <!-- MP3 player goes here-->
                        <?php
                        $count = count(array($data));
                        for ($i = 0; $i <= $count; $i++) {
                        ?>
                            <form name="pick" action="/" method="post">

                                <button class="button_song" type="submit" name="main_song" value="<?php echo $data[$i]['albumart_name']; ?> |<?php echo $data[$i]['songfile_name']?>">

                                <img width="130" height="130" src="/public/uploads/art/<?php echo $data[$i]['albumart_name']; ?>">
                        <?php } ?>
                                </button>
                                </from>
                    </div>
                </div>
            </div>
            <br><a style="text-align: end;" href="/logout">Logout</a>
</body>

</html>
