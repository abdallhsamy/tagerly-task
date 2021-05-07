<p align="center">
<a href="https://travis-ci.org/abdallhsamy/tagerly-task"><img src="https://travis-ci.org/your/repo.svg?branch=main" alt="travis"></a>

</p>

## About

## how to run fake API server

### Install JSON Server

```bash
npm install -g json-server
```

### Start fake API server

```bash
json-server --watch db.json
```

Now if you go to `http://localhost:3000/products/1`, you'll get

```json
{
    "id": 1,
    "name": "Alysa Jacobs",
    "price": "13",
    "vendor_id": "1",
    "sold_times": "51",
    "currency": "CZK"
}
```

## Installation Instructions:

1. download the repo : run this command in terminal:
```bash 
git clone git@github.com:abdallhsamy/tagerly-task.git
```
2. open project directory
```bash
cd tagerly-task
```
3. create database with name you want to use in application
4. create configuration file `.env` using following command
```bash
cp .env.example .env
```
5. open `.env` file and file with your database credentials and database name.
6. run `composer install` command to download packages which are needed to run the app.
7. run database migrations :
```bash
php artisan migrate:fresh --seed
```
8. run `php artisan serve` command to run app or use `valet`.

- feel free to use `docker`.
## requirements


- the same as [laravel requirements](https://laravel.com/docs/7.x/installation#server-requirements)



## usage
 make sure that you are running json server to retrieve data :
 using postman or any web browser you can call any of the following examples   as `http://tagerlytask.test` is your app url fell free to use `localhost` or anything else
 -  `http://tagerlytask.test/api/v1/products?price=10`
 -  `http://tagerlytask.test/api/v1/products?price=10:20`
 -  `http://tagerlytask.test/api/v1/products?vendor_name=Emie`
 -  `http://tagerlytask.test/api/v1/products?name=Alysa%20Jacobs`
 -  `http://tagerlytask.test/api/v1/products?sort=price`
 -  `http://tagerlytask.test/api/v1/products?sort=price`
 -  `http://tagerlytask.test/api/v1/products?sort=price&type=desc`
 -  `http://tagerlytask.test/api/v1/products?sort=most_selling`
 -  `http://tagerlytask.test/api/v1/products?sort=votes`

you can filter by multiple criteria in the same time like search by Price ex:
 -  `http://tagerlytask.test/api/v1/products?sort=price&type=desc&name=Jeramy&vendor_name=Brandi`

