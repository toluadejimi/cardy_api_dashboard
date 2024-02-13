<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Transaction Report</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>



</head>



<body style="background-color: #eef5ff;">

    <div class="container">
        <main>
            <div class="py-5">
                <img class="" src="{{ url('') }}/asset/images/dark-logo1.svg" alt="" width="200" height="100">
                <h6>Transaction Report</h6>
            </div>


            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">

                    <div class="col-6">
                        <span class="badge bg-dark my-3">Account Information</span>

                    </div>



                    <ul class="list-group mb-3">

                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0 text-muted">Customer Name</h6>
                            </div>
                            <strong> {{ $user->first_name }} {{ $user->last_name }} </strong>
                        </li>

                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0 text-muted">Serial No</h6>
                            </div>
                            <strong> {{ $serial_no }} </strong>
                        </li>


                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0 text-muted">Total Credit</h6>
                            </div>
                            <strong><span class=" text-bold text-success">NGN {{number_format($total_credit, 2)}}</span></strong>
                        </li>

                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0 text-muted">Total Debit</h6>
                            </div>
                            <strong><span class="text-bold text-danger">NGN {{number_format($total_debit, 2)}}</span></strong>
                        </li>

                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0 text-muted">Transaction Count</h6>
                            </div>
                            <strong><span class="text-muted">{{ number_format($tranaction_count, 2) }}</span></strong>
                        </li>



                        <li class="list-group-item d-flex justify-content-between">
                            <span>Avaivalable Balance</span>
                            <strong>NGN{{ number_format($balance, 2) }}</strong>
                        </li>



                    </ul>


                </div>
                <div class="col-md-7 col-lg-8">
                    <span class="badge bg-dark my-3">Transactions Report from {{ $from  }} - {{ $to }}</span>


                    <div class="card">
                        <div class="col-lg-12">
                            <div class="card-body">
                                <h5>{{__('All Transactions')}}</h5>
                                <a href="/download-pdf?id={{ $user->id }}&serial_no={{$serial_no}}&from={{ $from }}&to={{ $to }}" class="btn btn-sm btn-dark">PDF</a>
                                <div class="table-responsive py-4">
                                    <table class="table-responsive-lg table display mb-4 dataTablesCard order-table card-table text-black dataTable no-footer student-tbl" id="example5">
                                        <thead>
                                            <tr class="table-dark">
                                                <th>{{__('Date Time')}}</th>
                                                <th>{{__('Debit')}}</th>
                                                <th>{{__('Credit')}}</th>
                                                <th>{{__('Balance')}}</th>
                                                <th>{{__('Remarks')}}</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($transaction as $k=>$val)
                                            <tr>
                                                <td class="text-small">{{date("d/m/Y h:i:A", strtotime($val->created_at))}}</td>
                                                <strong>
                                                    <td class="text-danger text-small">₦{{number_format($val->debit, 2)}}</td>
                                                </strong>
                                                <strong>
                                                    <td class="text-success text-small">₦{{number_format($val->credit, 2)}}</td>
                                                </strong>
                                                <strong>
                                                    <td class="text-small">₦{{number_format($val->balance, 2)}}</td>
                                                </strong>
                                                <td class="text-small">{{$val->note}}</td>

                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>






                </div>
            </div>
        </main>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">ENKWAVE DYNAMICS TECHNOLOGY LTD</p>
            <p>No 4 Bode Thomas, Surulere, Lagos</p>
            <p>Info@enkwave.com</p>
        </footer>
    </div>

</body>
</html>
