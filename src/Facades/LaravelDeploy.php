<?php

namespace BenQoder\LaravelDeploy\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \BenQoder\LaravelDeploy\LaravelDeploy
 */
class LaravelDeploy extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \BenQoder\LaravelDeploy\LaravelDeploy::class;
    }
}
