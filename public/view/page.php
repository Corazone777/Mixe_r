<?php
session_start();

if (isset($_SESSION['t4hg8pa9erughstgb'])) {
    echo "Display Page";
?>
    <link rel="stylesheet" href="/resources/css/style.css">
    <form method="POST" action="/logout">
        <button class="btn btn-primary" type="submit" name="logout" value="<?php echo $_COOKIE['t4hg8pa9erughstgb'] ?>">Logout</button>
    </form>
<?php
} else {
    die("<h1 style=" . '"color:#ffffff;"' . ">Not Logged in<h1>");
    require_once("public/view/login.php");
}
