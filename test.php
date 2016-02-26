<?php
namespace infrajs\update;
use infrajs\ans\Ans;

$ans = array();
if (Update::$is) return Ans::ret($ans, 'Сейчас идёт обновление');
return Ans::ret($ans, 'Обновление сейчас не идёт');