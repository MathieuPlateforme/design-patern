<?php

namespace App\Controller;

class Controller
{

    public function __construct()
    {
    }

    public function render($view, $params = [])
    {
        ob_start();
        extract($params);
        require_once 'src/views/' . $view . '.php';
        $content = ob_get_clean();
        require_once 'src/views/partials/header.php';
        echo $content;
        require_once 'src/views/partials/footer.php';
    }

    public function redirect($url, $params = [], $code = 302, $message = null)
    {
        $url = Router::url($url, $params);
        header("Location: $url", true, $code);
        exit();
    }

    public static function getUser()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        } else {
            return null;
        }
    }

    public function createComment($content, $post_id)
    {
        if (empty($content)) {
            throw new \Exception("Le contenu ne peut pas être vide");

            return;
        }

        if (self::getUser() === null) {
            throw new \Exception("Vous devez être connecté pour commenter");

            return;
        }

        if (is_numeric($post_id) === false) {
            throw new \Exception("L'identifiant du post n'est pas valide");

            return;
        }

        $post_id = (int) $post_id;

        $post = new Post();
        $post = $post->findOneById($post_id);

        $comment = new Comment();
        $comment->setContent($content);
        $comment->setUser(self::getUser());
        $comment->setPost($post);
        $comment->setCreatedAt(new \DateTime());
        $comment->save();

        $this->redirect('post', ['id' => $post->getId()]);
    }
}
