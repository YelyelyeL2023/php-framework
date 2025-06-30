# PHP Framework

Пользовательский PHP фреймворк, построенный с использованием современных практик разработки и FastRoute для маршрутизации.

## Структура проекта

```
php-framework/
├── public/          # Публичная директория
│   └── index.php    # Точка входа
├── app/             # Код приложения (PSR-4: App\)
│   ├── HomeController.php     # Контроллер главной страницы
│   └── PostController.php     # Контроллер постов
├── framework/       # Ядро фреймворка (PSR-4: Yelarys\Framework\)
│   ├── http/        # HTTP компоненты
│   │   ├── Kernel.php    # HTTP ядро и обработчик маршрутов
│   │   ├── Request.php   # Класс для работы с HTTP запросами
│   │   └── Response.php  # Класс для HTTP ответов
│   └── Routing/     # Система маршрутизации
│       └── Route.php     # Фасад для создания маршрутов
├── routes/          # Файлы маршрутов
│   └── web.php      # Веб-маршруты приложения
├── vendor/          # Зависимости Composer
├── .lando.yml       # Конфигурация Lando
├── composer.json    # Конфигурация Composer
└── .gitignore       # Правила игнорирования Git
```

## Требования

- PHP 8.2+
- Composer
- nikic/fast-route для маршрутизации
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

- **HTTP Kernel**: [`Yelarys\Framework\Http\Kernel`](framework/http/Kernel.php) - центральный обработчик HTTP запросов
- **Request**: [`Yelarys\Framework\Http\Request`](framework/http/Request.php) - обработка входящих запросов
- **Response**: [`Yelarys\Framework\Http\Response`](framework/http/Response.php) - формирование HTTP ответов
- **Route**: [`Yelarys\Framework\Routing\Route`](framework/Routing/Route.php) - фасад для создания маршрутов

### Принципы разработки

- **PSR-4 автозагрузка**: Стандартная организация классов
- **Namespace разделение**: Четкое разделение кода приложения и фреймворка
- **Современный PHP**: Использование PHP 8.2+ возможностей
- **FastRoute integration**: Быстрая и эффективная маршрутизация

## Маршрутизация

Фреймворк использует FastRoute для обработки маршрутов. Маршруты определяются в файле [`routes/web.php`](routes/web.php):

```php
<?php
use App\Controllers\HomeController;
use App\Controllers\PostController;
use Yelarys\Framework\Routing\Route;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/posts/{id:\d+}', [PostController::class, 'show'])
];
```

### Создание маршрутов

Доступные методы:

```php
// GET маршрут
Route::get('/path', [Controller::class, 'method'])

// POST маршрут  
Route::post('/path', [Controller::class, 'method'])

// Маршрут с параметрами
Route::get('/posts/{id:\d+}', [PostController::class, 'show'])
Route::get('/users/{name:[a-zA-Z]+}', [UserController::class, 'profile'])
```

### Параметры маршрутов

Фреймворк поддерживает параметры маршрутов с регулярными выражениями:

- `{id:\d+}` - только цифры
- `{name:[a-zA-Z]+}` - только буквы
- `{slug:[a-zA-Z0-9-]+}` - буквы, цифры и дефисы

## Контроллеры

Контроллеры должны возвращать объект [`Response`](framework/http/Response.php):

```php
<?php
namespace App\Controllers;

use Yelarys\Framework\Http\Response;

class HomeController
{
    public function index(): Response
    {
        return new Response("Добро пожаловать!", 200);
    }
}
```

### Контроллер с параметрами

```php
<?php
namespace App\Controllers;

use Yelarys\Framework\Http\Response;

class PostController
{
    public function show(int $id): Response
    {
        $content = "<h1>Post - $id</h1>";
        return new Response($content);
    }
}
```

## Работа с HTTP

### Request (Запросы)

Класс [`Request`](framework/http/Request.php) предоставляет доступ к данным запроса:

```php
use Yelarys\Framework\Http\Request;

$request = Request::createFromGlobals();

// Получение пути
$path = $request->getPath();

// Получение HTTP метода
$method = $request->getMethod();
```

### Response (Ответы)

Класс [`Response`](framework/http/Response.php) для формирования ответов:

```php
use Yelarys\Framework\Http\Response;

// Простой ответ
$response = new Response("Hello World");

// Ответ с кодом состояния
$response = new Response("Not Found", 404);

// Отправка ответа
$response->send();
```

## Жизненный цикл запроса

1. **Входная точка**: [`public/index.php`](public/index.php) принимает все запросы
2. **Создание Request**: Создается объект запроса из глобальных переменных
3. **HTTP Kernel**: [`Kernel::handle()`](framework/http/Kernel.php) обрабатывает запрос
4. **Маршрутизация**: FastRoute находит соответствующий маршрут
5. **Контроллер**: Вызывается метод контроллера
6. **Response**: Формируется и отправляется ответ

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

- **Маршрутизация**: nikic/fast-route
- **Форматирование кода**: Laravel Pint
- **Отладка**: Symfony VarDumper

### Форматирование кода

```bash
# Проверка стиля кода
lando composer exec pint

# Исправление стиля кода
lando composer exec pint --fix
```

### Отладка

```php
// В любом месте кода
dump($variable); // Вывод переменной
dd($variable);   // Вывод переменной и остановка выполнения
```

## Автозагрузка

Проект использует автозагрузку PSR-4:

- `App\` → директория `app/` (код приложения)
- `Yelarys\Framework\` → директория `framework/` (ядро фреймворка)

### Создание новых контроллеров

```php
// Файл: app/Controllers/UserController.php
<?php

namespace App\Controllers;

use Yelarys\Framework\Http\Response;

class UserController 
{
    public function profile(string $name): Response
    {
        return new Response("<h1>Профиль: $name</h1>");
    }
}
```

Добавьте маршрут в [`routes/web.php`](routes/web.php):

```php
Route::get('/users/{name:[a-zA-Z]+}', [UserController::class, 'profile'])
```

## Обработка ошибок

Фреймворк автоматически обрабатывает:

- **404 Not Found** - маршрут не найден
- **405 Method Not Allowed** - неподдерживаемый HTTP метод
- **500 Internal Server Error** - внутренняя ошибка сервера

## Примеры использования

### Простая страница

```php
// routes/web.php
Route::get('/about', [AboutController::class, 'index'])

// app/Controllers/AboutController.php
class AboutController
{
    public function index(): Response
    {
        return new Response("<h1>О нас</h1><p>Информация о компании</p>");
    }
}
```

### API endpoint

```php
// routes/web.php
Route::get('/api/posts/{id:\d+}', [ApiController::class, 'getPost'])

// app/Controllers/ApiController.php
class ApiController
{
    public function getPost(int $id): Response
    {
        $data = json_encode(['id' => $id, 'title' => 'Post Title']);
        return new Response($data, 200);
    }
}
```