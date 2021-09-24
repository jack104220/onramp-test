<?php

namespace App\Consts;

class TypeConst
{
    /**
     * 可用列表
     */
    const LIST = [
        'conversion' => self::CONVERSION,
        'click' => self::CLICK,
        'play' => self::PLAY,
    ];

    /**
     * 未知
     */
    const UNKNOWN = 0;
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