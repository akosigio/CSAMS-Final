<?php
class DatabaseAccount {
    private $server_name = "localhost";
    private $username = 'root';
    private $db_name = 'final';
    protected $conn;

    public function __construct(){
        if (!headers_sent() && !isset($_SESSION)){ session_start(); }
        if (isset($_SESSION["acount_user_id"])){
            if ((time() - $_SESSION["last_login_timestamp"]) > 900) {
                header("Location: actions/php/logout.php");
            }else{
                    $_SESSION["last_login_timestamp"] = time();
            }
        }else{
            header("Location: actions/php/logout.php");
        }
        $this->conn = new mysqli($this->server_name, $this->username, $this->password, $this->db_name);

        if($this->conn->connect_error){
            die("Unable to connect to database " . $this->db_name . ": " . $this->conn->connect_error);
        }
    }
}

class DatabaseLogin {
    private $server_name = "localhost";
    private $username = 'root';
    private $db_name = 'final';
    protected $conn;

    public function __construct(){
        // if (!isset($_SESSION)){ session_start(); }
        // if (isset($_SESSION["acount_user_id"])){
        //     if ((time() - $_SESSION["last_login_timestamp"]) > 900) {
        //             header("Location: actions/php/logout.php");
        //     }else{
        //             $_SESSION["last_login_timestamp"] = time();
        //     }
        // }else{
        //     header("Location: actions/php/logout.php");
        // }
        $this->conn = new mysqli($this->server_name, $this->username, $this->password, $this->db_name);

        if($this->conn->connect_error){
            die("Unable to connect to database " . $this->db_name . ": " . $this->conn->connect_error);
        }
    }
}