<?php
use \Cake\Collection\Collection;

$sqls = new Collection([
    "name1" => "first",
    "name2" => "second"
]);

// 新しいコレクションを作成
$sqls->each(
    function($value, $key) {
        echo "$key = $value<br />";
    }
);

echo pj($sqls);

$ary = [
    "name" => ["yamada", "kobayashi"]
];
pr($ary);

echo $this->Form->create($page);
echo $this->Form->button(__('Save article'));
echo $this->Form->end();

