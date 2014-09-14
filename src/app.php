<?php
 
require_once __DIR__ . '/../vendor/autoload.php';
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

GameRocket_Configuration::environment('production');
GameRocket_Configuration::apikey('16a9d25c079f46b29d1e7e2193ae7ae0');
GameRocket_Configuration::secretkey('41b12432741b4f028ed39cc23afab8d4');

$app = new Silex\Application();
 
$app->get('/', function() {
    include 'views/form.php';
    return '';
});
 
$app->post('/create_player', function (Request $request) {
    $result = GameRocket_Player::create(array(
        'name' => $request->get('name'),
        'locale' => $request->get('locale')
    ));
 
    if ($result->success) {
        // Create the customer in your database with a field which contains Player ID for next calls
 
        return new Response("<h1>Success! Anasazi Player ID: " . $result->player->id . "</h1>", 200);
    } else {
        return new Response("<h1>Error: " . $result->message . "</h1>", 200);
    }
});
 
$app->run();
 
return $app;
                        
?>