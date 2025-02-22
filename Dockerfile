# Node.js の Alpine 版イメージをベースに利用（軽量）
FROM node:alpine

# コンテナ内で作業するディレクトリを設定
WORKDIR /app

# package.json と package-lock.json（存在すれば）を先にコピー
COPY package*.json ./

# 依存関係のインストール
RUN npm install

# 残りのアプリケーションソースコードをコピー
COPY . .

# コンテナがリッスンするポートを公開
EXPOSE 3000

# コンテナ起動時に実行するコマンド
CMD ["node", "app.js"]
