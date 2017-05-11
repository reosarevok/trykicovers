<div class="row">
    <div class="col-xs-12">
        <h2>Register</h2>
        <form action="system/register.php" method="post">
            <p>
                <label for="username">Username:</label>
                <input id="username" type="text" name="username" required/>
            </p>
            <p>
                <label for="password">Password:</label>
                <input id="password" type="password" name="password" required/>
            </p>
            <p>
                <label for="passwordcheck">Password again:</label>
                <input id="passwordcheck" type="password" name="passwordcheck" required/>
            </p>
            <p>This set of question + answer will be used to recover your password if you forget it.</p>
            <p>
                <label for="question">Security question:</label>
                <input id="question" type="text" name="question" required/>
            </p>
            <p>
                <label for="answer">Security answer:</label>
                <input id="answer" type="text" name="answer" required/>
            </p>
            <p>
                <input type="submit" name="register" value="Register" />
            </p>
        </form>
    </div>
</div>