## SilverStripe Versioned Snapshots

[![Build Status](https://api.travis-ci.org/silverstripe/silverstripe-fluent-snapshots.svg?branch=master)](https://travis-ci.org/silverstripe/silverstripe-fluent-snapshots)
[![SilverStripe supported module](https://img.shields.io/badge/silverstripe-supported-0071C4.svg)](https://www.silverstripe.org/software/addons/silverstripe-commercially-supported-module-list/)
[![Latest Stable Version](https://poser.pugx.org/silverstripe/versioned/version.svg)](http://www.silverstripe.org/stable-download/)
[![Latest Unstable Version](https://poser.pugx.org/silverstripe/fluent-snapshots/v/unstable.svg)](https://packagist.org/packages/silverstripe/fluent-snapshots)
[![Total Downloads](https://poser.pugx.org/silverstripe/fluent-snapshots/downloads.svg)](https://packagist.org/packages/silverstripe/fluent-snapshots)
[![License](https://poser.pugx.org/silverstripe/fluent-snapshots/license.svg)](https://github.com/silverstripe/silverstripe-fluent-snapshots#license)
[![Dependency Status](https://www.versioneye.com/php/silverstripe:fluent-snapshots/badge.svg)](https://www.versioneye.com/php/silverstripe:fluent-snapshots)
[![Reference Status](https://www.versioneye.com/php/silverstripe:admin/reference_badge.svg?style=flat)](https://www.versioneye.com/php/silverstripe:admin/references)
![helpfulrobot](https://helpfulrobot.io/silverstripe/fluent-snapshots/badge)

## Overview

Enables snapshots to work with the [Fluent](https://github.com/tractorcow/silverstripe-fluent) translation module for SilverStripe.

## Installation

```
$ composer require silverstripe/fluent-snapshots
```

You'll also need to run `dev/build`.

## Versioning

This library follows [Semver](http://semver.org). According to Semver,
you will be able to upgrade to any minor or patch version of this library
without any breaking changes to the public API. Semver also requires that
we clearly define the public API for this library.

All methods, with `public` visibility, are part of the public API. All
other methods are not part of the public API. Where possible, we'll try
to keep `protected` methods backwards-compatible in minor/patch versions,
but if you're overriding methods then please test your work before upgrading.

## Reporting Issues

Please [create an issue](http://github.com/silverstripe/silverstripe-fluent-snapshots/issues)
for any bugs you've found, or features you're missing.

## License

This module is released under the [BSD 3-Clause License](LICENSE)
