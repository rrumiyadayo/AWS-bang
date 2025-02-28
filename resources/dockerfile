# マルチステージビルド: ビルドステージ
FROM php:8.2-fpm AS builder

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV NODE_VERSION=18.x
ENV APP_ENV=production

# システムパッケージとPHP拡張モジュールのインストール
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Node.js のインストール
RUN curl -fsSL https://deb.nodesource.com/setup_${NODE_VERSION} | bash - && \
    apt-get install -y nodejs

# Composer のインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 作業ディレクトリの設定
WORKDIR /var/www

# PHP依存関係のインストール（キャッシュ活用のため、先に依存関係ファイルだけコピー）
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Node.js依存関係のインストール（キャッシュ活用のため、先に依存関係ファイルだけコピー）
COPY package.json package-lock.json* ./
RUN npm ci --production

# アプリケーションコード全体のコピー
COPY . .

# フロントエンドアセットのビルド
RUN npm run build

# --- 本番実行ステージ ---
FROM php:8.2-fpm AS production

# 必要なPHP拡張モジュールのインストール（ビルドステージより少ない）
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# アプリケーション実行用の非rootユーザーを作成
RUN groupadd -g 1000 appuser && \
    useradd -u 1000 -g appuser -s /bin/bash -m appuser

# 作業ディレクトリの設定
WORKDIR /var/www

# ビルダーステージからアプリケーションファイルをコピー（必要なものだけ）
COPY --from=builder --chown=appuser:appuser /var/www/vendor /var/www/vendor
COPY --from=builder --chown=appuser:appuser /var/www/public /var/www/public
COPY --from=builder --chown=appuser:appuser /var/www/bootstrap /var/www/bootstrap
COPY --from=builder --chown=appuser:appuser /var/www/app /var/www/app
COPY --from=builder --chown=appuser:appuser /var/www/config /var/www/config
COPY --from=builder --chown=appuser:appuser /var/www/database /var/www/database
COPY --from=builder --chown=appuser:appuser /var/www/routes /var/www/routes
COPY --from=builder --chown=appuser:appuser /var/www/resources /var/www/resources
COPY --from=builder --chown=appuser:appuser /var/www/storage /var/www/storage
COPY --from=builder --chown=appuser:appuser /var/www/artisan /var/www/artisan

# ストレージディレクトリの権限設定
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache && \
    chown -R appuser:appuser /var/www

# ユーザーを非rootに切り替え
USER appuser

# ポート公開
EXPOSE 8000

# エントリーポイントとコマンド
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

# --- 開発環境ステージ ---
FROM builder AS development

# 開発環境特有のパッケージをインストール
RUN composer install --no-interaction --prefer-dist

# エントリーポイントスクリプトをコピー
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# エントリーポイントとコマンド
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
