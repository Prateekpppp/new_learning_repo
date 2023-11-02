<?php

namespace App\Http\Controllers;

use App\Models\Shark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        // $json = json_decode($json);

        $json = json_decode($json,TRUE);
        dump($json);

        $json = $this->reorderassociativearray($json,'logins_count');
        dd($json);

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

}
