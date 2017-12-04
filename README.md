# Charashee

キャラクターシート管理ツール

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy)

- メインターゲットはCoC(クトゥルフ神話TRPG)
- キャラクターシートの新規作成/編集
- 複数のキャラクターシートをグループ化する(自身の作成したものに限らない)グループ作成機能
- ランダムで全体/個別に能力値を計算する

利用フレームワーク/ライブラリ

- サーバサイド
  - laravel
- フロントエンド
  - Vue.js (+ vuex, vue-router)
  - TypeScript
  - Webpack
  - Axios
  - Lodash

その他利用ライブラリはpackage.json, composer.jsonを参照。

対象ブラウザ

- Google Chrome
- FireFox
- Safari
- Edge

IE11のみの不具合/デザイン崩れは一切対応しません。

IE11はすでにメイン機能の開発は終了し、セキュリティアップデートのみが提供されています。EdgeやChromeなどのモダンブラウザを使うことをお勧めします。

## セットアップ

<!-- [Heroku](https://heroku.com)で動作させるならボタンをポチッと押して必要事項を入力するだけで動作できます。よくわからない方はこの方法をお勧めします。 -->

### レンタルサーバーなどでの動作

ある程度Webアプリケーションの構築に知識がある方向け。

まずローカルで必要最低限の設定を行う必要があります。

#### 事前にインストールの必要があるもの

- php 7.0.0以上
  - OpenSSL, PDO, Mbstring, Tokenizer, XMLのPHP拡張を含む
  - レンタルサーバーで動かす場合は利用するPHPの変更を忘れずに
- Composer
  - ```sh
    $ php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    $ php composer-setup.php
    $ php -r "unlink('composer-setup.php');"
    ```

    でインストール可能。
- npm/yarn (このプロジェクトではyarnの方が望ましい)
  - npmは[Node.js](https://nodejs.org/ja/)をインストールすれば使えるようになります。yarnはnpmをインストール後、`npm i -g yarn`でインストールできます。
  - レンタルサーバーでNode.jsやnpmが使えない場合は後述。ローカルにはインストールしておきましょう。
- MySQL

レンタルサーバーを利用する場合、シェルへのログインができることを必ず確認してください。

#### 1. プロジェクトのダウンロード

`git clone`などでプロジェクトをダウンロードしましょう。

#### 2. PHP依存関係のインストール

ダウンロードしてきたプロジェクトのルート階層で、
```sh
$ composer install
```

#### 3. 設定ファイルのセットアップ
`.env_example`を`.env`にリネームし、DBの設定を変更します。初期状態でも動作しますがセキュリティ的に危ないです。

レンタルサーバーを利用の場合はレンタルサーバーの設定に合わせないと動きません。

```text
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=(任意のデータベース名)
DB_USERNAME=(任意のユーザー名)
DB_PASSWORD=(任意のパスワード)
```

その後、

```sh
$ php artisan key:generate
$ php artisan passport:keys
```

で必要なその他の設定を書き出します。

#### 4. JavaScriptのビルド

npmを利用する場合は適宜yarnをnpmに置き換えてください。

```sh
$ yarn install
$ yarn run prod
```

#### 5. パッケージアップロード

プロジェクトをサーバーにアップロードします。

その際、プロジェクトルートがpublicフォルダを指すようにしてください。

レンタルサーバで変更ができない場合はプロジェクトルートにpublicフォルダの中身を移動してpublicフォルダを削除、publicでプロジェクトルートを指すシンボリックリンクを作成しましょう。

```sh
# Charasheeプロジェクト内
$ mv -rf public/* (プロジェクトルートのパス)
$ rmdir public
$ ln -s (プロジェクトルートのパス) public
```

その後、初期データ配置のため以下のコマンドを入力

```sh
$ php artisan migrate:fresh --seed
```

### ローカルでの動作

とりあえずどういうアプリケーションなのか確認したい人向け。

外部からのアクセスは基本的にはできません。

#### 必要なもの

- 上記`レンタルサーバーなどでの動作`の必要なツール参照。
- もしくは、[`Docker`](https://www.docker.com/)を使う手もあります。
  - その場合でも、yarn/npmは必要なのでインストールしておいてください。

#### Dockerを使わない方法

上記`レンタルサーバーなどでの動作`の手順1~4を参照。ただし、MySQLの設定は先に行っておくこと。

##### 5. 初期データ挿入

```sh
$ php artisan migrate:fresh --seed
```

##### 6. ローカルサーバーの立ち上げ

```sh
$ php artisan serve --port:8080
```

任意のブラウザで`http://localhost:8080`にアクセスすれば動作を確認できます。

#### Dockerを使う方法

##### 1. 設定ファイル編集

`.env_example`を`.env`にリネーム

```sh
$ php artisan key:generate
$ php artisan passport:keys
```

##### 2. Javascriptビルド

```sh
$ yarn install
$ yarn run dev
```

##### 3. コンテナ起動

```sh
$ cd docker/
$ docker-compose up -d
```

##### 4. 初期データ挿入

```sh
$ php artisan migrate:fresh --seed
```
