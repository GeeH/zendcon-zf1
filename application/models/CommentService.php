<?php

class Application_Model_CommentService
{

    /**
     * @var Application_Model_DbTable_Comment
     */
    protected $commentTable;

    /**
     * @param Application_Model_DbTable_Comment $commentTable
     */
    function __construct(Application_Model_DbTable_Comment $commentTable)
    {
        $this->commentTable = $commentTable;
    }

    /**
     * @param Application_Model_Comment $comment
     * @return int|mixed
     */
    public function save(Application_Model_Comment $comment)
    {
        $data = array(
            'name' => $comment->getName(),
            'email' => $comment->getEmail(),
            'comment' => $comment->getComment(),
            'created' => new Zend_Db_Expr('NOW()'),
            'referer' => Zend_Registry::get('Referer')
        );
        if (is_null($comment->getId())) {
            return $this->commentTable->insert($data);
        }

        return $this->commentTable->update($data, array('id = ?'), $comment->getComment());
    }

    /**
     * @param null $referer
     * @param int $limit
     * @return Application_Model_Comment[]
     */
    public function fetchAll($referer = null, $limit = 10)
    {
        if(is_null($referer)) {
            $referer = Zend_Registry::get('Referer');
        }

        $resultSet = $this->commentTable
            ->select()
            ->where('referer = ?', $referer)
            ->order('created DESC')
            ->limit((int)$limit)
            ->query()
            ->fetchAll();
        $return = array();
        foreach ($resultSet as $result) {
            $comment = new Application_Model_Comment();
            $comment->setId($result['id']);
            $comment->setName($result['name']);
            $comment->setComment($result['comment']);
            $comment->setCreated($result['created']);
            $comment->setEmail($result['email']);
            $comment->getReferer($result['referer']);
            $return[] = $comment;
        }
        return $return;
    }
}

