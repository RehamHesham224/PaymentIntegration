<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transactions.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $transactions = Transaction::select(['payment_id', 'amount', 'currency', 'created_at', 'status']);
            return DataTables::of($transactions)
//                ->addColumn('action', function ($transaction) {
//                    // Add any additional action buttons or HTML here
//                    return '';
//                })
                ->toJson();
        }
    }
}
