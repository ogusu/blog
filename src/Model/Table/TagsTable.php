<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class TagsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->belongsToMany('Articles', [
            'joinTable' => 'ArticlesTags',
        ]);
        /*
        $this->belongsToMany(
            'Articles',
            [
                'joinTable' => 'articles_tags',
                'foreignKey' => 'tag_id'
            ]
        );
        */
    }
}