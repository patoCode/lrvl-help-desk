<?php

namespace App\Constants;

enum SolicitudEventoEnum: string{
    case CREATED = 'CREATED';
    case CREATED_NOT_ASSIGNED = 'CREATED_NOT_ASSIGNED';
    case ASSIGNED = 'ASSIGNED';
    case RE_ASSIGNED = 'RE_ASSIGNED';
    case REJECT = 'REJECT';
    case START = 'START';
    case PAUSE = 'PAUSE';
    case ATTENTION = 'ATTENTION';
    case CLOSE = 'CLOSE';
    case  DERIVATIVE = 'DERIVATIVE';

}


