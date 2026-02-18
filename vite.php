<?php

/**
 * Vite アセットヘルパー
 *
 * 環境変数:
 *   VITE_DEV=true          開発モードを有効化
 *   VITE_DEV_SERVER=<url>  Vite 開発サーバーの URL（デフォルト: http://localhost:5173）
 */
class Vite
{
    private static ?array $manifest = null;

    private static function isDev(): bool
    {
        return getenv('VITE_DEV') === 'true';
    }

    private static function devServer(): string
    {
        return rtrim(getenv('VITE_DEV_SERVER') ?: 'http://localhost:5173', '/');
    }

    private static function manifest(): array
    {
        if (self::$manifest === null) {
            $path = __DIR__ . '/dist/.vite/manifest.json';
            self::$manifest = json_decode(file_get_contents($path), true);
        }
        return self::$manifest;
    }

    /**
     * <head> 内に出力するタグを返す。
     * - 開発時: @vite/client の <script>
     * - 本番時: エントリに紐づく CSS の <link>
     */
    public static function head(string $entry): string
    {
        if (self::isDev()) {
            return '<script type="module" src="' . self::devServer() . '/@vite/client"></script>';
        }

        $chunk = self::manifest()[$entry] ?? [];
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
    public static function body(string $entry): string
    {
        if (self::isDev()) {
            return '<script type="module" src="' . self::devServer() . '/' . $entry . '"></script>';
        }

        $chunk = self::manifest()[$entry] ?? null;
        if (!$chunk) {
            throw new RuntimeException("Vite manifest にエントリ '{$entry}' が見つかりません。");
        }
        return '<script type="module" src="/dist/' . $chunk['file'] . '"></script>';
    }
}
