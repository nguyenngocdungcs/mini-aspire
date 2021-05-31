## Step to setup source code:

Install packages
```
composer install
```
Create .env file from .env.example 
```
cp .env.example .env
```
Create database for the project (Postgres). Then add config in .env file. For example:
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=mini-aspire
DB_USERNAME=postgres
DB_PASSWORD=123456
```
Migrate database
```
php artisan migrate
```
Start server on default port 8000
```
php artisan serve
```
## Step to test the API:

Use this postman:
https://www.getpostman.com/collections/7f1786a2120c57dcd5aa

+ Create users: API `User - store`
+ Create loan for that user: API `Loan - store`

This will create all repayment objects for this loan

+ Get first repayment info: API `Loan - Next repayment`
+ Try to pay that repayment: API `Repayment - pay`

Use repayment id from API `Loan - next payment`

You can also test some other API I've prepare  