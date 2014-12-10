# 4_diary

* PHP 5.3 or greater
* MySQL 5 or greater

## Install

Use SlimFramework

- http://www.slimframework.com/

### composer install

```
$ curl -s https://getcomposer.org/installer | php
```

### composer.json

```
{
    "require": {
        "slim/slim": "2.*"
    }
}
```

### Slim Install

```
$ ./composer.phar install
```

### Data Import

    $ mysql 4th_diary < database.sql
    $ mysql 4th_diary < insert.sql

## Run

### PHP Build In Web Server

```
$ php -S localhost:9000
```


# License

4_diary the MIT license.


