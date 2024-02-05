@extends('layouts.app')

@section('custom-css')
<style>
    .student-error{
        color: red;
    }
</style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Users List
                            <a href="{{ route('user-index') }}" class="btn btn-sm btn-primary float-end">Back</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" id="add-user-form">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                                <p></p>
                            </div>
                            <div class="form-group mb-3">
                                <label>Email</label>
                                <input type="text" name="email" id="email" class="form-control">
                                <p></p>
                            </div>
                            <div class="form-group mb-3">
                                <label>Mobile no.</label>
                                <input type="text" name="mobile" id="mobile" class="form-control">
                                <p></p>
                            </div>
                            <div class="form-group mb-3">
                                <label>Address</label>
                                <input type="text" name="address" id="address" class="form-control">
                                <p></p>
                            </div>
                            <div class="form-group mb-3">
                                <label>Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                                <p></p>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        $("#add-user-form").submit(function (event) {
            event.preventDefault();
            var data = $(this);
            // var student_id = $("#student_id").val();
            {{--var url = (!student_id || student_id == null) ? "{{route("teacher.add.student")}}" : "{{route("edit.student")}}";--}}
            $.ajax({
                // url: url,
                url: {{ route('user-store') }},
                type: 'post',
                data: data.serializeArray(),
                dataType: "json",
                success: function (response) {
                    console.log(response)
                    if (response['status'] == true){
                        $("#name").siblings("p").removeClass("student-error").html("");
                        $("#email").siblings("p").removeClass("student-error").html("");
                        $("#mobile").siblings("p").removeClass("student-error").html("");
                        $("#address").siblings("p").removeClass("student-error").html("");
                        $("#password").siblings("p").removeClass("student-error").html("");
                        $("#add-user-form")[0].reset();
                        window.location.href='{{ route('user-index') }}';
                    }
                    else{
                        var errors = response['errors'];
                        if (errors['name']){
                            $("#name").siblings("p").addClass("student-error").html(errors['name']);
                        } else {
                            $("#name").siblings("p").removeClass("student-error").html("");
                        }
                        if (errors['email']){
                            $("#email").siblings("p").addClass("student-error").html(errors['email']);
                        } else {
                            $("#email").siblings("p").removeClass("student-error").html("");
                        }
                        if (errors['mobile']){
                            $("#mobile").siblings("p").addClass("student-error").html(errors['mobile']);
                        } else {
                            $("#mobile").siblings("p").removeClass("student-error").html("");
                        }
                        if (errors['address']){
                            $("#address").siblings("p").addClass("student-error").html(errors['address']);
                        } else {
                            $("#address").siblings("p").removeClass("student-error").html("");
                        }
                        if (errors['password']){
                            $("#password").siblings("p").addClass("student-error").html(errors['password']);
                        } else {
                            $("#password").siblings("p").removeClass("student-error").html("");
                        }
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    </script>
@endsection
