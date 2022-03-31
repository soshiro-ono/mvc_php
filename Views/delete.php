<?php
  use User\UserController;

  require_once('../Controllers/UserControllers.php');
  // require_once('../Models/model.php');
  $controller = new UserController(); //クラスをインスタンス化　クラスの中にある関数を使う準備　
  $delete = $controller -> delete($_POST);
  // $delete = $model -> delete($_POST);ここの$modelはmodelクラスの関数を読み込んでるだけで$modelにdelete($_POST)が入ってきているわけではない。$model -> delete($_POST)の結果が$deleteに代入されている。
?>