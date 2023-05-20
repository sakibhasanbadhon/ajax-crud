@extends('layouts.app')

@section('content')



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>AJAX</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.0/css/all.min.css" integrity="sha512-3PN6gfRNZEX4YFyz+sIyTF6pGlQiryJu9NlGhu9LrLMQ7eDjNgudQoFDK3WSNAayeIKc6B8WXXpo4a7HqxjKwg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .profile-img{
            width: 50px;
            height:50px;
            border-radius: 5px;
        }
    </style>
</head>

<body>


    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="alert-message">

                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0 card-title d-flex justify-content-between align-items-center">student List
                            
                            <button class="btn btn-sm btn-primary" onclick="addNew_btn('New Student','Save Change')"> Add New</button>
                            
                        </h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <th>SL</th>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Roll</th>
                                <th>reg</th>
                                <th>Board</th>
                                <th>Action</th>
                            </thead>

                            <tbody id="student-body">

                            </tbody>
                        </table>
                    </div>

                </div>



            </div>
        </div>
    </div>


@include('modal')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>


    var _token = "{{ csrf_token() }}"; //security er jonno

    var student_modal = new bootstrap.Modal(document.getElementById('student-modal'),{
    keyboard: false,
    backdrop:'static'

    });


    // setTimeout(function() {
    //     $('.alert-message').addClass('d-none');

    // }, 2000);


    function addNew_btn(modal_title,save_btn_text) {
        $('form.ajaxForm input[name="update"]').val();
        $('form#ajaxForm').addClass('ajaxForm'); //form a ajaxForm class add hobe
        $('form.ajaxForm').removeClass('update-form'); //form a "update-form" class remove hobe

        $('form.ajaxForm').find('.error-msg').remove(); //modal close then open korle jeno error msg na thake
        $('#title-modal').text(modal_title); //oporer addnew button a click korle "onclick="save_btn('New Student','Save Change')"  daynamic vabe modal title show korbe
        $('button.save-btn').text(save_btn_text); //oporer addnew button a click korle "onclick="addNew_btn('New Student','Save Change')"  daynamic vabe modal title show korbe
        $('form.ajaxForm')[0].reset(); //Modal show korar age form reset hobe
        $('form.ajaxForm .modalEdit_avatar').html(''); //Modal show korar age image reset hobe

        $('.board-select').html(`
                <label for="board-label" class="form-label">Board</label>
                <select name="board" class="form-select" id="board">
                    <option value="">select please</option>
                    <option value="Dhaka">Dhaka</option>
                    <option value="Bogura">Bogura</option>
                    <option value="Rangpur">Rangpur</option>
                    <option value="Barishal">Barishal</option>
                </select>
        `) //Modal show korar age selectOption reset hobe

        student_modal.show(); //modal show
    }




    // store data

    $(document).on('submit','form.ajaxForm',function(e){
        e.preventDefault(); //page jeno load na hoy
        $.ajax({
            url: "{{ route('ajax.store') }}",
            type: "post",
            data: new FormData(this),
            contentType:false,
            processData:false,
            success: function(response){
                $('form.ajaxForm').find('.error-msg').remove(); //modal save button a click korle akadhik bar error smg show na kore
                if (response.status == false){
                    $.each(response.error, function(key,value) {
                        $('form.ajaxForm #'+key).parent().append('<span class="text-danger error-msg">'+value+'</span>')
                    });

                }else{

                if (response.status == 'success')
                {
                    fetch_data(); //fetch_data method ta reload korar jonno
                    $('form.ajaxForm')[0].reset();
                    student_modal.hide(); // modal hide
                    $('.alert-message').append('<div class="alert alert-success py-2">'+response.message+'</div>')
                }else{
                    $('.alert-message').append('<div class="alert alert-danger py-2">'+response.message+'</div>')
                }



            }


            }
        });
    });





    //Data fetch from database

    function fetch_data(){
        $.ajax({
            url:"{{ route('ajax.get-data') }}",
            type:"post",
            dataType:"json",
            data:{_token:_token},
            success: function(response){
                // console.log(response); //inspect er network option a response dekhar jonno
                $('tbody#student-body').html(response);
            }
        });
    }


    fetch_data();



    // student edit
    $(document).on('click','button.edit-btn', function(){
        let student_id = $(this).data('id');
        $('form.ajaxForm').find('.error-msg').remove(); //
        $('#title-modal').text('Edit Student'); //edit-btn a click korle modal title a "Edit Student" show korbe
        $('button.save-btn').text('Save Changes'); //edit-btn a click korle modal er save button a "save change" show korbe
        $('form#ajaxForm input[name="update"]').val(student_id); // modal er update input a id anar jonno

        $('form.ajaxForm').addClass('update-form'); //form a "update-form" name a akta class newa holo
        $('form.update-form').removeClass('ajaxForm'); // form theke "ajaxForm" class ta remove korbe

        $.ajax({
            url: "{{ route('ajax.edit') }}",
            type: "post",
            data:{_token:_token,student_id:student_id},
            success: function (response) {
                if (response) {
                    let avatar_path = "{{ asset('images/profile/') }}/"+response.avatar;
                    $('form#ajaxForm input[name="name"]').val(response.name);
                    $('form#ajaxForm input[name="email"]').val(response.email);
                    $('form#ajaxForm input[name="phone"]').val(response.phone);
                    $('form#ajaxForm input[name="roll"]').val(response.roll);
                    $('form#ajaxForm input[name="reg"]').val(response.reg);

                    $('form#ajaxForm .modalEdit_avatar').html('<img src="'+avatar_path+'" width="150" height="100" class="profile_img" alt="profile">');

                    student_board(response.id);
                    student_modal.show();
                }

            }
        });

        student_modal.show(); // modal hide
    });




    // Update data

    $(document).on('submit','form.update-form',function(e){
        e.preventDefault(); //page jeno load na hoy
        $.ajax({
            url: "{{ route('ajax.update') }}",
            type: "post",
            data: new FormData(this),
            contentType:false,
            processData:false,
            success: function(response){
                $('form.update-form').find('.error-msg').remove(); //modal save button a click korle akadhik bar error smg show na kore
                if (response.status == false){
                    $.each(response.error, function(key,value) {
                        $('form.update-form #'+key).parent().append('<span class="text-danger error-msg">'+value+'</span>')
                    });

                }else{

                if (response.status == 'success')
                {
                    fetch_data(); //fetch_data method ta reload korar jonno
                    $('form.update-form')[0].reset();
                    student_modal.hide(); // modal hide
                    $('.alert-message').append('<div class="alert alert-success py-2">'+response.message+'</div>')
                }else{
                    $('.alert-message').append('<div class="alert alert-danger py-2">'+response.message+'</div>')
                }



            }


          }
        });
    });



    // student board select

    function student_board(student_id){
        $.ajax({
            url: "{{ route('ajax.board-select') }}",
            type: "post",
            data:{_token:_token,student:student_id},
            success: function (response) {
                if (response) {
                    $('.board-select').html(response);

                }
            }
        });
    }






    // student delete
    $(document).on('click','button.delete-btn', function(){
        let student_id = $(this).data('id');

        $.ajax({
            url: "{{ route('ajax.destroy') }}",
            type: "post",
            data:{_token:_token,student:student_id},
            success: function (response) {
                if (response.status =='success') {
                    fetch_data(); //fetch_data method ta reload korar jonno

                    $('.alert-message').append('<div class="alert alert-success py-2">'+response.message+'</div>')

                }
            }
        });
    });




</script>

</body>
</html>

@endsection
