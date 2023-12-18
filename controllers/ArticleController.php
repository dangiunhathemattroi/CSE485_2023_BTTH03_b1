<?php
require_once 'models/Article.php';
require_once 'services/ArticleService.php';

class ArticleController
{
    // Display a list of articles
    public function index()
    {
        //Lay du lieu tu server tuong ung 
        $articles = Article::getAll();
        require 'views/index.php';
    }

    // Display the article creation form
    public function create(){
        $articleService = new ArticleService();
        require 'views/create.php';
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
        $id = $_GET['id'];
        $article = Article::getById($id);
        // Render ra view
        require 'views/edit.php';
    } 

    public function update() {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content= $_POST['content'];

        $newArticle = new Article();
        $newArticle->setId($id);
        $newArticle->setTitle($title);
        $newArticle->setContent($content);

        $newArticle->update();
        header('Location: index.php?controller=article&action=index');

    }

    //Delete the specified article from the database
    public function delete()
    {
        $id = $_GET['id'];
        $article = new Article($id, null, null);
        $article->delete();
        header('Location: index.php?controller=article&action=index');
}
}
?>