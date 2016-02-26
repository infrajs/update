<?php
namespace infrajs\update;
use infrajs\config\Config;
use infrajs\path\Path;
use infrajs\each\Each;

class Update {
	public static $is = false;
	public static function update($name)
	{
		$conf = Config::get($name);
		Each::exec($conf['dependencies'], function ($name) {
			Update::update($name);
		});
		if ($conf['update']) Path::req('-'.$name.'/'.$conf['update']);
	}
	public static function exec()
	{
		if (Update::$is) return;
		Update::$is = true;
		$conf = Config::$conf;
		foreach($conf as $name => $v) {
			Update::update($name);
		}
		Config::add('update', function ($name, $value, $conf) {
			if (!Update::$is) return;
			Path::req('-'.$name.'/'.$value);
		});
		Config::get();
	}
}