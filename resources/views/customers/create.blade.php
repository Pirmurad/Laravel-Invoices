@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Add new Customer') }}</div>
                    <div class="card-body">
                        <form action="{{ route('customers.store') }}" method="post">
                            @csrf

                            Name: <input type="text" name="name" class="form-control" required>
                            <br>
                            Address*: <input type="text" name="address" class="form-control" required>
                            <br>
                            Postcode/ZIP*: <input type="text" name="postcode" class="form-control" required>
                            <br>
                            City*: <input type="text" name="city" class="form-control" required>
                            <br>
                            State*: <input type="text" name="state" class="form-control" required>
                            <br>
                            Country*: <select name="country_id" id="country" class="form-control" required>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }} ({{ $country->code }})</option>
                                @endforeach
                            </select>
                            <br>
                            Phone: <input type="text" name="phone" class="form-control" required>
                            <br>
                            Email: <input type="email" name="email" class="form-control" required>
                            <br>
                            <b>Additional fileds</b> (optional):
                            <br>
                            <table class="table table-bordered table-hover">
                                <tbody>
                                <tr>
                                    <th class="text-center" width="50%">Field</th>
                                    <th class="text-center">Value</th>
                                </tr>
                                @for($i=0; $i<3; $i++)
                                    <tr>
                                        <td class="text-center">
                                            <input type="text" name="customer_fields[{{ $i }}][field_key]"
                                                   class="form-control">
                                        </td>
                                        <td class="text-center">
                                            <input type="text" name="customer_fields[{{ $i }}][field_value]"
                                                   class="form-control">
                                        </td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>

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
