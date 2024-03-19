<?php

class DraftManager
{
    private $mementosFolder = 'mementos';

    public function addMemento(ArticleMemento $memento, $userId)
    {
        // Créez le répertoire s'il n'existe pas
        if (!is_dir($this->mementosFolder)) {
            mkdir($this->mementosFolder, 0777, true);
        }

        $filename = $userId . '_' . $memento->getTitle() . '_' . time() . '_memento.txt';

        // Enregistrez le memento dans le fichier
        file_put_contents($this->mementosFolder . '/' . $filename, serialize($memento));
    }


    public function getMementos($userId)
    {
        $mementos = [];

        $mementoFiles = glob($this->mementosFolder . '/' . $userId . '_*_memento.txt');
        foreach ($mementoFiles as $filepath) {
            $memento = unserialize(file_get_contents($filepath));
            var_dump($filepath);
            if ($memento instanceof ArticleMemento) {
                // Récupérez le titre et la date de création du memento
                $mementoTitle = $memento->getTitle();

                $timestamp =  explode('_', $mementoTitle)[1];
                var_dump($timestamp);
                $mementos[] = [
                    'title' => $mementoTitle,
                    'timestamp' => $timestamp,

                ];
            }
        }

        usort($mementos, function ($a, $b) {
            return $b['timestamp'] <=> $a['timestamp'];
        });

        return $mementos;
    }
}
