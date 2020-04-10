<?php
// Send Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

    // Get Files
    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    // Instantiate and connect 

    $obj = new Database();
    $dbCon = $obj->connect();
    $post = new Post($dbCon);

    // Get Inserted data and assign
    $data = json_decode(file_get_contents("php://input"));

    $post->title = $data->title;
    $post->body = $data->body;
    $post->author = $data->author;
    $post->category_id = $data->category_id;

    // Call Create post method with feedback
    if ($post->createPost()) {
        echo json_encode(
            array('message' => 'Post Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Post Not Created')
        );
    }