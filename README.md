Sequence Provider for Faker
---

This package will allow [Faker](https://github.com/FakerPHP/Faker) to generate
incrementing, decrementing and manual sequences.

[![Build Status](https://travis-ci.org/dlnsk/faker-sequence.svg?branch=master)](https://travis-ci.org/dlnsk/faker-sequence)

## Install

To install, use composer:

```bash
composer require dlnsk/faker-sequence
```

## Use

```php
# When installed via composer
require_once 'vendor/autoload.php';

$faker = \Faker\Factory::create();
$faker->addProvider(new \Faker\Provider\Sequence($faker));
```

```
echo $faker->initSequence();
```

## License

This package is under the WTFPL license. Do whatever you want with it.

[LICENSE](https://github.com/dlnsk/faker-sequence/LICENSE)

## Reporting an issue or a feature request

Fork it, send a PR. Issues and feature requests are tracked in the
[GitHub issue tracker](https://github.com/dlnsk/faker-sequence/issues).
