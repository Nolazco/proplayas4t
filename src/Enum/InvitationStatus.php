<?php

namespace App\Enum;

enum InvitationStatus: string
{
    case P = "pending";
    case A = "accepted";
    case E = "expired";
}
