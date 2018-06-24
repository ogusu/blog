<h1>Article - add</h1>

<?php
    // form start パラメータなしの場合は現在のコントローラーにPOSTバック。idがなければadd、あればedit
    echo $this->Form->create($article);

    // 入力フォーム １つ目のパラメータはどのフィールドに対応しているか、
    echo $this->Form->control('title');
    echo $this->Form->control('body', ['rows' => 3]);

    // submit
    echo $this->Form->button(__('Save article'));

    // form end
    echo $this->Form->end();
?>