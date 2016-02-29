# Расширение [infrajs/config](https://github.com/infrajs/config) обрабатывается свойство update
**Disclaimer:** Module is not complete and not ready for use yet.

```json
{
	"update":"update.php" //Файл расширения, который нужно выполнить при обновлении или установки системы
}
```

Стандартное свойство "require" (автоматического подключения расширения) выполняется после "update".
Разница в том, что "require" выполняется постоянно, а "update" выполняется только в момент запуска Update::exec(); Запуск происходит при наличии файла ~update или при отсутствии папки кэша ! или при появлении в адресе ключа -update=true