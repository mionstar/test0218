<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>おみくじ</title>
  <?php require_once __DIR__ . '/vite.php' ?>
  <?= vite_head('src/pages/index.js') ?>
</head>
<body>
  <div id="app"></div>

  <?= vite_body('src/pages/index.js') ?>
</body>
</html>
