![tests](https://github.com/jeyroik/extas-access/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/extas-access/coverage.svg?branch=master)

# Описание

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

## Пример комбинированного доступа на основе существующих

`/resources/examples/CombinedAccess.php`

```php
<?php
namespace my\extas\access;

use extas\components\access\AccessOperation;
use extas\components\access\objects\ObjectRoot;
use extas\components\access\operations\OperationCreate;
use extas\components\access\sections\SectionData;
use extas\components\access\subjects\SubjectAccess;

class CombinedAccess extends AccessOperation
{
    /**
     * @return array
     */
    protected function getDefaults(): array
    {
        $object = new ObjectRoot();
        $section = new SectionData();
        $subject = new SubjectAccess();
        $operation = new OperationCreate();

        return array_merge(
            $object->__toArray(),
            $section->__toArray(),
            $subject->__toArray(),
            $operation->__toArray()
        );
    }
}

$combined = new CombinedAccess();
if ($combined->exists()) {
    echo 'Root can data access create';
}

```