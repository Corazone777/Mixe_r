<?php
namespace App\Controller;

use App\Model\SongUpload;
use Core\Controller;
use Lib\VerifyInput;
use App\View\Render;

class SongUploadController extends Controller
{
    public function upload(array $params) : void
    {
        $user_song = new SongUpload;

        $song = VerifyInput::verifyInput($params['artist']);
        $album_art = VerifyInput::verifyInput($params['song_name']);

        $valid_input = array($song, $album_art, $params['artist'], $params['song_name']);

        if(!$user_song->uploadSong($valid_input))
        {
            Render::render_upload();
            echo "<p>Upload did not work please try again";
        }

        header("Location: /");
        exit();
    }

    public function displaySongs() : array
    {
        $song_list = new SongUpload;

        $data = $song_list->displayAll();
        return $data;

    }

}
