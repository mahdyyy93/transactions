<?php

namespace App\Enums;

enum StatusEnum: string
{
    case INITIATE = 'initiate';
    case COMMIT = 'commit';
    case REJECT = 'reject';
    case PENALTY = 'penalty';
    case DISBURSE = 'disburse';
}
