<?php

namespace App\Enum;

enum RecordTypeEnum
{

    public const POINT_START = 'point_start';
    public const POINT_END = 'point_end';

    public static function getList(): array
    {
        return [
            self::POINT_START => 'Inicio',
            self::POINT_END => 'Fim',
        ];
    }

    public static function getName(string $constName) : string
    {
        return self::getList()[$constName] ?: 'Indefinido';
    }

}
