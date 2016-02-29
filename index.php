<?php
	namespace infrajs\update;
	use infrajs\access\Access;
	use infrajs\ans\Ans;
	use infrajs\once\Once;
	use infrajs\path\Path;

	$ans = array();
	
	if (Update::$is) return Ans::ret($ans, 'update итак запущен');

	Access::test(true);	
	Path::fullrmdir(Path::$conf['cache']);
	Update::exec();
	

	
	return Ans::ret($ans);
?>