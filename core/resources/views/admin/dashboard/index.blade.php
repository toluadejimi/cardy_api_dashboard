@extends('master')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-xl-12">
                @if($admin->id==1)
                    <div class="row">
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                                        <div>
                                            <h4 class="mb-1">Total In</h4>
                                            <ul class="list list-unstyled mb-0">
                                                <h5><span
                                                        class="text-default text-sm">{{$currency->symbol.number_format($in)}}</span>
                                                </h5>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">

                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                                        <div>
                                            <h4 class="mb-1">Total Out</h4>
                                            <ul class="list list-unstyled mb-0">
                                                <h5><span
                                                        class="text-default text-sm">{{$currency->symbol.number_format($out)}}</span>
                                                </h5>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                                        <div>
                                            <h4 class="mb-1">Wallet</h4>
                                            <ul class="list list-unstyled mb-0">
                                                <h5><span
                                                        class="text-default text-sm">{{$currency->symbol.number_format($twallet)}}</span>
                                                </h5>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">

                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                                        <div>
                                            <h4 class="mb-1">Overflow</h4>
                                            <ul class="list list-unstyled mb-0">
                                                <h5><span
                                                        class="text-danger text-sm">{{$currency->symbol.number_format($diff)}}</span>
                                                </h5>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="col-md-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                                        <div>
                                            <h4 class="mb-1">Pool</h4>
                                            <ul class="list list-unstyled mb-0">
                                                <h5><span
                                                        class="text-success text-sm">{{$currency->symbol.(number_format($allbal,
                                                2))}}</span>
                                                </h5>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                                        <div>
                                            <h4 class="mb-1">USD</h4>
                                            <ul class="list list-unstyled mb-0">
                                                <h5><span class="text-default text-sm"> USD {{number_format($issuing_wallet,
                                                2) ?? 0}}</span>
                                                </h5>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                                        <div>
                                            <h4 class="mb-1">Rate</h4>
                                            <ul class="list list-unstyled mb-0">
                                                <h5><span
                                                        class="text-default text-sm">{{$b_rate}}/{{$set->ngn_rate}}</span>
                                                </h5>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">

                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                                        <div>
                                            <h4 class="mb-1">VTU</h4>
                                            <ul class="list list-unstyled mb-0">
                                                <h5><span
                                                        class="text-default text-sm">{{$currency->symbol.number_format($vtbalance)}}</span>
                                                </h5>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                                        <div>
                                            <h4 class="mb-1">Users</h4>
                                            <ul class="list list-unstyled mb-0">
                                                <h5><span
                                                        class="text-default text-sm">{{ number_format($totalusers)}}</span>
                                                </h5>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                                        <div>
                                            <h4 class="mb-1">Customers</h4>
                                            <ul class="list list-unstyled mb-0">
                                                <h5><span
                                                        class="text-default text-sm">{{ number_format($customer)}}</span>
                                                </h5>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-2">

                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                                        <div>
                                            <h4 class="mb-1">Webpay</h4>
                                            <ul class="list list-unstyled mb-0">
                                                <h5><span
                                                        class="text-warning text-sm">{{number_format($money_in_today_webpay,
                                                    2)}}</span>
                                                </h5>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="col-md-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                                        <div>
                                            <h4 class="mb-1">POS</h4>
                                            <ul class="list list-unstyled mb-0">
                                                <h5><span
                                                        class="text-warning text-sm">{{number_format($money_in_today_pos,
                                                    2)}}</span>
                                                </h5>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                @endif
            </div>
            <div class="col-md-12">


                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-2">
                            <div class="card-header">
                                <h4 class="mb-0">{{__('Recent Transactions')}}</h4>
                            </div>
                            <div class="table-responsive py-4">
                                <table id="example" class="display">
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
                                            <td>{{$item->user->first_name ?? "name"}} {{$item->user->last_name ??
                                            "name"}}</td>
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
                                                <td><span
                                                        class="badge rounded-pill bg-success text-white ">Successful</span>
                                                </td>
                                            @elseif($item->status == "2")
                                                <td><span
                                                        class="badge rounded-pill bg-warning text-white">Pending</span>
                                                </td>
                                            @elseif($item->status == "3")
                                                <td><span
                                                        class="badge rounded-pill bg-warning text-white">Reversed</span>
                                                </td>
                                            @elseif($item->status == "0")
                                                <td><span
                                                        class="badge rounded-pill bg-warning text-white">Pending</span>
                                                </td>
                                            @else
                                                <td><span
                                                        class="badge rounded-pill bg-danger text-white">Declined</span>
                                                </td>
                                            @endif


                                            <td>{{date('F d, Y', strtotime($item->created_at))}}</td>
                                            <td>{{date('h:i:s A', strtotime($item->created_at))}}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>

                                    {{-- {{ $transactions->onEachSide(5)->links() }} --}}

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>




    </div>

@stop


