<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>    <title>Ajax</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>



    <script>
        $(document).ready(function(){
          $("#hide").click(function(){
            $("p").hide();
          });
          $("#show").click(function(){
            $("p").show();
          });
        });
    </script>



        <p>If you click on the "Hide" button, I will disappear.</p>

        <button id="hide">Hide</button>
        <button id="show">Show</button>



{{--
<script>
$(document).ready(function(){
  $("#button").click(function(){
    $('h1').hide();
  });
});
</script> --}}



<div>

    <p id="para">Lorem ipsum dolor sit amet.</p>
    <button id="click-button" class="btn btn-danger btn-sm"> send </button>

    <h1></h1>

</div>


<script>
    $(document).ready(function(){
        const para = $('p#para').text();

        $('#click-button').click(function () {
            $.ajax({
                url:"{{ route('ajax.request') }}",
                type:"get",
                data:{para_text:para},
                success:function(response){
                    // alert(response);
                    $('h1').text(response.data);

                }
            });
        })

    });

</script>





<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mx-auto">

            <div class="alert-message mb-3">

            </div>

            <div class="card" style="background: #c6cdbe0a;">
                <div class="card-body">
                    <form method="post">
                      @csrf
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


                        <button id="hi" type="button" class="btn btn-sm btn-primary submit-btn d-block w-100">Submit</button>
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
        $('button.submit-btn').click(function(){
            let name = $('input[name="name"]').val();
            let email = $('input[name="email"]').val();
            let phone = $('input[name="phone"]').val();

            $.ajax({
                url:"{{ route('ajax.store') }}",
                type:"post",
                data:{
                    name:name,
                    email:email,
                    phone:phone,
                    _token: _token
                },
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
