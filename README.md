<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## How to install
``` bash
- Clone the repository 
- composer install
- cp .env.example .env
- php artisan key:generate
- cd requisitions-api && sail up
```

## How to run tests

``` bash
sail php artisan test --testsuite=Feature
```
