# extas-access

Пакет для управления правами доступа.

Пакет реализует модель "всё, что не разрешено, запрещено".

# Установка

`composer require jeyroik/extas-access:*`

# Использование

## Установка доступа для вашего пакета

Если ваш пакет (приложение) предусматривает какой-либо предустановленный доступ, то его установку можно организовать следующим образом:

- Добавить доступ в extas-совместимую конфигурацию
```json
{
  "access": [
    {"object": "jeyroik", "section": "api", "subject": "app", "operation": "delete"}
  ]
}
```
- Запустить установку сущностей `/vendor/bin/extas i`

## Создание доступа

```php
use \extas\interfaces\access\IAccess;

$operation = new \extas\components\access\AccessOperation([
    IAccess::FIELD__OBJECT => 'player.name',
    IAccess::FIELD__SECTION => 'api',
    IAccess::FIELD__SUBJECT => 'player',
    IAccess::FIELD__OPERATION => 'create'
]);

if (!$operation->exists()) {
    $operation->create();
}
```

## Проверка доступа

Мало чем отличается от создания.

```php
use \extas\interfaces\access\IAccess;

$operation = new \extas\components\access\AccessOperation([
    IAccess::FIELD__OBJECT => 'player.name',
    IAccess::FIELD__SECTION => 'api',
    IAccess::FIELD__SUBJECT => 'player',
    IAccess::FIELD__OPERATION => 'create'
]);

if (!$operation->exists()) {
    echo 'Нет доступа';
}
```