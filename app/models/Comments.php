<?php

declare(strict_types=1);

namespace App\models;

use Core\Model;

defined('ROOT_PATH') or exit('Access Denied!');

class Comments extends Model
{
    protected static $table = "comments";
    public $id, $article_slug, $user_id = 'anonymous', $message, $status = 'active', $created_at, $updated_at;

    public function beforeSave()
    {
        $this->timeStamps();
    }

    const ACTIVE_STATUS = 'active';
    const DISABLED_STATUS = 'disabled';

}