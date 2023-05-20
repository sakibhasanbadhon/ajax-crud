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

</head>

<body>


<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto">

            <div class="alert-message mb-3">

            </div>

            <div class="card" style="background: #c6cdbe0a;">
                <div class="card-body">
                    <form method="post" id="ajaxForm" enctype="multipart/form-data">
                      @csrf
                        <div class="row" style="box-shadow: 1px -8px 20px 0px #ddd;padding: 16px;border-radius: 9px;">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="name-label" class="form-label">Name</label>
                                    <input type="text" name="name" id="name-label" class="form-control form-control-sm name">
                                </div>

                                <div class="mb-3">
                                    <label for="email-label" class="form-label">Email Address</label>
                                    <input type="email" name="email" id="email-label" class="form-control form-control-sm">
                                </div>

                                <div class="mb-3">
                                    <label for="phone-label" class="form-label">Phone Number</label>
                                    <input type="text" name="phone" id="phone-label" class="form-control form-control-sm">
                                </div>

                                <div class="mb-3">
                                    <label for="roll-label" class="form-label">Roll Number</label>
                                    <input type="number" name="roll" id="roll-label" class="form-control form-control-sm">
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label for="reg-label" class="form-label">Registration No</label>
                                    <input type="number" name="reg" id="regi-label" class="form-control form-control-sm">
                                </div>

                                <div class="mb-3">
                                    <label for="board-label" class="form-label">Board</label>

                                    <select name="board" class="form-select" id="board-label" aria-label="Default select example">
                                        <option selected>select please</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                      </select>
                                </div>

                                <div class="mb-3">
                                    <label for="profile-label" class="form-label">Profile</label>
                                    <input type="file" name="avatar" id="profile-label" class="form-control form-control-sm">
                                </div>


                            </div>
                        </div>

                        <button id="hi" type="submit" class="btn btn-sm btn-primary submit-btn d-block w-100">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>

    var _token = "{{ csrf_token() }}";

    $(document).ready(function(){

        // $('button.submit-btn').click(function() //button theke submit korleo hobe

        $('form#ajaxForm').submit(function(e){
            e.preventDefault();

            // let forms = document.getElementById('ajaxForm');
            // let form_Data = new FormData(forms);

            $.ajax({
                url:"{{ route('ajax.store') }}",
                type:"post",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success:function(response){
                    $('form')[0].reset();
                    $('.alert-message').append('<span class="alert alert-success d-block">'+response+'</span>')

                }

            })

        });
    });





</script>


</body>
</html>
