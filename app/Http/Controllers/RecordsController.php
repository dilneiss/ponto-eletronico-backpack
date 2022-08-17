<?php

namespace App\Http\Controllers;

use App\Enum\RecordTypeEnum;
use App\Http\Requests;
use App\Models\Records;
use Auth;
use Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class RecordsController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $reg = new Records();
        $reg->type = $request->input('type');
        $reg->date = Carbon\Carbon::now();
        $reg->ip = request()->ip();
        $reg->user_id = Auth::user()->id;
        $reg->save();
        return redirect('/ponto');
    }

    public function create()
    {
        $buttonText = 'Iniciar Horário de Trabalho';
        $buttonClass = 'btn btn-success';
        $type = RecordTypeEnum::POINT_START;

        $lastRecord = Records::where('user_id', '=', \Illuminate\Support\Facades\Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastRecord->type == RecordTypeEnum::POINT_START) {
            $type = RecordTypeEnum::POINT_END;
            $buttonText = 'Encerrar Ponto';
            $buttonClass = 'btn btn-warning';
        }

        return view('panel.record.new', compact('buttonText', 'buttonClass', 'type', 'lastRecord'));
    }

    public function retrieve()
    {
        $buttonText = 'Iniciar Horário de Trabalho';
        $buttonClass = 'btn btn-success btn-lg';
        $type = RecordTypeEnum::POINT_START;

        $points = Records::where('user_id', '=', Auth::user()->id)
            ->orderBy('date', 'desc')
            //->take(10)
            ->get();

        $last = $points->first();
        if (isset($last) && $last->type == RecordTypeEnum::POINT_START) {
            $type = RecordTypeEnum::POINT_END;
            $buttonText = 'Encerrar Ponto';
            $buttonClass = 'btn btn-success btn-lg';
        }
        return view('panel.record.show', compact('buttonText', 'buttonClass', 'type', 'points'));
    }

    public function editRecordsByUser($record_id)
    {

        //return view('panel.record.create');

        $records = DB::table('records')->where('record_id', $record_id)->first();
        $users = DB::table('users')->where('id', $records->user_id)->first();

        return view('panel.record.edit', compact('records', 'users'))->with('record_id', $record_id);
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'description' => 'required|max:40',
            'date' => 'required',
            'type' => 'required',
            'time' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return Redirect::to($request->record_id . '/editarHistorico')->withErrors($validator)->withInput();
        } else {
            $timestamp = Carbon\Carbon::createFromTimestamp(strtotime($request->date . $request->time));

            $data =
                [
                    'record_id' => $request->record_id,
                    'type' => $request->type,
                    'date' => $timestamp,
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                    //'user_id' => $request->user_id, //Dono do registro
                ];

            DB::table('activity_logs')->insert(
                [
                    'newTypeLog' => $request->type,
                    'oldTypeLog' => $request->newTypeLog,
                    'record_id' => $request->record_id,
                    'dateLog' => $request->dateLog,
                    'edited_by' => $request->edited_by,
                    'dateLog' => $request->created_at_log,
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'description' => $request->description,
                    'owner' => $request->user_id,
                ]);

            DB::table('records')->where('record_id', $request->record_id)->update($data);

            return redirect('/colaboradores');
        }
    }

    //carrega a tela do adm criar registro para usuario
    public function createRecordsByAdmin($user_id)
    {
        $users = DB::table('users')->where('id', $user_id)->first();
        return view('panel.record.create', compact('users'))->with('user_id', $user_id);
    }

    public function createByAdmin(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'description' => 'required|max:40',
            'date' => 'required',
            'type' => 'required',
            'time' => 'required',
            'user_id' => 'required',
        );

        $validator = Validator::make($input, $rules);

        //dd($input);
        if ($validator->fails()) {
            return Redirect::to($request->user_id . '/criarHistorico')->withErrors($validator)->withInput();
        } else {
            $timestamp = Carbon\Carbon::createFromTimestamp(strtotime($request->date . $request->time));

            DB::table('records')->insert(
                [
                    'type' => $request->type,
                    'date' => $timestamp,
                    'ip' => request()->ip(),
                    'user_id' => $request->user_id,
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),

                ]);

            $lastId = DB::getPdo()->lastInsertId();

            DB::table('activity_logs')->insert(
                [
                    'newTypeLog' => $request->type,
                    'oldTypeLog' => $request->type,
                    'dateLog' => $timestamp,
                    'description' => $request->description,
                    'edited_by' => Auth::user()->id,
                    'record_id' => $lastId,
                    'owner' => $request->user_id,
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),

                ]);

            return redirect('/colaboradores');
        }
    }


    public function reports()
    {
        $logs = DB::table('activity_logs')->get();
        $users = DB::table('users')->get();
        //dd($logs);
        return view('panel.record.reports', compact('logs', 'users'));
    }
}
