<?php

namespace App\Consts;

class TypeConst
{
    /**
     * 可用列表
     */
    const LIST = [
        self::CONVERSION,
        self::CLICK,
        self::PLAY,
    ];

    /**
     * 轉換
     */
    const CONVERSION = 1;
    /**
     * 點擊
     */
    const CLICK = 2;
    /**
     * 運行
     */
    const PLAY = 3;
}