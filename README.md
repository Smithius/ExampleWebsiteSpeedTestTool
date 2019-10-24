Page speed tool
========================

This is an example application written in php. 

Requirements
------------

  * PHP 7.2 or higher;
  * for tests some of the [PHPUnit requirements][1].

Installation
------------

Clone the repository and run composer command:

```bash
$ composer install
```

Usage
-----

Example console application contain two parameters. First with the tested website (baseUrl) 
and second with other websites urls (comparedUrls) separated by space.

```bash
$ php cli.php foo.zzz bar.yyy baz.xxx
```

Tests
-----

Execute this command to run tests:

```bash
$ ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/
```

[1]: https://phpunit.readthedocs.io/en/8.4/installation.html#requirements
