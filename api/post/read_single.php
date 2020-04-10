<?php
 // Send Headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');

 // Get Files
 include_once '../../config/Database.php';
 include_once '../../models/Post.php';

 // Instantiate and connect DB

 $obj = new Database();
 $dbCon = $obj->connect();
 $post = new Post($dbCon);

 // Assign id or die
 $post->id = isset($_GET['id']) ? $_GET['id'] : die("Unauthorized Access");

//calling, Encoding to JSON etc
 $post->readSinglePost();

 $post_arr = array(
     "id" => $post->id,
     "title" => $post->title,
     "body" => $post->body,
     "author" => $post->author,
     "category_id" => $post->category_id,
     "category_name" => $post->category_name,
     "created_at" => $post->created_at
 );

 print_r(json_encode($post_arr));