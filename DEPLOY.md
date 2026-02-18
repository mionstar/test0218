# デプロイ（公開）ファイル一覧

## 公開が必要なファイル

```
web root (public_html / htdocs / www など)
├── index.php          # トップページ
├── result.php         # おみくじ結果ページ
└── dist/              # npm run build で生成
    └── assets/
        ├── index.js   # index.php 用バンドル
        ├── result.js  # result.php 用バンドル
        └── index.css  # スタイルシート (生成される場合)
```

## 公開不要なファイル（サーバーに置かない）

| ファイル / ディレクトリ | 理由 |
|---|---|
| `src/` | Vite のソースファイル。ビルド後は不要 |
| `package.json` | npm 設定ファイル。公開すると依存関係が露出する |
| `vite.config.js` | Vite 設定ファイル。公開不要 |
| `node_modules/` | npm パッケージ群。ビルド後は不要 |

## デプロイ手順

```bash
# 1. 依存パッケージをインストール
npm install

# 2. 本番用ビルドを実行
npm run build

# 3. 以下のファイル/ディレクトリをサーバーの web root にアップロード
#    - index.php
#    - result.php
#    - dist/  (フォルダごと)
```

## ディレクトリ構成イメージ（サーバー上）

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
