<?php
require '../vendor/autoload.php';

// Prepare app
$app = new \Slim\Slim(array(
    'templates.path' => '../templates',
));

// Create monolog logger and store logger in container as singleton 
// (Singleton resources retrieve the same log resource definition each time)
$app->container->singleton('log', function () {
    $log = new \Monolog\Logger('slim-skeleton');
    $log->pushHandler(new \Monolog\Handler\StreamHandler('../logs/app.log', \Monolog\Logger::DEBUG));
    return $log;
});

// Prepare view
$app->view(new \Slim\Views\Twig());
$app->view->parserOptions = array(
    'charset' => 'utf-8',
    'cache' => realpath('../templates/cache'),
    'auto_reload' => true,
    'strict_variables' => false,
    'autoescape' => true
);

$app->view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
    new \JSW\Twig\TwigExtension());

// Define routes
$app->get('/', function () use ($app) {
    // Sample log message
    $app->log->info("Slim-Skeleton '/' route");
    // Render index view
    $app->render('index.html.twig');
});

$app->get('/openid', function() use ($app) {
    $app->render('openid.html.twig');
});


$app->get('/sendopenidrequest', function() use ($app){

$openid = new LightOpenID('promis.local');
// var_dump($openid);
if(!$openid->mode) {

        
        # The connectWithIntuitOpenId parameter is passed when the user clicks the login button below
        # The subscribeFromAppsDotCom parameter is an argument in the OpenID URL of a sample app on developer.intuit.com
        # Example of OpenID URL:  http://localhost/ippPhpOpenId/IPP-PHP-OpenID-Login.php?subscribeFromAppsDotCom
        if(isset($_GET['connectWithIntuitOpenId']) || isset($_GET['subscribeFromAppsDotCom'])) {
            $openid->identity = "https://openid.intuit.com/Identity-me";
            # The following two lines request email and full name
            # from the Intuit OpenID provider
            $openid->required = array('contact/email');
            $openid->optional = array('namePerson/last', 'namePerson', 'intuit/realmId');

/* Fields available (according to intuit docs): 
            contact/email
            namePerson
            namePerson/first
            namePerson/last
            intuit/realmId
                —This field can only be fetched when there is an active connection between the realm and the app and when the user is launching the application from Apps.com.
    */


            header('Location: ' . $openid->authUrl());
        }else{
            # Show the login button.  The user is not in the process of loggin in
            echo '<div><ipp:login href="index.php?connectWithIntuitOpenId" type="vertical"></div>';
        }
    } elseif($openid->mode == 'cancel') {
        echo 'User has canceled authentication!';
    } else {
        # Print the OpenID attributes that we requested above, email and full name
        //print_r($openid->getAttributes());


                error_reporting(E_ERROR | E_PARSE);
            
                // After the oauth process the oauth token and secret 
                // are storred in session variables.
                $tk = $_SESSION['token'];
                $app->render("openidcallback.html.twig", [
                    "tk"=>$tk,
                    "authenticated" => isset($_SESSION['token']),
                    "test" => "it sure is",
                    "valid" => $openid->validate(),
                    "attributes" => $openid->getAttributes(),
                    ]);


    }

});



// Define 404 template
$app->notFound(function () use ($app) {
    $app->render('404.html.twig');
});

// Run app
$app->run();
