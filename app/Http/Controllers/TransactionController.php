<?php

namespace App\Http\Controllers;

use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller {
    public function __construct(TransactionRepository $transactionRepository) {
        $this->repository = $transactionRepository;
    }

    public function index(Request $request) {
        $filterBy = null;

        if ($request->get('filterBy')) {
            $filterBy = explode('-', $request->get('filterBy'));
        }

        return view('transactions.index', [
            'yearMonths' => $this->repository->getTransactionsByYearMonth($filterBy),
            'tags' => session('space')->tags
        ]);
    }

    public function create() {
        $tags = [];
        $spaces = [];

        foreach (session('space')->tags as $tag) {
            $tags[] = ['key' => $tag->id, 'label' => '<div class="row"><div class="row__column row__column--compact row__column--middle mr-1"><div style="width: 15px; height: 15px; border-radius: 2px; background: #' . $tag->color . ';"></div></div><div class="row__column row__column--middle">' . $tag->name . '</div></div>'];
        }

        foreach(Auth::user()->spaces as $space)
        {
            $spaces[] = ['key' => $space->id, 'label' => '<div class="row"><div class="row__column row__column--compact row__column--middle mr-1"><div style="width: 15px; height: 15px; border-radius: 2px; background: white;"></div></div><div class="row__column row__column--middle">' . $space->name . '</div></div>'];
        }

        return view('transactions.create', compact('tags', 'spaces'));
    }
}
