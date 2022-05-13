<?php 
use App\Controller\SessionController;
$user = new SessionController;
$user->isAllowed();
?>

<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mixer</title>
    <style type="text/css" media="screen">
        .title {
            text-align: center;
        }

        .upload {
            margin-top: 5%;
            display: grid;
            justify-content: center;
            text-align: center;
        }
    </style>

</head>
  
<body>
    <h3 style="text-align: center;">Upload your song here</h3>
    <div class="upload">

        <form method='POST' action='/upload' enctype='multipart/form-data'>

            <h3>Song File</h3>
            <input type='file' name='song[]' placeholder="Song File" required/>
            <br>
            <br>
            <h3>Album Art</h3>
            <input type='file' name='albumart[]' placeholder="Album Art" required/></br>
            <br />
            <br />

            <input type='text' name='artist' placeholder="Artist" size="25" required>
            <br>
            <br>
            <input type='text' name='song_name' placeholder="Song Name" size="25" required>
            <br>
            <br>
            <input class='button' type='submit' value='Upload' name='submit' />
        </form>
    </div>
</body>
  
</html>
