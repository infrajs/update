<?php
namespace infrajs\update;
use infrajs\config\Config;
use infrajs\path\Path;
use infrajs\each\Each;
use infrajs\ans\Ans;
use infrajs\once\Once;
use infrajs\access\Access;

class Update {
	public static $is = false;
	public static function check()
	{
		Once::func(function (){
			$action = Ans::GET('-update');
			$path = Path::$conf;
			if ($action) {
				Access::test(true);
				if (!Update::$is) {
					Path::fullrmdir($path['cache']);
					Update::exec();
				}
			}
			

			if ($path['fs'] && !Update::$is) {
				if (!is_dir($path['cache']) || !is_file($path['cache'].'/.infra.json')) {
					Access::$conf['test'] = true;
					Update::exec();
				}
				if (Access::isTest()) {
					if (is_file($path['data'].'update')) {
						unlink($path['data'].'update');
						Access::$conf['test'] = true;
						if (!Update::$is) {
							Path::fullrmdir($path['cache']);
							Update::exec();
						}
					}
				}
			}

			if (Update::$is) {
				if(is_file($path['data'].'update')) {
					unlink($path['data'].'update');
				}
			}
		});
	}
	public static function update($name)
	{
		Once::func( function ($name){
			$conf = Config::get($name);
			if (!empty($conf['off'])) return;
			Each::exec($conf['dependencies'], function &($name) {
				$r = null;
				Update::update($name);
				return $r;
			});
			if (!empty($conf['update'])) {
				Path::req('-'.$name.'/'.$conf['update']);
			}
		}, [$name]);
	}
	public static function exec()
	{
		if (!Update::$is) {
			Config::add('update', function ($name, $value, $conf) {
				if (!Update::$is) return;
				//if (!empty($conf['off'])) return;
				Path::req('-'.$name.'/'.$value);
			});
		}

		Update::$is = true;
		//Пр появлении нового Config::get будет проверяться свойство update
		
		//Но нужно установить то что уже было установлено
		$conf = Config::$conf;
		
		foreach ($conf as $name => $v) {
			Update::update($name);
		}
		//И вообще всё установить нужно что ещё не установлено
		Config::get();
	}
}
