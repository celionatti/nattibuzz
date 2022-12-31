<?php 

declare(strict_types=1);

namespace App\models;

use Core\Model;
use Core\Config;
use Core\Cookie;
use Core\Session;
use Core\helpers\Token;
use Core\Helpers;
use Core\validators\UniqueValidator;
use Core\validators\RequiredValidator;

defined('ROOT_PATH') or exit('Access Denied!');

class Categories extends Model
{
    protected static $table = "categories";
    public $id, $category, $slug, $status;

    const ACTIVE_STATUS = 'active';
    const DISABLED_STATUS = 'disabled';

    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'category', 'msg' => "Category is a required field."]));
        $this->runValidation(new RequiredValidator($this, ['field' => 'status', 'msg' => "Status is a required field."]));
        $this->runValidation(new UniqueValidator($this, ['field' => 'category', 'msg' => "Category already exists."]));

        if ($this->isNew()) {
            $this->slug = str_to_url($this->category);
        } else {
            $this->_skipUpdate = ['slug'];
        }
    }

    public static function findAllWithArticles()
    {
        $params = [
            'columns' => 'categories.*',
            'conditions' => "articles.status = 'published'",
            'joins' => [
                ['articles', 'articles.category_id = categories.id']
            ],
            'group' => 'categories.id',
            'order' => 'categories.category DESC'
        ];
        return self::find($params);
    }

}