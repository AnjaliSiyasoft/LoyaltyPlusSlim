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
        $msg=1;
        echo json_encode($msg);
    } catch (PDOException $e) {
        $error= $db->errorInfo();
        CatchError(mysql_real_escape_string($error[2]),__LINE__,basename($_SERVER['PHP_SELF']));
        echo '{"error":{"text": ' . $error[2] . '}';
    }
});


///////////////////////////////  Get Single City Data //////////////////////////

$app->get('/api/city/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT pls.id,pls.title,pls1.title AS stateTitle,pls.r_id,pls.stitle FROM  places AS pls
            LEFT JOIN places AS pls1 ON pls.r_id=pls1.id
            WHERE pls.id=" . $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $city = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($city);
    } catch (PDOException $e) {
        $error= $db->errorInfo();
        CatchError(mysql_real_escape_string($error[2]),__LINE__,basename($_SERVER['PHP_SELF']));
        echo '{"error":{"text": ' . $error[2] . '}';
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
        $msg=1;
        echo json_encode($msg);
    } catch (PDOException $e) {
        $error= $db->errorInfo();
        CatchError(mysql_real_escape_string($error[2]),__LINE__,basename($_SERVER['PHP_SELF']));
        echo '{"error":{"text": ' . $error[2] . '}';
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
        $msg=1;
        echo json_encode($msg);
    } catch (PDOException $e) {
        $error= $db->errorInfo();
        CatchError(mysql_real_escape_string($error[2]),__LINE__,basename($_SERVER['PHP_SELF']));
        echo '{"error":{"text": ' . $error[2] . '}';
    }
});

////////////////////////////////  Get All City  ////////////////////////////////

$app->get('/api/cities', function (Request $request, Response $response) {
    $sql = "SELECT pls.id,pls.title,pls1.title AS stateTitle,pls2.title AS countryTitle,pls3.title AS regionTitle,pls.r_id FROM  places AS pls
            LEFT JOIN places AS pls1 ON pls.r_id=pls1.id
            LEFT JOIN places AS pls2 ON pls1.r_id=pls2.id
            LEFT JOIN places AS pls3 ON pls2.r_id=pls3.id
            WHERE pls.type='City'";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $cities = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($cities);
    } catch (PDOException $e) {
        $error= $db->errorInfo();
        CatchError(mysql_real_escape_string($error[2]),__LINE__,basename($_SERVER['PHP_SELF']));
        echo '{"error":{"text": ' . $error[2] . '}';
    }
});

///////////////////////////////  Get City Combo Data ///////////////////////////

$app->get('/api/citycombo', function (Request $request, Response $response) {
    $sql = "SELECT id,title FROM places WHERE type='City'";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $cities = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($cities);
    } catch (PDOException $e) {
        $error= $db->errorInfo();
        CatchError(mysql_real_escape_string($error[2]),__LINE__,basename($_SERVER['PHP_SELF']));
        echo '{"error":{"text": ' . $error[2] . '}';
    }
});
