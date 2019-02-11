<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenseItems = Expense::all();
        return view('expense/all_expenses', compact('expenseItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expense/add_expense');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $description = $request->description;
        $date = $request->expense_date;
        $amount = $request->expense_amount;
        $payee = $request->expense_payee;
        $paymentmethod = $request->payment_method;
        $reference = $request->reference;
        $note = $request->expense_note;

       $expense = new Expense();
       $expense->description = $description;
       $expense->date = $date;
       $expense->amount = $amount;
       $expense->payee = $payee;
       $expense->paymentmethod = $paymentmethod;
       $expense->reference = $reference;
       $expense->note = $note;

       $expense->save();

       return redirect(route('allExpenses'));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = Expense::where('id', $id)->first();
        return view('expense.edit_expense', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->expense_id;
        $expense = Expense::where('id', $id)->first();

        $description = $request->description;
        $date = $request->expense_date;
        $amount = $request->expense_amount;
        $payee = $request->expense_payee;
        $paymentmethod = $request->payment_method;
        $reference = $request->reference;
        $note = $request->expense_note;

        $expense->description =$description;
        $expense->date = $date;
        $expense->amount = $amount;
        $expense->payee = $payee;
        $expense->paymentmethod = $paymentmethod;
        $expense->reference = $reference;
        $expense->note = $note;

        $expense->update();
        return redirect(route('allExpenses'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Expense::find($id)->delete();
        return redirect(route('allExpenses'));
        
    }

    public function reset() {
        return redirect()->back();
    }
}
