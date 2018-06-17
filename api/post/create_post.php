<?php

    //  Header
        //  Can be accessed by everyone
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database_Connection.php';
    include_once '../../models/Post.php';

    //  Init DB and connect
        $database = new Database();
        $db = $database->connect();
    
    //  Init blog post object
        $post = new Post($db);
    
    //  Get RAW posted data
        $data = json_decode(file_get_contents("php://input"));

    $post->title = $data->title;
    $post->body = $data->body;
    $post->author = $data->author;
    $post->category_id = $data->category_id;

    //  Create post
    if($post->create_post()) {
        echo json_encode(
            array('message' => 'Post created!')
        );
    } else {
        echo json_encode(
            array('message' => 'Post NOT created!')
        );
    }