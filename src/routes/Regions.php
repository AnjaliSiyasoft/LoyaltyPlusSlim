<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Add Region

$app->post('/api/region/add', function (Request $request, Response $response) {
    $title = $request->getParam('title');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO places (type,title,created,modified) VALUES ('Region',:title,'$date','$date') ";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Regions Added"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Get Single Region Data

$app->get('/api/region/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT * from places WHERE id =$id";
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

//Update Region 

$app->put('/api/region/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $title = $request->getParam('title');
    $sql = "UPDATE places SET title=:title WHERE id=$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Region Updated"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Delete Region

$app->delete('/api/region/delete/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "DELETE from places WHERE id =$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Region Deleted"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Get All Region

$app->get('/api/regions', function (Request $request, Response $response) {
    $sql = "SELECT * from places";
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


//Add Country

$app->post('/api/country/add', function (Request $request, Response $response) {
    $title = $request->getParam('title');
    $flag = $request->getParam('flag');
    $r_id = $request->getParam('r_id');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO places (type,title,flag,r_id,created,modified) VALUES ('Country',:title,:flag,:r_id,'$date','$date') ";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':flag', $flag);
        $stmt->bindParam(':r_id', $r_id);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Country Added"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});


//Add State

$app->post('/api/state/add', function (Request $request, Response $response) {
    $title = $request->getParam('title');
    $r_id = $request->getParam('r_id');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO places (type,title,r_id,created,modified) VALUES ('State',:title,:r_id,'$date','$date')";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':r_id', $r_id);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "State Added"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Add City

$app->post('/api/city/add', function (Request $request, Response $response) {
    $title = $request->getParam('title');
    $r_id = $request->getParam('r_id');
    $stitle = $request->getParam('stitle');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO places (type,title,r_id,stitle,created,modified) VALUES ('City',:title,:r_id,:stitle,'$date','$date')";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':r_id', $r_id);
        $stmt->bindParam(':stitle', $stitle);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "City Added"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Add Area

$app->post('/api/area/add', function (Request $request, Response $response) {
    $title = $request->getParam('title');
    $r_id = $request->getParam('r_id');
    $stitle = $request->getParam('stitle');
    $pcode = $request->getParam('pcode');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO places (type,title,r_id,stitle,pcode,created,modified) VALUES ('Area',:title,:r_id,:stitle,:pcode,'$date','$date')";
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
        echo '{"notice":{"text": "Area Added"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

