# おみくじアプリ

PHP + Vue 3 + Vite で構築したシンプルなおみくじアプリです。

## 技術スタック

- **フロントエンド**: Vue 3
- **ビルドツール**: Vite 5
- **バックエンド**: PHP

## ディレクトリ構成

```
.
├── index.php           # トップページ
├── result.php          # おみくじ結果ページ
├── vite.config.js      # Vite 設定
├── package.json
└── src/
    ├── pages/
    │   ├── index.js    # index.php のエントリポイント
    │   └── result.js   # result.php のエントリポイント
    ├── components/
    │   ├── FortuneButton.vue
    │   └── FortuneResult.vue
    └── style.css
```

## セットアップ

```bash
# 依存パッケージをインストール
npm install
```

## 開発

```bash
# Vite 開発サーバーを起動
npm run dev
```

PHP ファイルを PHP の開発サーバー等で配信しながら、Vite の HMR を利用して開発します。

```bash
# PHP 開発サーバー（別ターミナルで起動）
VITE_DEV=true php -S localhost:8000
```

## ビルド

```bash
npm run build
```

`dist/` ディレクトリに本番用ファイルが生成されます。

---

## デプロイ（公開ファイル一覧）

### 公開が必要なファイル

| ファイル | 説明 |
|---|---|
| `index.php` | トップページ |
| `result.php` | おみくじ結果ページ |
| `dist/assets/index.js` | `npm run build` で生成される JS |
| `dist/assets/result.js` | `npm run build` で生成される JS |
| `dist/assets/index.css` | `npm run build` で生成される CSS |

### 公開不要なファイル（サーバーに置かない）

| ファイル / ディレクトリ | 理由 |
|---|---|
| `src/` | Vite のソースファイル。ビルド後は不要 |
| `package.json` | npm 設定ファイル。公開すると依存関係が露出する |
| `vite.config.js` | Vite 設定ファイル。公開不要 |
| `node_modules/` | npm パッケージ群。ビルド後は不要 |

### サーバー上のディレクトリ構成

```
/var/www/html/          ← web root
├── index.php
├── result.php
└── dist/
    └── assets/
        ├── index.js
        ├── result.js
        └── index.css
```
