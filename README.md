Sequence Provider for Faker
---

This package will allow [Faker](https://github.com/FakerPHP/Faker) to generate
incrementing, decrementing and manual sequences.

[![tests](https://github.com/dlnsk/faker-sequence/actions/workflows/tests.yml/badge.svg)](https://github.com/dlnsk/faker-sequence/actions/workflows/tests.yml)
[![Latest Stable Version](http://poser.pugx.org/dlnsk/faker-sequence/v)](https://packagist.org/packages/dlnsk/faker-sequence)
[![License](http://poser.pugx.org/dlnsk/faker-sequence/license)](https://packagist.org/packages/dlnsk/faker-sequence)

## Install

To install, use composer:

```bash
composer require dlnsk/faker-sequence
```


## Use

#### Laravel
This package supports Laravel's auto discovering, so you don't have to do anything else.

If you want to use the package in tests initialize sequences in ```setUp```:
```php
public function setUp(): void {
    ...
    $faker = app(\Faker\Generator::class);
    $faker->initSequence('seq_name', ['one', 'two']);
}
```

#### Other frameworks
```php
# When installed via composer
require_once 'vendor/autoload.php';

$faker = \Faker\Factory::create();
$faker->addProvider(new \Dlnsk\Faker\SequenceProvider($faker));
```

## Generate
### Numeric sequences
#### Quick use
```php
echo $faker->nextInSequence('seq_name');    // 0
echo $faker->nextInSequence('seq_name');    // 1

$faker->resetSequence('seq_name');
echo $faker->nextInSequence('seq_name');    // 0
```

#### Initialization
```php
$faker->initSequence(
    $name,          // Sequence name. You can use number of sequences simultaneously
    $start = 0,     // Starting value
    $step = 1,      // Sequence step, may be positive or negative
    $bound = null,  // Value that can be reached
    $loop = false   // Loop sequence or throw the exception NoMoreException on the bound
);
```

#### Improved use
```php
$faker->initSequence('seq_name', 10, -2);
echo $faker->nextInSequence('seq_name');    // 10
echo $faker->nextInSequence('seq_name');    // 8

$faker->initSequence('seq_name', 0, 2, 5);
echo $faker->nextInSequence('seq_name');    // 0
echo $faker->nextInSequence('seq_name');    // 2
echo $faker->nextInSequence('seq_name');    // 4
echo $faker->nextInSequence('seq_name');    // throw NoMoreException

$faker->initSequence('seq_name', 0, 2, 5, true);
echo $faker->nextInSequence('seq_name');    // 0
echo $faker->nextInSequence('seq_name');    // 2
echo $faker->nextInSequence('seq_name');    // 4
echo $faker->nextInSequence('seq_name');    // 0
```

### Iterable sequences

#### Initialization
```php
$faker->initSequence(
    $name,          // Sequence name. You can use number of sequences simultaneously
    $collection,    // Array or iterable object
    $loop = false   // Loop sequence or throw the exception NoMoreException on the end
);
```

#### Using
```php
$faker->initSequence('seq_name', ['one', 'two']);
echo $faker->nextInSequence('seq_name');    // one
echo $faker->nextInSequence('seq_name');    // two
echo $faker->nextInSequence('seq_name');    // throw NoMoreException

$faker->initSequence('seq_name', ['one', 'two'], true)
echo $faker->nextInSequence('seq_name');    // one
echo $faker->nextInSequence('seq_name');    // two
echo $faker->nextInSequence('seq_name');    // one

$singers = Employee::where('salary', '>', 10000)->get();
$faker->initSequence('seq_name', $singers);
echo $faker->nextInSequence('seq_name');    // { 'firstname' => 'Bob', 'lastname' => 'Dylan'}
echo $faker->nextInSequence('seq_name');    // { 'firstname' => 'Laura', 'lastname' => 'Marling'}
```

## License

This package is under the WTFPL license. Do whatever you want with it.

[LICENSE](https://github.com/dlnsk/faker-sequence/blob/master/LICENSE)

## Reporting an issue or a feature request

Fork it, send a PR. Issues and feature requests are tracked in the
[GitHub issue tracker](https://github.com/dlnsk/faker-sequence/issues).
