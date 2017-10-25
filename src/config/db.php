<?php
class db{

// properties

private $dbhost ='192.168.0.102';
private $dbuser ='netroot';
private $dbpass ='netroot';
private $dbname ='ncrm';

//connect

public function connect()
{
$mysql_connect_str="mysql:host=$this->dbhost;dbname=$this->dbname";
$dbConnection = new PDO($mysql_connect_str,$this->dbuser,$this->dbpass);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
return $dbConnection;
}
}