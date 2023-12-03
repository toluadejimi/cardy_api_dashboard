@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">


            <div class="col-md-4">


                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                            <div>
                                <h3 class="mb-2">Total In</h3>
                                <ul class="list list-unstyled mb-0">
                                    <h2><span
                                            class="text-default text-sm">{{$currency->symbol.number_format($moneyin)}}</span>
                                    </h2>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                            <div>
                                <h3 class="mb-2">Bank Transfer (Mobile App)</h3>
                                <ul class="list list-unstyled mb-0">
                                    <h2><span
                                            class="text-default text-sm">{{$currency->symbol.number_format($mobiletransfer)}}</span>
                                    </h2>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                            <div>
                                <h3 class="mb-2">Web Payment</h3>
                                <ul class="list list-unstyled mb-0">
                                    <h2><span
                                            class="text-default text-sm">{{$currency->symbol.number_format($webpay)}}</span>
                                    </h2>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <div class="col-md-4">


                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                            <div>
                                <h3 class="mb-2">Total Out</h3>
                                <ul class="list list-unstyled mb-0">
                                    <h2><span
                                            class="text-default text-sm">{{$currency->symbol.number_format($moneyout)}}</span>
                                    </h2>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                            <div>
                                <h3 class="mb-2">POS Purchase</h3>
                                <ul class="list list-unstyled mb-0">
                                    <h2><span
                                            class="text-default text-sm">{{$currency->symbol.number_format($purchase)}}</span>
                                    </h2>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                            <div>
                                <h3 class="mb-2">Total VAS</h3>
                                <ul class="list list-unstyled mb-0">
                                    <h2><span
                                            class="text-default text-sm">{{$currency->symbol.number_format($vas)}}</span>
                                    </h2>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>





            </div>

            <div class="col-md-4">


                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                            <div>
                                <h3 class="mb-2">POS Transfer</h3>
                                <ul class="list list-unstyled mb-0">
                                    <h2><span
                                            class="text-default text-sm">{{$currency->symbol.number_format($postransfer)}}</span>
                                    </h2>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                            <div>
                                <h3 class="mb-2">Wallet Funding</h3>
                                <ul class="list list-unstyled mb-0">
                                    <h2><span
                                            class="text-default text-sm">{{$currency->symbol.number_format($walletfund)}}</span>
                                    </h2>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


            </div>












            <div class="col-lg-12">
                <div class="card-body">
                    <a href="{{route('new.transaction')}}" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i>
                        {{__('New Transaction')}}</a>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                    <form action="{{ route('admin.search-transactions') }}" method="GET">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="date" class="form-control" name="from">
                            </div>

                            <div class="col-md-4">
                                <input type="date" class="form-control" name="to">
                            </div>

                        {{-- <select class="form-control" name="transaction_type">

                            <value data="">Any</value>
                            <value data="CashOut">POS</value>
                            <value data="">Purchase</value>
                            <value data="">Any</value>


                        </select> --}}

                        <button type="submit" class="btn btn-success">Search</button> 

                    </div>



                    </form>
                    
                </div

            </div>


        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Transactions')}}</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th>{{__('S / N')}}</th>
                                    <th>{{__('Trx ID')}}</th>
                                    <th>E REF</th>
                                    <th>Title</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                    <th>E Fee</th>
                                    <th>Profit</th>
                                    <th>Terminal No</th>
                                    <th>Sender Name</th>
                                    <th>Sender Account</th>
                                    <th>Sender Bank</th>
                                    <th>Receiver Name</th>
                                    <th>Receiver Account</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $k=>$item)
                                <tr>
                                    <td>{{++$k}}.</td>
                                    <td>{{$item->ref_trans_id}}</td>
                                    <td>{{$item->e_ref}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->user->first_name ?? "name"}} {{$item->user->last_name ?? "name"}}</td>
                                    <td>{{number_format($item->amount)}}</td>
                                    <td>{{number_format($item->debit)}}</td>
                                    <td>{{number_format($item->credit)}}</td>
                                    <td>{{number_format($item->balance)}}</td>
                                    <td>{{number_format($item->fee)}}</td>
                                    <td>{{number_format($item->enkPay_Cashout_profit)}}</td>
                                    <td>{{$item->serial_no}}</td>
                                    <td>{{$item->sender_name}}</td>
                                    <td>{{$item->sender_account_no}}</td>
                                    <td>{{$item->sender_bank}}</td>
                                    <td>{{$item->receiver_name}}</td>
                                    <td>{{$item->receiver_account_no}}</td>

                                    @if($item->status == "1")
                                    <td><span class="badge rounded-pill bg-success text-white ">Successful</span></td>
                                    @elseif($item->status == "2")
                                    <td><span class="badge rounded-pill bg-warning text-white">Pending</span></td>
                                    @elseif($item->status == "3")
                                    <td><span class="badge rounded-pill bg-warning text-white">Reversed</span></td>
                                    @elseif($item->status == "0")
                                    <td><span class="badge rounded-pill bg-warning text-white">Pending</span></td>
                                    @else
                                    <td><span class="badge rounded-pill bg-danger text-white">Declined</span></td>
                                    @endif

                                    <td>{{date('F d, Y', strtotime($item->created_at))}}</td>
                                    <td>{{date('h:i:s A', strtotime($item->created_at))}}</td>

                                </tr>
                                @endforeach
                            </tbody>

                            {{-- <tfoot>
                                <tr>
                                    <td colspan="n">Total:</td> 
                                    <td>{{ $pos_total }}</td>
                                </tr>
                            </tfoot> --}}

                            {{-- {{ $transactions->onEachSide(5)->links() }} --}}

                        </table>


                    </div>
                </div>
            </div>
        </div>






        @stop
