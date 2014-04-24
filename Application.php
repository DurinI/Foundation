<?php

namespace Durin\Foundation;

use Exception,
    Durin\Container\DIContainer,
    Phalcon\Mvc\Application as PhalconApplication;


class Application extends DIContainer
{
    public function run()
    {
        $engine = new PhalconApplication($this);
        echo $engine->handle()->getContent();
    }

    public function bindPaths(array $paths)
    {
        foreach ($paths as $key => $value)
        {
            $this->set("path.{$key}", function() use ($value)
            {
                return realpath($value);
            }, true);
        }
    }
    
    public function resolveProviderClass($provider)
    {
        return new $provider($this);
    }
}