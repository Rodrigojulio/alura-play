<?php

declare(strict_types=1);

namespace Alura\Mvc\Repository;

use Alura\Mvc\Entity\video;
use PDO;


class videoRepository 
{
    public function __construct(private PDO $pdo)
    {

    }


    public function add(video $video): bool
    {

        $sql = 'INSERT INTO videos (url, title) VALUES (?, ?)';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $video->url);
        $statement->bindValue(2, $video->title);

        $result = $statement->execute();
        $id = $this->pdo->lastInsertId();

        $video->setId(intval($id));
        
        return $result;
    }


    public function remove(int $id): bool
    {
        $sql = 'DELETE FROM videos WHERE id = ?';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();

        return $statement->execute();

    }


    public function update(video $video): bool
    {

        $sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id;';
        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(':url', $video->url);
        $statement->bindValue(':title', $video->title);
        $statement->bindValue(':id', $video->id, PDO::PARAM_INT);

        return $statement->execute();

    }


    /**
     * @retun video[]
     */

    public function all(): array    
    {
        //($videoData['url'], $videoData['title']);
        $videoList = $this->pdo->query('SELECT * FROM videos;')->fetchAll(PDO::FETCH_ASSOC);
        return array_map(function(array $videoData) {
            $video = new video($videoData['url'], $videoData['title']);  
            $video->setId($videoData['id']);

            return $video;
            
            },

            $videoList,
        );
    }

}