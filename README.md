# PHP-Quiz    ![](https://img.shields.io/badge/Under-Construction-yellow.svg?style=flat-square)
![](https://img.shields.io/badge/php-5.5-blue.svg?style=flat-square) 
![](https://img.shields.io/badge/npm-2.12-brightgreen.svg?style=flat-square)  ![](https://img.shields.io/badge/gulp-3.9-red.svg?style=flat-square)

PHP Quiz Conducting System.

**Deployed at Azure:** [Here](http://php-quiz.azurewebsites.net/)

## Prerequisite

1. PHP
2. MySQL
3. phpMyAdmin or any other tool for database importing

## System Preparation

To get started with this project, you'll need the following things installed on your machine.

1. [NodeJS](http://nodejs.org) - use the installer.
2. [GulpJS](https://github.com/gulpjs/gulp) - `$ npm install -g gulp` (mac users may need sudo)

## Local Installation

1. Clone this repo, or download it into a directory of your choice.
2. Inside the directory, run `npm install`.

## Deployment

Make sure you have Virtual Hosts set up in Apache because path like ```localhost/php-quiz``` will not work!

Now open ```gulpfile.js``` and change

1. **deployPath** variable to your localhost root ```line: 10```
2. **browserSync proxy target** with your virtual host link ```line: 57```

## Usage

Once you set up everything inside directory, run

```shell
$ gulp
```

This will give you file watching, browser synchronisation, auto-deploy etc.
