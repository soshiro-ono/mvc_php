<?php

use User\UserController;

session_start();
require_once('../Controllers/UserControllers.php'); //これを書くことによってファイルが共有される。インクルードみたいなもん
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header('Location: contact.php');
    //post request以外リダイレクト
}
$controller = new UserController(); //userコントローラークラスを呼び出している。５行目のrequire_onceをしてるから使える。$controllerにUserController.phpで記述した関数たちを代入しているイメージ
$controller -> create($_POST);  //UserControllers.php 93行目のcreate関数を呼び出している。

// $_SESSION = array();
// session_destroy();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Casteria</title>
    <link rel="stylesheet" type="text/css" href="../public/css/complete.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="./validation.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css" />
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <script defer src="../js/index.js"></script>
</head>
<body>
  <div class="form-group">  
    <div class="form-container">
      <h1>お問合せ</h1>
      <div class="complete-text">      
        <p>お問い合わせ頂きありがとうございます。</p>
        <p>送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。</p>
        <p>なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。</p>
        <a href="index.php">トップへ戻る</a>
      </div>
    </div>
  </div>
</body>
</html>

