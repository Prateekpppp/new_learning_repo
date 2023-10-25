<?php

namespace App\Http\Controllers;

use App\Models\Shark;
use Illuminate\Http\Request;

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

    public function testfunc() {
        echo 'tesdfghjkhgfdsaZxcvghytrewa';
    }
}
