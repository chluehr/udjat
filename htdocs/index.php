<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xris
 * Date: 6/21/11
 * Time: 1:01 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Udjat;

error_reporting(E_ALL);
ini_set('display_errors', true);

require_once
    implode(
        DIRECTORY_SEPARATOR,
        array(dirname(__FILE__), '..', 'src', 'Udjat', 'Bootstrap.php')
    );

Bootstrap::init();
$dispatcher = new Dispatcher();
$dispatcher->dispatch();

