<?php

$url = $_SERVER['REQUEST_URI'];
if(strpos($url,"/") !== 0){
    $url = "/$url";
}
$urlArr = explode("/", $url);

$dbInstance = new DB();
$dbConn = $dbInstance->connect($db);


header("Content-Type:application/json");

if($url == '/posts' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $posts = getAllPosts($dbConn);
    echo json_encode($posts);
}

if($url == '/posts' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST;
    $postId = addPost($input, $dbConn);
    if($postId){
        $input['id'] = $postId;
        $input['link'] = "/posts/$postId";
    }

    echo json_encode($input);

}

if(preg_match("/posts\/([0-9])+/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'PUT'){
    $input = $_GET;
    $postId = $matches[1];
    updatePost($input, $dbConn, $postId);

    $post = getPost($dbConn, $postId);
    echo json_encode($post);
}

if(preg_match("/posts\/([0-9])+/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'GET'){
    $postId = $matches[1];
    $post = getPost($dbConn, $postId);

    echo json_encode($post);
}

if(preg_match("/posts\/([0-9])+/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'DELETE'){
    $postId = $matches[1];
    deletePost($dbConn, $postId);

    echo json_encode([
        'id'=> $postId,
        'deleted'=> 'true'
    ]);
}

/**
 * Get Post based on ID
 *
 * @param $db
 * @param $id
 *
 * @return Associative Array
 */
function getPost($db, $id) {
    $statement = $db->prepare("SELECT * FROM posts where id=:id");
    $statement->bindValue(':id', $id);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

/**
 * Delete Post record based on ID
 *
 * @param $db
 * @param $id
 */
function deletePost($db, $id) {
    $statement = $db->prepare("DELETE FROM posts where id=':id'");
    $statement->bindValue(':id', $id);
    $statement->execute();
}

/**
 * Get all posts
 *
 * @param $db
 * @return mixed
 */
function getAllPosts($db) {
    $statement = $db->prepare("SELECT * FROM posts");
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    return $statement->fetchAll();
}

/**
 * Add post
 *
 * @param $input
 * @param $db
 * @return integer
 */
function addPost($input, $db){

    $sql = "INSERT INTO posts 
          (title, status, content, user_id) 
          VALUES 
          (:title, :status, :content, :user_id)";

    $statement = $db->prepare($sql);

    bindAllValues($statement, $input);

    $statement->execute();

    return $db->lastInsertId();
}

/**
 * @param $statement
 * @param $params
 * @return PDOStatement
 */
function bindAllValues($statement, $params){
    $allowedFields = ['title', 'status', 'content', 'user_id'];

    foreach($params as $param => $value){
        if(in_array($param, $allowedFields)){
            $statement->bindValue(':'.$param, $value);
        }
    }

    return $statement;
}

/**
 * Get fields as parameters to set in record
 *
 * @param $input
 * @return string
 */
function getParams($input) {
    $allowedFields = ['title', 'status', 'content', 'user_id'];

    $filterParams = [];
    foreach($input as $param => $value){
        if(in_array($param, $allowedFields)){
            $filterParams[] = "$param=:$param";
        }
    }

    return implode(", ", $filterParams);
}


/**
 * Update Post
 *
 * @param $input
 * @param $db
 * @param $postId
 * @return integer
 */
function updatePost($input, $db, $postId){

    $fields = getParams($input);

    $sql = "
          UPDATE posts 
          SET $fields 
          WHERE id='$postId'
           ";

    $statement = $db->prepare($sql);

    bindAllValues($statement, $input);

    $statement->execute();

    return $postId;

}
