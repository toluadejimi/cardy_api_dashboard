@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-8">
                @if($set->notify == 1 && Auth::user()->status == 0)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Alert!</strong> {{ $set->verify_message }}. <a class="text-white" href="/user/profile">Click
                        here to verify</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if($set->notify == 1 && Auth::user()->is_email_verified == 0)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Alert!</strong> {{ Auth::user()->email }} {{ $set->email_message }},verify your Email
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif


                @if($set->notify == 1 && Auth::user()->status == 2)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Today Rate:<strong> NGN/USD - {{$set->ngn_rate }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif





                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100"
                                            src="https://enkwave.com/wp-content/uploads/2023/06/pos1-1.png"
                                            alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="https://enkwave.com/wp-content/uploads/2023/06/vcard.png" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="https://enkwave.com/wp-content/uploads/2023/06/advvv.png" alt="Third slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="card">
                    <div class="col-lg-12">

                    <div class="card-body">
                        <h4 class="font-weight-bolder text-gray"><i class="fad fa-undo-alt"></i> {{__('Latest
                            Transaction')}}</h5>
                            <div class="table-responsive py-4">
                                <table class="table table-flush" id="datatable-buttons">
                                    <thead>
                                        <tr>
                                            <th>{{__('S / N')}}</th>
                                            <th>{{__('Reference ID')}}</th>
                                            <th>{{__('Session ID')}}</th>
                                            <th>{{__('Debit')}}</th>
                                            <th>{{__('Credit')}}</th>
                                            <th>{{__('Balance')}}</th>
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
                                            <td>{{$val->e_ref}}</td>
                                            <td>{{number_format($val->debit, 2)}}</td>
                                            <td>{{number_format($val->credit, 2)}}</td>
                                            <td>{{number_format($val->balance, 2)}}</td>
                                            <td>{{$val->title}}</td>
                                            <td>{{$val->sender_name ?? " No Details" }}</td>
                                            <td>{{$val->sender_bank ?? " No Details"}}</td>
                                            <td>{{$val->sender_account_no ?? " No Details"}}</td>
                                            <td>@if($val->status==2) <span class="badge badge-pill badge-danger"><i
                                                        class="fad fa-ban"></i>Failed</span> @elseif($val->status==1)
                                                <span class="badge badge-pill badge-success"><i
                                                        class="fad fa-check"></i>Successful @elseif($val->status==4)
                                                    Refunded @endif
                                            </td>
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

            <div class="col-lg-4">
                <div class="row align-items-center text-center">
                    <div class="col-12 mt-5">
                        <h5 class="text-gray mb-3 h4"><i class="fad fa-sack-dollar"></i> {{__('Main Wallet')}}</h5>
                        <h5 class="mb-1 h2">{{$currency->name}} {{number_format($balance)}}</h5>
                        <hr>
                    </div>
                    <div class="col-12 mt-5">
                        <h5 class="text-gray mb-3 h4"><i class="fad fa-cart-plus"></i> {{__('Total Payout')}}</h5>
                        <h5 class="mb-1 h2">{{$currency->name}} {{number_format($t_payout, 2, '.', '')}}</h5>
                        @if($user->business_level==1)
                        <p class="text-gray mb-3">{{number_format($t_payout/$set->withdraw_limit*100, 2, '.', '')}}% of
                            limit</p>
                        @if($user->kyc_status==0)
                        <a href="{{route('user.compliance')}}" class="btn btn-sm btn-neutral"><i
                                class="fad fa-arrow-up"></i> {{__('Upgrade Account')}}</a>
                        @endif
                        @elseif($user->business_level==2)
                        <p class="text-gray mb-3">{{number_format($t_payout/$set->starter_limit*100, 2, '.', '')}}% of
                            limit
                        </p>
                        @if($user->kyc_status==0)
                        <a href="{{route('user.compliance')}}" class="btn btn-sm btn-neutral"><i
                                class="fad fa-arrow-up"></i> {{__('Upgrade Account')}}</a>
                        @endif
                        @elseif($user->business_level==3)
                        <p class="text-gray mb-3">No limit</p>
                        @endif
                        <hr>
                    </div>
                    <div class="col-12 mt-5">
                        <h5 class="text-gray mb-3 h4"><i class="fad fa-calendar"></i> {{__('Next Payout')}}</h5>
                        <h5 class="mb-2 h2">{{$currency->name}} {{number_format($n_payout, 2, '.', '')}}</h5>
                        <p class="text-gray mb-3">Due {{date("Y/m/d", strtotime($set->next_settlement))}}</p>
                        <a href="{{route('user.withdraw')}}" class="btn btn-sm btn-neutral"><i
                                class="fad fa-history"></i>
                            {{__('Past Payouts')}}</a>
                    </div>
                </div>
            </div>
        </div>
        @stop