<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Add Regions

$app->post('/api/regions/add', function (Request $request, Response $response) {
$title = $request->getParam('title');
$date=date('Y-m-d H:i:s');
$sql="INSERT INTO places (type,title,created,modified) VALUES ('Region',:title,'$date','$date') ";
try
{
$db = new db();
$db =$db->connect();
$stmt=$db->prepare($sql);
$stmt->bindParam(':title',$title);
$stmt->execute();
$db = null;
echo '{"notice":{"text": "Regions Added"}';
}
catch(PDOException $e)
{
echo '{"error":{"text": '.$e->getMessage().'}';
}
});

//Add Countrys

$app->post('/api/country/add', function (Request $request, Response $response) {
$title = $request->getParam('title');
$flag=$request->getParam('flag');
$r_id=$request->getParam('r_id');
$date=date('Y-m-d H:i:s');
$sql="INSERT INTO places (type,title,flag,r_id,created,modified) VALUES ('Country',:title,:flag,:r_id,'$date','$date') ";
try
{
$db = new db();
$db =$db->connect();
$stmt=$db->prepare($sql);
$stmt->bindParam(':title',$title);
$stmt->bindParam(':flag',$flag);
$stmt->bindParam(':r_id',$r_id);
$stmt->execute();
$db = null;
echo '{"notice":{"text": "Country Added"}';
}
catch(PDOException $e)
{
echo '{"error":{"text": '.$e->getMessage().'}';
}
});


//Add State

$app->get('/api/state/add', function (Request $request, Response $response) {
$title = $request->getParam('title');
$r_id=$request->getParam('r_id');
$date=date('Y-m-d H:i:s');
$sql="INSERT INTO places (type,title,r_id,created,modified) VALUES ('State',:title,:r_id,'$date','$date')";
try
{
$db = new db();
$db =$db->connect();
$stmt=$db->prepare($sql);
$stmt->bindParam(':title',$title);
$stmt->bindParam(':r_id',$r_id);
$stmt->execute();
$db = null;
echo '{"notice":{"text": "State Added"}';
}
catch(PDOException $e)
{
echo '{"error":{"text": '.$e->getMessage().'}';
}
});

//Add City

$app->get('/api/city/add', function (Request $request, Response $response) {
$title = $request->getParam('title');
$r_id=$request->getParam('r_id');
$stitle = $request->getParam('stitle');
$date=date('Y-m-d H:i:s');
$sql="INSERT INTO places (type,title,r_id,stitle,created,modified) VALUES ('City',:title,:r_id,:stitle,'$date','$date')";
try
{
$db = new db();
$db =$db->connect();
$stmt=$db->prepare($sql);
$stmt->bindParam(':title',$title);
$stmt->bindParam(':r_id',$r_id);
$stmt->bindParam(':stitle',$stitle);
$stmt->execute();
$db = null;
echo '{"notice":{"text": "State Added"}';
}
catch(PDOException $e)
{
echo '{"error":{"text": '.$e->getMessage().'}';
}
});




