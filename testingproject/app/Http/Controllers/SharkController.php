<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Shark;
use App\Models\SbFixture;
use Response;
use DB;
use App\Notifications\SlackNotification;
use Illuminate\Support\Facades\Notification;
use GuzzleHttp\Client as GuzzleClient;

class SharkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = Shark::all();

        return view('sharks.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sharks.create');
        // return View::make('sharks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Shark::create($request->all());
        return redirect('user');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shark $shark,$id)
    {
        $user = Shark::find($id);
        return view('sharks.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shark $shark,$id)
    {
        $user = Shark::find($id);
        return view('sharks.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = request()->except(['_token','_method']);
        Shark::where('id',$id)->update($data);
        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Shark::destroy($id);
        return redirect('user');
    }

    public function fetchjson_n_reorder() {
        $json = Storage::disk('public')->get('sample.json');

        // $json = storage_path('app/public/sample.json');
        // $json = file_get_contents($json);

        // $json = json_encode(json_decode($json));
        // dd($json);

        $json = json_decode($json);

        // $json = json_decode($json,TRUE);
        dump($json);

        $json = $this->reorderobjects($json,'logins_count');

        dd($json);
        $json = $this->reorderassociativearray($json,'logins_count');

        // $test_array = array(3, 0, 2, 5, -1, 4, 1);

        // dd($this->insertionsorting($ordering_array));

        return $json;

    }

    function singlekeyvalue(array $arr,$k) : string {
        $rarr = '';
        foreach ($arr as $key => $value) {
            if ($key == $k) {
                $rarr = $value;
            }
        }
        return $rarr;
    }

    function object_to_array($data)
    {
        $result = [];
        foreach ($data as $key => $value)
        {
            $result[$key] = (is_array($value) || is_object($value)) ? object_to_array($value) : $value;
        }
        return $result;
    }

    function bubble_Sort($my_array)
    {
        // do
        // {
        //     $swapped = false;
        //     for( $i = 0, $c = count( $my_array ) - 1; $i < $c; $i++ )
        //     {
        //         if( $my_array[$i] > $my_array[$i + 1] )
        //         {
        //             list( $my_array[$i + 1], $my_array[$i] ) =
        //                     array( $my_array[$i], $my_array[$i + 1] );
        //             $swapped = true;
        //         }
        //     }
        // }
        // while( $swapped );
        for($i=0;$i<count($my_array);$i++){
            for($j=$i+1;$j<count($my_array);$j++){
                echo $my_array[$i].'<br>';
                if($my_array[$j]<$my_array[$i]){
                    $temp = $my_array[$i];
                    $my_array[$i] = $my_array[$j];
                    $my_array[$j] = $temp;
                }
            }
        }
        return $my_array;
    }

    function insertionsorting($arr) : array {

        for($i=1; $i < count($arr); $i++){
            $key = $arr[$i];
            for($j=$i-1;$j>=0;$j--){
                if($arr[$j]>$key){
                    $arr[$j+1] = $arr[$j];
                } else {
                    break;
                }
            }
            $arr[$j+1] = $key;
        }
        return $arr;
    }

    function reorderassociativearray(array $arr, $k) : array {

        for($i=1; $i < count($arr); $i++){
            $key = $arr[$i];
            for($j=$i-1;$j>=0;$j--){
                if($arr[$j][$k]>$key[$k]){
                    $arr[$j+1] = $arr[$j];
                } else {
                    break;
                }
            }
            $arr[$j+1] = $key;
        }
        return $arr;
    }

    function reorderobjects(array $arr, $k) {

        for($i=1; $i < count($arr); $i++){
            $key = $arr[$i];
            for($j=$i-1;$j>=0;$j--){
                if($arr[$j]->$k>$key->$k){
                    $arr[$j+1] = $arr[$j];
                } else {
                    break;
                }
            }
            $arr[$j+1] = $key;
        }
        return $arr;
    }

    function sendFast2quicksms($message, $mobile_no) {
        $client = new \GuzzleHttp\Client();

        $api = '763x9JiEzBDZIkfnFOhC0ArlWt2cS4LMvsqguNayQU5TbpKjmwdwOIi3NCuhAS4nxE50et2zFYjoUbMZ';

        $res = $client->get("https://www.fast2sms.com/dev/bulkV2?authorization=$api&route=q&message=$message&flash=0&numbers=$mobile_no");

        $response = json_decode($res->getBody());

        return $response->return;
    }

    function sendFast2otp($otp, $mobile_no, $api) {
        $client = new \GuzzleHttp\Client();

        $res = $client->get("https://www.fast2sms.com/dev/bulkV2?authorization=$api&route=otp&variables_values=$otp&flash=0&numbers=$mobile_no");
        // echo $res->getStatusCode(); // 200
        echo $res->getBody();
    }

    function callsmsApi($smstype) {

        $otp = '57575757';
        $mobile_no = '6362964392';
        $msg = '78787878 is your MUX otp';
        $api = '763x9JiEzBDZIkfnFOhC0ArlWt2cS4LMvsqguNayQU5TbpKjmwdwOIi3NCuhAS4nxE50et2zFYjoUbMZ';

        if($smstype == 'otp'){

            $this->sendFast2otp($otp, $mobile_no,$api);
        } else {

            $this->sendFast2quicksms($msg,$mobile_no);
        }

    }

    function callsmspostApi(Request $request) {

        $client = new \GuzzleHttp\Client();

        $api = '763x9JiEzBDZIkfnFOhC0ArlWt2cS4LMvsqguNayQU5TbpKjmwdwOIi3NCuhAS4nxE50et2zFYjoUbMZ';

        $url = "https://www.fast2sms.com/dev/bulkV2";

        $res = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json','authorization' => $api],
            'body' => json_encode([
                'message' => $request->message,
                'language'=> 'english',
                'route' => 'q',
                'numbers' =>"$request->mobile_no",

            ])
        ]);
        $response = json_decode($res->getBody());

        return $response->return;
    }

    public function getTableColumns($model_name)
    {
        // dd($model_name);
        $table = new $model_name;

        $table = $table->getTable();
        // $columns = $model->getConnection()->getSchemaBuilder()->getColumnListing($tableName);
        return \DB::getSchemaBuilder()->getColumnListing($table);

        // OR

        $model = $model->first();
        $columns = array_keys(json_decode($model, true));
        return $columns;
        // return \Schema::getColumnListing($table);

    }

    public function getTableColumns2($table)
    {
        // $columns = $model->getConnection()->getSchemaBuilder()->getColumnListing($tableName);

        return \DB::getSchemaBuilder()->getColumnListing($table);

        // return \Schema::getColumnListing($table);

    }

    function crudonTable($model_name, $request) {

        if(gettype($request) == 'array') $request = json_decode(json_encode($request));

        $columns = $this->getTableColumns($model_name);

        $table = new $model_name;

        foreach($columns as $k=>$v){
            if ($k>0 and $k<count($columns)-2) {
                $table->$v = $request->$v;
            }
        }
        $table->save();

    }

    function downloadtablecsv (){

        $file = 'testdata.csv';

        $model = "SbFixture";

        $table = 'sb_fixtures';

        // $model = new \ReflectionClass($model);
        // $model = $model->getName();
        // dd(app()->getNamespace().'Models\\'.$model);
        // dump($model);
        // dump(app()->getNamespace().'Models\\'.$model.'.php');
        // dump(str_replace("\\", "/", app()->getNamespace().'Models\\').$model.'.php');
        // dump('app/Models/'.$model.'.php');
        // dd('trfdxg',file_exists('app/Models/'.$model.'.php'));

        $columns = $this->getTableColumns(app()->getNamespace().'Models\\'.$model);

        // $columns = $this->getTableColumns($model::class);

        $write = fopen($file, 'w+');


        // $data = \DB::table('sigma.sb_fixtures')->select('sb_fixtures.*')->where('id','!=','0')->orderBy('id','DESC');

        $data = \DB::table($table)->select("$table.*")->where('id','!=','0')->orderBy('id','DESC');

        $data->chunk(5000,function($data) use (&$file, &$write, &$columns){

            foreach ($data as $k => $v) {
                $arr = [];
                $i = 0;
                while($i<count($columns)){
                    if ($v->{$columns[$i]}) {
                        $arr[] = $v->{$columns[$i]};
                    } else {
                        $arr[] = 'NULL';
                    }
                    $i++;
                }
                fputcsv($write, $arr);
            }

        });

        fclose($write);
        $storageAt = public_path();
        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download(public_path($file),$file,$headers);
    }

    function slackNotificationMessage(){
        // Notification::route('slack',env('SLACK_WEBHOOK_URL'))->notify(new SlackNotification());
        // Notification::route('slack',env('SLACK_WEBHOOK_URL1'))->notify(new SlackNotification());
        // return response()->json(['message'=>'Notification sent'], 200);

        $url = 'https://slack.com/api/chat.postMessage';

        // $url = 'https://slack.com/api/conversations.list';

        // $url = 'https://slack.com/api/users.list';

        $client = new GuzzleClient(
            [
                'headers' =>
                    [
                        'Authorization' => 'Bearer xoxp-6418765229157-6424147752548-6412905095223-84fcc490dbfe6a8897e6157babfe1b21',
                        // 'AccessToken' => 'xoxb-6418765229157-6415131294150-HjAtTruwQW3WwEZ1x7PEdhVU',
                        'Content-Type' => 'application/json',
                        // 'Content-Type' => 'application/x-www-form-urlencoded',
                    ]
            ]);

            $formData = [
                'form_params' => [
                    'channel' => 'D06CN39SRL4',
                    'text' => 'Hii testing',
                    'as_user' => true,
                ]
            ];

            $response = $client->post($url, $formData)->getBody()->getContents();
            $response = json_decode($response, true);
            dd($response);
    }

    public function shiftTableData2($main_table)
    {
        // dd($main_table);
        $move_until_date = date('Y-m-d H:i:s');

        $backup_table = 'backup_'.$main_table;

        // $columns = json_encode($this->getTableColumns2($main_table));
        $columns = $this->getTableColumns2($main_table);
        // dd($columns);
         // DB TRANSACTION STARTS HERE

        //  $insql = DB::select("SELECT * FROM $main_table WHERE created_at < '$move_until_date'");
        //  foreach ($insql as $key => $value) {
        //      $value = json_decode(json_encode($value, true),true);
        //     //  dd($value);
        //     // $val = [];
        //     $cnt = 0;
        //     $insertableArray = [];
        //     foreach ($value as $k => $v){
        //         $insertableArray[$columns[$cnt]] = $v;
        //         // echo '<br>'.$columns[$cnt];
        //         $val[] = $v;
        //         $cnt+=1;
        //     }
        //     // dd($val);
        //     // $val = json_encode($val);
        //     // DB::table($backup_table)->insert($val);
        //     // $sql = "INSERT INTO $backup_table ($columns) VALUES ($val)";
        //     // $result = DB::raw($sql);
        //     DB::table($backup_table)->insert($insertableArray);

        //  }

        // create table new_table like old_table;

        // $insql = DB::select("SELECT * FROM $main_table WHERE created_at < '$move_until_date'");
        // $insql = json_encode($insql);
        // dd('wedtghujio');

         DB::beginTransaction();

         try {

            $sql = "CREATE TABLE IF NOT EXISTS $backup_table LIKE $main_table";

            DB::select($sql);

            DB::select("INSERT INTO $backup_table SELECT * FROM $main_table");

            // DB::table($main_table)->where('created_at','<',$move_until_date)->delete();

            DB::commit();

            // $insql = DB::select("SELECT * FROM $main_table WHERE created_at < '$move_until_date'");
            // foreach ($insql as $key => $value) {
            //     $cnt = 0;
            //     $insertableArray = [];
            //     foreach ($value as $k => $v){
            //         $insertableArray[$columns[$cnt]] = $v;
            //         $cnt+=1;
            //     }
            //     DB::table($backup_table)->insert($insertableArray);

            // }

            // $insql = DB::select("SELECT * FROM $main_table WHERE created_at < '$move_until_date'");
            // foreach ($insql as $key => $value) {
            //     $value = json_encode($value);
            //     $sql = "INSERT INTO $backup_table ($columns) VALUES ($value)";
            //     $result = DB::insert($sql);
            // }


            // dd('werfghjk');
            // COMMIT HERE IF NOT ERRORS

        } catch (\Exception $e) {

            // IF ANY ERROR COMPLETE ROLLBACK FOR PARTICULAR USER

            DB::rollback();
        }
        // dd('23456');

    }

    public function shiftTableData($main_table)
    {

        // $move_until_date = date('Y-m-d H:i:s');
        $move_until_date = date('2024-01-13 00:00:01');

        $backup_table = 'backup_'.$main_table;

        // $sql = "SELECT * FROM $main_table
        // WHERE
        // created_at < '2024-01-12 00:00:00' ORDER BY created_at DESC";

        // dd(DB::select($sql));
         // DB TRANSACTION STARTS HERE

         DB::beginTransaction();

         try {

            $sql = "CREATE TABLE IF NOT EXISTS $backup_table LIKE $main_table";

            DB::select($sql);

             $sql = "INSERT INTO $backup_table
                 (SELECT * FROM $main_table
                 WHERE
                 created_at < '$move_until_date')";

             $result = DB::select($sql);

             DB::table($main_table)->where('created_at','<',$move_until_date)->delete();

             DB::commit();

             // COMMIT HERE IF NOT ERRORS

         } catch (\Exception $e) {
            // dd($e);
             // IF ANY ERROR COMPLETE ROLLBACK FOR PARTICULAR USER

             DB::rollback();
         }

    }


    public function mkTableBackup()
    {
        //
        $tables = [
            'sb_feed_messages',
        ];

        foreach ($tables as $main_table) {
            self::shiftTableData($main_table);
        }

    }

// multiple image upload in laravel
    public function ticket(Request $request){
        // dd($request->all());
              $validation = Validator::make($request->all(), [
                'select_file.*' => 'required|image|mimes:jpeg,png,pdf,jpg|max:2048',
                'issue' => 'required',
                'subject' => 'required',
                'description' => 'required'
              ]);

              // $validate = $request->validate([
              //     'select_file.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
              //     // 'select_file' => 'required',
              //     // 'select_file.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
              //     'issue' => 'required',
              //     'subject' => 'required',
              //     'description' => 'required'
              // ]);
              //Default status to be set as 1
              $status = '1';
              $ticket = new Ticket;
              if($validation->passes()) {
                if ($request->hasFile('select_file')) {
                  $file_urls = [];
                  foreach ($request['select_file'] as $key => $file) {
                    $imageName=time().$file->getClientOriginalName();
                    echo 'sdfghjngfdsa -------- '.$imageName.'<br>';
                    $filePath = 'tickets/' . $imageName;
                    Storage::disk('local')->put($filePath, file_get_contents($file), 'public');
                    dd(url(Storage::disk('local')->url($filePath)));
                    $file_urls[] = Storage::disk('local')->url($filePath);
                  //   Storage::disk('s3')->put($filePath, file_get_contents($file), 'public');
                  //   $file_urls[] = Storage::disk('s3')->url($filePath);
                  }
                  $ticket->file = implode(',',$file_urls);
                }
                $ticket->status = $status;
                $ticket->issue = $request->issue;
                $ticket->subject = $request->subject;
                $ticket->description = $request->description;
                $ticket->user_id = Auth::user()->id;
                $ticket->created_by = Auth::user()->id;
                //dd($request->all());
                $ticket->save();
               return response()->json([
              "message" => "Ticket created successfully"
              ], 201);
           }
      }
}
