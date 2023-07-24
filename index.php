<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Cover Art Generator</title>
  <style type="text/css">
    html {
      font-size: 16px;
    }
    body {
      font-size: 1em;
      font-family: sans-serif;
      padding: 2em 3em 3em 3em;
    }
    form * {
      padding: 0.125em;
    }
    form label {
      display: block;
      font-size: 0.875em;
      font-weight: bold;
    }
    form input {
      font-size: 1em;
      width: 90%;
    }
    form input[type="submit"] {
      font-weight: bold;
      margin-right: 3em;
    }
    form input.button {
      width: auto;
      padding-left: 1em;
      padding-right: 1em;
    }
    form textarea {
      font-size: 1em;
      font-family: monospace;
      white-space: pre;
      width: 90%;
      height: 10em;
    }
    form textarea.tall {
      height: 40em;
    }
  </style>
</head>
<body>
  <h1>Cover Art Generator</h1>
  <?php include('generator.php'); ?>
</body>
</html>
