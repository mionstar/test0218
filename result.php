<?php
// おみくじのロジック
$fortunes = [
    [
        'rank'    => '大吉',
        'color'   => '#e63946',
        'message' => '素晴らしい運気です！何事もうまくいくでしょう。積極的に行動してください。',
        'details' => [
            ['category' => '願望', 'value' => '必ず叶う'],
            ['category' => '恋愛', 'value' => '良縁あり'],
            ['category' => '仕事', 'value' => '大成功'],
            ['category' => '健康', 'value' => '絶好調'],
            ['category' => '金運', 'value' => '大幸運'],
        ],
    ],
    [
        'rank'    => '中吉',
        'color'   => '#f4a261',
        'message' => '良い運気が流れています。努力が実を結ぶ時期です。',
        'details' => [
            ['category' => '願望', 'value' => '叶う'],
            ['category' => '恋愛', 'value' => '順調'],
            ['category' => '仕事', 'value' => '順調'],
            ['category' => '健康', 'value' => '良好'],
            ['category' => '金運', 'value' => '良い'],
        ],
    ],
    [
        'rank'    => '小吉',
        'color'   => '#2a9d8f',
        'message' => 'まずまずの運気です。着実に前進しましょう。小さな努力が大きな結果を生みます。',
        'details' => [
            ['category' => '願望', 'value' => '焦らずに'],
            ['category' => '恋愛', 'value' => 'ゆっくりと'],
            ['category' => '仕事', 'value' => '堅実に'],
            ['category' => '健康', 'value' => '普通'],
            ['category' => '金運', 'value' => '節約を'],
        ],
    ],
    [
        'rank'    => '吉',
        'color'   => '#457b9d',
        'message' => '穏やかな運気です。日々の小さな幸せを大切にしてください。',
        'details' => [
            ['category' => '願望', 'value' => '時間がかかる'],
            ['category' => '恋愛', 'value' => '友情から'],
            ['category' => '仕事', 'value' => '地道に'],
            ['category' => '健康', 'value' => '無理禁物'],
            ['category' => '金運', 'value' => '現状維持'],
        ],
    ],
    [
        'rank'    => '末吉',
        'color'   => '#6d6875',
        'message' => '今は準備の時期です。焦らず着実に進みましょう。やがて運が開けるでしょう。',
        'details' => [
            ['category' => '願望', 'value' => '急がないこと'],
            ['category' => '恋愛', 'value' => '慎重に'],
            ['category' => '仕事', 'value' => '準備を怠らず'],
            ['category' => '健康', 'value' => '休養を'],
            ['category' => '金運', 'value' => '出費に注意'],
        ],
    ],
    [
        'rank'    => '凶',
        'color'   => '#495057',
        'message' => '少し注意が必要な時期です。慎重に行動し、周囲の人を大切にしましょう。',
        'details' => [
            ['category' => '願望', 'value' => '見直しを'],
            ['category' => '恋愛', 'value' => '衝突注意'],
            ['category' => '仕事', 'value' => 'ミスに注意'],
            ['category' => '健康', 'value' => '体調管理を'],
            ['category' => '金運', 'value' => '無駄遣い禁止'],
        ],
    ],
    [
        'rank'    => '大凶',
        'color'   => '#212529',
        'message' => '試練の時期かもしれませんが、必ず乗り越えられます。今こそ内省し、力を蓄える時です。',
        'details' => [
            ['category' => '願望', 'value' => '時期を待て'],
            ['category' => '恋愛', 'value' => '忍耐が必要'],
            ['category' => '仕事', 'value' => '慎重第一'],
            ['category' => '健康', 'value' => '無理しない'],
            ['category' => '金運', 'value' => '節制を'],
        ],
    ],
];

// 重み付き抽選（大吉が出にくく、吉系が多め）
$weights = [5, 15, 20, 25, 20, 10, 5];
$totalWeight = array_sum($weights);
$random = random_int(1, $totalWeight);
$cumulative = 0;
$selectedFortune = $fortunes[0];

foreach ($fortunes as $index => $fortune) {
    $cumulative += $weights[$index];
    if ($random <= $cumulative) {
        $selectedFortune = $fortune;
        break;
    }
}

$fortuneJson = json_encode($selectedFortune, JSON_UNESCAPED_UNICODE);
$isDev = getenv('VITE_DEV') === 'true';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>おみくじ結果 - <?= htmlspecialchars($selectedFortune['rank'], ENT_QUOTES, 'UTF-8') ?></title>
  <?php if ($isDev): ?>
  <script type="module" src="http://localhost:5173/@vite/client"></script>
  <?php else: ?>
  <link rel="stylesheet" href="/dist/assets/result.css">
  <?php endif; ?>
</head>
<body>
  <div id="app" data-fortune="<?= htmlspecialchars($fortuneJson, ENT_QUOTES, 'UTF-8') ?>"></div>

  <?php if ($isDev): ?>
  <script type="module" src="http://localhost:5173/src/pages/result.js"></script>
  <?php else: ?>
  <script type="module" src="/dist/assets/result.js"></script>
  <?php endif; ?>
</body>
</html>
