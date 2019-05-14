
# Budget

Budget is an open-source web application that helps you keep track of your finances.

![Product](https://user-images.githubusercontent.com/9268822/46098425-a8877300-c1c4-11e8-9293-f43ceb9d6f97.png)

## Features

* Ability to organize spendings using tags
* Dashboard displaying monthly statistics about your spendings
* Available in multiple languages (English, Dutch, Danish, German)

## Installation

```
composer install --no-dev
yarn install

cp .env.example .env
php artisan key:generate

php artisan storage:link

php artisan migrate

yarn add --dev @fortawesome/fontawesome-free
yarn run development

php artisan serve

php artisan queue:work
```

## Setting up Example data 

If you wish to add some data to see how budget ticks, you can easily add some by running

```
php artisan db:seed
```

If you like how everything works, but want to start with a fresh install, you can reset the application by running 
```
php artisan migrate:fresh
```
This will leave you with a clean budget install, ready to be served.