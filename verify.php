<?php

include 'config.php';

$username = $_POST["username"];
$password = $_POST["pwd"];

//$query = $mysqli->query("SELECT email, password from users");

$result = $mysqli->query('SELECT id,email,password,fname,type from users order by id asc');

if($result === FALSE){
  die(mysql_error());
}

if($result){
  while($obj = $result->fetch_object()){
    if($obj->email === $username && $obj->password === $password) {

      //if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
      if(session_id() == '' || !isset($_SESSION)){session_start();}

      $_SESSION['username'] = $username;
      $_SESSION['type'] = $obj->type;
      $_SESSION['id'] = $obj->id;
      $_SESSION['fname'] = $obj->fname;
      header("location:index.php");
    }

    else {
      if(session_id() == '' || !isset($_SESSION)){session_start();}
      session_unset();
      session_destroy();
      header("location:index.php");
    }
  }
}


?>
