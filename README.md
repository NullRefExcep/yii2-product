Yii2 Product
===============
[![Latest Stable Version](https://poser.pugx.org/nullref/yii2-product/v/stable)](https://packagist.org/packages/nullref/yii2-product) [![Total Downloads](https://poser.pugx.org/nullref/yii2-product/downloads)](https://packagist.org/packages/nullref/yii2-product) [![Latest Unstable Version](https://poser.pugx.org/nullref/yii2-product/v/unstable)](https://packagist.org/packages/nullref/yii2-product) [![License](https://poser.pugx.org/nullref/yii2-product/license)](https://packagist.org/packages/nullref/yii2-product)

Module for products management

!!! This project is under development and not ready for production !!!
-----------------------------
 
**The main idea of this package is providing a flexible way to configure product entities at the website.**

**For those purposes, now we have another solution that calls [EAV](https://github.com/NullRefExcep/yii2-eav).**

**At this moment  we recommend you to check it instead of this package.**


Main features
-------------

- configure different types of products (e.g. configurable, grouped, simple)
- defining properties and options for products entities
- ability to extend base features to add new types of products and properties

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist nullref/yii2-product "*"
```

or add

```
"nullref/yii2-product": "*"
```

to the require section of your `composer.json` file.

Then You have run console command for install this module:

```
php yii module/install product
```

and module will be added to your application config (`@app/config/installed_modules.php`)

Using with yii2-admin module
----------------------------

You can use this module with [Yii2 Admin](https://github.com/NullRefExcep/yii2-admin) module.
