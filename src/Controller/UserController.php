<?php
namespace App\Controller;

require_once __DIR__ . '/../../vendor/autoload.php';

use Core\Controller;
use App\Model\UserAuth;
use Lib\SendMail;
use Lib\VerifyInput;
use App\View\Render;

class UserController extends Controller
{
    public static array $error;


    /*
      register the user and send mail to the created user
      @params -> values from input form on register page
     */

    public function register(array $params) : void
    {
        $user_data = new UserAuth;
        $email_body = "<p>Thank you for registering!</p>
                 <p>This is a verification email, please click the link to veriy your email address.</p>
                 <p><a href=http://localhost/verify?code={$params['verification_code']}>Click to verify</a></p>
                 <p>If this is not you, please do not click on the link </p>";


        if($user_data->createUser($params))
        {
            echo "Email has been sent to your email address, please click on the link we sent you.";
            SendMail::sendEmail($params['email'], GUSER, 'Mixer', 'Welcome to Mixer', $email_body);
        }
        else
        {
            Render::render_register();
            UserAuth::showErrors();
        }
	
    }

    //if user clicked on the link, change the status in db from disabled to enabled
    public function enable() : void
    {
        if(isset($_GET['code']))
        {
            $code = new UserAuth;

            $code->enableAccount($_GET['code']);

            header("Location: /login?action=verified");
            exit();
        }
    }

    /*
     * login the user with given credentials
     * @params -> values from input form located on login page
     */
    public function login(array $params) : void
    {
        $params['username'] = VerifyInput::verifyInput($params['username']);
        $params['password'] = VerifyInput::verifyInput($params['password']);

        $user = new UserAuth;
        if($user->loginUser($params))
        {
            session_start();
            $_SESSION['username'] = $params['username'];
            header("Location: /");
            exit();
        }

        $user->showErrors();
        Render::render_login();
    }
}
