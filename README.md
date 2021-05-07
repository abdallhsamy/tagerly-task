<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
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

