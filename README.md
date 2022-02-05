## About App

-- is asimple SPA (Single Page Application), that renders indexes of customers' data categorized by country, state, phone and code and also enables search filter according to two levels (country & state), it also supports pagination keeping search filter rendering as it was selected earlier.

-- can add customers accrding to three fields (name, country, phone)


## How to get start

- clone or download repo (or from google drive)
- run composer update
- run npm install
- run npm run dev
- run php artisan key:generte
- run .env
- copy .env.exampe to .env
- create database with name of your choice
- run php artisan migrate
- run php artisan db:seed
- run php artisan serve

## Seed Dummy Data

- we are gonna seed db with dummy data and accordingly we can apply search filters on
- we have two tabes in use (countries & customers)
- dummy data for some countries' phone codes and regex
- dummy data for some customers to be rendered on landing page
- dummy data returned from db can be filter according to (country, state) with pagination


## Tools Used

- php & laravel
- composer
- git bash
- nodejs , npm
- vueJs && bootstrap
- postman
