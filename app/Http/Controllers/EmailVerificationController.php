<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jrean\UserVerification\Traits\VerifiesUsers;
use App\Repositories\UserRepository;

class EmailVerificationController extends Controller
{
    use VerifiesUsers;

    private $repository;

    public function __construct(UserRepository $repository){
        $this->repository = $repository;
    }

    public function redirectAfterVerification(){
        $this->loginUser();
        return url('/admin/dashboard');
    }

    protected function loginUser(){
        $email = \Request::get('email');
        $user = $this->repository->findByField('email', $email)->first();
        \Auth::login($user);
    }
}
