<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Spending;
use App\Earning;
use App\Space;

class TransferController extends Controller
{
    public function index() 
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'tag_id' => 'nullable|exists:tags,id', // TODO CHECK IF TAG BELONGS TO USER
            'space_id' => 'nullable|exists:spaces,id',
            'date' => 'required|date|date_format:Y-m-d',
            'description' => 'required|max:255',
            'amount' => 'required|regex:/^\d*(\.\d{2})?$/'
        ]);

        if ($validator->fails()) 
        {
            // do something!
        }

        Spending::create([
            'space_id'      => session('space')->id,
            'tag_id'        => $request->input('tag_id'),
            'happened_on'   => $request->input('date'),
            'description'   => $request->input('description') . ' an ' . Space::where('id', '=', $request->space_id)->first()->name,
            'amount'        => (int) ($request->input('amount') * 100),
        ]);

        Earning::create([
            'space_id'      => $request->space_id,
            'tag_id'        => $request->input('tag_id'),
            'happened_on'   => $request->input('date'),
            'description'   => $request->input('description') . ' von ' . Space::where('id', '=', session('space')->id)->first()->name,
            'amount'        => (int) ($request->input('amount') * 100),
        ]);

    }
}
