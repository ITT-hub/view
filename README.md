# Мини шаблонизатор

Установка

```bash
composer install
```

### Подключение
Подключите автозагрузчик
```php
<?php
require_once "/vendor/autoload.php";
```

Создайте обьект шаблонизатора, передав в него в качестве параметров путь до файлов шаблона. При необходимости можно передать время кэширования в секундах, если параметр не указан кэширование происходить не будет

```php
<?php
use ITTech\View\View;

$view = new View($_SERVER["DOCUMENT_ROOT"]."/templates", 3600 * 24);
```

Вывод на экран осуществляется при помощи метода render с передачей в него в качестве параметра имени файла шаблона

```php
<?php
echo $view->render("index.php");
```

В качестве второго параметра можно передать массив, ключи которого будут доступны в шаблоне в качестве переменных

```php
<?php
echo $view->render("index.php", ["title" => "Заголовок страницы"]);
```