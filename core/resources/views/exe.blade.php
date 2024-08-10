Ï<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>


<body class="container">

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


    @if($set->opay_trx == '1')
        <div class="col-sm-3 my-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Opay</h6>
                    <div class="col-lg-12">
                        <form method="POST" action="/lock-opay">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-danger btn-md mt-2">Lock</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @else
        <div class="col-sm-3 my-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Opay</h6>
                    <div class="col-lg-12">
                        <form method="POST" action="/unlock-opay">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-success btn-md mt-2">Unlock</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endif

        @if($set->palmpay_trx == '1')
            <div class="col-sm-3 my-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Palmpay</h6>
                        <div class="col-lg-12">
                            <form method="POST" action="/lock-palmpay">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger btn-md mt-2">Lock</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @else
            <div class="col-sm-3 my-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Palmpay</h6>
                        <div class="col-lg-12">
                            <form method="POST" action="/unlock-palmpay">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-success btn-md mt-2">Unlock</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @endif


        @if($set->ninepsb == '1')
            <div class="col-sm-3 my-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">9psb</h6>
                        <div class="col-lg-12">
                            <form method="POST" action="/lock-ninepsb">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger btn-md mt-2">Lock</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @else
            <div class="col-sm-3 my-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">9psb</h6>
                        <div class="col-lg-12">
                            <form method="POST" action="/unlock-ninepsb">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-success btn-md mt-2">Unlock</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @endif


        @if($set->wema_transfer == '1')
            <div class="col-sm-3 my-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Wema</h6>
                        <div class="col-lg-12">
                            <form method="POST" action="/lock-wema">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger btn-md mt-2">Lock</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @else
            <div class="col-sm-3 my-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Wema</h6>
                        <div class="col-lg-12">
                            <form method="POST" action="/unlock-wema">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-success btn-md mt-2">Unlock</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @endif


    <div class="col-sm-3 my-3">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Get Transactions</h6>
                <div class="col-lg-12">
                    <form method="POST" action="get-transaction">
                        @csrf
                        @method('POST')

                        <label>Date From</label>
                        <input class="form-control" type="date" name="from" required>

                        <label>Date To</label>
                        <input class="form-control" type="date" name="to" required>
                        <label>Pin</label>
                        <input class="form-control" type="password" name="pass" required>

                        <button type="submit" class="btn btn-primary btn-md mt-2">Get Transaction</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="col-sm-3 my-3">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Delete Transactions</h6>
                <div class="col-lg-12">
                    <form method="POST" action="delete-transaction">
                        @csrf
                        @method('POST')

                        <label>Date From</label>
                        <input class="form-control" type="date" name="from" required>

                        <label>Date To</label>
                        <input class="form-control" type="date" name="to" required>
                        <label>Pin</label>
                        <input class="form-control" type="password" name="pass" required>

                        <button type="submit" class="btn btn-primary btn-md mt-2">Detele Transaction</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="col-sm-3 my-3">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Download Excel Transactions</h6>
                <div class="col-lg-12">
                    <form method="POST" action="excel-transaction">
                        @csrf
                        @method('POST')

                        <label>Date From</label>
                        <input class="form-control" type="date" name="from" required>

                        <label>Date To</label>
                        <input class="form-control" type="date" name="to" required>


                        <label>Pin</label>
                        <input class="form-control" type="password" name="pass" required>

                        <button type="submit" class="btn btn-primary btn-md mt-2">Download Excel Transaction</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="col-sm-3 my-3">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Back Up Transactions Table</h6>
                <div class="col-lg-12">
                    <form method="POST" action="backup-transaction">
                        @csrf
                        @method('POST')

                        <label>Date From</label>
                        <input class="form-control" type="date" name="from" required>

                        <label>Date To</label>
                        <input class="form-control" type="date" name="to" required>

                        <label>Pin</label>
                        <input class="form-control" type="password" name="pass" required>

                        <button type="submit" class="btn btn-primary btn-md mt-2">Back up Transactions</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="col-sm-3 my-3">
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





</div>

</body>

</html>
