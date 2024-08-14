<?php

namespace App\Http\Controllers\ClientProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\SharkController;
use App\Models\Client;
use App\Models\Clientuser;

class DynamicFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $sharkcontroller;

    public function __construct() {
        $this->sharkcontroller = new SharkController();
    }

    public function index()
    {
        $columns = $this->sharkcontroller->getTableColumns(Client::class);
        return view('client_forms.form_add_field',compact('columns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->form_fields = json_encode($request->form_fields);
        $this->sharkcontroller->crudonTable(Client::class, $request);

        return 'done';

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function add_client_user_page($client_id)
    {
        $columns = Client::where('id',$client_id)->first()->form_fields;
        $client_id = $client_id;
        $columns = json_decode($columns);
        return view('client_forms.form_view',compact('columns','client_id'));
    }

    function add_client_user($client_id, Request $request) {

        $user_data = $request->all();
        unset($user_data['_token']);
        // $user_data['id'] = $user_data;

        $form_values = [];
        $form_values['client_id'] = $client_id;
        $form_values['client_user_data'] = json_encode($user_data);

        $this->sharkcontroller->crudonTable(Clientuser::class, $form_values);
    }

    function get_client_user($client_id, $field, $field_value) {

        $table = 'clientusers';
        $client_id = 1;
        $field = 'add_client3';
        $field = '$.'.$field;
        $field_value = 'fld3';
        $json_column = 'client_user_data';

        // dd("SELECT $table.* ,JSON_VALUE('$json_column','$field') AS client_user FROM $table WHERE JSON_VALUE('$json_column','$field') = '$field_value' AND '$json_key'='$client_id'");
        $data = \DB::select("SELECT $table.* ,JSON_VALUE($json_column,'$field') AS json_data FROM $table WHERE JSON_VALUE($json_column,'$field') = '$field_value' AND client_id='$client_id'");

        dd($data);
    }

    // below codes are example codes not to be directly use case functions ---------
    // https://cosme.dev/post/laravel-orwhere-how-to-use-and-group-queries
    function group_where_condition() {

        // group where condition is required here

        $q->where(function($q){
            $q->where(function($condition){
                $condition->where('sport_event_status','Live');
                $condition->where('liveodds','booked');
            });

            $q->orWhere(function($condition){
                $condition->where('sport_event_status','Live');
                $condition->where('sport_name','Cricket');
            });

        });

        $employees = Employee::where('age', '>', 56)
        ->where('type', 'full time')
        ->orWhere(function ($query) {
            $query->where('type', 'part time')
                ->where('age', '>', 44);
        })->get();
        // dd($q->toSql());
    }
}
