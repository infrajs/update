<?php
	namespace infrajs\update;
	use infrajs\access\Access;
	use infrajs\ans\Ans;
	use infrajs\path\Path;

	Access::test(true);

	Path::fullrmdir(Path::$conf['cache']);

	$ans = array();
	Update::exec();

	return Ans::ret($ans);
?>