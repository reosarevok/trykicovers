<?php require $_SERVER['DOCUMENT_ROOT'] . "/trykicovers/controllers/password_recovery.php"; ?>

<div class="row">
    <div class="col-xs-12">
        <h2>Password recovery</h2>
        <form action="system/password_recovery.php" method="post">
            <p><?= $user->question ?></p>
            <input type="hidden" name="username" value="<?= $user->username ?>">
            <p>
                <label for="answer">Answer:</label>
                <input id="answer" type="text" name="answer" required/>
            </p>
            <p>
                <label for="password">New password:</label>
                <input id="password" type="password" name="password" required/>
            </p>
            <p>
                <label for="passwordcheck">New password again:</label>
                <input id="passwordcheck" type="password" name="passwordcheck" required/>
            </p>
            <p>
                <input type="submit" name="register" value="Change password"/>
            </p>
        </form>
    </div>
</div>