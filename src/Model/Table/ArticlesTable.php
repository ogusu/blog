<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ArticlesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->addBehavior('Timestamp');
        // Just add the belongsTo relation with CategoriesTable
        $this->belongsTo('Categories', ['foreignKey' => 'category_id']);
        // tagsテーブル
        $this->belongsToMany('Tags', [
            'joinTable' => 'ArticlesTags',
        ]);

        /*
        $this->belongsToMany(
            'Tags',
            [
                'joinTable' => 'articles_tags',
                'foreignKey' => 'id'
            ]
        );
        */
    }

    /**
     * save() メソッドが呼ばれた時に、 どうやってバリデートするかを CakePHP に教えます。
     * @param Validator $validator
     * @return Validator|void
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('title')
            ->requirePresence('title')
            ->notEmpty('body')
            ->requirePresence('body');

        return $validator;
    }
}