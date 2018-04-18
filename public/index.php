<?php
require_once dirname(__DIR__) . '/config/init.php';
require_once LIBS . '/functions.php';
use \webshop\App;

new App();

throw new Exception('Page not Found', 500);