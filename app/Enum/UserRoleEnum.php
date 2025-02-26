<?php

namespace App\Enum;

enum UserRoleEnum: string
{
    case SUPER_ADMIN = 'Super Admin';
    case ADMIN_SUB_HOLDING = 'Admin Sub Holding';
    case ADMIN_HOLDING = 'Admin Holding';
    case ADMIN_REGIONAL = 'Admin Regional';
    case ADMIN_UNIT = 'Admin Unit';
    case VIEWER_REGIONAL = 'Viewer Regional';
    case VIEWER_UNIT = 'Viewer Unit';
    case APPROVER_UNIT = 'Approver Unit';

}
