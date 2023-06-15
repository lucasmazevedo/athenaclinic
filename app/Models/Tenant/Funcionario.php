<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected static $statuses = array(
        ['id' => '0', 'text' => 'Inativo', 'color' => 'danger'],
        ['id' => '1', 'text' => 'Ativo', 'color' => 'success']
    );

    protected static $adminStatus = array(
        ['id' => '0', 'text' => 'Não', 'color' => 'dark'],
        ['id' => '1', 'text' => 'Sim', 'color' => 'dark']
    );


    public function getStatusAttribute($value)
    {
        return self::$statuses[$value];
    }

    public static function listStatuses()
    {
        return self::$statuses;
    }

    public function getAdministradorAttribute($value)
    {
        return self::$adminStatus[$value];
    }

    public static function listAdminStatus()
    {
        return self::$adminStatus;
    }

    public function user()
    {
        return $this->morphOne('App\Models\User', 'profile');
    }
}
