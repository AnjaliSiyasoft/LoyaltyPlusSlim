<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

////////////////////////////   Insert Region   /////////////////////////////////

$app->post('/api/region/add', function (Request $request, Response $response) {
    $title = $request->getParam('title');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO places (type,title,created,modified) VALUES ('Region',:title,'" . $date . "','" . $date . "') ";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->execute();
        $db = null;
        $msg=1;
        echo json_encode($msg);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

////////////////////////////   Get Single Region Data   ////////////////////////

$app->get('/api/region/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM places WHERE id =" . $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $region = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($region);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

/////////////////////////////  Update Region  ////////////////////////////////// 

$app->put('/api/region/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $title = $request->getParam('title');
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE places SET title=:title,modified='" . $date . "' WHERE id=" . $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->execute();
        $db = null;
        $msg=1;
        echo json_encode($msg);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

////////////////////////////////  Delete Region  ///////////////////////////////

$app->delete('/api/region/delete/{id}', function (Request $request, Response $response) {
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

/////////////////////////////  Get All Region  /////////////////////////////////

$app->get('/api/regions', function (Request $request, Response $response) {
    $sql = "SELECT * FROM places where type='Region'";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $regions = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($regions);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});
