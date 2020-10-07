<?php

namespace src;

use PDO;



/**
 *
 * @author Edikowy
 *
 */
class User extends Model {
    private $id;
    private $login;
    private $pass;
    private $email;
    private $access;
    private $register_date;
    private $register_confirm;
    private $user_addr;
    private $user_env;
    private $last_loged_date;
    private $loged_date;
    private $loged;
    public function __construct() {
        parent::__construct();
        echo 'User';
        if ((!empty($_SESSION['user']['login'])) && (!empty($_SESSION['user']['pass']))) {
            $login_c = addslashes($_SESSION['user']['login']);
            $pass_c = addslashes($_SESSION['user']['pass']);
            // --------------------------------------------------------------------------------
            $sql = "SELECT * FROM users WHERE login = '$login_c'";
            $query = $this->conn->prepare($sql);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if (!empty($result) && (password_verify($pass_c,$result["pass"]))) {
                $this->set("id", $result["id"]);
                $_SESSION['user']['id'] = $this->get("id");
                $this->set("login", $login_c);
                $this->set("pass", $pass_c);
                $this->set("email", $result["email"]);
                $_SESSION['user']['email'] = $this->get("email");
                $this->set("access", $result["access"]);
                $_SESSION['user']['access'] = $this->get("access");
                $this->set("register_date", $result["register_date"]);
                $_SESSION['user']['register_date'] = $this->get("register_date");
                $this->set("register_confirm", $result["register_confirm"]);
                $_SESSION['user']['register_confirm'] = $this->get("register_confirm");
                $this->set("user_addr", $result["user_addr"]);
                $_SESSION['user']['user_addr'] = $this->get("user_addr");
                $this->set("user_env", $result["user_env"]);
                $_SESSION['user']['user_env'] = $this->get("user_env");
                $this->set("loged_date", $result["loged_date"]);
                $_SESSION['user']['loged_date'] = $this->get("loged_date");
                $this->set("loged", TRUE);
                $_SESSION['user']['loged'] = TRUE;
            }
            $this->conn = null;
        }
    }
    public function login($login, $pass) {
        $login_l = addslashes($login);
        $pass_l = addslashes($pass);
        // --------------------------------------------------------------------------------
        $sql = "SELECT * FROM users WHERE login = '$login_l'";
        $query = $this->conn->prepare($sql);
        //         $query->bindValue("login",$login_l);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            if (password_verify($pass_l,$result["pass"])) {
                $this->set("id",$result["id"]);
                $_SESSION['user']['id'] = $this->get("id");
                $this->set("login", $result["login"]);
                $this->set("pass", $result["pass"]);
                $_SESSION['user']['login'] = $this->get("login");
                $_SESSION['user']['pass'] = $this->get("pass");
                $this->set("email",$result["email"]);
                $_SESSION['user']['email'] = $this->get("email");
                $this->set("access",$result["access"]);
                $_SESSION['user']['access'] = $this->get("access");
                $this->set("register_date",$result["register_date"]);
                $_SESSION['user']['register_date'] = $this->get("register_date");
                // --------------------------------------------------------------------------------
                // --------------------------------------------------------------------------------
                $this->set("user_addr",$result["user_addr"]);
                $_SESSION['user']['user_addr'] = $this->get("user_addr");
                // --------------------------------------------------------------------------------
                $this->set("user_env",$result["user_env"]);
                $_SESSION['user']['user_env'] = $this->get("user_env");
                // --------------------------------------------------------------------------------
                // --------------------------------------------------------------------------------
                $this->set("loged",TRUE);
                $_SESSION['user']['loged'] = TRUE;
                $this->conn = null;
                echo 'zalogowany';
                return TRUE;
            } else {
                $_SESSION['err_user']['pass'] = 'Złe haslo';
                return FALSE;
            }
        } else {
            $_SESSION['err_user']['login'] = 'Zły login';
            return FALSE;
        }
    }
    public function logout() {
        if ($this->get("loged")) {
            $this->set("loged",FALSE);
            $this->set("id",0);
            $this->set("access",0);
            session_destroy();
            //             Engine::doHedera("index.php");
        }
    }
    public function register($new_login, $new_email, $new_pass, $new_pass2) {
        echo 'register';
        $login = addslashes($new_login);
        $email = addslashes($new_email);
        $pass = addslashes($new_pass);
        $pass2 = addslashes($new_pass2);
        $all_OK = TRUE;
        // --------------------------------------------------------------------------------
        if ((strlen($login) < 3) || (strlen($login) > 20)) {
            $all_OK = FALSE;
            $_SESSION['err_user']['new_login'] = "Nick musi posiadać od 3 do 20 znaków!";
        }
        if (!ctype_alnum($login)) {
            $all_OK = FALSE;
            $_SESSION['err_user']['new_login'] = "Nick musi składać się z znaków alfanumerycznych";
        }
        // --------------------------------------------------------------------------------
        $emailB = filter_var($email,FILTER_SANITIZE_EMAIL);
        if ((!filter_var($emailB,FILTER_VALIDATE_EMAIL)) || ($emailB != $email)) {
            $all_OK = FALSE;
            $_SESSION['err_user']['new_email'] = "Podaj poprawny adres e-mail!";
        }
        // --------------------------------------------------------------------------------
        if ((strlen($pass) < 6) || (strlen($pass2) > 20)) {
            $all_OK = FALSE;
            $_SESSION['err_user']['new_pass'] = "Hasło musi składać się od 6 do 20 znaków.";
        }
        if ($pass != $pass2) {
            $all_OK = FALSE;
            $_SESSION['err_user']['new_pass2'] = "Hasła nie są identyczne.";
        }
        $pass_hash = password_hash($pass,PASSWORD_DEFAULT);
        // --------------------------------------------------------------------------------
        $sql = "SELECT email FROM users WHERE email = '$email'";
        $query = $this->conn->prepare($sql);
        $query->bindValue('email',$email);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            $all_OK = FALSE;
            $_SESSION['err_user']['new_email'] = "Istnieje już konto przypisane do tego adresu e-mail!";
        }
        // --------------------------------------------------------------------------------
        $sql = "SELECT login FROM users WHERE login = '$login'";
        $query = $this->conn->prepare($sql);
        $query->bindValue('login',$login);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            $all_OK = FALSE;
            $_SESSION['err_user']['new_login'] = "Istnieje już gracz o takim nicku! Wybierz inny.";
        }
        // --------------------------------------------------------------------------------
        // ???????????????/
        // ???????????????/
        if ($all_OK) {
            $remote = $_SERVER['REMOTE_ADDR'];
            $agent = $_SERVER['HTTP_USER_AGENT'];
            $sql = "INSERT INTO users VALUES (NULL, '$login', '$pass_hash', '$email', '1', NULL, TRUE, '$remote', '$agent')";
            $query = $this->conn->prepare($sql);
            $query->execute();
            $_SESSION['user']['register_ok'] = TRUE; // ???????????????/
            Engine::doHedera("index.php");
        }
        // ???????????????/
        // ???????????????/
        // --------------------------------------------------------------------------------
    }
    // --------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------
    public function newEmail($new_email, $pass) {}
    public function newPass($pass, $new_pass, $new_pass2) {}
    public function delUser($pass) {}
    // --------------------------------------------------------------------------------
    public function get($name) {
        return $this->$name;
    }
    public function set($name, $value) {
        $this->$name=$value;
    }
}

