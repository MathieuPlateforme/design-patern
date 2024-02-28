<?php

use App\Router\Router;

?>


<body>

    <h1>Login</h1>

    <?php
    // Afficher le message d'erreur s'il existe
    if (isset($_SESSION['error_message'])) {
        echo '<p style="color: red;">' . $_SESSION['error_message'] . '</p>';
        // Effacer le message d'erreur de la session pour ne pas l'afficher à nouveau
        unset($_SESSION['error_message']);
    }
    ?>

    <form action="<?= Router::url('login') ?>" method="post">
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <input type="submit" value="Login">
        </div>
    </form>

</body>
