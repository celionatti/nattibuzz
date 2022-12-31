<?php

declare(strict_types=1);

namespace App\models;

use Core\Model;
use Core\Helpers;
use Core\validators\RequiredValidator;
use Core\validators\UniqueValidator;

defined('ROOT_PATH') or exit('Access Denied!');

class Articles extends Model
{
    protected static $table = "articles";
    public $id, $user_id, $category_id = 0, $slug, $title, $content, $thumbnail, $trending = 0, $status = 'draft', $tags, $meta_description, $meta_keywords, $created_at, $updated_at;

    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'title', 'msg' => 'Title is a required field']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'content', 'msg' => 'Article Content is a required field.']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'meta_description', 'msg' => 'Article Meta Description is a required field.']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'meta_keywords', 'msg' => 'Article Meta Keywords is a required field.']));
        $this->runValidation(new UniqueValidator($this, ['field' => 'slug', 'msg' => 'Article Slug already exists.']));

        $this->content = remove_images_from_content($this->content);

        if ($this->isNew()) {
            $this->slug = str_to_url($this->title);
        }

    }

}