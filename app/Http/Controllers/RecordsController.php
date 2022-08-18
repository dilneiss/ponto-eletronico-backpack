<?php

namespace App\Http\Controllers;

use App\Enum\RecordTypeEnum;
use App\Models\Records;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecordsController extends Controller
{

    public function store(Request $request)
    {
        $reg = new Records();
        $reg->type = $request->input('type');
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

    public function reports(Request $request)
    {

        $query = 'SELECT records.id, records.type, records.created_at, users.name, users.birthdate, users_owner.name AS owner_name, roles.name AS role_name
                    FROM records
                    JOIN users ON (records.user_id = users.id)
                    LEFT JOIN users AS users_owner ON (users.user_id = users_owner.id) 
                    JOIN roles ON (users.role_id = roles.id) ';

        $query .= ' WHERE users.user_id = ' . Auth::user()->id;

        if ($request->get('date_start') || $request->get('date_end')) {

            if ($request->get('date_start')) {
                $query .= " AND records.created_at >= '{$request->get('date_start')} 00:00:00' ";
            }

            if ($request->get('date_end')) {
                $query .= " AND records.created_at <= '{$request->get('date_end')} 23:59:59' ";
            }

        }

        $users = DB::select($query);

        return view('panel.record.reports', compact('users'));

    }

}
