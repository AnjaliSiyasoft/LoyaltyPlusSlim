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
    $sql = "SELECT * from places where type='Region'";
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
    $sql = "SELECT 
    t1.id,t1.title,t2.title,t1.r_id
    FROM 
    places as t1
    left JOIN 
    places as t2
    ON
    t1.r_id=t2.id
    where t1.type='Country'";
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

$app->get('/api/cities', function (Request $request, Response $response) {
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

///////////////////////////////////////////////TimeZone//////////////////////////////////////////////////

//Add TimeZone

$app->post('/api/timezone/add', function (Request $request, Response $response) {
    $title = $request->getParam('title');
    $value = $request->getParam('value');
    $code = $request->getParam('code');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO reqs (title,value,code,type,created,modified) VALUES (:title,:value,:code,'Time Zone','$date','$date')";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "TimeZone Added"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Get Single TimeZone Data

$app->get('/api/timezone/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT * from reqs WHERE id =$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $timezone = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($timezone);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Update TimeZone

$app->put('/api/timezone/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $title = $request->getParam('title');
    $value = $request->getParam('value');
    $code = $request->getParam('code');
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE reqs SET title=:title,value=:value,code=:code,modified='$date' WHERE id=$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Timezone Updated"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Delete TimeZone

$app->delete('/api/timezone/delete/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "DELETE from reqs WHERE id =$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "TimeZone Deleted"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Get All TimeZone

$app->get('/api/timezones', function (Request $request, Response $response) {
    $sql = "SELECT * from reqs";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $timezones = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($timezones);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});
///////////////////////////////////////////////TimeZone Exit///////////////////////////////////////////////

///////////////////////////////////////////////Currency//////////////////////////////////////////////////

//Add Currency

$app->post('/api/currency/add', function (Request $request, Response $response) {
    $title = $request->getParam('title');
    $code = $request->getParam('code');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO reqs (title,code,type,created,modified) VALUES (:title,:code,'Currency','$date','$date')";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Currency Added"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Get Single Currency Data

$app->get('/api/currency/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT * from reqs WHERE id =$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $currency = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($currency);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Update Currency

$app->put('/api/currency/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $title = $request->getParam('title');
    $code = $request->getParam('code');
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE reqs SET title=:title,code=:code,modified='$date' WHERE id=$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Currency Updated"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Delete Currency

$app->delete('/api/currency/delete/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "DELETE from reqs WHERE id =$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Currency Deleted"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Get All Currency

$app->get('/api/currencies', function (Request $request, Response $response) {
    $sql = "SELECT * from reqs";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $currencies = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($currencies);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});
///////////////////////////////////////////////Currency Exit///////////////////////////////////////////////

///////////////////////////////////////////////Language//////////////////////////////////////////////////

//Add Language

$app->post('/api/language/add', function (Request $request, Response $response) {
    $title = $request->getParam('title');
    $code = $request->getParam('code');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO reqs (title,code,type,created,modified) VALUES (:title,:code,'Language','$date','$date')";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Language Added"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Get Single Language Data

$app->get('/api/language/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT * from reqs WHERE id =$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $language = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($language);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Update Language

$app->put('/api/language/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $title = $request->getParam('title');
    $code = $request->getParam('code');
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE reqs SET title=:title,code=:code,modified='$date' WHERE id=$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Language Updated"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Delete Language

$app->delete('/api/language/delete/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "DELETE from reqs WHERE id =$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Language Deleted"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Get All Language

$app->get('/api/languages', function (Request $request, Response $response) {
    $sql = "SELECT * from reqs";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $languages = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($languages);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});
///////////////////////////////////////////////Language Exit///////////////////////////////////////////////

///////////////////////////////////////////////Benifit//////////////////////////////////////////////////

//Add Benefit

$app->post('/api/benefit/add', function (Request $request, Response $response) {
    $title = $request->getParam('title');
    $icon = $request->getParam('icon'); 
    $type=$request->getParam('type');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO benefits (title,icon,type,created,modified) VALUES (:title,:icon,:type,'$date','$date')";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':icon', $icon);
        $stmt->bindParam(':type', $type);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Benefit Added"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Get Single Benefit Data

$app->get('/api/benefit/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT * from benefits WHERE id =$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $benefit = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($benefit);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Update Benefit

$app->put('/api/benefit/update/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $title = $request->getParam('title');
    $icon = $request->getParam('icon');
    $type = $request->getParam('type');
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE benefits SET title=:title,icon=:icon,type=:type,modified='$date' WHERE id=$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':icon', $icon);
        $stmt->bindParam(':type', $type);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Benefit Updated"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Delete Benefit

$app->delete('/api/benefit/delete/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "DELETE from benefits WHERE id =$id";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice":{"text": "Benefit Deleted"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});

//Get All Benefit

$app->get('/api/benefits', function (Request $request, Response $response) {
    $sql = "SELECT * from benefits";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $benefits = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($benefits);
    } catch (PDOException $e) {
        echo '{"error":{"text": ' . $e->getMessage() . '}';
    }
});
///////////////////////////////////////////////Benifit Exit///////////////////////////////////////////////
