<?php 

declare(strict_types=1);

namespace App;

use App\Exception\AppException;
use App\Exception\ConfigurationException;

require_once("src/View.php");
require_once('Database.php');



class Controller 
{
    private const DEFAULT_ACTION = 'list';

    private array $request;
    private Database $database;

    private View $view;

    private static array $configuration;

    public static function initConfiguration(array $configuration): void
    {
      self::$configuration = $configuration;
    }

    public function __construct(array $request)
    {
      if (empty(self::$configuration['db'])) {
        throw new ConfigurationException("configuration error");
      };
      $this->database = new Database(self::$configuration['db']);
        $this->view = new View();
        $this->request = $request;
    }

    public function run():void
     { 
        $viewParams = [];

         switch ($this->action()) {
             case 'create':
                $page = "create";
                $created = false;

                $data = $this->getRequestPost();
                if (!empty($data)) 
                {
 
                    $this->database->createNote([
                      'title' => $data['title'],
                      "description" => $data['description']
                    ]);
                     header("location: /?before=created");
                }
                 break;
                 case 'show':
                  $viewParams = [
                    "title" => "moja notatka",
                    "description" => "opis"
                  ];
                  break;
                default:
                $page = 'list';

                $data = $this->getRequestGet();
                $viewParams['before'] = $data['before'] ?? null;
                 break;
         }
         $this->view->render($page, $viewParams);
     }
     private function action(): string
     {
       $data = $this->getRequestGet();
       return $data['action'] ?? self::DEFAULT_ACTION;
     }
   
     private function getRequestGet(): array
     {
       return $this->request['get'] ?? [];
     }
   
     private function getRequestPost(): array
     {
       return $this->request['post'] ?? [];
     }
}