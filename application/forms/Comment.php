<?php

class Application_Form_Comment extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');

        $this->addElement(
            'text',
            'name',
            array(
                'label' => 'Your name',
                'required' => true,
                'filters' => array(
                    'StringTrim'
                ),
                'validators' => array(
                    array(
                        'validator' => 'StringLength',
                        'options' => array(2, 128)
                    ),
                ),
            )
        );
        $this->addElement(
            'text',
            'email',
            array(
                'label' => 'Your email address',
                'required' => true,
                'filters' => array(
                    'StringTrim'
                ),
                'validators' => array(
                    'EmailAddress',
                    array(
                        'validator' => 'StringLength',
                        'options' => array(2, 128)
                    ),
                ),
            )
        );
        $this->addElement(
            'textarea',
            'comment',
            array(
                'label' => 'Comment',
                'required' => true,
                'filters' => array(
                    'StringTrim',
                    'StripTags',
                ),
                'validators' => array(
                    array(
                        'validator' => 'StringLength',
                        'options' => array(2, 256)
                    ),
                ),
                'rows' => 4,
            )
        );
        $this->addElement(
            'hash',
            'csrf',
            array(
                'ignore' => true,
            )
        );
        $this->addElement(
            'hidden',
            'referer',
            array(
                'value' => Zend_Registry::get('Referer')
            )
        );
        $this->addElement(
            'submit',
            'submit',
            array(
                'ignore' => true,
                'label' => 'Add Comment',
            )
        );


    }

}

