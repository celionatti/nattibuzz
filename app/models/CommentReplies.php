<?php

declare(strict_types=1);

namespace App\models;

use Core\Model;

defined('ROOT_PATH') or exit('Access Denied!');

class CommentReplies extends Model
{
    protected static $table = "comment_replies";
    public $id, $comment_id, $user_id = 'anonymous', $reply_msg, $status = 'active', $created_at, $updated_at;

    public function beforeSave()
    {
        $this->timeStamps();
    }

    const ACTIVE_STATUS = 'active';
    const DISABLED_STATUS = 'disabled';

}