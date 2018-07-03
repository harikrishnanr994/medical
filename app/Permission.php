<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Permission extends \Spatie\Permission\Models\Permission {

    public static function defaultPermissions()
    {
        return [
            'users_manage',
            'supply_chain_manage',
        ];
    }

}