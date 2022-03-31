<?php
namespace User;

use Model;

require_once('../Models/model.php');

class UserController //クラスは関数の集まり
{
    public function __construct()
    {
        $this->Model = new Model\Model();
    }
    public function validation($get_post)
    {
        $nameValidation = '';
        $kanaValidation = '';
        $telValidation = '';
        $emailValidation = '';
        $bodyValidation = '';
        // $_SESSION['flag'] = 0;

    
        // 空じゃなければ
        // この($_POST["session"])はcontact.php90行目
        if (!empty($get_post["session"])) {
            // $_SESSION['flag'] = 1;
            $errorCount = 0;
        
            if (empty($get_post["name"]) || mb_strlen($get_post["name"]) > 10) {
                $nameValidation = "氏名は必須入力です。10文字以内でご入力ください";
                $errorCount ++;
            }
            if (empty($get_post["kana"]) || mb_strlen($get_post["kana"]) > 10) {
                $kanaValidation = "フリガナは必須入力です。10文字以内でご入力ください";
                $errorCount ++;
            }
            if (!is_numeric($get_post["tel"])) {
                $telValidation = "電話番号は0-9の数字のみでご入力ください";
                // var_dump($telValidation);
                $errorCount ++;
            }
            if (empty($get_post["email"]) ||!filter_var($get_post["email"], FILTER_VALIDATE_EMAIL)) {
                $emailValidation = "メールアドレスは正しくご入力ください";
                $errorCount ++;
            }
            if (empty($get_post["body"])) {
                $bodyValidation = "お問合せ内容は必須入力です。";
                $errorCount ++;
            }
        
            $_SESSION['nameValidation'] = $nameValidation;
            $_SESSION['kanaValidation'] = $kanaValidation;
            $_SESSION['telValidation'] = $telValidation;
            $_SESSION['emailValidation'] = $emailValidation;
            $_SESSION['bodyValidation'] = $bodyValidation;
            
            $_SESSION['name'] = ($get_post["name"]);
            $_SESSION['kana'] = ($get_post["kana"]);
            $_SESSION['tel'] = ($get_post["tel"]);
            $_SESSION['email'] = ($get_post["email"]);
            $_SESSION['body'] = ($get_post['body']);
            
        
            if ($errorCount !== 0) {
                header("Location: ./contact.php");
            // } else {
            //     $_SESSION['name'] = '';
            //     $_SESSION['kana'] = '';
            //     $_SESSION['tel'] = '';
            //     $_SESSION['email'] = '';
            //     $_SESSION['body'] = '';
            //     var_dump($get_post["name"]);
            
            //     $_SESSION['nameValidation'] = '';
            //     $_SESSION['kanaValidation'] = '';
            //     $_SESSION['telValidation'] = '';
            //     $_SESSION['emailValidation'] = '';
            //     $_SESSION['bodyValidation'] = '';
            // }
            }
        
            // そもそもelseifはいらない？要確認
            } elseif ($_SESSION['flag'] == 1) {
                // } elseif (!empty($_SESSION['flag'] == 1)) {
                $_SESSION['flag'] = 0;
            } else {
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
            }
    
    }

    public function updateValidation($data)
    {
        $nameValidation = '';
        $kanaValidation = '';
        $telValidation = '';
        $emailValidation = '';
        $bodyValidation = '';
        // $_SESSION['flag'] = 0;
        // 空じゃなければ
        // この($_POST["session"])はcontact.php90行目
        if (!empty($data["session"])) {
            // $_SESSION['flag'] = 1;
            $errorCount = 0;
        
            if (empty($data["name"]) || mb_strlen($data["name"]) > 10) {
                $nameValidation = "氏名は必須入力です。10文字以内でご入力ください";
                $errorCount ++;
            }
            if (empty($data["kana"]) || mb_strlen($data["kana"]) > 10) {
                $kanaValidation = "フリガナは必須入力です。10文字以内でご入力ください";
                $errorCount ++;
            }
            if (!is_numeric($data["tel"])) {
                $telValidation = "電話番号は0-9の数字のみでご入力ください";
                // var_dump($telValidation);
                $errorCount ++;
            }
            if (empty($data["email"]) ||!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
                $emailValidation = "メールアドレスは正しくご入力ください";
                $errorCount ++;
            }
            if (empty($data["body"])) {
                $bodyValidation = "お問合せ内容は必須入力です。";
                $errorCount ++;
            }
        
            $_SESSION['nameValidation'] = $nameValidation;
            $_SESSION['kanaValidation'] = $kanaValidation;
            $_SESSION['telValidation'] = $telValidation;
            $_SESSION['emailValidation'] = $emailValidation;
            $_SESSION['bodyValidation'] = $bodyValidation;
            
            $_SESSION['id'] = ($data["id"]);
            $_SESSION['name'] = ($data["name"]);
            $_SESSION['kana'] = ($data["kana"]);
            $_SESSION['tel'] = ($data["tel"]);
            $_SESSION['email'] = ($data["email"]);
            $_SESSION['body'] = ($data['body']);


            if ($errorCount !== 0) {
                header("Location: ./edit.php");
            }
        } elseif ($_SESSION['flag'] == 1) {

            // } elseif (!empty($_SESSION['flag'] == 1)) {
            $_SESSION['flag'] = 0;
        } else {
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
        }
    }

    public function findAll() //関数
    {
        // $findAll = new Model\Model();
        //これは何をしてる？おそらくモデルの関数のインスタンスを定義（使う準備）
        return $params = $this->Model -> findAll();
    }

    public function create($get_post)
    {
        // $Model = new Model\Model(); 
        //おそらくモデルの関数のインスタンスを定義 これってもしかしてモデルに記述した関数を使ってるから$modelにしてるんちゃん？他のところが$controllerなんはコントローラークラスの関数使ってるからちゃうん
        $Model -> create($get_post); //モデルに記述した関数を実行している
    }

    // public function edit()
    public function edit($get_id)
    {
        // $data = new Model\Model();
        $params = $this->Model -> edit($get_id);
        // var_dump($params);
        return $params;
    }

    public function delete($delete_id)
    {
        // $Model = new Model\Model(); 
        $this->Model -> delete($delete_id); //モデルに記述した関数を実行している
    }


    public function update($update)
    {
        // $Model = new Model\Model(); 
        //おそらくモデルの関数のインスタンスを定義 これってもしかしてモデルに記述した関数を使ってるから$modelにしてるんちゃん？他のところが$controllerなんはコントローラークラスの関数使ってるからちゃうん
        $this->Model -> update($update); //モデルに記述した関数を実行している
    }
}
