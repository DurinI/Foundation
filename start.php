<?php

use Durin\Foundation\AliasLoader,
    Durin\Foundation\Dispatcher,
    Durin\Config\Repository as Config,
    Durin\Config\FileLoader,
    Durin\Filesystem\Filesystem,
    Durin\Support\Facade\Facade;

$app->setShared('app', $app);

$app->setShared('config', $config = new Config(

    new FileLoader(new Filesystem, $app['path.app'].'/config'), null

));

AliasLoader::getInstance($config->get('app.aliases'))->register();
Facade::clearResolvedInstances();
Facade::setFacadeApplication($app);

foreach($config->get('app.providers') as $provider)
{
    $app->resolveProviderClass($provider)->register();
}

$app->set('dispatcher', function() 
{
    $dispatcher = new Dispatcher;
    $dispatcher->setEventsManager(App::get('eventsManager'));
    return $dispatcher;
});