<?php
// require_once('config/DBConnection.php');
require_once('models/Article.php');
class ArticleService{
    // Cac phuong thuc thao tac voi DB Server
    public static function getAll(){
        // Buoc 1: Ket noi DB Server
        
        try {
            $conn = new PDO('mysql:host=localhost;dbname=articles','root','');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $sql = "SELECT * FROM articles";
        $stmt = $conn->query($sql);

        // Buoc 3: Xu ly ket qua
        $articles = [];
        //Chuyen doi moi Ban ghi lay ra > Doi tuong: Article
        while($row=$stmt->fetch()){
            $article = new Article($row['id'],$row['title'],$row['content']);
            $articles[] = $article;
        }
        return $articles;
    }

    // function insert
    public static function insertData($objArticle){
        // Buoc 1: Ket noi DB Server
        try {
            $conn = new PDO('mysql:host=localhost;dbname=articles','root','');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
      
        $newTitle = $objArticle->getTitle();
        $newContent = $objArticle->getContent();
        // Buoc 2: Thuc hien truy van
        $sql = "INSERT INTO articles(title, content) VALUES ('$newTitle', '$newContent')";
        $stmt = $conn->query($sql);
    }

    // Lấy dữ liệu 1 bản ghi
    public static function getData($id){
        // Buoc 1: Ket noi DB Server
        try {
            $conn = new PDO('mysql:host=localhost;dbname=articles','root','');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
      
        // Buoc 2: Thuc hien truy van
        $sql = "SELECT * FROM articles WHERE id = $id";
        $stmt = $conn->query($sql)->fetch();
        $chosenArticle = new Article($stmt['id'], $stmt['title'], $stmt['content']);
        return $chosenArticle;
    }

     // Sửa dữ liệu bảng
     public function updateData($objArticle){
          // Buoc 1: Ket noi DB Server
          try {
            $conn = new PDO('mysql:host=localhost;dbname=articles','root','');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        $ID = $objArticle->getId();
        $newTitle = $objArticle->getTitle();
        $newContent = $objArticle->getContent();
        // Buoc 2: Thuc hien truy van
        $sql = "UPDATE articles SET title = '$newTitle', content = '$newContent' WHERE id = $ID";
        $conn->query($sql);

       
    }

    // Xóa dữ liệu bảng
    public function deleteData($objArticle){
        // Buoc 1: Ket noi DB Server
        try {
            $conn = new PDO('mysql:host=localhost;dbname=articles','root','');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $ID = $objArticle->getId();
        $sql = "DELETE FROM articles WHERE id = $ID";
        $conn->query($sql);
    }
}