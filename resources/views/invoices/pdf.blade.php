@extends('layouts.pdf')

@section('content')
    <div class="clearfix">
        @if(config('invoices.logo_file') != '')
            <div class="text-center">
                <img class="img-fluid" src="{{ asset(config('invoices.logo_file')) }}" alt="logo">
            </div>
        @endif

            <div class="text-center">
                <b>Invoice number*:</b> {{ $invoice->invoice_number }}
                <br/>
                <b>Invoice date*:</b> {{ $invoice->invoice_date }}
            </div>
    </div>

    <div class="clearfix mt-3">
        <div class="float-left">
            <b>To</b>
            {{ $invoice->customer->name }}
            <br><br>
            <b>Address</b>
            {{ $invoice->customer->address }}
            @if($invoice->customer->postcode != '')
                ,
                {{ $invoice->customer->postcode }}
            @endif
            @if($invoice->customer->city != '')
                ,
                {{ $invoice->customer->city }}
            @endif
            @if($invoice->customer->state != '')
                ,
                {{ $invoice->customer->state }}
            @endif
            @if($invoice->customer->country != '')
                ,
                {{ $invoice->customer->country }}
            @endif
            @if($invoice->customer->phone != '')
                <br><br> <b>Phone<</b> {{ $invoice->customer->phone }}
            @endif
            @if($invoice->customer->email != '')
                <br><br> <b>Email</b>> {{ $invoice->customer->email }}
            @endif

            @if($invoice->customer->customer_fields != '')
                @foreach($invoice->customer->customer_fields as $field)
                    <br/>  <br/> <b>{{ $field->field_key }}: </b> {{ $field->field_value }}
                @endforeach
            @endif
            <br><br>
        </div>
    </div>

    <div class="clearfix mt-3">
        <table class="table table-bordered table-hover" id="tab_logic">
            <thead>
            <tr>
                <th class="text-center"> #</th>
                <th class="text-center"> Product</th>
                <th class="text-center"> Qty</th>
                <th class="text-center"> Price ({{ config('invoices.currency') }})</th>
                <th class="text-center"> Total ({{ config('invoices.currency') }})</th>
            </tr>
            </thead>
            <tbody>
            @foreach($invoice->invoice_items as $item)
                <tr id='addr0'>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price,2) }} ({{ config('invoices.currency') }})</td>
                    <td>{{ number_format($item->quantity * $item->price,2) }} ({{ config('invoices.currency') }})</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="clearfix mt-3">
        <table class="table table-bordered table-hover" id="tab_logic_total">
            <tbody>
            <tr>
                <th class="text-center" width="50%">Sub Total</th>
                <td class="text-center">{{ number_format($invoice->total_amount,2) }}</td>
            </tr>
            <tr>
                <th class="text-center">Tax ({{ config('invoices.currency') }})</th>
                <td class="text-center">
                    <div class="input-group mb-2 mb-sm-0">
                        {{ $invoice->tax_percent }}
                        <div class="input-group-addon">%</div>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="text-center">Tax Amount ({{ config('invoices.currency') }})</th>
                <td class="text-center">{{ number_format(($invoice->total_amount * $invoice->tax_percent) / 100,2)}}</td>
            </tr>
            <tr>
                <th class="text-center">Grand Total ({{ config('invoices.currency') }})</th>
                <td class="text-center">{{ number_format($invoice->total_amount * ($invoice->total_amount * $invoice->tax_percent) / 100,2) }}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="clearfix mt-3">
        <div class="col-md-12">
            {{ config('invoices.foot_text') }}
        </div>
    </div>

@endsection
