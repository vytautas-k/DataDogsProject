<?php
class User{
    protected $id;
    protected $name;
    protected $passwd;

    function __construct()
    {
    }

    public function getUsername(){
        return $this->name;
    }

    public function setUsername($username){
        $this->name = $username;
    }

    public function setPassword($password){
        $this->passwd = $password;
    }

    public function getPassword(){
        return $this->passwd;
    }

    public function setID($id){
        $this->id = $id;
    }

    public function getID(){
        return $this->id;
    }
}
session_start();
$user = new User();
$error=''; //Variable to Store error message;
if(isset($_POST['submit'])){
    if(empty($_POST['user']) || empty($_POST['pass'])){
        $error = "Username or Password is Invalid";
    }
    else
    {
        $user->setPassword($_POST['pass']);
        $user->setUsername($_POST['user']);
        $name = $user->getUsername();
        $pass = $user->getPassword();
        $conn = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($conn, "login");
        //sql query to fetch information of registered user and find user match.
        $query = mysqli_query($conn, "SELECT * FROM userpass WHERE pass='$pass' AND user='$name'");
        $row = mysqli_fetch_array($query);
        $rows = mysqli_num_rows($query);

        if($rows == 1){
            $user->setID($row['id']);
            $_SESSION['class'] = $user;
            header("Location: welcome.php"); // Redirecting to other page
        }
        else
        {
            $error = "Username or Password is Invalid";
        }
        mysqli_close($conn); // Closing connection
    }
}