<?php

namespace App\Enums;

enum StatusEnum: int
{
    case initiate = 1;
    case commit = 2;
    case reject = 3;
    case penality = 4;
    case disburse = 5;
}
