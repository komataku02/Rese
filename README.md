#アプリケーション名

Rese

##作成した目的

外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。

##URL

アプリページ：http://localhost/

メール：http://localhost:8025/

phpMyadmin:http://localhost:8080/

##機能一覧

ログイン・ログアウト機能、会員登録機能、マイページ、飲食店一覧表示、店舗予約機能、
店舗お気に入り登録機能、エリア・ジャンル・店名検索、レビュー機能、予約変更機能、
権限（管理者・店舗代表者・利用者）、ストレージ機能、メール認証機能

##使用技術

Laravel Framework 8.83.8

PHP 7.4.9

##環境構築

Dockerビルド

1.git clone リンク 2.2docker-compose up -d --build

Laravel環境構築

1.docker-compose exec php bash 2.composer install
3.cp .env.example .envを行い、環境変数を変更 
4.php artisan key:generate 5.php artisan mirate 6.php artisan 

##ER図


##アカウントの種類

・user_id:1 name:admin_user email:admin@mail.com password:admin@mail.com 権限：管理者

・user_id:2 name:shop_owner1 email:owner1@mail.com password:owner1@mail.com 権限：店舗代表者

・user_id3 name:user1 email:user1@mail.com password:user1@mail.com 権限：利用者
