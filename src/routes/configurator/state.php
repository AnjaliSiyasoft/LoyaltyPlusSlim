<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

////////////////////////////////  Insert State  ////////////////////////////////

$app->post('/api/state/add', function (Request $request, Response $response) {
    $title = $request->getParam('title');
    $r_id = $request->getParam('r_id');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO places (type,title,r_id,created,modified) VALUES ('State',:title,:r_id,'" . $date . "','" . $date . "')";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':r_id', $r_id);
        $stmt->execute();
        $db = null;
        $msg=1;
        echo json_encode($msg);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

/////////////////////////////  Get Single State Data ///////////////////////////

$app->get('/api/state/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT pls.id,pls.title,pls1.title AS countryTitle,pls.r_id FROM  places as pls
            LEFT JOIN places as pls1 ON pls.r_id=pls1.id
            WHERE pls.id=". $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $state = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($state);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

/////////////////////////////// Update State  ////////////////////////////////// 

$app->put('/api/state/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $title = $request->getParam('title');
    $r_id = $request->getParam('r_id');
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE places SET title=:title,r_id=:r_id,modified='" . $date . "' WHERE id=" . $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':r_id', $r_id);
        $stmt->execute();
        $db = null;
        $msg=1;
        echo json_encode($msg);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

///////////////////////////////  Delete State  /////////////////////////////////

$app->delete('/api/state/delete/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM places WHERE id =" . $id;
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

///////////////////////////////  Get All State  ////////////////////////////////

$app->get('/api/states', function (Request $request, Response $response) {
    $sql = "SELECT pls.id,pls.title,pls1.title AS countryTitle,pls.r_id, FROM  places as pls
            LEFT JOIN places as pls1 ON pls.r_id=pls1.id
            WHERE pls.type='State'";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $states = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($states);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

///////////////////////////////  Get State Combo Data //////////////////////////

$app->get('/api/statecombo', function (Request $request, Response $response) {
    $sql = "SELECT id,title FROM places WHERE type='State'";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $states = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($states);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

