# PHP Framework

Пользовательский PHP фреймворк, построенный с использованием современных практик разработки.

## Структура проекта

```
php-framework/
├── public/          # Публичная директория
│   └── index.php    # Точка входа
├── app/             # Код приложения (PSR-4: App\)
├── framework/       # Ядро фреймворка (PSR-4: Yelarys\Framework\)
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

# Доступ к приложению
# URL будет отображен после выполнения 'lando start'

# Доступ к phpMyAdmin
# URL будет отображен после выполнения 'lando start'

# Выполнение команд composer
lando composer install
lando composer update

# Доступ к PHP CLI
lando php -v
```

## Инструменты разработки

- **Форматирование кода**: Laravel Pint
- **Отладка**: Symfony VarDumper

### Форматирование кода

Запустите Laravel Pint для форматирования кода:

```bash
lando composer exec pint
```

## Автозагрузка

Проект использует автозагрузку PSR-4:

- `App\` → директория `app/`
- `Yelarys\Framework\` → директория `framework/`

