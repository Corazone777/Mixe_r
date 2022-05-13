<?php
namespace App\View;

class Render
{
    public static function render_login()
    {
        require_once __DIR__ . '/../../public/view/login.php';
    }

    public static function render_register()
    {
        require_once __DIR__ . '/../../public/view/register.php';
    }

    public static function render_homepage()
    {
        require_once __DIR__ . '/../../public/view/homepage.php';
    }

    public static function render_upload()
    {
        require_once __DIR__ . '/../../public/view/upload.php';
    }

}
