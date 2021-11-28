@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Customers') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a class="btn btn-primary" href="{{ route('customers.create') }}">Add new customer</a>
                        <br> <br>

                        <table class="table table-responsive table-bordered table-hover">
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Postcode</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>{{ $customer->postcode }}</td>
                                    <td>{{ $customer->city }}</td>
                                    <td>{{ $customer->state }}</td>
                                    <td>{{ $customer->country->name }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{ route('invoices.create')  }}?customer_id={{ $customer->id }}">New Invoice</a>
                                        <a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="ConfirmDelete();">Delete</a>
                                        <form id="delete_customer" style="display: none;" action="{{ route('customers.destroy',$customer->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
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
@section('scripts')
    <script type="text/javascript">
        function ConfirmDelete()
        {
            if (confirm("Delete Account?"))
                window.document.getElementById('delete_customer').submit();
        }
    </script>
@endsection
