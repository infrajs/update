<?php
namespace infrajs\update;
use infrajs\ans\Ans;
if (!is_file('vendor/autoload.php')) {
	chdir('../../../');
	require_once('vendor/autoload.php');
}
Update::init();

$ans = array();
if (Update::$is) return Ans::ret($ans, 'Сейчас идёт обновление');
return Ans::ret($ans, 'Обновление сейчас не идёт');