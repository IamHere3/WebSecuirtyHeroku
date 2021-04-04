<?php
include ('database/databaseconnection.php')?
require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

//database stuff
$host = "ec2-3-211-37-117.compute-1.amazonaws.com";
$user = "xdirfqqbivnlvo";
$password = "d2a96e5fc52efc75c15678f4e581aa9783481cf9af49083248ca25834b559a1a";
$dbname = "d81l6hfqatknea";
$port = "5432";


try{
	$myPDO = new PDO('pgsql:host=localhost;dbname=d81l6hfqatknea', 'postgres', 'secret');


  //create a pdo instance
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) 
{
echo 'Connection failed: ' . $e->getMessage();
}

try 
{
	$result = $myPDO->query('SELECT * FROM users');
	echo $result;
}
catch (PDOException $e)
{
	echo 'Query Error: ' . $e->getMessage();
}

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});

$app->run();
?>