<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>おみくじ</title>
  <?php
    $isDev = getenv('VITE_DEV') === 'true';
    if ($isDev):
  ?>
  <script type="module" src="http://localhost:5173/@vite/client"></script>
  <?php else: ?>
  <link rel="stylesheet" href="/dist/assets/index.css">
  <?php endif; ?>
</head>
<body>
  <div id="app"></div>

  <?php if ($isDev): ?>
  <script type="module" src="http://localhost:5173/src/pages/index.js"></script>
  <?php else: ?>
  <script type="module" src="/dist/assets/index.js"></script>
  <?php endif; ?>
</body>
</html>
