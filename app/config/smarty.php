<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$smarty = new Smarty\Smarty();

$smarty->setTemplateDir(__DIR__ . '/../views/templates/');
$smarty->setCompileDir(__DIR__ . '/../../tmp/templates_c/');
$smarty->setCacheDir(__DIR__ . '/../../tmp/cache/');
$smarty->debugging = false;
$smarty->error_reporting = E_ALL;
$smarty->force_compile = false;
return $smarty;