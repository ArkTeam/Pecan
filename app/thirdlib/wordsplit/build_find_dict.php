<?php
require_once 'Dict.php';

define('ROOT', dirname(__FILE__));
$dict = new Dict(ROOT . '/data/coreDict.dct');

$dict->buildFindDict(ROOT . '/data/coreDict.find');