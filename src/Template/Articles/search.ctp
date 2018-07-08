<h1>Search articles</h1>
<p>
    <?= $this->Html->link('Index', ['action' => 'index']); ?>
</p>

<div style="padding: 4px; background-color: #f8f8f8;">
    <?= $this->Form->create(null, ['class' => 'condition-form js-query-target-form', 'type' => 'get', 'autocomplete' => 'off']) ?>
        <?= $this->Form->control('title', ['label' => 'Title: ']); ?>
        <?= $this->Form->control('body', ['label' => 'Body: ']) ?>
        <?= $this->Form->select('tag', $tags, ['empty' => true, 'multiple' => true]) ?>
        <?= $this->Form->button('Clear', ['type' => 'reset']) ?>
        <?= $this->Form->button('Search Articles', ['type' => 'submit']) ?>
    <?= $this->Form->end() ?>
</div>

<?php if(!empty($articles)) : ?>
    <p>
        <?php echo count($articles) ?>件ヒットしました。
    </p>
<?php endif ?>
<div style="padding: 4px; background-color: #f8f8f8;">
    <table>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Title</th>
            <th>Body</th>
            <th>Tags</th>
            <th>Created</th>
        </tr>
        <?php if(!empty($articles)) : ?>
            <?php foreach($articles as $article) : ?>
                <tr>
                    <td><?php echo $article->id ?></td>
                    <td><?php echo $article->category->name ?></td>
                    <td><?php echo $article->title ?></td>
                    <td><?php echo $article->body ?></td>
                    <td><?php echo implode(', ', array_column($article->tags, 'title')) ?></td>
                    <td><?php echo $article->created ?></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </table>
</div>

<?php
