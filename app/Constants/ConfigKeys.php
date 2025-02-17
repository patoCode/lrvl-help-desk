<?php

namespace App\Constants;

enum ConfigKeys: string{
    case ASSIGN_TYPE = 'ASSIGN_TYPE';
    case ASSIGN_TYPE_MANUAL = 'manual';
    case ASSIGN_TYPE_AUTO = 'auto';
}
