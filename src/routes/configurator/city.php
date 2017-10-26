<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

///////////////////////////////  Insert City  //////////////////////////////////

$app->post('/api/city/add', function (Request $request, Response $response) {
    $title = $request->getParam('title');
    $r_id = $request->getParam('r_id');
    $stitle = $request->getParam('stitle');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO places (type,title,r_id,stitle,created,modified) VALUES ('City',:title,:r_id,:stitle,'" . $date . "','" . $date . "')";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':r_id', $r_id);
        $stmt->bindParam(':stitle', $stitle);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Inserted SuccessFully"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});


///////////////////////////////  Get Single City Data //////////////////////////

$app->get('/api/city/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT pls.id,pls.title,pls1.title AS stateTitle,pls.r_id,pls.stitle FROM  places as pls
            LEFT JOIN places as pls1 ON pls.r_id=pls1.id
            WHERE pls.id=" . $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $city = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($city);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//////////////////////////////     Update City  ////////////////////////////////

$app->put('/api/city/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $title = $request->getParam('title');
    $r_id = $request->getParam('r_id');
    $stitle = $request->getParam('stitle');
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE places SET title=:title,r_id=:r_id,stitle=:stitle,modified='" . $date . "' WHERE id=" . $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':r_id', $r_id);
        $stmt->bindParam(':stitle', $stitle);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Updated SuccessFully"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

////////////////////////////////   Delete City  ////////////////////////////////

$app->delete('/api/city/delete/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM places WHERE id =" . $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Deleted SuccessFully"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

////////////////////////////////  Get All City  ////////////////////////////////

$app->get('/api/cities', function (Request $request, Response $response) {
    $sql = "SELECT pls.id,pls.title,pls1.title AS stateTitle ,pls.r_id,pls.stitle FROM  places as pls
            LEFT JOIN places as pls1 ON pls.r_id=pls1.id
            WHERE pls.type='City'";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $cities = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($cities);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

