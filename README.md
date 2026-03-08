# coachtechフリマ  

## 環境構築  
**Dockerビルド**  
1. `git clone git@github.com:miho-85-ux/coachtech-fleamarket-app.git`  
2. `cd coachtech-fleamarket-app.git`  
3. DockerDesktopアプリを立ち上げる  
```bash  
docker-compose up -d --build  
```  

**Laravel環境構築**
1. `docker-compose exec php bash`  
2. `composer install`  
3. .env.exampleファイルから.envファイルをコピーする    
```bash  
cp .env.example .env
```   
4. envに以下の環境変数を追加  
``` text  
DB_CONNECTION=mysql 
DB_HOST=mysql 
DB_PORT=3306 
DB_DATABASE=laravel_db 
DB_USERNAME=laravel_user 
DB_PASSWORD=laravel_pass 
```  
5. アプリケーションキーの作成  
```bash  
php artisan key:generate  
```  
6. マイグレーションの実行  
```bash  
php artisan migrate  
```  
7. シーディングの実行  
```bash  
php artisan db:seed   
```  
8. シンボリックリンク作成  
``` bash  
php artisan storage:link 
```  

**Mailtrap**  
1. Mailtrapのアカウントを作る  
```bash  
https://mailtrap.io  
```
2. SandboxのCredentialsを.envに設定  
```text  
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=2525
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
```
3. キャッシュをクリア
```bash
php artisan config:clear
```
4. メールを確認


**支払い方法** 
・コンビニ支払い  
・カード支払い（Stripe）

カード決済のテストには以下のテストカードを使用してください。
```bash
カード番号  
4242 4242 4242 4242

有効期限  
任意の未来日(例：12/34)  

CVC  
任意の3桁　（例：123）  
```
※Stripeはテストモードで動作しています。
実際の決済は行われません。

**備考**  
* 今回のテストデータは2つあります。
    * テストデータ1  商品を出品しており、商品一覧が見れません。
    * テストデータ2  テストデータ2を使って、ログインしてください。  

* ログインする際、以下のログインパスワードでログインしてください。　
    * テストデータ1  
        メールアドレス　　
        ```bash  
        test1@example.com  
        ```
        パスワード　
        ```bash  
        password  
        ```
    * テストデータ2  
        メールアドレス  
        ```bash
        test2@example.com  
        ```
        パスワード  
        ```bash
        password  
        ```
  



## 使用技術 
* PHP:8.1.33 
* Lravel:8.83.8 
* MySQL:8.0.26 
* nginx:1.21.1 
* MailTrap
* Stripe  

# 開発環境 
* 商品一覧:http://localhost/  
* phpmyadmin:http://localhost:8080  
* MailTrap:https://mailtrap.io  

# ER図添付  
 [ER図]<img src=".drawio.png">


