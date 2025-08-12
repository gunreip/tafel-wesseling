<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::match(['get','post'], '/session-check', function (Request $request) {
    if ($request->isMethod('post')) {
        $data = $request->validate(['note' => ['required','string','max:100']]);
        $request->session()->put('dev_note', $data['note']); // intern en-US
        return redirect('/session-check')->with('status', 'Session aktualisiert.');
    }
    return view('dev.session-check', [
        'note' => $request->session()->get('dev_note'),
        'status' => session('status'),
    ]);
});