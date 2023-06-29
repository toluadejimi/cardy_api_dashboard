@extends('userlayout')

@section('content')

{{-- @php
$upd=App\Models\Virtual::whereUser_id(Auth::guard('user')->user()->id)->orderBy('id', 'DESC')->get();
foreach($upd as $trx){
$data = array("id"=>$trx->card_hash);
$getCard = $check->getCard($data);
$result = $getCard;
$amo=str_replace( ',', '', $result['data']['amount']);
if($amo<$trx->amount){
    if($result['data']['is_active']==true){
    $trx->amount=$amo;
    $trx->save();
    }else{
    $trx->amount=0;
    $trx->save();
    }
    }else{
    $trx->amount=$amo;
    $trx->save();
    }
    }
    @endphp --}}
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="content-wrapper">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-5">

                    @if($vc == null)
                    <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i
                            class="fa fa-plus"></i> {{__('Create Card')}}</a>
                    @else



                    @endif



                </div>
            </div>

            @if($vc->user_id == Auth::id())
            <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card bg-white border-0 mb-0">
                                <div class="card-header">
                                    <h3 class="mb-0 font-weight-bolder">{{__('New Virtual Card')}} | Rate - NGN {{
                                        $set->ngn_rate }} </h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fad fa-times"></i></span>
                                    </button>
                                    <p class="form-text text-xs">Card creation charge is USD
                                        {{$set->virtual_createcharge}}<br>1% transaction fee, min of USD 1 and max of
                                        USD 5 <br> $1 maintenance fee per active card.
                                        <br> Maximum cash a card can hold is USD {{(number_format($set->vc_max))}}.<br>
                                    </p>









                                </div>
                                <div class="card-body">
                                    <form method="post" action="{{route('create.virtual')}}">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <input type="text" name="first_name" class="form-control"
                                                            placeholder="Give your card a name">
                                                    </div>
                                                    {{-- <div class="col-6">
                                                        <input type="text" name="last_name" class="form-control"
                                                            placeholder="Last Name">
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group row">
                                            <label class="col-form-label col-lg-12">{{__('Amount to fund
                                                (NGN)')}}</label>
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">NGN</span>
                                                    </div>
                                                    <input type="number" name="amount" id="createamount"
                                                        class="form-control" min="{{$set->vc_min}}"
                                                        max="{{$set->vc_max}}" onkeyup="createcharge()" required>
                                                    <input type="hidden" value="{{$set->virtual_createcharge}}"
                                                        id="chargecreate">
                                                    <input type="hidden" value="{{$set->virtual_createchargep}}"
                                                        id="chargecreatex">

                                                    <input type="hidden" value="{{$set->ngn_rate}}" id="ngnrate">


                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <select class="form-control select" name="bg" required>
                                                    <option value="">{{__('Select Card Style')}}</option>
                                                    <option value="bg-newlife">{{__('New Life')}}</option>
                                                    <option value="bg-morpheusden">{{__('Morpheus Den')}}</option>
                                                    <option value="bg-sharpblues">{{__('Sharp Blue')}}</option>
                                                    <option value="bg-fruitblend">{{__('Fruit Blend')}}</option>
                                                    <option value="bg-deepblue">{{__('Deep Blue')}}</option>
                                                    <option value="bg-fabledsunset">{{__('Fabled Sunset')}}</option>
                                                    <option value="bg-white">{{__('White')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-neutral btn-block my-4">{{__('Create
                                                USD Card')}} <span id="resulttransfer0"></span></button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(count($card)>0)
                @foreach($card as $k=>$val)
                <div class="col-lg-4">
                    <div class="card {{$val->bg}}">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row justify-content-between align-items-center">
                                <div class="col">
                                    <span
                                        class="@if($val->bg=='bg-white' || $val->bg==null)text-primary @else text-white @endif">USD
                                        {{number_format($val->amount, 2, '.', '')}}</span> @if($val->status==0) <span
                                        class="badge badge-pill badge-danger">Terminated</span> @elseif($val->status==1)
                                    <span class="badge badge-pill badge-success">Active</span> @elseif($val->status==2)
                                    <span class="badge badge-pill badge-danger">Blocked</span>@endif
                                </div>
                                <div class="col-auto">
                                    <a class="mr-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i
                                            class="fad fa-chevron-circle-down @if($val->bg=='bg-white' || $val->bg==null)text-dark @else text-white @endif"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-left">
                                        <a href="{{route('transactions.virtual', ['id'=>$val->id ?? null])}}"
                                            class="dropdown-item"><i class="fad fa-sync"></i>{{__('Transactions')}}</a>
                                        <a data-toggle="modal" data-target="#modal-more{{$val->id ?? null}}" href=""
                                            class="dropdown-item"><i class="fad fa-credit-card"></i>{{__('Card
                                            Details')}}</a>
                                        @if($val->status==1)
                                        <a data-toggle="modal" data-target="#modal-formfund{{$val->id ?? null}}" href=""
                                            class="dropdown-item"><i class="fad fa-money-bill-wave-alt"></i>{{__('Fund
                                            Card')}}</a>
                                        <a data-toggle="modal" data-target="#modal-formwithdraw" href=""
                                            class="dropdown-item"><i class="fad fa-arrow-circle-down"></i>{{__('Withdraw
                                            Money')}}</a>
                                        <a href="{{route('terminate.virtual', ['id'=>$val->id ?? null])}}"
                                            class="dropdown-item"><i class="fad fa-ban"></i>{{__('Terminate')}}</a>
                                        <a href="{{route('block.virtual', ['id'=>$val->id ?? null])}}"
                                            class="dropdown-item"><i
                                                class="fad fa-sad-tear text-danger"></i>{{__('Freeze')}}</a>
                                        @elseif($val->status==2)
                                        <a href="{{route('unblock.virtual', ['id'=>$val->id ?? null])}}"
                                            class="dropdown-item"><i
                                                class="fad fa-smile text-success"></i>{{__('Unfreeze')}}</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="my-4">
                                <span
                                    class="h6 surtitle @if($val->bg=='bg-white' || $val->bg==null)text-gray @else text-white @endif mb-3">
                                    {{$val->name_on_card}} - {{$val->card_type}}
                                </span>
                                <div
                                    class="card-serial-number h1 @if($val->bg=='bg-white' || $val->bg==null)text-primary @else text-white @endif">
                                    <div>{{chunk_split($val->masked_card, 4, ' ')}}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span
                                        class="h6 surtitle @if($val->bg=='bg-white' || $val->bg==null)text-gray @else text-white @endif">Expiry
                                        date</span>
                                    <span
                                        class="d-block h3 @if($val->bg=='bg-white' || $val->bg==null)text-primary @else text-white @endif">{{$val->expiration}}</span>
                                </div>
                                <div class="col">
                                    <span
                                        class="h6 surtitle @if($val->bg=='bg-white' || $val->bg==null)text-gray @else text-white @endif">CVV</span>
                                    <span
                                        class="d-block h3 @if($val->bg=='bg-white' || $val->bg==null)text-primary @else text-white @endif">{{$val->cvv}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-md-12 mb-5">
                    <div class="text-center mt-8">
                        <div class="mb-3">
                            <img src="{{url('/')}}/asset/images/empty.svg">
                        </div>
                        <h3 class="text-dark">No Virtual Card</h3>
                        <p class="text-dark text-sm card-text">We couldn t find any virtual card to this account</p>
                    </div>
                </div>
                @endif
            </div>



            <div class="modal fade" id="modal-formwithdraw" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card bg-white border-0 mb-0">
                                <div class="card-header">
                                    <h3 class="mb-0 font-weight-bolder">{{__('Withdraw funds from Virtual Card')}}</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="{{route('withdraw.virtual')}}">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-12">{{__('Amount')}}</label>
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">USD</span>
                                                    </div>
                                                    <input type="number" step="any" name="amount" id="w_amount"
                                                        class="form-control" min="10" max="10000" onkeyup="removeusd()"
                                                        required>
                                                    <input type="hidden" value="{{$set->w_rate}}" id="w_rate">

                                                </div>
                                                <p class="form-text text-xs">Min Amount - USD 10 | Max Amount - 10,0000.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-neutral btn-block my-4">{{__('You
                                                get')}} <span id="resulttransfer9"></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-formfund{{$val->id ?? null}}" tabindex="-1" role="dialog"
                aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card bg-white border-0 mb-0">
                                <div class="card-header">
                                    <h3 class="mb-0 font-weight-bolder">{{__('Add Funds to USD Virtual Card')}} | Rate -
                                        NGN {{ $set->ngn_rate }} </h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                    <p class="form-text text-xs"><br> $1 maintenance fee per active card. <br> 1%
                                        transaction fee, min of USD 1 and max of USD 5
                                        <br> Maximum cash a card can hold is USD {{(number_format($set->vc_max))}}.<br>
                                    </p>


                                </div>
                                <div class="card-body">
                                    <form method="post" action="{{route('fund.virtual')}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$val->card_hash ?? null}}">
                                        <div class="form-group row">

                                            <label class="col-form-label col-lg-12">{{__('Amount to fund
                                                (NGN)')}}</label>
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">NGN</span>
                                                    </div>
                                                    <input type="number" name="amount" id="createamount"
                                                        class="form-control" min="{{$set->vc_min}}"
                                                        max="{{$set->vc_max}}" onkeyup="createcharge()" required>
                                                    <input type="hidden" value="{{$set->virtual_createcharge}}"
                                                        id="chargecreate">
                                                    <input type="hidden" value="{{$set->virtual_createchargep}}"
                                                        id="chargecreatex">

                                                    <input type="hidden" value="{{$set->ngn_rate}}" id="ngnrate">


                                                </div>
                                            </div>
                                        </div>

                                        <p class="form-text text-xs">Min amount - NGN {{$set->vc_min}} | Max amount -
                                            NGN {{$set->vc_max}}</p>

                                        <div class="text-right">
                                            <button type="submit" class="btn btn-neutral btn-block my-4">{{__('You
                                                get')}} <span id="resulttransfer6"></span></button>
                                        </div>



                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-more{{$val->id ?? null}}" tabindex="-1" role="dialog"
                aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="mb-0 font-weight-bolder">{{__('Card Details')}}</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>State: {{$val->state ?? null}}</p>
                            <p>City: {{$val->city ?? null}}</p>
                            <p>Zip Code: {{$val->zip_code ?? null}}</p>
                            <p>Address: {{$val->address ?? null}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-md-12 mb-5">
                <div class="text-center mt-8">
                    <div class="mb-3">
                        <img src="{{url('/')}}/asset/images/empty.svg">
                    </div>
                    <h3 class="text-dark">No Virtual Card</h3>
                    <p class="text-dark text-sm card-text">We couldn t find any virtual card to this account</p>
                </div>
            </div>
            @endif

            @stop
