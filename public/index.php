<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/db.php';

$app = new \Slim\App;

require '../src/routes/configurator/region.php';
require '../src/routes/configurator/country.php';
require '../src/routes/configurator/state.php';
require '../src/routes/configurator/city.php';
require '../src/routes/configurator/area.php';
require '../src/routes/configurator/timeZone.php';
require '../src/routes/configurator/currency.php';
require '../src/routes/configurator/benefit.php';

$app->run();
