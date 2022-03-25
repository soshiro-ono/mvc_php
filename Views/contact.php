<?php
use User\UserController;

session_start();

require_once('../Controllers/UserControllers.php'); //これを書くことによってファイルが共有される。インクルードみたいなもん

?>

<!DOCTYPE html>
<html>
<body>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Casteria</title>
    <link rel="stylesheet" type="text/css" href="../css/contact.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="./validation.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css" />
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <script defer src="../js/index.js"></script>
</head>

<div class="form-group">
    <div class="form-container">
      <h1>お問い合わせ</h1>
      <form action="confirm.php" method="post" class="form-contact">
        <div class="form-contents">
          <h3>下記の項目をご記入の上送信ボタンを押してください</h3>
          <p>送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。</p>
          <p>なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。</p>
          <p><span id="red">*</span>は必須項目となります。</p>

          <div class="form-content">
            <label>氏名</label><span id="red">*</span>
          </div>
          <div class="validation">
            <?php echo $_SESSION['nameValidation']; ?>
          </div>
          <div class="form-content">
            <input type="text" name="name" id="name" placeholder="山田太郎" value="<?php echo $_SESSION['name'] ?>">
          </div>

          <div class="form-content">
            <label>フリガナ</label><span id="red">*</span>
          </div>
          <div class="validation">
            <?php echo $_SESSION['kanaValidation']; ?>
          </div>
          <div class="form-content">
            <input type="text" name="kana" id="kana" placeholder="ヤマダタロウ" value="<?php echo $_SESSION['kana'] ?>">
          </div>

          <div class="form-content">
            <label>電話番号</label>
          </div>
          <div class="validation">
            <?php echo $_SESSION['telValidation']; ?>
          </div>
          <div class="form-content">
            <input type="text" name="tel" id="tel" placeholder="09012345678" maxlength="50" value="<?php echo $_SESSION['tel'] ?>">
          </div>

          <div class="form-content">
            <label>メールアドレス</label><span id="red">*</span>
          </div>
          <div class="validation">
            <?php echo $_SESSION['emailValidation']; ?>
          </div>
          <div class="form-content">
            <input type="text" name="email" id="email" placeholder="test@test.co.jp" maxlength="50" value="<?php echo $_SESSION['email'] ?>">
          </div>

          <div class="form-content">
            <label><h3>お問い合わせ内容をご記入ください<span id="red">*</span></h3></label>
          </div>
          <div class="validation">
            <?php echo $_SESSION['bodyValidation']; ?>
          </div>

          <div class="form-content">
            <textarea name="body" id="body"  maxlength="500" wrap="hard" ><?php echo $_SESSION['body'] ?></textarea>
          </div>
          <input type="hidden" name="session" value="session" >
          <div class="form-content">
            <button type="submit" id="send">送 信</button>
          </div>
        </div>
      </form>      
    </div>    
</div>
<table class="form-table">
    <tr>
      <th>システムID</th>
      <th>氏名</th>
      <th>フリガナ</th>
      <th>電話番号</th>
      <th>メールアドレス</th>
      <th>お問い合わせ内容</th>
      <th>作成日時</th>
    </tr>

    <?php
      $controller = new UserController(); //クラスをインスタンス化　クラスの中にある関数を使う準備　
      $findAll = $controller -> findAll(); //関数呼び出し
    ?>

    <!--データベースのデータはもともとカンマでつなげられているだけの長いCSVデータであり、配列ではない。
    そこにfetch()することで、配列化をする。
    while文は、TRUEである限りループをする。
    while文がfalseになるときは、fetchできなくなったとき、すなわちすべてのデータを配列化し終えたとき。-->
    <?php foreach ($findAll as $column) :?>
      <tr>
        <td><?php echo ($column['id']) ?></td>
        <td><?php echo ($column['name']) ?></td>
        <td><?php echo ($column['kana']) ?></td>
        <td><?php echo ($column['tel']) ?></td>
        <td><?php echo ($column['email']) ?></td>
        <td><?php echo nl2br(($column['body'])) ?></td>
        <td><?php echo $column['created_at'] ?></td>


        <form action="edit.php" method="GET">
          <td>
            <button name="data_edit" value="<?=$column["id"] ?>">編集</button>
          </td>
        </form>

        <form action="delete.php" method="post">
          <td id="delete">
            <button id="db_delete" name="data_delete" value="<?= $column["id"] ?>
            "onClick="return confirm('本当に削除しますか？')">削除</button>
          </td>
        </form>

      </tr>
    <?php endforeach ;?>    
  </table>
  
  <?php include('./footer.php') ?>
</body>
</html>


</body>

</html>