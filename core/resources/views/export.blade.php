<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>


<body>


    <div class="container">

        <div class="row">

            <div class="col-sm-6 my-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Back Up User Table</h6>
                        <div class="col-lg-12">
                            <form method="POST" action="export-trx">
                                @csrf
                                @method('POST')

                                <label>Choose User</label>
                                <select class="form-control" required name="id">
                                    @foreach($users as $data)
                                    <option value="{{ $data->id }}"> {{ $data->first_name }} {{ $data->last_name }}</option>
                                    @endforeach
                                </select>

                                <input class="form-control" type="date" name="from" required>

                                <input class="form-control" type="date" name="to" required>

                                <input class="form-control" type="text" placeholder="serial no" name="serial_no">



                                <button type="submit" class="btn btn-primary btn-md mt-2">Continue</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-sm-6 my-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Back Up User Table</h6>
                        <div class="col-lg-12">
                            <form method="POST" action="backup-user">
                                @csrf
                                @method('POST')

                                <label>Pin</label>
                                <input class="form-control" type="password" name="pass" required>

                                <button type="submit" class="btn btn-primary btn-md mt-2">Back Up Users</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>




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

                        @foreach($transaction as $data)
                        <tr>

                            <td>{{ $data->ref_trans_id }}</td>

                            <td>{{ $data->user->first_name }} {{ $data->user->last_name }}</td>
                            <td>NGN {{ number_format($data->amount, 2) }}</td>
                            <td>{{date("h:i:A", strtotime($data->created_at))}}</td>


                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>






    </div>


</body>



</html>
