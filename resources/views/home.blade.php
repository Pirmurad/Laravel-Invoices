@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <table class="table table-bordered table-hover">
                          <tr>
                              <th>Invoice Date</th>
                              <th>Invoice Number</th>
                              <th>Invoice Customer</th>
                              <th>Total Amount</th>
                              <th>Total Amount</th>
                          </tr>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->invoice_date }}</td>
                                    <td>{{ $invoice->invoice_number }}</td>
                                    <td>{{ $invoice->customer->name }}</td>
                                    <td>{{ number_format($invoice->total_amount,2) }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-secondary" href="{{ route('invoices.show',$invoice->id) }}">View</a>
                                        <a class="btn btn-sm btn-danger" href="{{ route('invoices.download',$invoice->id) }}">PDF</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
