<h1>Blog articles</h1>

<p>
    <?= $this->Html->link('Search articles', ['action' => 'search']) ?>
     /
    <?= $this->Html->link('Add article', ['action' => 'add']) ?>
</p>

<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
        <th>edit</th>
        <th>delete</th>
    </tr>

    <!-- ここから、$articles のクエリーオブジェクトをループして、投稿記事の情報を表示 -->

    <?php foreach ($articles as $article): ?>
        <tr>
            <td><?= $article->id ?></td>
            <td>
                <?= $this->Html->link($article->title, ['action' => 'view', $article->id]) ?>
            </td>
            <td>
                <?= $article->created->format(DATE_RFC850) ?>
            </td>
            <td>
                <?= $this->Html->link('edit', ['action' => 'edit', $article->id]) ?>
            </td>
            <td>
                <?= $this->Form->postLink(
                        'delete',
                        ['action' => 'delete', $article->id],
                        ['confirm' => 'Are you sure ?']
                    );
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>