<?php

use User\UserController;

session_start();

require_once('../Controllers/UserControllers.php'); //これを書くことによってファイルが共有される。インクルードみたいなもん

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header('Location: contact.php');
    //post request以外リダイレクト
}

$controller = new UserController(); //クラスをインスタンス化　クラスの中にある関数を使う準備　
$validation = $controller -> Validation($_POST);
?>



  
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Casteria</title>
    <link rel="stylesheet" type="text/css" href="../css/confirm.css">
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
      <!-- データを渡すため。hiddenで隠しているがデータを渡しているのはこの部分。 -->
      <h1>お問い合せ</h1>
      <form action="complete.php" method="post">
        <input type="hidden" name="name" id="name" placeholder="山田太郎" value="<?php echo $_SESSION['name'] ?>">
          <input type="hidden" name="kana" id="kana" placeholder="ヤマダタロウ" value="<?php echo $_SESSION['kana'] ?>">
          <input type="hidden" name="tel" id="tel" placeholder="09012345678" maxlength="50"
          value="<?php echo $_SESSION['tel']?>">
          <input type="hidden" name="email" id="email" placeholder="test@test.co.jp" maxlength="50"
          value="<?php echo $_SESSION['email'] ?>">     
          <input type="hidden" name="body" id="body" maxlength="500" wrap="hard"
          value=<?php echo $_SESSION['body'] ?>">     

        <div class="form-contents">   
          <div class="confirm-text"> 
            <p>下記の内容をご確認の上送信ボタンを押してください</p>          
            <p>内容を訂正する場合は戻るを押してください。</p> 
          </div>
          <!-- 表示するため
          $_POSTはsubmitを押した時に発火する。(formのinputの中のデータが送られる。$POSTとして)
          そのためcomplete.phpの$_POSTは16行目から24行目のデータが入っている。
          -->
          <div class="form-confirm">
            <label>氏名</label>
          </div>
          <p><?php echo ($_POST['name']); ?></p>
          
          <div class="form-confirm">
            <label>フリガナ</label>
          </div>
          <p><?php echo ($_POST['kana']); ?></p>

          <div class="form-confirm">
            <label>電話番号</label>
          </div>
          <p><?php echo ($_POST['tel']); ?></p>

          <div class="form-confirm">
            <label>メールアドレス</label>
          </div>
          <p><?php echo ($_POST['email']); ?></p>

          <div class="form-confirm">
            <label>お問い合わせ内容</label>
          </div>
          <p><?php echo ($_POST['body']); ?></p>  <!--対策しつつ改行含める-->

          <div class="confirm-buttons">            
            <div class="confirm-button"> 
              <button class="send-button" type="submit">送信</button>
            </div>
            <div class="confirm-button"> 
              <button class="return-button" type="button" onclick="history.back()">戻る</button>
            </div>
          </div>          

        </div>
      </form>
    </div>
  </div>
</body>
