<?php

namespace Durin\Foundation;

use Phalcon\Mvc\Dispatcher as PhalconDispatcher;

class Dispatcher extends PhalconDispatcher
{
    protected $_actionSuffix = '';
    protected $_handlerSuffix = 'Controller';
    protected $_defaultHandler = 'index';
    protected $_defaultAction = 'index';
}