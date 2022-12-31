<?php

declare(strict_types=1);

namespace App\models;

use Core\Model;

defined('ROOT_PATH') or exit('Access Denied!');

class Subscribers extends Model
{
    protected static $table = "subscribers";
    public $id, $email, $status = 'active', $created_at, $updated_at;

    public function beforeSave()
    {
        $this->timeStamps();
    }

    const ACTIVE_STATUS = 'active';
    const DISABLED_STATUS = 'disabled';

}