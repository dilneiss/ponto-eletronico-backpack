<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function changePassword(ChangePasswordRequest $request)
    {

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->nova_senha)]);

        return redirect()->to('perfil')->with('message', "Senha Atualizada com sucesso!");

    }

    public function update(UserUpdateRequest $request, User $user)
    {

        $data = $request->all();
        if (isset($data['senha']) && $data['senha']) {
            $data['password'] = bcrypt($request->senha);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'Usuário atualizado com sucesso');
    }

    public function profile()
    {
        return view('panel.users.profile');
    }

    public function index()
    {
        $users = User::latest()->paginate(5);

        return view('panel.users.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(UserStoreRequest $request)
    {

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['password'] = bcrypt($request->senha);

        User::create($data);

        return redirect()->route('users.index')->with('success', 'Usuário Cadastrado com Sucesso');

    }

    public function create()
    {
        return view('panel.users.create');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('panel.users.edit', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuário Excluído com sucesso');
    }

}
