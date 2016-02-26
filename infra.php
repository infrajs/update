<?php

namespace infrajs\update;

use infrajs\ans\Ans;
use infrajs\path\Path;
use infrajs\config\Config;
use infrajs\access\Access;

$action = Ans::GET('-update');
$path = Config::get('path');
if ($action) {
	Access::test(true);
	if (!Update::$is) {
		Path::fullrmdir($path['cache']);
		Update::exec();
	}
}


if ($path['fs']) {
	if (!is_dir($path['cache'])) {
		Access::$conf['test'] = true;
		Update::exec();
	}
	if(is_file($path['data'].'update')) {
		unlink($path['data'].'update');
		Access::$conf['test'] = true;
		if (!Update::$is) {
			header('Infrajs-Path-Update:true');
			Path::fullrmdir($path['cache']);
			Update::exec();
		}
	}	
}

if(!Access::adminTime()){
	Update::exec();
}

?>