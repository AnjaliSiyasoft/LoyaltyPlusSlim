<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Add Regions

$app->get('/api/regions/add', function (Request $request, Response $response) {
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
echo '{"notice":{"text": "Regions Added"}';
}
catch(PDOException $e)
{
echo '{"error":{"text": '.$e->getMessage().'}';
}
});

//Add Countrys

$app->get('/api/gfg/add', function (Request $request, Response $response) {
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
echo '{"notice":{"text": "Regions Added"}';
}
catch(PDOException $e)
{
echo '{"error":{"text": '.$e->getMessage().'}';
}
});




