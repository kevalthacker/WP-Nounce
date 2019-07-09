# WPNonce

**```Under progress```**

## Requirements

- PHP 7.0+
- Composer
- WordPress 4.8.3+

## Installation

Install with [Composer](https://getcomposer.org):

```sh
$ composer require kevalthacker/wp-nonces:dev-master
```

Features
--------

* Follow Inpsyde PHP Codex Standard (https://github.com/inpsyde/php-coding-standards)
* Unit-Testing with PHPUnit
* Object-oriented architecture

## Usage

Initialize the WPNonce object  

**```$generator = new WPNonce( 'action_name', 'nonce_parameter_name', 'nonce_life' );```**

Then, to generate the nonce use the wpnonceGenerate() method:

**```$nonce = $generator->wpnonceGenerate();```**
  
Generate a url with nonce parameter:

**```$url = $generator->wpnonceGenerate( '_URL','''http://www.thinkovi.com' );```**

Generate nonce field:

**``$field = $generator->wpnonceGenerate('_Form');``**  

Nonce validation:

**``$isValid = $generator->wpnonceValidate($nonce);``**
