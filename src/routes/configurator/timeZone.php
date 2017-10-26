<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/////////////////////////////// Insert TimeZone ////////////////////////////////

$app->post('/api/timezone/add', function (Request $request, Response $response) {
    $title = $request->getParam('title');
    $value = $request->getParam('value');
    $code = $request->getParam('code');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO reqs (title,value,code,type,created,modified) VALUES (:title,:value,:code,'Time Zone','" . $date . "','" . $date . "')";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        $db = null;
        $msg=1;
        echo json_encode($msg);
    } catch (PDOException $e) {
        $error= $db->errorInfo();
        CatchError(mysql_real_escape_string($error[2]),__LINE__,basename($_SERVER['PHP_SELF']));
        echo '{"error":{"text": ' . $error[2] . '}';    }
});

////////////////////////////  Get Single TimeZone Data /////////////////////////

$app->get('/api/timezone/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT id,title,value,code FROM reqs WHERE id =" . $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $timezone = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($timezone);
    } catch (PDOException $e) {
        $error= $db->errorInfo();
        CatchError(mysql_real_escape_string($error[2]),__LINE__,basename($_SERVER['PHP_SELF']));
        echo '{"error":{"text": ' . $error[2] . '}';
    }
});

//////////////////////////////  Update TimeZone  ///////////////////////////////

$app->put('/api/timezone/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $title = $request->getParam('title');
    $value = $request->getParam('value');
    $code = $request->getParam('code');
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE reqs SET title=:title,value=:value,code=:code,modified='" . $date . "' WHERE id=" . $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':code', $code);
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

///////////////////////////////  Delete TimeZone  //////////////////////////////

$app->delete('/api/timezone/delete/{id}', function (Request $request, Response $response) {
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
        $error= $db->errorInfo();
        CatchError(mysql_real_escape_string($error[2]),__LINE__,basename($_SERVER['PHP_SELF']));
        echo '{"error":{"text": ' . $error[2] . '}';
    }
});

/////////////////////////////  Get All TimeZone  ///////////////////////////////

$app->get('/api/timezones', function (Request $request, Response $response) {
    $sql = "SELECT id,title,value,code FROM reqs WHERE type='Time Zone'";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $timezones = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($timezones);
    } catch (PDOException $e) {
        $error= $db->errorInfo();
        CatchError(mysql_real_escape_string($error[2]),__LINE__,basename($_SERVER['PHP_SELF']));
        echo '{"error":{"text": ' . $error[2] . '}';
    }
});


