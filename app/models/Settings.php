<?php

declare(strict_types=1);

namespace App\models;

use Core\Helpers;
use Core\Model;
use Core\validators\RequiredValidator;

defined('ROOT_PATH') or exit('Access Denied!');

class Settings extends Model
{
    protected static $table = "settings";
    public $id, $setting, $type = '', $value = null, $status = '', $created_at, $updated_at;

    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'setting', 'msg' => 'Setting Name is a required field']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'type', 'msg' => 'Setting Type is a required field']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'status', 'msg' => 'Setting Status is a required field']));
    }

    const ACTIVE_STATUS = 'active';
    const DISABLED_STATUS = 'disabled';

    public static function fetchSettings()
    {
        $params = [
            'conditions' => "status = :status",
            'bind' => ['status' => 'active']
        ];

        $data['settings'] = Settings::find($params);

        $data['data'] = [];

        if($data['settings']) {
            foreach($data['settings'] as $row) {
                $data['data'][$row->setting] = $row->value;
            }
        }
        return $data['data'];
    }

}
