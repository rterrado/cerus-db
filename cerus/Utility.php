<?php

declare(strict_types=1);
namespace cerus;

class Utility {

    private const KEY_CHARS = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public static function create32bitKey()
    {
        return Self::createUniqueKey(4);
    }

    public static function create64bitKey()
    {
        return Self::createUniqueKey(12);
    }

    public static function createUniqueKey(
        int $def
        )
    {
        return substr(str_shuffle(SELF::KEY_CHARS),(-1*$def))
             .(date('Y')-2000)
             .substr(str_shuffle(SELF::KEY_CHARS),(-1*$def))
             .(date('m')*1)
             .substr(str_shuffle(SELF::KEY_CHARS),(-1*$def))
             .(date('d')*1)
             .substr(str_shuffle(SELF::KEY_CHARS),(-1*$def))
             .substr(str_shuffle(time().SELF::KEY_CHARS),(-10));
    }

}
