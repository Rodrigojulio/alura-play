<?php 

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\videoRepository;
use PDO;

class videoListController
{

    private videoRepository $videoRepository;
    
    public function __construct()
    {
        $dbPath = __DIR__ . '/banco.sqlite';
        $pdo = new PDO("sqlite:$dbPath");
        $repossitory = new videoRepository($pdo);
        $videoList = $repossitory->all();
    }

    public function processaRequisicao(): void 
    {
       
    }
}