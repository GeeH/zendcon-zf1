<?php

class IndexController extends Zend_Controller_Action
{

    /**
     * @var Application_Model_CommentService
     */
    protected $commentService;

    public function init()
    {
        $this->commentService = new Application_Model_CommentService(new Application_Model_DbTable_Comment());
    }

    public function indexAction()
    {
        $request = $this->getRequest();
        $form = new Application_Form_Comment();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $values = $form->getValues();
                // form is valid, add to the gubbins
                $comment  = new Application_Model_Comment();
                $comment->setName($values['name']);
                $comment->setEmail($values['email']);
                $comment->setComment($values['comment']);
                $this->commentService->save($comment);
                return $this->redirect('/?referer=' . Zend_Registry::get('Referer'));
            }
        }
        $this->view->form = $form;
        $this->view->comments = $this->commentService->fetchAll();
    }


}

