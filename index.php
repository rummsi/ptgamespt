<?php

/* 
 * PTGamesPT
 * Copyright (C) 2012 -2017
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should read the GNU General Public License, see <http://www.gnu.org/licenses/>.
 * 
 * PTGamesPT
 * @author PTGamesPT Team <geral@ptgames.pt>
 * @index.php
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 0.01  5/fev/2017 14:09:08
 */

define('INSIDE', true);
define('INSTALL', false);
define('DISABLE_IDENTITY_CHECK', true);
require_once dirname(__FILE__) . '/common.php';

$page = filter_input(INPUT_GET, 'page');
$mode1 = filter_input(INPUT_GET, 'mode');
$mode = str_replace(array('_', '\\', '/', '.', "\0"), '', $mode1);

$pageClass = ucwords($page);
if (empty($page)) {
    $pageClass = 'login';
}
includeLang('login');

// Added Autoload in feature Versions
//require(ROOT_PATH . $pageClass . '.php');
require(ROOT_PATH . 'includes/classes/Ptgames/Index/' . $pageClass . '.php');

$pageObj = new $pageClass;

$pageObj->{$mode}();
