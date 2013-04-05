Limonade template
=================


## Install

First install [composer](http://getcomposer.org/download/) if you have not.

Next enter this commands
```
$ composer.phar install
$ cp public/.htaccess-dist public/.htaccess
```

Now configure.  
Edit [`.htaccess`](https://github.com/opsone/limonade-template/blob/composer/public/.htaccess-dist#L9) file and apply your `RewriteBase`.
And the same base path in [`development.php`](https://github.com/opsone/limonade-template/blob/composer/config/environments/development.php#L10)
