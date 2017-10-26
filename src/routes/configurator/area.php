<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

///////////////////////////////  Insert Area  //////////////////////////////////  

$app->post('/api/area/add', function (Request $request, Response $response) {
    $title = $request->getParam('title');
    $r_id = $request->getParam('r_id');
    $stitle = $request->getParam('stitle');
    $pcode = $request->getParam('pcode');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO places (type,title,r_id,stitle,pcode,created,modified) VALUES ('Area',:title,:r_id,:stitle,:pcode,'" . $date . "','" . $date . "')";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':r_id', $r_id);
        $stmt->bindParam(':stitle', $stitle);
        $stmt->bindParam(':pcode', $pcode);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Inserted SuccessFully"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//////////////////////////// Get Single Area Data  /////////////////////////////

$app->get('/api/area/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT pls.id,pls.title,pls1.title,pls.r_id,pls.stitle,pls.pcode FROM  places as pls
            LEFT JOIN places as pls1 ON pls.r_id=pls1.id
            WHERE pls.id=" . $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $area = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($area);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//////////////////////////////   Update Area   /////////////////////////////////

$app->put('/api/area/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $title = $request->getParam('title');
    $r_id = $request->getParam('r_id');
    $stitle = $request->getParam('stitle');
    $pcode = $request->getParam('pcode');
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE places SET title=:title,r_id=:r_id,stitle=:stitle,pcode=:pcode,modified='" . $date . "' WHERE id=" . $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':r_id', $r_id);
        $stmt->bindParam(':stitle', $stitle);
        $stmt->bindParam(':pcode', $pcode);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Updated SuccessFully"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

/////////////////////////////////  Delete Area /////////////////////////////////

$app->delete('/api/area/delete/{id}', function (Request $request, Response $response) {
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

///////////////////////////////  Get All Area  /////////////////////////////////

$app->get('/api/areas', function (Request $request, Response $response) {
    $sql = "SELECT pls.id,pls.title,pls1.title,pls.r_id,pls.stitle,pls.pcode FROM  places as pls
            LEFT JOIN places as pls1 ON pls.r_id=pls1.id
            WHERE pls.type='Area'";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $areas = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($areas);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});
