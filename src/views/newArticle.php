<?php

use App\Router\Router;

?>

<body>
    <h1>Ecrire un nouvel Article</h1>

    <?php if (isset($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action=<?= Router::url('switch_road') ?> method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="10" cols="50" required></textarea><br>

        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <?php foreach ($categories as $category) :
            ?>
                <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
            <?php endforeach; ?>
        </select><br>

        <input type="submit" name="action" value="Create Article">
        <input type="submit" name="action" value="Create Memento">
    </form>
</body>