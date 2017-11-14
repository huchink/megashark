<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Movie Controller
 *
 *
 * @method \App\Model\Entity\Movie[] paginate($object = null, array $settings = [])
 */
class MovieController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $movie = $this->paginate($this->Movie);

        $this->set(compact('movie'));
        $this->set('_serialize', ['movie']);
    }

    /**
     * View method
     *
     * @param string|null $id Movie id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $movie = $this->Movie->get($id, [
            'contain' => []
        ]);

        $this->set('movie', $movie);
        $this->set('_serialize', ['movie']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $movie = $this->Movie->newEntity();
        if ($this->request->is('post')) {
            $movie = $this->Movie->patchEntity($movie, $this->request->getData());
            if ($this->Movie->save($movie)) {
                $this->Flash->success(__('The movie has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The movie could not be saved. Please, try again.'));
        }
        $this->set(compact('movie'));
        $this->set('_serialize', ['movie']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Movie id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $movie = $this->Movie->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $movie = $this->Movie->patchEntity($movie, $this->request->getData());
            if ($this->Movie->save($movie)) {
                $this->Flash->success(__('The movie has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The movie could not be saved. Please, try again.'));
        }
        $this->set(compact('movie'));
        $this->set('_serialize', ['movie']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Movie id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $movie = $this->Movie->get($id);
        if ($this->Movie->delete($movie)) {
            $this->Flash->success(__('The movie has been deleted.'));
        } else {
            $this->Flash->error(__('The movie could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
