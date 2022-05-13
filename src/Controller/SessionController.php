<?php
namespace App\Controller;

session_start();

use Core\Controller;
use App\View\Render;

class SessionController extends Controller
{
    public static function isAllowed() : bool
    {
        if(!isset($_SESSION['username']) || $_SESSION['username'] == '')
        {
            echo "<h3>You are not authorized to view this page. Login instead</h3>";

            Render::render_login();
            return false;
        }

        return true;
    }

    public static function logOut() : void
    {
        unset($_SESSION['username']);

        header('Location: /login');
        exit();
    }
}
