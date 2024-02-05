@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Users List
                            <a href="{{ route('user-create') }}" class="btn btn-sm btn-primary float-end">Add User</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>MOBILE</th>
                                    <th>ADDRESS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(!empty($users))
                                <?php $no = 1; ?>
                                @foreach($users as $key => $value)
                                    <tr>
{{--                                        <td>{{ $key }}</td>--}}
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $value['name'] }}</td>
                                        <td>{{ $value['email'] }}</td>
                                        <td>{{ $value['mobile'] }}</td>
                                        <td>{{ $value['address'] }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">No Record Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
