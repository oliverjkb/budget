<?php

namespace App\Http\Controllers;

use App\Space;
use App\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpaceController extends Controller {
    public function __invoke($id) {
        $space = Space::find($id);

        if ($space->users->contains(Auth::user()->id)) {
            session(['space' => $space]);
        }

        return redirect()->route('dashboard');
    }

    public static function create()
    {
        $currencies = [];

        foreach (Currency::all() as $currency) {
            $currencies[] = ['key' => $currency->id, 'label' => $currency->symbol];
        }

        return view('spaces.create', compact('currencies'));
    }

    public static function store(Request $request)
    {
        $space = Space::create([
            'name'      =>   $request->Name,
            'currency_id'  =>   $request->Currency,
        ]);
        
        Auth::user()->spaces()->attach($space->id, ['role' => 'regular']);

        session(['space' => Auth::user()->spaces[0]]);

        return redirect()
            ->route('dashboard');
    }
}
