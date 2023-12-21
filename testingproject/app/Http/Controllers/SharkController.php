<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Shark;
use App\Models\SbFixture;
use Response;

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
}
