<?php
session_start();
$email = $_POST['email'];
$password = password_hash($_POST['password'] , PASSWORD_DEFAULT);

$pdo = new PDO("mysql:host=localhost; dbname=marlin11", "root", "");
$statement = $pdo->prepare("SELECT * FROM users WHERE email=:email");
$statement->bindParam(":email", $email);
$statement->execute();
$userByEmail = $statement->fetch(PDO::FETCH_ASSOC);



if ($userByEmail !== false) {
   $_SESSION['issetEmail'] = "Этот enail уже занят";
   header("Location: task11.php");
   die();
}
else {
    $pdo = new PDO("mysql:host=localhost; dbname=marlin11", "root", "");

    $sql = "INSERT INTO users (email , password ) VALUES (:email, :password)";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(":email", $email);
    $statement->bindParam(":password", $password);
    $statement->execute();

   header("Location: Home.php ");
}