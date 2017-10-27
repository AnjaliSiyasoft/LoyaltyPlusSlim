<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

////////////////////////////// Insert Year //////////////////////////////////

$app->post('/api/year/add', function (Request $request, Response $response) {
    $year = $request->getParam('year');
    $startdate = $request->getParam('sdate');
    $enddate = $request->getParam('edate');
    $sdate = getDMYDate($startdate);
    $edate = getDMYDate($enddate);
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
        $msg = 1;
        echo json_encode($msg);
    } catch (PDOException $e) {
        $error = $db->errorInfo();
        CatchError(mysql_real_escape_string($error[2]), __LINE__, basename($_SERVER['PHP_SELF']));
        echo '{"error":{"text": ' . $error[2] . '}';
    }
});

///////////////////////////// Get Single Year Data /////////////////////////////

$app->get('/api/year/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT id,year,date_format(sdate,'%d-%m-%Y') AS sdate,date_format(edate,'%d-%m-%Y') AS edate FROM dates WHERE id = " . id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $year = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($year);
    } catch (PDOException $e) {
        $error = $db->errorInfo();
        CatchError(mysql_real_escape_string($error[2]), __LINE__, basename($_SERVER['PHP_SELF']));
        echo '{"error":{"text": ' . $error[2] . '}';
    }
});

///////////////////////////////   Update Year  /////////////////////////////////

$app->put('/api/year/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $startdate = $request->getParam('sdate');
    $enddate = $request->getParam('edate');
    $sdate = getDMYDate($startdate);
    $edate = getDMYDate($enddate);
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
        $msg = 1;
        echo json_encode($msg);
    } catch (PDOException $e) {
        $error = $db->errorInfo();
        CatchError(mysql_real_escape_string($error[2]), __LINE__, basename($_SERVER['PHP_SELF']));
        echo '{"error":{"text": ' . $error[2] . '}';
    }
});

////////////////////////////////  Delete Year //////////////////////////////////

$app->delete('/api/year/delete/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM dates WHERE id =" . $id;
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        $msg = 1;
        echo json_encode($msg);
    } catch (PDOException $e) {
        $error = $db->errorInfo();
        CatchError(mysql_real_escape_string($error[2]), __LINE__, basename($_SERVER['PHP_SELF']));
        echo '{"error":{"text": ' . $error[2] . '}';
    }
});

/////////////////////////////////  Get All Year ////////////////////////////////

$app->get('/api/year', function (Request $request, Response $response) {
    $sql = "SELECT id,year,date_format(sdate,'%d-%m-%Y') AS sdate,date_format(edate,'%d-%m-%Y') AS edate FROM dates WHERE type='Year'";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $years = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($years);
    } catch (PDOException $e) {
        $error = $db->errorInfo();
        CatchError(mysql_real_escape_string($error[2]), __LINE__, basename($_SERVER['PHP_SELF']));
        echo '{"error":{"text": ' . $error[2] . '}';
    }
});
