<?php

declare(strict_types=1);

namespace App\models;

use Core\Model;
use Core\validators\RequiredValidator;

defined('ROOT_PATH') or exit('Access Denied!');

class Tickers extends Model
{
    protected static $table = "tickers";
    public $id, $content, $status = 'active', $created_at, $updated_at;

    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'content', 'msg' => 'Content is a required field']));
    }

    public static function tickersDisplay()
    {
        $params = [
            'conditions' => "status = 'active'",
            'order' => "id DESC"
        ];
        return self::find($params);
    }

}
