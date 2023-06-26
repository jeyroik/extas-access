<?php

use extas\components\repositories\RepoItem;

return [
    "name" => "extas\access",
    "tables" => [
        "access" => [
            "namespace" => "extas\\repositories",
            "item_class" => "extas\\components\\access\\Access",
            "pk" => "id",
            "aliases" => ["access"],
            "hooks" => [],
            "code" => [
                'create-before' => '\\' . RepoItem::class . '::setId($item);'
                                  .'\\' . RepoItem::class . '::throwIfExist($this, $item, [\'object\',\'section\',\'subject\',\'operation\']);'
            ]
        ]
    ]
];
