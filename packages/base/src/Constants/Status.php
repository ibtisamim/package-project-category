<?php

/*
 * @author Anas almasri (anas.almasri@merwas.net)
 * @Description: This is class for status  constants
 */

namespace drafeef\base\Constants;


final class Status {

    public const ACTIVE = 1 ;

    public const INACTIVE = 2 ;

    public const LIST = [
        self::ACTIVE,
        self::INACTIVE
    ];

}
