<?php

namespace App\Http\Controllers;

use App\Enum\RecordTypeEnum;
use App\Models\Records;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordsController extends Controller
{

    public function store(Request $request)
    {
        $reg = new Records();
        $reg->type = $request->input('type');
        $reg->date = Carbon\Carbon::now();
        $reg->ip = request()->ip();
        $reg->user_id = Auth::user()->id;
        $reg->save();
        return redirect('/point')->with('success', "Ponto Registrado com sucesso!");
    }

    public function index()
    {
        $buttonText = 'Iniciar Horário de Trabalho';
        $buttonClass = 'btn btn-success';
        $type = RecordTypeEnum::POINT_START;

        $lastRecord = Records::where('user_id', '=', \Illuminate\Support\Facades\Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastRecord && $lastRecord->type == RecordTypeEnum::POINT_START) {
            $type = RecordTypeEnum::POINT_END;
            $buttonText = 'Encerrar Ponto';
            $buttonClass = 'btn btn-warning';
        }

        return view('panel.record.new', compact('buttonText', 'buttonClass', 'type', 'lastRecord'));
    }

}
