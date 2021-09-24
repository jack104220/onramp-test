<?php

namespace App\Consts;

class ActionConst
{
    /**
     * 可用列表
     */
    const LIST = [
        'event' => self::EVENT,
        'view' => self::VIEW,
        'video' => self::VIDEO,
    ];

    /**
     * 未知
     */
    const UNKNOWN = 0;
    /**
     * 事件
     */
    const EVENT = 1;
    /**
     * 瀏覽
     */
    const VIEW = 2;
    /**
     * 影片
     */
    const VIDEO = 3;
}