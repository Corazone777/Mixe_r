<?php
namespace App\Model;

use Core\Model;

class UserAuth extends Model
{
    private string $first_name;
	private string $last_name;
	private string $username;
	private string $email;
	private string $password;
	private string $status;
	private string $registration_date;
	private string $verification_code;

    public static array $error;

    //Setter methods for user credentials
    public function setFirstName(string $first_name) {
        $this->first_name = $first_name;
    }

    public function setLastName(string $last_name) {
		$this->last_name = $last_name;
	}

	public function setUsername(string $username) {
        $this->username = $username;
	}

    	public function setEmail(string $email) {
		$this->email = $email;
	}

	public function setPassword(string $password) {

        $this->password = $password;
	}

    //Status is either 'Disabled' or 'Enabled' in DB, when 'Enabled' user can login.
	public function setStatus(string $status) {
		$this->status = $status;
	}

	public function setRegistrationDate(string $registration_date) {
		$this->registration_date = $registration_date;
	}

    //Verification code of an email sent to the user making user worthy of loging in.
    public function setVerificationCode(string $verification_code) {
        $this->verification_code = $verification_code;
    }

    //Getter functions
    public function getFirstName() : string {
        return $this->first_name;
    }
    public function getLastName() : string {
		return $this->last_name;
	}
	public function getUsername() : string {
		return $this->username;
	}
	public function getEmail() : string {
		return $this->email;
	}
	public function getPassword() : string {
		return $this->password;
	}
	public function getStatus() : string {
		return $this->status;
	}
	public function getRegistrationDate() : string {
		return $this->registration_date;
	}
	public function getVerificationCode() : string {
		return $this->verification_code;
	}

    //Creates an user and sets users credentials into the DB.
    public function createUser(array $params) : bool
    {
        $sql = "INSERT INTO mixer.users (first_name, last_name, username, email, password, status, registration_date, verification_code) VALUES (:first_name, :last_name, :username, :email, :password, :status, :registration_date, :verification_code)";
        $db = $this->db;

        //Rules for form input fields.
        if(!preg_match("/^[a-zA-Z\pL]+$/u", $params['first_name'])) {
            self::$error[] = "First Name must only contain letters";
        }
        if(!preg_match("/^[a-zA-Z\pL]+$/u", $params['last_name'])) {
            self::$error[] = "Last name must only contain letters";
        }
    	if(!preg_match("/^[a-zA-Z0-9_\pL]+$/u", $params['username'])) {
			self::$error[] = "Username must contain letters, numbers and underscore only";
		}
        if(!filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
			self::$error[] = "Email format apears to be wrong.";
		}
     	if(!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/", $params['password'])) {
			self::$error[] = "Password must include at least one uppercase, one lowercase letter and a digit.";
		}
        if($params['password'] !== $params['password1']) {
            self::$error[] = "Passwords you provided do not match";
        }

        $password = $params['password'];
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $params['password'] = $hash;

        $db->query($sql);
        $db->bind(':first_name', $params['first_name']);
        $db->bind(':last_name', $params['last_name']);
        $db->bind(':username', $params['username']);
        $db->bind(':email', $params['email']);
        $db->bind('password', $params['password']);
        $db->bind(':status', $params['status']);
        $db->bind(':registration_date', $params['registration_date']);
        $db->bind(':verification_code', $params['verification_code']);

        if(empty(self::$error))
        {
            $db->execute();
            return true;
        }

        $db = null;
        return false;
    }

    public static function showErrors() : void
    {
        if(!empty(self::$error))
        {
            foreach(self::$error as $msg)
            {
                echo "<p>$msg</p>";
            }
        }
    }

    public function loginUser(array $params)
    {
        $sql = "SELECT * FROM mixer.users WHERE username = :username OR email = :email";
        $db = $this->db;

        $db->query($sql);
        $db->bind(':username', $params['username']);
        $db->bind(':email', $params['username']);
        $db->execute();
        $row = $db->fetchSingle();

        if($row['status'] == "Enabled")
        {
            if(password_verify($params['password'], $row['password']))
            {
               return $row;
            }
            self::$error[] = 'Wrong password';
        }
        self::$error[] = 'Please click on the link we send you to your email address.';
        return false;
    }

    public function getUserData(string $username) : array
    {
        $sql = "SELECT first_name, last_name, username, email, status, registration_date FROM mixer.users WHERE username = :username";
        $db = $this->db;

        $db->query($sql);
        $db->bind(':username', $username);

        if($db->execute())
        {
            $data = $db->fetchAll();
            return $data;
        }

        echo "Nothing found in SQL query";

        $db = null;
    }


    //Update users status from 'Disabled' into 'Enabled' when verification code matches the one sent via email
    public function enableAccount(string $verification_code) : bool
    {
        $sql = "UPDATE mixer.users SET status = :status WHERE verification_code = :verification_code";
        $db = $this->db;

        $db->query($sql);

        $db->bind(':status', "Enabled");
        $db->bind(':verification_code', $verification_code);

        if($db->execute()) {
            return true;
        }
        else {
            return false;
        }

    }

    public function deleteUser(string $username) : bool
    {
        $sql = "DELETE FROM mixer.users WHERE username = :username";

        $db = $this->db;
        $db->query($sql);

        $db->bind(':username', $username);

        if($db->execute())
        {
            return true;
        }
        $db = null;
        return false;
    }

    public function insert(array $data)
    {
        $sql = "INSERT INTO mixer.radi (id, name) VALUES (:id, :name)";

        $db = $this->db;
        $db->query($sql);
        $db->bind(':id', $data['id']);
        $db->bind(':name',$data['name']);
        $db->execute();

    }

}
