<?php

include "library/db.php";
$conn = connect();


class user {
    public $id = 0;
    public $username = "";
    public $email = "";

  function __construct($username, $email) {
    $this->username = $username;
    $this->email = $email;
  }
  function __toString() {
    return "User: {$this->username}, Email: {$this->email}";
  }
  static function load ($username, $password) {

    $query = "SELECT * FROM users WHERE username=?";
    global $conn;
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $u = false;
    if ($user) {
        if (password_verify($_POST['password'], $user['password'])) {
            $u = new User($user["username"], $user["email"], $user["admin"]);
            $u->id = $user["ID"];
            $u->admin = $user["admin"];
          }
    }
    return $u;
  }
  function save(){
    echo "Saving user {$this->username} to the database";
  }
  function insert() {
    $this->id = 11;
    echo "Inserting user {$this->username} to the database";
  }
}


