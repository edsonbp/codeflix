<?php

namespace App\Http\Controllers\Admin;

use App\Entities\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Forms\UserForm;
use App\Repositories\UserRepository;

class UsersController extends Controller
{

    private $repository;

    public function __construct(UserRepository $repository){
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->paginate();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(UserForm::class, [
            'url'=>route('admin.users.store'),
            'method'=>'POST'
        ]);
        return view('admin.users.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** @var Form $form*/
        $form = \FormBuilder::create(UserForm::class);
        if(!$form->isValid()){
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = $form->getFieldValues();
        
        $this->repository->create($data);

        $request->session()->flash('message', 'Usuário criado com sucesso');
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $form = \FormBuilder::create(UserForm::class, [
            'url'=>route('admin.users.update', ['user' => $user->id]),
            'method'=>'PUT',
            'model' => $user
        ]);
        return view('admin.users.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form = \FormBuilder::create(UserForm::class,[
            'data' => ['id'=> $id]
        ]);
        if(!$form->isValid()){
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $data = array_except($form->getFieldValues(),['password', 'role']);
        $this->repository->update($data, $id);
        $request->session()->flash('message', 'Usuário alterado com sucesso');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('admin.users.index');
    }
}
