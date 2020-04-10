<?php
class Post{
    // DB stuff

    private $pdo;
    private $table = 'posts';

    // Table Propeties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // constructor
    public function __construct($db){
        $this->pdo = $db;
    }

    
    public function read(){
        // Select Stmt
        $query = "SELECT 
                c.name AS category_name,
                p.id,
                p.category_id,
                p.title,
                p.body,
                p.author,
                p.created_at
            FROM 
                $this->table p
            LEFT JOIN 
                categories c ON p.category_id = c.id
            ORDER BY
                p.created_at DESC";
        
        // Prepare and execute
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    public function readSinglePost(){
         // Bind Parameters
        $bind = array(':id'=> $this->id);

        // Select Query
        $query = "SELECT 
                c.name AS category_name,
                p.id,
                p.category_id,
                p.title,
                p.body,
                p.author,
                p.created_at
            FROM 
                $this->table p
            LEFT JOIN 
                categories c ON p.category_id = c.id
            WHERE
                p.id = :id
            LIMIT 0,1";
        

        // Prepare and execute
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($bind);

        // Fetch Post and assign
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
        $this->created_at = $row['created_at'];
    }
    
    public function createPost(){

        // Sanitize Input
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // Bind Parameters
        $bind = array(':title'=> $this->title, ':body'=> $this->body, ':author'=> $this->author, ':category_id'=> $this->category_id);

        // Insert Query
       $query = "INSERT INTO $this->table 
            SET
                title = :title,
                body = :body,
                author = :author,
                category_id = :category_id";

        // Prepare and Execute
        $stmt = $this->pdo->prepare($query);

        if ($stmt->execute($bind)) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}