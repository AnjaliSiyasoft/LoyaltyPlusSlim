<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

////////////////////////////// Insert Benefit //////////////////////////////////

$app->post('/api/benefit/add', function (Request $request, Response $response) {
    $title = $request->getParam('title');
    $icon = $request->getParam('icon');
    $type = $request->getParam('type');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO benefits (title,icon,type,created,modified) VALUES (:title,:icon,:type,'" . $date . "','" . $date . "')";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':icon', $icon);
        $stmt->bindParam(':type', $type);
        $stmt->execute();
        $db = null;
        $msg=1;
        echo json_encode($msg);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

///////////////////////////// Get Single Benefit Data //////////////////////////

$app->get('/api/benefit/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM benefits WHERE id = " . id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $benefit = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($benefit);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

///////////////////////////////   Update Benefit ///////////////////////////////

$app->put('/api/benefit/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $title = $request->getParam('title');
    $icon = $request->getParam('icon');
    $type = $request->getParam('type');
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE benefits SET title=:title,icon=:icon,type=:type,modified='" . $date . "' WHERE id=" . $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':icon', $icon);
        $stmt->bindParam(':type', $type);
        $stmt->execute();
        $db = null;
        $msg=1;
        echo json_encode($msg);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

////////////////////////////////  Delete Benefit ///////////////////////////////

$app->delete('/api/benefit/delete/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM benefits WHERE id =" . $id;
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

////////////////////////////////  Get All Benefit //////////////////////////////

$app->get('/api/benefits', function (Request $request, Response $response) {
    $sql = "SELECT * FROM benefits";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $benefits = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($benefits);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});
