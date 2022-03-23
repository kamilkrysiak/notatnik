<?php 

declare(strict_types=1);

namespace App;

use App\Exception\AppException;
use App\Exception\ConfigurationException;
use Throwable;

require_once("/application/src/View.php");
require_once("/application/src/Controller.php");

// $action = $_GET["action"] ?? null;

$configuration = require_once("config/config.php");
   
$request = [
    "get" => $_GET,
    "post" => $_POST
];

var_dump($request['get']);
var_dump($request['post']);


// try {
//     Controller::initConfiguration($configuration);
//     $controller = new Controller($require);
//     $controller->run($require);
// }  


// catch(AppException $e) {
//     echo '<h1>' . $e->getMessage() . '</h1>';
// } catch (Throwable $e) {
//     echo "<h2>BŁĄD</h2>";
// }


try {
    //$controller = new Controller($request);
    //$controller->run();
  
    Controller::initConfiguration($configuration);
    (new Controller($request))->run();
  } catch (ConfigurationException $e) {
     echo '<h1>Wystąpił błąd w aplikacji</h1>';
    echo 'Problem z applikacją, proszę spróbować za chwilę.';
  } catch (AppException $e) {
    echo '<h1>Wystąpił błąd w aplikacji</h1>';
    echo '<h3>' . $e->getMessage() . '</h3>';
  } catch (Throwable $e) {
    echo '<h1>Wystąpił błąd w aplikacji</h1>';
   }



// alternatywny syntax
// (new Controller($require))->run();

?>