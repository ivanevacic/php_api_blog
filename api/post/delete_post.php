<?php

    //  Header
        //  Can be accessed by everyone
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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

    //  Set ID to delete
        $post->id = $data->id;

    //  Delete post
    if ($post->delete_post()) {
        echo json_encode(
            array('message' => 'Post deleted!')
        );
    } else {
        echo json_encode(
            array('message' => 'Post NOT deleted!')
        );
    }
