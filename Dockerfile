# ベースイメージとして、PHP 8.1-FPMを使用
FROM php:8.2-fpm

ENV COMPOSER_ALLOW_SUPERUSER=1

# --- システムパッケージ・PHP拡張モジュールのインストール ---
# 必要なパッケージ（Git、curl、ライブラリ等）をインストールし、
# PHPの各種拡張モジュール（pdo_mysql、mbstring、gdなど）を有効化します。
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# --- Node.js のインストール ---
# Node.jsをNodeSourceのセットアップスクリプトでインストールします（ここでは16.xを利用）
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs

# --- Composer のインストール ---
# ComposerはPHPの依存関係管理ツールです。
# 公式の Composer イメージからバイナリをコピーして利用します。
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# --- 作業ディレクトリの設定 ---
WORKDIR /var/www

# --- 依存関係のインストール用ファイルのコピー ---
# composer.json, composer.lock と package.json, package-lock.json（存在する場合）を先にコピーし、キャッシュを活用
COPY composer.json composer.lock artisan bootstrap/ /var/www/
COPY package.json package-lock.json* /var/www/

# 必要なファイルがコンテナ内にあることを確認（デバッグ用）
RUN ls -la /var/www/bootstrap
RUN ls -la /var/www

# --- PHP依存関係のインストール ---
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# --- Node.js依存関係のインストール ---
RUN npm install

# --- アプリケーションコード全体のコピー ---
COPY . /var/www

# --- ポート公開 ---
# Laravelの開発サーバ（artisan serve）を8000番ポートで実行するので公開
EXPOSE 8000

# --- エントリーポイントスクリプトの設定 ---
# 複数プロセス（npm run dev と php artisan serve）を起動するためのシェルスクリプトをコピーして実行権限を付与
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# --- コンテナ起動時のエントリーポイントとコマンド ---
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
