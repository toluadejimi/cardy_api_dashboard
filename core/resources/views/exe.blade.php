<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">



</head>


<div class="container">

    <div class="row">

        @if($set_trx == '1')
        <div class="col-sm-3 my-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">POS Transfer</h6>
                    <div class="col-lg-12">
                        <form method="POST" action="/block-pos?ref_trans_id={{ $set->pos_transfer }}">
                            @csrf
                            @method('POST')

                            <button type="submit" class="btn btn-danger btn-md mt-2">Stop POS Transfer</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        @else
        <div class="col-sm-3 my-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">POS Transfer</h6>
                    <div class="col-lg-12">
                        <form method="POST" action="/unblock-pos">
                            @csrf
                            @method('POST')

                            <button type="submit" class="btn btn-success btn-md mt-2">Activate Pos Transfer</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        @endif



    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif



    <div class="mt-4">
        <table class="table responsive">

            <thead>

                <tr>

                    <th>TRX ID</th>

                    <th>Name</th>

                    <th>Amount</th>
                    <th>Time</th>

                    <th>Time Left</th>


                    <th>Action</th>

                    <th>Action</th>




                </tr>

            </thead>

            <tbody>

                @foreach($trx as $user)

                <tr>

                    <td>{{ $user->ref_trans_id }}</td>

                    <td>{{ $user->user->first_name }} {{ $user->user->last_name }}</td>

                    <td>NGN {{ number_format($user->amount, 2) }}</td>

                     <td>{{date("h:i:A", strtotime($user->created_at))}}</td>


                   


                    <td>

                        <p id="demo"></p>

                        <script>

                            // Set the date we're counting down to
                        var countDownDate = new Date ("{{date("F d, Y H:i:s", strtotime($user->created_at))}}").getTime();

                        // Update the count down every 1 second
                        var x = setInterval(function() {

                          // Get today's date and time
                          var now = new Date().getTime();

                          // Find the distance between now and the count down date
                          var distance = countDownDate - now;

                          // Time calculations for days, hours, minutes and seconds
                          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                          var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                          // Output the result in an element with id="demo"
                          document.getElementById("demo").innerHTML =  seconds + "s ";

                          // If the count down is over, write some text
                          if (distance < 0) {
                            clearInterval(x);
                            document.getElementById("demo").innerHTML = "EXPIRED";
                          }
                        }, 1000);
                        </script>
                    </td>


                    <td>
                        <div class="col-lg-12">
                            <form method="POST" action="/delete-trx?ref_trans_id={{ $user->ref_trans_id }}">
                                @csrf
                                @method('POST')

                                <button type="submit" class="btn btn-danger btn-sm mt-2">Delete Transaction</button>
                            </form>
                        </div>
                    </td>


                    <td>
                        @if($user->user->status == 7)
                        <div class="col-lg-12">
                            <form method="POST" action="/unblock-user?user_id={{ $user->user_id }}">
                                @csrf
                                @method('POST')

                                <button type="submit" class="btn btn-success btn-sm mt-2 text-white">Unblock
                                    User</button>
                            </form>
                        </div>
                        @else
                        <div class="col-lg-12">
                            <form method="POST" action="/block-user?user_id={{ $user->user_id }}">
                                @csrf
                                @method('POST')

                                <button type="submit" class="btn btn-warning btn-sm mt-2 text-white">Block User</button>
                            </form>
                        </div>
                        @endif
                    </td>


                </tr>

                @endforeach

            </tbody>

        </table>

    </div>









    <script>
        $(function() {

    $('.toggle-class').change(function() {

        var status = $(this).prop('checked') == true ? 1 : 0;

        var user_id = $(this).data('id');



        $.ajax({

            type: "GET",

            dataType: "json",

            url: '/changeStatus',

            data: {'status': status, 'user_id': user_id},

            success: function(data){

              console.log(data.success)

            }

        });

    })

  })

    </script>

</div>

</body>

</html>