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

//database stuff
try 
{
	$sql = 'SELECT * FROM users';
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$rowCount = $stmt->rowCount();
	$details = $stmt->fetch();
	echo $details;
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