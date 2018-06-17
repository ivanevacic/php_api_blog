<?php

    class Post
    {
        private $connection;
        private $table = 'posts';

        public $id;
        public $category_id;
        public $category_name;
        public $title;
        public $body;
        public $author;
        public $created_at;

        //  Constructor
        public function __construct($db)
        {
            $this->connection = $db;
        }

        //  Get posts
        public function read_all_posts()
        {
            //  Create query
            $query = 'SELECT 
                c.name as category_name,
                p.id,
                p.category_id,
                p.title,
                p.body,
                p.author,
                p.created_at
            FROM
                ' . $this->table . ' p
            LEFT JOIN
                categories c ON p.category_id = c.id
            ORDER BY 
                p.created_at DESC';

        
            //  Prepare statement
            $stmt = $this->connection->prepare($query);
            //  Execute statement
            $stmt->execute();
            //  Return statement
            return $stmt;
        }

        //  Get single post
        public function read_single_post()
        {
            //  Create query
            $query = 'SELECT 
                    c.name as category_name,
                    p.id,
                    p.category_id,
                    p.title,
                    p.body,
                    p.author,
                    p.created_at
                FROM
                    ' . $this->table . ' p
                LEFT JOIN
                    categories c ON p.category_id = c.id
                WHERE
                    p.id = ?
                LIMIT 0,1';
            
            //  Prepare statement
            $stmt = $this->connection->prepare($query);
            //  Bind ID
            $stmt->bindParam(1, $this->id);
            //  Execute statement
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            //Set properties
            $this->title = $row['title'];
            $this->body = $row['body'];
            $this->author = $row['author'];
            $this->category_id = $row['category_id'];
            $this->category_name = $row['category_name'];
        }
    }
