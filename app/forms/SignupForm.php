<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class SignupForm extends Form
{

    public function initialize()
    {
        $text = new Text(
            'name'
        );
        $text->addValidator(
            new PresenceOf(
                [
                    'message' => 'The name is required',
                ]
            )
        )->addValidator(
            new StringLength(
                [
                    'min' => 3,
                    'messageMinimum' => 'Name is too short',
                ]
            )
        );
        $this->add($text);

        $this->add(
            new Text(
                'email'
            )
        );
    }
}