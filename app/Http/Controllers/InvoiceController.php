<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Customer;
use App\InvoicesItem;
use App\Product;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Mpociot\VatCalculator\Facades\VatCalculator;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return redirect()->route('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $customer = Customer::findOrFail(\request('customer_id',''));
        $tax =VatCalculator::getTaxRateForLocation($customer->country->code) * 100;

        $products = Product::all();

        return view('invoices.create',compact('tax','products','customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $invoice = Invoice::create($request->invoice);

        for ($i=0; $i<count($request->product); $i++){
            if (isset($request->qty[$i]) && isset($request->price[$i])){
                InvoicesItem::create([
                    'invoice_id' => $invoice->id,
                    'name' => $request->product[$i],
                    'quantity'=> $request->qty[$i],
                    'price'=>$request->price[$i]
                ]);
            }
        }




        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.show',compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

    /**
     * @param Invoice $invoice
     * Download PDF
     */

    public function download(Invoice $invoice)
    {
        $invoice->load('invoice_items');

        $pdf = PDF::loadView('invoices.pdf', compact('invoice'));

        return $pdf->stream('invoice.pdf');
    }
}
