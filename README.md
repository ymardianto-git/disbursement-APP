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


## Install on Heroku

Create new app on heroku. Connect to this source github and deploy

Setting up config vars on .env file after github source connected to DB
```

APP_NAME=Disbursement App
APP_ENV=production
APP_KEY=base64:epjkN4hsVq3bc9uBH+6e4WVtif/ayC6h4WrdDKZOG78=
APP_DEBUG=false
APP_URL={URL App Here}

DB_CONNECTION= {DB_CONNECTION (mysql, postgree)}
DB_HOST= {DB HOST here}
DB_PORT=  {DB PORT here}
DB_DATABASE= {DB DATABASE here}
DB_USERNAME= {DB USERNAME here}
DB_PASSWORD= {DB PASSWORD here}
```

Screenshot config vars on heroku
<img src="https://i.postimg.cc/mkP9fKVr/Screen-Shot-2021-01-08-at-13-02-37.png" />

Run db migration 
```
heroku run php artisan migrate 
```


## Pre Requisite (Non Heroku)


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

APP_NAME=Disbursement App
APP_ENV=production
APP_KEY=base64:epjkN4hsVq3bc9uBH+6e4WVtif/ayC6h4WrdDKZOG78=
APP_DEBUG=false
APP_URL={URL App Here}

DB_CONNECTION= {DB_CONNECTION (mysql, postgree)}
DB_HOST= {DB HOST here}
DB_PORT=  {DB PORT here}
DB_DATABASE= {DB DATABASE here}
DB_USERNAME= {DB USERNAME here}
DB_PASSWORD= {DB PASSWORD here}
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