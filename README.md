![tests](https://github.com/jeyroik/extas-access/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/extas-access/coverage.svg?branch=master)
<a href="https://codeclimate.com/github/jeyroik/extas-access/maintainability"><img src="https://api.codeclimate.com/v1/badges/ffff257103af0ab71a9c/maintainability" /></a>
[![Latest Stable Version](https://poser.pugx.org/jeyroik/extass-access/v)](//packagist.org/packages/jeyroik/extass-access)
[![Total Downloads](https://poser.pugx.org/jeyroik/extass-access/downloads)](//packagist.org/packages/jeyroik/extass-access)
[![Dependents](https://poser.pugx.org/jeyroik/extass-access/dependents)](//packagist.org/packages/jeyroik/extass-access)

# Описание

Пакет для управления правами доступа.

Пакет реализует модель "всё, что не разрешено, запрещено".

# Установка

`composer require jeyroik/extas-access:4.*`

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
use \extas\components\access\Access;
use \extas\components\access\AccessService;

$access = new \extas\components\access\Access([
    IAccess::FIELD__OBJECT => 'player.name',
    IAccess::FIELD__SECTION => 'api',
    IAccess::FIELD__SUBJECT => 'player',
    IAccess::FIELD__OPERATION => 'create'
]);

$accessService = new AccessService();

if (!$accessService->isGranted($access)) {
    $accessService->grant($access);
}
```

## Проверка доступа

Мало чем отличается от создания.

```php
use \extas\interfaces\access\IAccess;
use \extas\components\access\Access;
use \extas\components\access\AccessService;

$access = new \extas\components\access\Access([
    IAccess::FIELD__OBJECT => 'player.name',
    IAccess::FIELD__SECTION => 'api',
    IAccess::FIELD__SUBJECT => 'player',
    IAccess::FIELD__OPERATION => 'create'
]);

$accessService = new AccessService();

if ($accessService->isGranted($access)) {
    echo 'Access granted';
}
```