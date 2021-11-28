@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Products') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a class="btn btn-primary" href="{{ route('products.create') }}">Add new product</a>
                        <br> <br>

                        <table class="table table-sm table-bordered table-hover">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <a class="btn btn-danger" href="javascript:void(0)" onclick="ConfirmDelete();">Delete</a>
                                        <form id="delete_product" style="display: none;" action="{{ route('products.destroy',$product->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%"><div class="alert alert-danger">No products found</div></td>
                                </tr>
                            @endforelse
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
                window.document.getElementById('delete_product').submit();
        }
    </script>
@endsection
