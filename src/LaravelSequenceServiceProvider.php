<?php
namespace Dlnsk\Faker;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;

/**
 * Faker provider for generating incrementing, decrementing and manual sequences.
 * Package auto discovering for Laravel.
 *
 * @author: Dmitry Pupinin
 */
class LaravelSequenceServiceProvider extends ServiceProvider {

    /**
     * This will be used to register config & view in
     * package namespace.
     */
    protected $packageName = 'faker-sequence';

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register ()
    {
        $this->app->singleton(Generator::class, function() {
            $faker = Factory::create();
            $faker->addProvider(new SequenceProvider($faker));

            return $faker;
        });

    }

}