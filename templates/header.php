<header>
    <div class="row">
        <div class="col-xs-12">
            <h1 class="text-center">Printing Museum Cover System</h1>
        </div>
        <div class="col-xs-12">
            <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <?php if (isset($_SESSION['username'])): ?>
                            <li><p class="navbar-text">Hi, <?= $_SESSION['username'] ?>! (<a href="system/logout.php">log
                                        out</a>)</p></li>
                        <?php else: ?>
                            <li><a href="login.php">Log in</a></li>
                        <?php endif; ?>
                        <li><a href="index.php">Home</a></li>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <li><a href="add_cover.php">Add a cover</a></li>
                        <?php endif; ?>
                        <li><a href="search.php">Search</a></li>
                        <li><a href="tags.php">Tags</a></li>
                        <li><a href="shelves.php">Shelves</a></li>
                        <li><a href="browse_all.php">Browse all</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>