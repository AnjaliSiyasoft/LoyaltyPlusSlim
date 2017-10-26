<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

////////////////////////////// Insert Year //////////////////////////////////

$app->post('/api/year/add', function (Request $request, Response $response) {
    $year = $request->getParam('year');
    $sdate = $request->getParam('sdate');
    $edate = $request->getParam('edate');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO dates (type,year,sdate,edate,created,modified) VALUES ('Year',:year,:sdate,:edate,'" . $date . "','" . $date . "')";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':sdate', $sdate);
        $stmt->bindParam(':edate', $edate);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Inserted SuccessFully"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

///////////////////////////// Get Single Year Data /////////////////////////////

$app->get('/api/year/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM dates WHERE id = " . id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $year = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($year);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

///////////////////////////////   Update Year  /////////////////////////////////

$app->put('/api/year/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $year = $request->getParam('year');
    $sdate = $request->getParam('sdate');
    $edate = $request->getParam('edate');
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE dates SET year=:year,sdate=:sdate,edate=:edate,modified='" . $date . "' WHERE id=" . $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':sdate', $sdate);
        $stmt->bindParam(':edate', $edate);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Updated SuccessFully"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

////////////////////////////////  Delete Year //////////////////////////////////

$app->delete('/api/year/delete/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM dates WHERE id =". $id;
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

/////////////////////////////////  Get All Year ////////////////////////////////

$app->get('/api/year', function (Request $request, Response $response) {
    $sql = "SELECT * FROM dates WHERE type='Year'";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $years = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($years);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});
