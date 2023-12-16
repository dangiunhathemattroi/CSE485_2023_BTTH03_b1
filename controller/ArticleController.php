<?php
require_once 'models/Article.php';
require_once'services/ArticleService.php';

class ArticleController
{
    // Display a list of articles
    public function index()
    {
        //Lay du lieu tu server tuong ung 
        $articleServer = new ArticleServer();
        $articles = Article::getAll();
        require 'views/articles/index.php';
    }

    // Display the article creation form
    public function create(){
    $articleService = new ArticleService();
      
        if(isset($_POST['add'])){
        
            $title = $_POST['title'];
            $content= $_POST['content'];

       
            $newArticle = new Article(null, $title, $content);
            $articleService->insertData($newArticle);
            echo "ADD new successfully";
            header("location: index.php?controller=article&action=index");}
            
        
        // Render ra view
        include("views/create.php");
  
    
        require 'views/articles/create.php';
    }

    // Store a newly created article in the database
    public function store()
    {
        $title = $_POST['title'];
        $content = $_POST['content'];

        $article = new Article();
        $article->setTitle($title);
        $article->setContent($content);
        $article->save();

        header('Location: index.php?controller=article&action=index');
    }

    // Display the article editing form
    public function edit()
    {
        $articleService = new ArticleService();
        $id = $_GET['id'];
        $chosenArticle = $articleService->getData($id);
        if(isset($_POST['edit'])){
        
            
        $title = $_POST['title'];
        $content= $_POST['content'];
            
        $chosenArticle->setTitle($title);
        $chosenArticle->setContent($content);  
        $articleService->updateData($chosenArticle);
        echo "Edit successfully";
        header("location: index.php?controller=article&action=index");}
        // Render ra view
        include("views/edit.php");
    } 

    // Delete the specified article from the database
    // public function delete()
    // {
    //     $articleService = new ArticleService();
    //     $id = $_GET['id'];
    //     $chosenArticle = $articleService->getData($id);
    //     if(isset($_POST['delete'])){
    //         $articleService->deleteData($chosenArticle);
    //         header("location: index.php?controller=article&action=index");
    //     }
    //     else if(isset($_POST['noDelete'])){
    //         header("location: index.php?controller=article&action=index");
    //     }
    //     // Render ra view
    //     include("../views/delete.php");
    // }
}
?>
