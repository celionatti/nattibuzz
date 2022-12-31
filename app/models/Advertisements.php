<?php

declare(strict_types=1);

namespace App\models;

use Core\Model;
use Core\validators\UrlValidator;
use Core\validators\RequiredValidator;

defined('ROOT_PATH') or exit('Access Denied!');

class Advertisements extends Model
{
    protected static $table = "advertisements";
    public $id, $company, $img, $position = 'main', $bgcolor = '#ccc', $objfit = 'contain', $link, $status = 'disabled', $created_at, $updated_at;

    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'company', 'msg' => "Company is a required field."]));
        $this->runValidation(new UrlValidator($this, ['field' => 'link', 'msg' => "You must provide a valid Url Link."]));
    }

    const ACTIVE_STATUS = 'active';
    const DISABLED_STATUS = 'disabled';

    public static function mainAdvertisement()
    {
        $params = [
            'conditions' => "position = 'main' AND status = 'active'",
            'limit' => '1',
        ];
        return self::findFirst($params);
    }

    public static function partialAdvertisement()
    {
        $params = [
            'conditions' => "position = 'partial' AND status = 'active'",
            'limit' => '1',
        ];
        return self::findFirst($params);
    }

}