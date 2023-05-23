<?php
use Alura\Mvc\Entity\video;
use Alura\Mvc\Repository\videoRepository;

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if ($url === false) {
    header('Location: /?sucesso=0');
    exit();
}
$titulo = filter_input(INPUT_POST, 'titulo');
if ($titulo === false) {
    header('Location: /?sucesso=0');
    exit();
}

//$sql = 'INSERT INTO videos (url, title) VALUES (?, ?)';
//$statement = $pdo->prepare($sql);
//$statement->bindValue(1, $url);
//$statement->bindValue(2, $titulo);

$repository = new videoRepository($pdo);
//$repossitory->add(new video($url, $titulo));

if ($repository->add(new video($url, $titulo)) === false) {
    header('Location: /?sucesso=0');
} else {
    header('Location: /?sucesso=1');
}

