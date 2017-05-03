<?php require $_SERVER['DOCUMENT_ROOT']."/trykicovers/controllers/login.php"; ?>

<div class="row">
    <div class="col-xs-12">
        <h2>Log in</h2>
        <form action="system/login.php" method="post">
            <p>
                <label for="username">Username:</label>
                <input id="username" type="text" name="username" />
            </p>
            <p>
                <label for="password">Password:</label>
                <input id="password" type="password" name="password" />
            </p>
            <p>
                <input type="submit" name="login" value="Login" />
            </p>
        </form>
        <p>If you don't have an account, you can <a href="register.php">register</a>.</p>
    </div>
</div>