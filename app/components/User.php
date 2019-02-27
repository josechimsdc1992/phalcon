<?php

namespace Component;


class User extends \Phalcon\Mvc\User\Component
{
	public function CreateUser(Usuario $user)
    {
        $this->session->set('id',$user->id);
        $this->session->set('role',$user->role);
        return $this->response->redirect('dashboard/');
    }
} 