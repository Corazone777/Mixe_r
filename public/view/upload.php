<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image.upload</title>

    <link rel="stylesheet" href="/resources/css/style_org.css">





</head>

<body>


    <div style="justify-content: center; text-align:center; text-color: white; color:white;">
        <h2>Upload a Song</h2>


        <form method='post' action='/upload' enctype='multipart/form-data'>
            <input type='text' name='artist' placeholder="Artist">
            <br>
            <input type='text' name='song_name' placeholder="Song Name">
            <br>

            <h3>Song File</h3>
            <input type='file' name='song[]' placeholder="Song File" />
            <br>
            <h3>Album Art</h3>
            <input type='file' name='albumart[]' placeholder="Album Art" /></br>
            <input type='hidden' name='user' value="<?php echo $_SESSION["username"];?>">
            <br>
            <br>
            <input class='button' type='submit' value='Submit' name='submit' />
        </form>


        <br> <br>
        <a href="/">Song Library</a>
        <br> <br> <br> <br>
        <a href="/logout">Logout</a>
    </div>
</body>

</html>
