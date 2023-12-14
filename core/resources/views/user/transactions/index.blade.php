@extends('transaction')

@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">


        <div class="row">

            <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body p-4">
                        <div class="media ai-icon">
                            <span class="me-3 bgl-success text-danger">
                                <svg id="icon-revenue" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
                            </span>
                            <div class="media-body">
                                <p class="mb-1">Total In</p>
                                <h4 class="mb-0">{{ number_format($total_in, 2) }}</h4>
                                <span class="badge badge-primary">+3.5%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body p-4">
                        <div class="media ai-icon">
                            <span class="me-3 bgl-danger text-whiite">
                                <svg id="icon-revenue" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
                            </span>
                            <div class="media-body">
                                <p class="mb-1">Total Out</p>
                                <h4 class="mb-0">{{ number_format($total_out, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body  p-4">
                        <div class="media ai-icon">
                            <span class="me-3 bgl-danger text-danger">
                                <svg id="icon-revenue" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
                            </span>
                            <div class="media-body">
                                <p class="mb-1">Revenue</p>
                                <h4 class="mb-0">364.50K</h4>
                                <span class="badge badge-danger">-3.5%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body p-4">
                        <div class="media ai-icon">
                            <span class="me-3 bgl-success text-success">
                                <svg id="icon-database-widget" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database">
                                    <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                                    <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                                    <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                                </svg>
                            </span>
                            <div class="media-body">
                                <p class="mb-1">Patient</p>
                                <h4 class="mb-0">364.50K</h4>
                                <span class="badge badge-success">-3.5%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

        </div>


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

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>

            <div class="row p-2">
                <ul class="nav nav-pills mb-4 light">
                    <li class=" nav-item">
                        <a href="#navpills-1" class="nav-link active" data-bs-toggle="tab" aria-expanded="false">All
                            Transactions</a>
                    </li>
                    <li class="nav-item">
                        <a href="#navpills-2" class="nav-link" data-bs-toggle="tab" aria-expanded="false">Bank
                            Transfer</a>
                    </li>
                    <li class="nav-item">
                        <a href="#navpills-3" class="nav-link" data-bs-toggle="tab" aria-expanded="true">Bills
                            Payment</a>
                    </li>

                    <li class="nav-item">
                        <a href="#navpills-4" class="nav-link" data-bs-toggle="tab" aria-expanded="true">Web
                            Payment</a>
                    </li>
                </ul>




                <div class="tab-content">
                    <div id="navpills-1" class="tab-pane active">
                        <div class="row">
                            <div class="card">
                                <div class="table-responsive py-4">
                                    <table id="example" class="display" style="width:250%">
                                        <thead>
                                            <tr>
                                                <th>{{__('S / N')}}</th>
                                                <th>{{__('Reference ID')}}</th>
                                                <th>{{__('Session ID')}}</th>
                                                <th>{{__('Debit')}}</th>
                                                <th>{{__('Credit')}}</th>
                                                <th>{{__('Type')}}</th>
                                                <th>{{__('Sender Name')}}</th>
                                                <th>{{__('Sender Bank')}}</th>
                                                <th>{{__('Sender Account No')}}</th>
                                                <th>{{__('Status')}}</th>
                                                <th>{{__('Note')}}</th>
                                                <th>{{__('Date Time')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($all as $k=>$val)
                                            <tr>
                                                <td>{{++$k}}.</td>
                                                <td>{{$val->ref_trans_id}}</td>
                                                <td>{{$val->p_session_id}}</td>
                                                <td>{{number_format($val->debit, 2)}}</td>
                                                <td>{{number_format($val->credit, 2)}}</td>
                                                <td>{{$val->title}}</td>
                                                <td>{{$val->sender_name ?? " No Details" }}</td>
                                                <td>{{$val->sender_bank ?? " No Details"}}</td>
                                                <td>{{$val->sender_account_no ?? " No Details"}}</td>
                                                <td>@if($val->status==2) <span class="badge badge-pill badge-danger"><i
                                                            class="fad fa-ban"></i>Failed</span>
                                                    @elseif($val->status==1) <span
                                                        class="badge badge-pill badge-success"><i
                                                            class="fad fa-check"></i>Successful @elseif($val->status==4)
                                                        Refunded @endif</td>
                                                <td>{{$val->note}}</td>
                                                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="navpills-2" class="tab-pane">
                        <div class="card">
                            <div class="table-responsive py-4">
                                <table class="table table-flush" id="datatable-buttons4">
                                    <thead class="">
                                        <tr>
                                            <th>{{__('S/N')}}</th>
                                            <th>{{__('Reference ID')}}</th>
                                            <th>{{__('Amount')}}</th>
                                            <th>{{__('Status')}}</th>
                                            <th>{{__('Created')}}</th>
                                            <th>{{__('Updated')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bank_transfer as $k=>$val)
                                        <tr>
                                            <td>{{++$k}}.</td>
                                            <td>#{{$val->trx}}</td>
                                            <td>{{$currency->symbol.number_format($val->amount, 2, '.', '')}}</td>
                                            <td>@if($val->status==0) <span class="badge badge-pill badge-danger"><i
                                                        class="fad fa-spinner"></i> pending</span>
                                                @elseif($val->status==1) <span class="badge badge-pill badge-success"><i
                                                        class="fad fa-check"></i> successful</span>
                                                @elseif($val->status==2) Declined @endif</td>
                                            <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                            <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="navpills-3" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12"> 
                                <div class="card">
                                    <div class="table-responsive py-4">
                                        <table class="table table-flush" id="datatable-buttons5">
                                            <thead>
                                                <tr>
                                                    <th>{{__('S / N')}}</th>
                                                    <th>{{__('Reference ID')}}</th>
                                                    <th>{{__('Debit')}}</th>
                                                    <th>{{__('Credit')}}</th>
                                                    <th>{{__('Type')}}</th>
                                                    <th>{{__('Sender Name')}}</th>
                                                    <th>{{__('Sender Bank')}}</th>
                                                    <th>{{__('Sender Account No')}}</th>
                                                    <th>{{__('Status')}}</th>
                                                    <th>{{__('Note')}}</th>
                                                    <th>{{__('Date Time')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($web_pay as $k=>$val)
                                                <tr>
                                                    <td>{{++$k}}.</td>
                                                    <td>{{$val->ref_trans_id}}</td>
                                                    <td>{{number_format($val->debit, 2)}}</td>
                                                    <td>{{number_format($val->credit, 2)}}</td>
                                                    <td>{{$val->title}}</td>
                                                    <td>{{$val->sender_name ?? " No Details" }}</td>
                                                    <td>{{$val->sender_bank ?? " No Details"}}</td>
                                                    <td>{{$val->sender_account_no ?? " No Details"}}</td>
                                                    <td>@if($val->status==2) <span
                                                            class="badge badge-pill badge-danger"><i
                                                                class="fad fa-ban"></i>Failed</span>
                                                        @elseif($val->status==1) <span
                                                            class="badge badge-pill badge-success"><i
                                                                class="fad fa-check"></i>Successful
                                                            @elseif($val->status==4) Refunded @endif</td>
                                                    <td>{{$val->note}}</td>
                                                    <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
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






                <div class="col-xl-12">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade @if(route('user.transactions')==url()->current())show active @endif"
                            id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">

                        </div>
                        <div class="tab-pane fade @if(route('user.transactionsd')==url()->current())show active @endif"
                            id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">

                            <div class="tab-pane fade @if(route('user.invoicelog')==url()->current())show active @endif"
                                id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                <div class="card">
                                    <div class="table-responsive py-4">
                                        <table class="table table-flush" id="datatable-buttons2">
                                            <thead>
                                                <tr>
                                                    <th>{{__('S / N')}}</th>
                                                    <th>{{__('Reference ID')}}</th>
                                                    <th>{{__('Name')}}</th>
                                                    <th>{{__('From')}}</th>
                                                    <th>{{__('Type')}}</th>
                                                    <th>{{__('Status')}}</th>
                                                    <th>{{__('Amount')}}</th>
                                                    <th class="text-center">{{__('Charge')}}</th>
                                                    <th>{{__('Created')}}</th>
                                                    <th>{{__('updated')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($invoice as $k=>$val)
                                                <tr>
                                                    <td>{{++$k}}.</td>
                                                    <td>{{$val->ref_id}}</td>
                                                    <td>{{$val->inplan['item']}}</td>
                                                    <td>@if($val->sender_id!=null) {{$val->sender->first_name.'
                                                        '.$val->sender->last_name}} [{{$val->sender->email}}] @else
                                                        {{$val->first_name.' '.$val->last_name}} [{{$val->email}}]
                                                        @endif</td>
                                                    <td>@if($val->sender_id==$user->id) Debit @else Credit @endif</td>
                                                    <td>@if($val->status==0) <span
                                                            class="badge badge-pill badge-danger"><i
                                                                class="fad fa-ban"></i> failed -
                                                            {{$val->payment_type}}</span> @elseif($val->status==1) <span
                                                            class="badge badge-pill badge-success"><i
                                                                class="fad fa-check"></i> paid -
                                                            {{$val->payment_type}}</span> @elseif($val->status==2)
                                                        refunded @endif</td>
                                                    <td>@if($val->sender_id==$user->id)
                                                        {{$currency->symbol.number_format($val->amount+$val->charge, 2,
                                                        '.', '')}} @else {{$currency->symbol.number_format($val->amount,
                                                        2, '.', '')}} @endif</td>
                                                    <td class="text-center">@if($val->sender_id==$user->id ||
                                                        $val->charge==null) - @else
                                                        {{$currency->symbol.number_format($val->charge, 2, '.', '')}}
                                                        @endif</td>
                                                    <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                                    <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade @if(route('user.depositlog')==url()->current())show active @endif"
                                id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                                <div class="card">
                                    <div class="table-responsive py-4">
                                        <table class="table table-flush" id="datatable-buttons3">
                                            <thead class="">
                                                <tr>
                                                    <th>{{__('S/N')}}</th>
                                                    <th>{{__('Reference ID')}}</th>
                                                    <th>{{__('Status')}}</th>
                                                    <th>{{__('Amount')}}</th>
                                                    <th>{{__('Charge')}}</th>
                                                    <th>{{__('Created')}}</th>
                                                    <th>{{__('Updated')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($deposits as $k=>$val)
                                                <tr>
                                                    <td>{{++$k}}.</td>
                                                    <td>{{$val->trx}}</td>
                                                    <td>@if($val->status==0) <span
                                                            class="badge badge-pill badge-danger"><i
                                                                class="fad fa-ban"></i> failed -
                                                            {{$val->gateway['name']}}</span> @elseif($val->status==1)
                                                        <span class="badge badge-pill badge-success"><i
                                                                class="fad fa-check"></i> successful -
                                                            {{$val->gateway['name']}}</span> @elseif($val->status==2)
                                                        refunded - {{$val->gateway['name']}} @endif</td>
                                                    <td>{{$currency->symbol.number_format($val->amount-$val->charge, 2,
                                                        '.', '')}}</td>
                                                    <td>{{$currency->symbol.number_format($val->charge, 2, '.', '')}}
                                                    </td>
                                                    <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                                    <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade @if(route('user.banktransfer')==url()->current())show active @endif"
                                id="tabs-icons-text-5" role="tabpanel" aria-labelledby="tabs-icons-text-5-tab">



                            </div>
                            <div class="tab-pane fade @if(route('user.senderlog')==url()->current())show active @endif"
                                id="tabs-icons-text-6" role="tabpanel" aria-labelledby="tabs-icons-text-6-tab">
                              
                            </div>
                            <div class="tab-pane fade @if(route('user.mysub')==url()->current())show active @endif"
                                id="tabs-icons-text-7" role="tabpanel" aria-labelledby="tabs-icons-text-7-tab">
                                <div class="card">
                                    <div class="table-responsive py-4">
                                        <table class="table table-flush" id="datatable-buttons6">
                                            <thead>
                                                <tr>
                                                    <th>{{__('S / N')}}</th>
                                                    <th>{{__('Name')}}</th>
                                                    <th>{{__('Amount')}}</th>
                                                    <th>{{__('Plan')}}</th>
                                                    <th>{{__('Reference ID')}}</th>
                                                    <th>{{__('Expiring Date')}}</th>
                                                    <th>{{__('Renewal')}}</th>
                                                    <th>{{__('Created')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($sub as $k=>$val)
                                                <tr>
                                                    <td>{{++$k}}.</td>
                                                    <td>{{$val->user['first_name']}} {{$val->user['last_name']}}</td>
                                                    <td>@if($val->plan['amount']==null){{$currency->symbol.$val->amount}}
                                                        @else {{$currency->symbol.$val->plan['amount']}} @endif</td>
                                                    <td>{{$val->plan['name']}}</td>
                                                    <td>#{{$val->ref_id}}</td>
                                                    <td>{{date("Y/m/d h:i:A", strtotime($val->expiring_date))}}</td>
                                                    <td>@if($val->times>0 && $val->status==1) Yes @else No @endif</td>
                                                    <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
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
            </div>

        </div>










        @stop