<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlashMessageController extends Controller
{
    public function showMessage(Request $request)
    { $req = new \ReflectionClass('Request');
        dd($req->getName());
        // Flash success message
        $request->session()->flash('success', 'Flash message example - success.');

        // Flash error message
        $request->session()->flash('error', 'Flash message example - error.');

        return view('message.flash-message');
    }
}
