<?php
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

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});

try{
	$db_connection = pg_connect("host=localhost dbname=d81l6hfqatknea user=postgres password=secret");
}
catch (PDOException $e) 
{
echo 'Connection failed: ' . $e->getMessage();
}

try 
{
	$result = pg_query($db_connection, "SELECT * FROM users;");
	echo $result;
}
catch (PDOException $e)
{
	echo 'Query Error: ' . $e->getMessage();
}

$app->run();
?>