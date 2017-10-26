<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

////////////////////////////// Insert Currency  ////////////////////////////////

$app->post('/api/currency/add', function (Request $request, Response $response) {
    $title = $request->getParam('title');
    $code = $request->getParam('code');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO reqs (title,code,type,created,modified) VALUES (:title,:code,'Currency','" . $date . "','" . $date . "')";
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

///////////////////////////// Get Single Currency Data /////////////////////////

$app->get('/api/currency/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM reqs WHERE id =" . $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $currency = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($currency);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

/////////////////////////////  Update Currency  ////////////////////////////////

$app->put('/api/currency/update/{id}', function (Request $request, Response $response) {
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

///////////////////////////////  Delete Currency ///////////////////////////////

$app->delete('/api/currency/delete/{id}', function (Request $request, Response $response) {
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

//////////////////////////////  Get All Currency ///////////////////////////////

$app->get('/api/currencies', function (Request $request, Response $response) {
    $sql = "SELECT * FROM reqs WHERE type='Currency'";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $currencies = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($currencies);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

