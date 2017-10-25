<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//$app->options('/{routes:.+}', function ($request, $response, $args) {
//    return $response;
//});

/////////////////////////////////////////////Region////////////////////////////////////////////

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
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE places SET title=:title,modified='$date' WHERE id=$id";
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

///////////////////////////////////////////////Region Exit/////////////////////////////////////////////

///////////////////////////////////////////////Country////////////////////////////////////////////////

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

//Get Single Country Data

$app->get('/api/country/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT * from places WHERE id =$id";
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

//Update Country 

$app->put('/api/country/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $title = $request->getParam('title');
    $flag = $request->getParam('flag');
    $r_id = $request->getParam('r_id');
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE places SET title=:title,flag=:flag,r_id=:r_id,modified='$date' WHERE id=$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':flag', $flag);
        $stmt->bindParam(':r_id', $r_id);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Country Updated"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Delete Country

$app->delete('/api/country/delete/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "DELETE from places WHERE id =$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Country Deleted"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Get All Country

$app->get('/api/countries', function (Request $request, Response $response) {
    $sql = "SELECT * from places";
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

///////////////////////////////////////////////Country Exit/////////////////////////////////////////////

///////////////////////////////////////////////State///////////////////////////////////////////////////

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

//Get Single State Data

$app->get('/api/state/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT * from places WHERE id =$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $state = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($state);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Update State 

$app->put('/api/state/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $title = $request->getParam('title');
    $r_id = $request->getParam('r_id');
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE places SET title=:title,r_id=:r_id,modified='$date' WHERE id=$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':r_id', $r_id);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "State Updated"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Delete State

$app->delete('/api/state/delete/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "DELETE from places WHERE id =$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "State Deleted"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Get All State

$app->get('/api/states', function (Request $request, Response $response) {
    $sql = "SELECT * from places";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $states = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($states);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

///////////////////////////////////////////////State Exit/////////////////////////////////////////////

///////////////////////////////////////////////City//////////////////////////////////////////////////

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


//Get Single City Data

$app->get('/api/city/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT * from places WHERE id =$id";
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

//Update City

$app->put('/api/city/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $title = $request->getParam('title');
    $r_id = $request->getParam('r_id');
    $stitle = $request->getParam('stitle');
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE places SET title=:title,r_id=:r_id,stitle=:stitle,modified='$date' WHERE id=$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':r_id', $r_id);
        $stmt->bindParam(':stitle', $stitle);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "City Updated"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Delete City

$app->delete('/api/city/delete/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "DELETE from places WHERE id =$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "City Deleted"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Get All City

$app->get('/api/city', function (Request $request, Response $response) {
    $sql = "SELECT * from places";
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


///////////////////////////////////////////////City Exit/////////////////////////////////////////////

///////////////////////////////////////////////Area//////////////////////////////////////////////////

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

//Get Single Area Data

$app->get('/api/area/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT * from places WHERE id =$id";
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

//Update Area

$app->put('/api/area/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $title = $request->getParam('title');
    $r_id = $request->getParam('r_id');
    $stitle = $request->getParam('stitle');
    $pcode = $request->getParam('pcode');
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE places SET title=:title,r_id=:r_id,stitle=:stitle,pcode=:pcode,modified='$date' WHERE id=$id";
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
        echo '{"notice":{"text": "Area Updated"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Delete Area

$app->delete('/api/area/delete/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "DELETE from places WHERE id =$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Area Deleted"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Get All Area

$app->get('/api/areas', function (Request $request, Response $response) {
    $sql = "SELECT * from places";
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
///////////////////////////////////////////////Area Exit///////////////////////////////////////////////
