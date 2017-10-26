<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//////////////////////////////  Insert Country  ///////////////////////////////////

$app->post('/api/country/add', function (Request $request, Response $response) {
    $title = $request->getParam('title');
    $flag = $request->getParam('flag');
    $r_id = $request->getParam('r_id');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO places (type,title,flag,r_id,created,modified) VALUES ('Country',:title,:flag,:r_id,'" . $date . "','" . $date . "') ";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':flag', $flag);
        $stmt->bindParam(':r_id', $r_id);
        $stmt->execute();
        $db = null;
        $msg=1;
        echo json_encode($msg);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

///////////////////////  Get Single Country Data  //////////////////////////////

$app->get('/api/country/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT pls.id,pls.title,pls1.title AS regionTitle,pls.r_id FROM places as pls
           LEFT JOIN  places as pls1 ON pls.r_id=pls1.id
           WHERE pls.id=" . $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $country = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($country);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

/////////////////////////////  Upadte Country   //////////////////////////////// 

$app->put('/api/country/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $title = $request->getParam('title');
    $flag = $request->getParam('flag');
    $r_id = $request->getParam('r_id');
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE places SET title=:title,flag=:flag,r_id=:r_id,modified='" . $date . "' WHERE id=" . $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':flag', $flag);
        $stmt->bindParam(':r_id', $r_id);
        $stmt->execute();
        $db = null;
        $msg=1;
        echo json_encode($msg);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

/////////////////////////////  Delete Country  /////////////////////////////////

$app->delete('/api/country/delete/{id}', function (Request $request, Response $response) {
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

///////////////////////////////  Get All Country ///////////////////////////////

$app->get('/api/countries', function (Request $request, Response $response) {
    $sql = "SELECT pls.id,pls.title,pls1.title AS regionTitle,pls.r_id FROM places as pls
           LEFT JOIN  places as pls1 ON pls.r_id=pls1.id
           WHERE pls.type='Country'";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $countries = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($countries);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

///////////////////////////////  Get Country Combo Data ////////////////////////

$app->get('/api/countrycombo', function (Request $request, Response $response) {
    $sql = "SELECT id,title FROM places WHERE type='Country'";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $countries = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($countries);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});
