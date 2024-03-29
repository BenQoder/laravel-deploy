<?php

namespace BenQoder\LaravelDeploy;

use BenQoder\LaravelDeploy\Commands\LaravelDeployCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelDeployServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-deploy')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-deploy_table')
            ->hasCommand(LaravelDeployCommand::class);
    }
}
