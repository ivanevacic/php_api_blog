<?php

    //  Header
        //  Can be accessed by everyone
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database_Connection.php';
    include_once '../../models/Post.php';

    //  Init DB and connect
        $database = new Database();
        $db = $database->connect();
    
    //  Init blog post object
        $post = new Post($db);

    //  Get ID of post
    $post->id = isset($_GET['id']) ? $_GET['id'] : die();

    //  Get post
    $post->read_single_post();

    //  Create array
    $post_arr = array(
        'id' => $post->id,
        'title' => $post->title,
        'body' => $post->body,
        'author' => $post->author,
        'category_id' => $post->category_id,
        'category_name' => $post->category_name
    );

    //  Convert to JSON
    print_r(json_encode($post_arr));

