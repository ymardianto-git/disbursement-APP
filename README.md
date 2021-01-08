# Disbursement Application

## Introduction

Disbursement Application is web application that provide withdraw money to the bank with account number. 
This application installed and can be found on heroku URL : (https://intense-gorge-47175.herokuapp.com)

This web application built with laravel 7.30 and PHP version of 7.3 
This web application deployable on heroku

## Requirements
- [PHP >= 7.2](http://php.net/)
- [Laravel 7](https://github.com/laravel/framework)
- [jQuery DataTables v1.10.x](http://datatables.net/)

## Pre Requisite 


Step 1 
Run composer install
```
$ composer install
```


Step 2 
Run nodejs module to built css and js
```
$ npm install
```

```
$ npm run prod
```


Step 3
Setting up config vars on .env file 
```
APP_URL
APP_NAME=
APP_ENV=
APP_KEY=
APP_DEBUG=
APP_URL=

DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```


Step 4  
Run db migration 

```
php artisan migrate
```

## User Guide


Register Form. Input any of user test and email

```
Screenshot 1
```
<img src="https://i.postimg.cc/g0vSqsJB/Screen-Shot-2021-01-08-at-08-06-10.png" /> 



After register you will provide of The List Disbursement


```
Screenshot 2
```
<img src="https://i.postimg.cc/cCsk9njM/Screen-Shot-2021-01-08-at-08-53-49.png" />


Request Disbursement. Click button create on the list and will show popup form.

```
Screenshot 3 
```

<img src="https://i.postimg.cc/FRvTzS95/Screen-Shot-2021-01-08-at-08-55-45.png" />


We will get transaction id from the api service 3rd party with status "PENDING"

```
Screenshot 4
```

<img src="https://i.postimg.cc/0jQdKdF3/Screen-Shot-2021-01-08-at-08-57-26.png" />

We can update status the disbursement with click button synch data

```
Screenshot 5
```

<img src="https://i.postimg.cc/g0WVHP13/Screen-Shot-2021-01-08-at-08-58-28.png" />


We got info status "SUCCESS" and get the receipt 

```
Screenshot 6
```

<img src="https://i.postimg.cc/Wbq0R3vM/Screen-Shot-2021-01-08-at-08-59-19.png" />