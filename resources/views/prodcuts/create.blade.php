@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Add new product') }}</div>
                    <div class="card-body">
                        <form action="{{ route('products.store') }}" method="post">
                            @csrf

                            Name: <input type="text" name="name" class="form-control" required>
                            <br>
                            Price: <input type="number" step="0.1" name="price" class="form-control" required>
                            <br>

                            <input type="submit" value="Save" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
