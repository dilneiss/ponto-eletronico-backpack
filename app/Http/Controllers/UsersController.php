<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{

    public function retrieve()
    {
        $users = User::all();
        return view('panel.collaborator.show', compact('users'));
    }

    public function changePassword(ChangePasswordRequest $request)
    {

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->nova_senha)]);

        return redirect()->to('perfil')->with('message', "Senha Atualizada com sucesso!");

    }

    public function profile()
    {
        return view('panel.collaborator.profile');
    }


}
