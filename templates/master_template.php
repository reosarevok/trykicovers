<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Printing Museum Cover System</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/bootstrap-tagsinput/bootstrap-tagsinput-css/bootstrap-tagsinput.css"/>
    <link href="static/style/style.css" rel="stylesheet" type="text/css">
    <script src="vendor/jquery/jquery/jquery-3.1.1.js"></script>
    <script src="vendor/bootstrap-tagsinput/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="vendor/typeahead.js/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="vendor/transliteration.cyr/transliteration.cyr/transliteration.cyr.js"></script>
</head>
<body>
<div class="container-fluid">
    <?php session_start(); ?>
    <?php require_once "header.php"; ?>
    <main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/trykicovers/views/$page.php"; ?>
    </main>
    <?php require_once "footer.php"; ?>
</div>
</body>
</html>
