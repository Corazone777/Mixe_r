<?php




?>
  
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content=
    "width=device-width, initial-scale=1.0">    
</head>
      

<body>


<?php


	

if (isset($_POST['main_song'])){
	list($artx, $songx) = explode('|', $_POST['main_song']);
	?>




	<img class="main_song" width="200" height="200" src="../../library/jukebox/album-art/<?php echo $artx; ?>" >

    <audio controls class="music_player">
        <source src="<?php echo $songx;  ?>" type="audio/mpeg">
    </audio>


</br>
</br>




<?php
}

	else 
	{
?>
	<img class="main_song" width="200" height="200" src="../../resources/images/vinyl_icon.png">
	<audio controls class="music_player">
	</audio>
</br>
</br>

<?php


}





echo '<div class="grid_song-container">';

foreach($songs as $item){

?>

<div class="grid_song-container">

<form name="pick" action="jukebox.php" method="post">
<button class="button_song" type="submit" name="main_song"  value="<?php echo $item['albumart_name'];?> | ../../library/jukebox/music/<?php echo $item['songfile_name']  ?>">
<img width="130" height="130" src="../../library/jukebox/album-art/<?php echo $item['albumart_name'];  ?>">
</button>
</form>











</div>
    <?php
}
?>

<div style="margin-bottom:50px;">
</div>

</div>

</body>
  
</html>
