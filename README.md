# PHP Framework

Пользовательский PHP фреймворк, построенный с использованием современных практик разработки.

## Структура проекта

```
php-framework/
├── public/          # Публичная директория
│   └── index.php    # Точка входа
├── app/             # Код приложения (PSR-4: App\)
├── framework/       # Ядро фреймворка (PSR-4: Yelarys\Framework\)
│   └── http/        # HTTP компоненты
│       └── Request.php # Класс для работы с HTTP запросами
├── vendor/          # Зависимости Composer
├── .lando.yml       # Конфигурация Lando
├── composer.json    # Конфигурация Composer
└── .gitignore       # Правила игнорирования Git
```

## Требования

- PHP 8.2+
- Composer
- Lando (для локальной разработки)

## Установка

1. Клонируйте репозиторий:
   ```bash
   git clone <repository-url>
   cd php-framework
   ```

2. Установите зависимости:
   ```bash
   composer install
   ```

3. Запустите среду разработки:
   ```bash
   lando start
   ```

## Архитектура фреймворка

### Компоненты ядра

- **HTTP**: Компоненты для работы с HTTP запросами и ответами
  - `Yelarys\Framework\Http\Request` - обработка входящих запросов

### Принципы разработки

- **PSR-4 автозагрузка**: Стандартная организация классов
- **Namespace разделение**: Четкое разделение кода приложения и фреймворка
- **Современный PHP**: Использование PHP 8.2+ возможностей

## Работа с HTTP запросами

Фреймворк предоставляет класс `Request` для работы с входящими HTTP запросами:

```php
use Yelarys\Framework\Http\Request;

// Создание объекта запроса из глобальных переменных
$request = Request::createFromGlobals();
```

Класс `Request` инкапсулирует:
- GET параметры
- POST данные
- Cookies
- Загруженные файлы
- Серверные переменные

## Среда разработки

Проект использует [Lando](https://lando.dev/) для локальной разработки с:

- **Рецепт**: LEMP (Linux, Nginx, MySQL, PHP)
- **Версия PHP**: 8.2
- **База данных**: MySQL
- **Корневая директория**: `public/`
- **Дополнительные сервисы**: phpMyAdmin

### Команды Lando

```bash
# Запуск среды
lando start

# Остановка среды
lando stop

# Перезапуск среды
lando restart

# Доступ к приложению
# URL будет отображен после выполнения 'lando start'

# Доступ к phpMyAdmin
# URL будет отображен после выполнения 'lando start'

# Выполнение команд composer
lando composer install
lando composer update

# Доступ к PHP CLI
lando php -v

# Выполнение PHP скриптов
lando php public/index.php

# Доступ к контейнеру
lando ssh
```

## Инструменты разработки

- **Форматирование кода**: Laravel Pint
- **Отладка**: Symfony VarDumper

### Форматирование кода

Запустите Laravel Pint для форматирования кода:

```bash
# Проверка стиля кода
lando composer exec pint

# Исправление стиля кода
lando composer exec pint --fix
```

### Отладка

Используйте Symfony VarDumper для отладки:

```php
// В любом месте кода
dump($variable); // Вывод переменной
dd($variable);   // Вывод переменной и остановка выполнения
```

## Автозагрузка

Проект использует автозагрузку PSR-4:

- `App\` → директория `app/` (код приложения)
- `Yelarys\Framework\` → директория `framework/` (ядро фреймворка)

### Создание новых классов

Для создания новых классов следуйте структуре namespace:

```php
// Файл: app/Controllers/HomeController.php
<?php

namespace App\Controllers;

class HomeController 
{
    // Код контроллера
}
```

```php
// Файл: framework/routing/Router.php
<?php

namespace Yelarys\Framework\Routing;

class Router 
{
    // Код роутера
}
```
