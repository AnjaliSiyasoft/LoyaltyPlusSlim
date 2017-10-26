<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

////////////////////////////// Insert Language /////////////////////////////////

$app->post('/api/language/add', function (Request $request, Response $response) {
    $title = $request->getParam('title');
    $code = $request->getParam('code');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO reqs (title,code,type,created,modified) VALUES (:title,:code,'Language','" . $date . "','" . $date . "')";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        $db = null;
        $msg=1;
        echo json_encode($msg);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

////////////////////////////  Get Single Language Data /////////////////////////

$app->get('/api/language/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM reqs WHERE id =" . $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $language = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($language);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

///////////////////////////////  Update Language ///////////////////////////////

$app->put('/api/language/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $title = $request->getParam('title');
    $code = $request->getParam('code');
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE reqs SET title=:title,code=:code,modified='" . $date . "' WHERE id=" . $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        $db = null;
        $msg=1;
        echo json_encode($msg);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

///////////////////////////////// Delete Language //////////////////////////////

$app->delete('/api/language/delete/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM reqs WHERE id =" . $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        $msg=1;
        echo json_encode($msg);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

////////////////////////////   Get All Language  ///////////////////////////////

$app->get('/api/languages', function (Request $request, Response $response) {
    $sql = "SELECT * FROM reqs WHERE type='Language'";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $languages = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($languages);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});
