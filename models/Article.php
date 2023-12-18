<?php
require_once 'config.php';

class Article
{
    private $id;
    private $title;
    private $content;
    private $db;

    public function __construct($id = null, $title = '', $content = '')
    {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
    }

    public static function getAll()
    {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $db->query('SELECT * FROM articles');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $db->prepare('SELECT * FROM articles WHERE id = :id');
        $query->bindParam(':id',$id, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function save()
    {
        $query = $this->db->prepare('INSERT INTO articles (title, content) VALUES (:title, :content)');
        $query->bindParam(':title', $this->title, PDO::PARAM_STR);
        $query->bindParam(':content', $this->content, PDO::PARAM_STR);
        $query->execute();
    }

    public function update()
    {
        $query = $this->db->prepare('UPDATE articles SET title = :title, content = :content WHERE id = :id');
        $query->bindParam(':id', $this->id, PDO::PARAM_INT);
        $query->bindParam(':title', $this->title, PDO::PARAM_STR);
        $query->bindParam(':content', $this->content, PDO::PARAM_STR);
        $query->execute();
    }

    public function delete()
    {
        $query = $this->db->prepare('DELETE FROM articles WHERE id = :id');
        $query->bindParam(':id', $this->id, PDO::PARAM_INT);
        $query->execute();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
   
}
?>