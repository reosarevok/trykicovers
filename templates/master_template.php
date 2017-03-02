<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Printing Museum Cover System</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" />
    <link href="static/style/style.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <script src="static/vendor/transliteration.cyr.js"></script>
</head>
<body>
<div class="container-fluid">
    <?php session_start(); ?>
    <?php require_once "header.php"; ?>
    <main>
    <?php require_once $_SERVER['DOCUMENT_ROOT']."/trykicovers/views/$page.php"; ?>
    </main>
    <?php require_once "footer.php"; ?>
</div>
</body>
</html>
