<?php

namespace App\Enums;

enum StatusEnum: int
{
    case INITIATE = 1;
    case COMMIT = 2;
    case REJECT = 3;
    case PENALTY = 4;
    case DISBURSE = 5;
}
