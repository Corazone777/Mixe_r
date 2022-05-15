<?php
namespace App\Model;

use Core\Model;

class SongUpload extends Model
{

    public static array $error;

    public function uploadSong(array $params) : bool
    {
        $db = $this->db;

        //params sent from SongUpload Controller
        $artist = $params[0];
        $song_name = $params[1];

        $song_file_count = count(array($_FILES['song']['name']));

        for($i = 0; $i < $song_file_count; $i++)
        {
           $song_file_name = $_FILES['song']['name'][$i];
           $album_art = $_FILES['albumart']['name'][$i];

            //File location
           $song_location = $_SERVER['DOCUMENT_ROOT'] .  '/public/uploads/music/' . $song_file_name;
           $album_art_location = $_SERVER['DOCUMENT_ROOT'] . '/public/uploads/art/' . $album_art;

           //extensions
           $song_file_extension = pathinfo($song_location, PATHINFO_EXTENSION);
           $valid_song_extension = array("mp3");

           //Album Art
           $art_file_extension = pathinfo($album_art_location, PATHINFO_EXTENSION);
           $valid_art_extension = array("jpg", "png", "jpeg");


           if(in_array($song_file_extension, $valid_song_extension)
           && in_array($art_file_extension, $valid_art_extension)) {

               if(move_uploaded_file($_FILES['song']['tmp_name'][$i], $song_location)
                  && move_uploaded_file($_FILES['albumart']['tmp_name'][$i], $album_art_location)) {

                   $sql = "INSERT INTO music (user, artist, song_name, songfile_path, songfile_name, albumart_path, albumart_name) VALUES (:user, :artist, :song_name, :songfile_path, :songfile_name, :albumart_path, :albumart_name)";
                   $db->query($sql);

                   //Getting username from session will be changed later.
                   session_start();
                   $user = $_SESSION['username'];

                   $db->bind('user', $user);
                   $db->bind('artist', $artist);
                   $db->bind('song_name', $song_name);
                   $db->bind('songfile_path', $song_location);
                   $db->bind('songfile_name', $song_file_name);
                   $db->bind('albumart_path', $album_art_location);
                   $db->bind('albumart_name', $album_art);

                   if($db->execute())
                   {
                    return true;
                   }
               }
          }
          return false;
        }
    }

    //Display all songs from the db
    public function displayAll() : array
    {
        $sql = "SELECT * FROM mixer.music";

        $db = $this->db;
        $db->query($sql);
        $db->execute();

        $data = $db->fetchAll();

        return $data;
    }
}
