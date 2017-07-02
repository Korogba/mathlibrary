## Hello

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

## Laravel ##

Mathlibrary is built using the Laravel PHP Framework. Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs). Laravel is an excellent framework for PHP and web development. To use Laravel, get [composer](https://getcomposer.org/) and check the documentation of [Laravel](http://laravel.com/docs/5.1). Or get [PHPStorm](https://www.jetbrains.com/phpstorm/). With PHPStorm you can just pull in this project from this repository and it will handle your set-ups for you. Easy as you like!

## Laracasts ##

If you will like to watch video tutorials on Laravel, you can check out this excellent site [Laracast](https://laracasts.com). Some of the tutorials are not free but there is a free introductory series on Laravel called [Laravel 5 Fundamentals](https://laracasts.com/series/laravel-5-fundamentals). 

## SearchIndex ##

In order not to re-invent the wheel as they say, I used a package called [searchindex](https://github.com/spatie/searchindex) for easy search and retrieval of values from the database. This package uses a search index, in this case [elasticsearch](https://www.elastic.co/). Hence, there was the need to save copies of books/students saved in mySql database into the elasticsearch index. So if you run the application without starting the server for elasticsearch, it might fail/not search properly. In the downloads links on this repository, you will find an uploaded copy of the elasticsearch with sample data already saved in its' index. To use, download, unzip and save in any appropriate directory. To start the server, run bin/elasticsearch.bat from the elasticsearch folder. If you want to have a nice way to interact with the data in the elasticsearch index, download this nice google chrome extension to elasticsearch [Sense (Beta)](https://chrome.google.com/webstore/search/sense?hl=en).

## MySql ##

I have also uploaded the sql file from the database that I used in testing the application during development. You might have to find a way to add additional sample data because just a few users and books have been added. From the administrator account, you can of course create new users/books and add them as you like. But this is tedious although adding them this way automatically saves them to the elasticsearch index as well. If you do find another way, kindly ensure that whatever is saved in the sql database is also saved in the elasticsearch index for consistency. If you like, you can make do with the little already saved.

## Miscellaneous ##

Kindly note that the username for sign-in is the email address of the users and the default password is 'password'.
