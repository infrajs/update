<?php
use infrajs\ans\Ans;
use infrajs\update\Update;

Update::check();

$ans = array();
if (Update::$is) return Ans::ret($ans, 'Сейчас идёт обновление');
return Ans::ret($ans, 'Обновление сейчас не идёт');