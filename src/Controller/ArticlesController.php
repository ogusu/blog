<?php
namespace App\Controller;

// Prior to 3.6 use Cake\Network\Exception\NotFoundException
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\TableRegistry;


class ArticlesController extends AppController
{
    public function index() {
        $articles = $this->Articles->find('all');
        $this->set(compact('articles'));
    }

    public function view($id) {
        $article = $this->Articles->get($id);
        $this->set(compact('article'));
    }

    public function add() {
        // create entity
        $newEntity = $this->Articles->newEntity();
        $this->set('article', $newEntity);

        // 記事のカテゴリーを１つ選択するためにカテゴリーの一覧を追加
        $categories = $this->Articles->Categories->find('treeList');
        $this->set(compact('categories'));

        // new form / yet posted
        if(!$this->request->is(('POST'))) {
            return;
        }

        // patch entity
        $newArticle = $this->Articles->patchEntity($newEntity, $this->request->getData());

        // save article
        $saveResult = $this->Articles->save($newArticle);
        $this->set('article', $newEntity);

        if(!$saveResult) {
            // failed
            $this->Flash->error(__('Unable to add your article.'));
        } else {
            // succeeded
            $this->Flash->success(__('Your new article has been saved.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function edit($id = null) {
        // get entity
        $orginalArticle = $this->Articles->get($id);
        $this->set('article', $orginalArticle);

        // new form / yet posted
        if(!$this->request->is('POST')) {
            return;
        }

        // patch entity
        $patchedEntity = $this->Articles->patchEntity($orginalArticle, $this->request->getData());

        // save entity
        $saveResult = $this->Articles->save($patchedEntity);
        $this->set('article', $orginalArticle);

        if(!$saveResult) {
            // failed
            $this->Flash->error(__('Unable to update your article.'));
        } else {
            //succeeded
            $this->Flash->success('Your article has been saved.');
        }

        return $this->redirect(['action' => 'index']);
    }

    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);

        // get entity
        $article = $this->Articles->get($id);
        if($this->Articles->delete($article)) {
            $this->Flash->success(__('The article id:{0} has been deleted.', h($id)));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function search()
    {
        $params = $this->request->getQueryParams();

        // for tag selection
        $allTags = $this->getTableLocator()->get('Tags')
            ->find('list')
            ->order(['title' => 'ASC'])
            ->toArray();
        $this->set('tags', $allTags);

        // find Articles
        $query = $this->Articles->find('all')
            ->contain(['Tags'])
            ->contain(['Categories']);

        // post title
        if(!empty($params['title']))
        {
            $query = $query->where(['Articles.title LIKE' => '%' . $params['title'] . '%']);
        }

        // post body
        if(!empty($params['body']))
        {
            $body = $params['body'];
            $query = $query->where(function ($exp, $query) use($body)
            {
                return $exp->like('Articles.body', "%$body%");
            });
        }

        // post tag
        if(!empty($params['tag']))
        {
            $tags = array_filter($params['tag']);
            if(count($tags) > 0)
            {
                $query = $query->matching('Tags', function ($q) use ($tags) {
                    return $q->where(['Tags.id IN' => $tags]);
                });
            }
        }

        // order by
        $articles = $query->order(['Articles.id' => 'ASC'])->all();
        
        $this->set(compact('articles'));
    }
}