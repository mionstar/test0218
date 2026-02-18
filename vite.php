<?php

/**
 * Vite アセットヘルパー
 *
 * 環境変数:
 *   VITE_DEV=true          開発モードを有効化
 *   VITE_DEV_SERVER=<url>  Vite 開発サーバーの URL（デフォルト: http://localhost:5173）
 */

function _vite_manifest(): array {
    static $manifest = null;
    if ($manifest === null) {
        $path = __DIR__ . '/dist/.vite/manifest.json';
        $manifest = json_decode(file_get_contents($path), true);
    }
    return $manifest;
}

/**
 * <head> 内に出力するタグを返す。
 * - 開発時: @vite/client の <script>
 * - 本番時: エントリに紐づく CSS の <link>
 */
function vite_head(string $entry): string {
    if (getenv('VITE_DEV') === 'true') {
        $server = rtrim(getenv('VITE_DEV_SERVER') ?: 'http://localhost:5173', '/');
        return '<script type="module" src="' . $server . '/@vite/client"></script>';
    }

    $chunk = _vite_manifest()[$entry] ?? [];
    $tags = [];
    foreach ($chunk['css'] ?? [] as $css) {
        $tags[] = '<link rel="stylesheet" href="/dist/' . $css . '">';
    }
    return implode("\n  ", $tags);
}

/**
 * </body> 直前に出力するタグを返す。
 * - 開発時: エントリの <script type="module">（開発サーバー経由）
 * - 本番時: ビルド済みエントリの <script type="module">
 */
function vite_body(string $entry): string {
    if (getenv('VITE_DEV') === 'true') {
        $server = rtrim(getenv('VITE_DEV_SERVER') ?: 'http://localhost:5173', '/');
        return '<script type="module" src="' . $server . '/' . $entry . '"></script>';
    }

    $chunk = _vite_manifest()[$entry] ?? null;
    if (!$chunk) {
        throw new RuntimeException("Vite manifest にエントリ '{$entry}' が見つかりません。");
    }
    return '<script type="module" src="/dist/' . $chunk['file'] . '"></script>';
}
