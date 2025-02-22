#!/bin/bash
# docker-entrypoint.sh
# このスクリプトは、npm run dev をバックグラウンドで起動し、
# 続いてメインプロセスとして渡されたコマンド（例: php artisan serve）を実行します。

# フロントエンド資産のビルドやウォッチを開始（バックグラウンド実行）
npm run dev &

# メインプロセスとして、引数として渡されたコマンドを実行
exec "$@"
