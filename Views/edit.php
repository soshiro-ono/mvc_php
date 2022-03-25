<?php
use User\UserController;

session_start();

require_once('../Controllers/UserControllers.php'); //これを書くことによってファイルが共有される。
if (!empty($_GET)) {
    $controller = new UserController(); //クラスをインスタンス化　クラスの中にある関数を使う準備　
    $data = $controller -> edit($_GET);
} else {
    $data = $_SESSION;
}

?>

<!DOCTYPE html>
<html lang="ja">
<body>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Casteria</title>
    <link rel="stylesheet" type="text/css" href="../css/edit.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="./validation.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css" />
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <script defer src="../js/index.js"></script>
</head>
  <div class="form-group">
    <div class="form-container">
      <h1>編集</h1>
      <form action="update.php" method="post" class="form-contact">
        <div class="form-contents">
          <h3>下記の項目を編集の上、送信ボタンを押してください</h3>

          <div class="form-content">
            <label>氏名</label><span id="red">*</span>
          </div>
          <div class="validation">
            <?php echo $_SESSION['nameValidation']; ?>
          </div>
          <div class="form-content">
            <input type="text" name="name" id="name" placeholder="山田太郎"
            value="<?php echo $data['name'] ?>">
          </div>

          <div class="form-content">
            <label>フリガナ</label><span id="red">*</span>
          </div>
          <div class="validation">
            <?php echo $_SESSION['kanaValidation']; ?>
          </div>
          <div class="form-content">
            <input type="text" name="kana" id="kana" placeholder="ヤマダタロウ"
            value="<?php echo $data['kana'] ?>">
          </div>

          <div class="form-content">
            <label>電話番号</label>
          </div>
          <div class="validation">
            <?php echo $_SESSION['telValidation']; ?>
          </div>
          <div class="form-content">
            <input type="text" name="tel" id="tel" placeholder="09012345678" maxlength="50"
            value="<?php echo $data['tel'] ?>">
          </div>

          <div class="form-content">
            <label>メールアドレス</label><span id="red">*</span>
          </div>
          <div class="validation">
            <?php echo $_SESSION['emailValidation']; ?>
          </div>
          <div class="form-content">
            <input type="text" name="email" id="email" placeholder="test@test.co.jp" maxlength="50"
            value="<?php echo $data['email'] ?>">
          </div>

          <div class="form-content">
            <label><h3>お問い合わせ内容をご記入ください<span id="red">*</span></h3></label>
          </div>
          <div class="validation">
            <?php echo $_SESSION['bodyValidation']; ?>
          </div>
          <div class="form-content">
            <textarea name="body" id="body"  maxlength="500" wrap="hard" ><?php echo $data['body'] ?></textarea>
          </div>

          <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
          <input type="hidden" name="session" value="session">
          <div class="form-content">
            <button type="submit" id="send">更新する</button>
          </div>
        </div>
      </form>
    </div>
  </div>