# Oops/MorozkoDoctrineBridge

:warning: **THIS PACKAGE IS NO LONGER MAINTAINED.** Instead, you can use any Symfony/Console integration such as [contributte/console](https://github.com/contributte/console) and use the `orm:generate-proxies` command directly.

[![Build Status](https://img.shields.io/travis/o2ps/MorozkoDoctrineBridge.svg)](https://travis-ci.org/o2ps/MorozkoDoctrineBridge)
[![Downloads this Month](https://img.shields.io/packagist/dm/oops/morozko-doctrine-bridge.svg)](https://packagist.org/packages/oops/morozko-doctrine-bridge)
[![Latest stable](https://img.shields.io/packagist/v/oops/morozko-doctrine-bridge.svg)](https://packagist.org/packages/oops/morozko-doctrine-bridge)

This package provides a [Doctrine](https://github.com/doctrine/doctrine2) metadata cache warmer for [Morozko](https://github.com/o2ps/Morozko).


## Installation and requirements

```bash
$ composer require oops/morozko-doctrine-bridge
```

Oops/MorozkoDoctrineBridge requires PHP >= 7.1.

This bridge requires that Morozko is set up correctly; please refer to its README for instructions.


## Usage

Register the extension in your config file, along with Morozko and a Symfony/Console integration:

```yaml
extensions:
    morozko: Oops\Morozko\DI\MorozkoExtension
    morozko.doctrine: Oops\MorozkoDoctrineBridge\DI\MorozkoDoctrineBridgeExtension
    console: Kdyby\Console\DI\ConsoleExtension
```

When you run the `oops:morozko:warmup` command, Doctrine cache warmer will warm up Doctrine metadata cache and generate entity proxies.
