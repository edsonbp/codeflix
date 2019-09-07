<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class UserAccountForm extends Form
{
    public function buildForm()
    {
        $this->add('password', 'password',[
                'label' => 'Senha:',
                'rules' => 'required|min:6|max:16|confirmed'
            ])
            ->add('password_confirmation', 'password',[
                'label' => 'Repita a senha:',
            ]);
    }
}
