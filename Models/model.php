<?php
namespace Model;

class Model
{
    public function DBconnect()
    {
        try
        {
        // データベースに接続
            $pdo = new \PDO(
                'mysql:host=localhost;dbname=casteria;charset=utf8',
                'root',
                'root',
                [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,    //エラーを例外処理する
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,//カラム名をキーとする連想配列で取得する (デフォルト→カラム番号とカラム名の両方をキーとする連想配列で取得する．）
                \PDO::ATTR_EMULATE_PREPARES => false, //静的プレースホルダを使う(動的より遅くなるがセキュリティ面強い)
                ]
            );
        }
            catch (PDOException $e) {
            exit('データベースに接続できませんでした。' . $e->getMessage());
        }
        return $pdo;
    }

    public function findAll()
    {
        $pdo = $this -> DBconnect();
            // データベースから習得する処理
            $prepare = $pdo->prepare('SELECT * FROM contacts');       //contactsテーブルから全てのカラムを変数に格納
            $prepare->execute();  //取り出しを実行
            $result = $prepare->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
            

    }

    public function create($get_post)
    {
        $pdo = $this -> DBconnect();
        
            
              //confirm.php の値を習得
                    $name = $get_post['name'];
                    $kana = $get_post['kana'];
                    $tel = $get_post['tel'];
                    $email = $get_post['email'];
                    $body = $get_post['body'];
            
                try {
              // $sql = "INSERT INTO contacts (name, kana, tel, email, text) VALUES (:name, :kana, :tel, :email, :text)"; // INSERT文を変数に格納。:nameや:categoryはプレースホルダという、値を入れるための単なる空箱
              // $stmt = $pdo->prepare($sql); //挿入する値は空のまま、SQL実行の準備をする
              // $params = array(':name' => $name, ':kana' => $kana, ':tel' => $tel, ':email' => $email, ':body' => $body); // 挿入する値を配列に格納する
              // $stmt->execute($params); //挿入する値が入った変数をexecuteにセットしてSQLを実行
              
                    $pdo->beginTransaction();  // トランザクション
            
                    $sql = $pdo->prepare("INSERT INTO contacts(name, kana, tel, email, body) VALUES (:name, :kana, :tel, :email, :body)");
                    $sql->bindParam(':name', $name);
                    $sql->bindParam(':kana', $kana);
                    $sql->bindParam(':tel', $tel);
                    $sql->bindParam(':email', $email);
                    $sql->bindParam(':body', $body);
            
                    $sql->execute(array($name, $kana, $tel, $email, $body));

                    $pdo->commit(); //コミット

                    $_SESSION['name'] = '';
                    $_SESSION['kana'] = '';
                    $_SESSION['tel'] = '';
                    $_SESSION['email'] = '';
                    $_SESSION['body'] = '';
                    // var_dump($get_post["name"]);
                
                    $_SESSION['nameValidation'] = '';
                    $_SESSION['kanaValidation'] = '';
                    $_SESSION['telValidation'] = '';
                    $_SESSION['emailValidation'] = '';
                    $_SESSION['bodyValidation'] = '';
                } catch (PDOException $e) {
                    $pdo->rollback(); //ロールバック
                    exit('データベースに接続できませんでした。' . $e->getMessage());
                }
    }

    public function edit($get_id)
    {
        $pdo = $this -> DBconnect();


        try {
            // データベースから習得する処理
            $prepare = $pdo->prepare("SELECT * FROM contacts WHERE id = :id");
            $prepare->bindValue(':id', $_GET['data_edit']);
            $prepare->execute();
        } catch (PDOException $e) {
            exit('データベースに接続できませんでした。' . $e->getMessage());
        }
        $data = $prepare->fetch();
        // var_dump($data);
        return $data;
    }

    public function delete($delete_id)
    {
        $pdo = $this -> DBconnect();


        try {
            $pdo->beginTransaction();  // トランザクション
          // データベースから習得する処理
            $prepare = $pdo->prepare("DELETE FROM contacts WHERE id = :id");
            $prepare->bindValue(':id', $_POST['data_delete']);  //contactsテーブルからIDカラムを変数に格納
            $prepare->execute();  //取り出しを実行
        
            $pdo->commit();
        
            header("Location: ./contact.php");
        } catch (PDOException $e) {
            $pdo->rollback();
            exit('データベースに接続できませんでした。' . $e->getMessage());
        }
    }

    public function update($update)
    {
        $pdo = $this -> DBconnect();

        try {


        //edit.php の値を習得
        $id = $update['id'];
        $name = $update['name'];
        $kana = $update['kana'];
        $tel = $update['tel'];
        $email = $update['email'];
        $body = $update['body'];
        } catch (PDOException $e) {
        exit('データベースに接続できませんでした' . $e->getMessage());
        }

        try {
        // $sql = "INSERT INTO contacts (name, kana, tel, email, text) VALUES (:name, :kana, :tel, :email, :text)"; // INSERT文を変数に格納。:nameや:categoryはプレースホルダという、値を入れるための単なる空箱
        // $stmt = $pdo->prepare($sql); //挿入する値は空のまま、SQL実行の準備をする
        // $params = array(':name' => $name, ':kana' => $kana, ':tel' => $tel, ':email' => $email, ':text' => $text); // 挿入する値を配列に格納する
        // $stmt->execute($params); //挿入する値が入った変数をexecuteにセットしてSQLを実行
        $pdo->beginTransaction();  // トランザクション
        $sql = $pdo->prepare("UPDATE contacts SET name = :name, kana = :kana, tel = :tel, email = :email, body = :body WHERE id = :id");

        $sql->bindParam(':id', $id);
        $sql->bindParam(':name', $name);
        $sql->bindParam(':kana', $kana);
        $sql->bindParam(':tel', $tel);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':body', $body);

        $sql->execute();

        $pdo->commit();
        $_SESSION['name'] = '';
        $_SESSION['kana'] = '';
        $_SESSION['tel'] = '';
        $_SESSION['email'] = '';
        $_SESSION['body'] = '';
    
        $_SESSION['nameValidation'] = '';
        $_SESSION['kanaValidation'] = '';
        $_SESSION['telValidation'] = '';
        $_SESSION['emailValidation'] = '';
        $_SESSION['bodyValidation'] = '';
        
        header("Location: ./contact.php");
        } catch (PDOException $e) {
        $pdo->rollback();
        exit('データベースに接続できませんでした。' . $e->getMessage());   
        }

    }
}
