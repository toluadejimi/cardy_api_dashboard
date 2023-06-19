@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Update Account Information')}}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/profile-update')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Business name')}}</label>
                                <div class="col-lg-10">
                                    <input type="" hidden value="{{$client->id}}" name="id">
                                    <input type="text" name="business_name" class="form-control"
                                        value="{{$client->business_name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('First Name')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" name="first_name" class="form-control"
                                        value="{{$client->first_name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Last Name')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" name="last_name" class="form-control"
                                        value="{{$client->last_name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Email')}}</label>
                                <div class="col-lg-10">
                                    <input type="email" name="email" class="form-control" readonly
                                        value="{{$client->email}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Type')}}</label>
                                <select class="form-control col-lg-2" name="type" id="exampleFormControlSelect2">

                                    <option value="{{$client->type}}">
                                        @if ($client->type == 1)
                                        Agent
                                        @elseif($client->type == 2)
                                        Customer
                                        @else
                                        Business
                                        @endif
                                    </option>
                                    <option value="1">Agent</option>
                                    <option value="2">Customer</option>
                                    <option value="3">Business</option>


                                </select>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Mobile')}}</label>
                                <div class="col-lg-10">
                                    <input type="text" name="mobile" class="form-control" value="{{$client->phone}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Balance')}}</label>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">{{$currency->symbol}}</span>
                                        </span>
                                        <input type="number" name="main_wallet" max-length="10"
                                            value="{{$client->main_wallet}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{__('Status')}}<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        @if($client->is_email_verified==1)
                                        <input type="checkbox" name="is_email_verified" id=" customCheckLogin5"
                                            class="custom-control-input" value="1" checked>
                                        @else
                                        <input type="checkbox" name="is_email_verified" id=" customCheckLogin5"
                                            class="custom-control-input" value="1">
                                        @endif
                                        <label class="custom-control-label" for=" customCheckLogin5">
                                            <span class="text-muted">{{__('Email verification')}}</span>
                                        </label>
                                    </div>
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        @if($client->is_phone_verified==1)
                                        <input type="checkbox" name="is_phone_verified" id=" customCheckLogin6"
                                            class="custom-control-input" value="1" checked>
                                        @else
                                        <input type="checkbox" name="is_phone_verified" id=" customCheckLogin6"
                                            class="custom-control-input" value="1">
                                        @endif
                                        <label class="custom-control-label" for=" customCheckLogin6">
                                            <span class="text-muted">{{__('Phone verification')}}</span>
                                        </label>
                                    </div>
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        @if($client->is_bvn_verified==1)
                                        <input type="checkbox" name="is_bvn_verified" id=" customCheckLogin8"
                                            class="custom-control-input" value="1" checked>
                                        @else
                                        <input type="checkbox" name="is_bvn_verified" id=" customCheckLogin8"
                                            class="custom-control-input" value="1">
                                        @endif
                                        <label class="custom-control-label" for=" customCheckLogin8">
                                            <span class="text-muted">{{__('BVN Verification')}}</span>
                                        </label>
                                    </div>

                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        @if($client->is_identification_verified==1)
                                        <input type="checkbox" name="is_identification_verified" id=" customCheckLogin9"
                                            class="custom-control-input" value="1" checked>
                                        @else
                                        <input type="checkbox" name="is_identification_verified" id=" customCheckLogin9"
                                            class="custom-control-input" value="1">
                                        @endif
                                        <label class="custom-control-label" for=" customCheckLogin9">
                                            <span class="text-muted">{{__('IDENTIFICATION Verification')}}</span>
                                        </label>
                                    </div>







                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        @if($client->status==1)
                                        <input type="checkbox" name="status" id=" customCheckLogin7"
                                            class="custom-control-input" value="1" checked>
                                        @else
                                        <input type="checkbox" name="status" id=" customCheckLogin7"
                                            class="custom-control-input" value="1">
                                        @endif
                                        <label class="custom-control-label" for=" customCheckLogin7">
                                            <span class="text-muted">{{__('2fa security')}}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success btn-sm">{{__('Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Compliance')}}</h3>
                    </div>
                    <div class="card-body">
                        <p>{{__('Trading Name')}}: {{$xver->trading_name ?? null }} </p>
                        <p>{{__('Description')}}: {{$xver->description ?? null }}</p>
                        <p>{{__('Staff Size')}}: {{$xver->staff_size ?? null }}</p>
                        <p>{{__('Industry')}}: {{$xver->industry ?? null }}</p>
                        <p>{{__('Category')}}: {{$xver->category ?? null }}</p>
                        <p>{{__('Phone')}}: {{$xver->phone ?? null }}</p>
                        <p>{{__('Address')}}: {{$xver->address ?? null }}</p>
                        <p>{{__('Email')}}: {{$xver->email ?? null }}</p>
                        <p>{{__('Website')}}: {{$xver->website ?? null }}</p>
                        <p>{{__('Gender')}}: {{$xver->gender?? null }}</p>
                        <p>{{__('Business Type')}}: {{$xver->business_type ?? null }}</p>
                        <a href="{{url('/')}}/asset/profile/{{$xver->paddress ?? null }}">{{__('View proof of
                            Address')}}</a><br><br>
                        @if($xver->business_type=="Registered Business")
                        <p>{{__('Legal name')}}: {{$xver->legal_name ?? null }}</p>
                        <p>{{__('Registration type')}}: {{$xver->registration_type ?? null }}</p>
                        <p>{{__('Tax id')}}: {{$xver->tax_id ?? null }}</p>
                        <p>{{__('BVN')}}: {{$xver->bvn ?? null }}</p>
                        <p>{{__('Reg no')}}: {{$xver->reg_no ?? null }}</p>
                        @if($xver->proof!=null)
                        <a href="{{url('/')}}/asset/profile/{{$xver->proof }}">{{__('Proof of Registration
                            [Front]')}}</a><br><br>
                        <a href="{{url('/')}}/asset/profile/{{$xver->proof_back}}">{{__('Proof of Registration
                            [Back]')}}</a><br><br>
                        @endif
                        @else
                        <p>{{__('Full name')}}: {{$xver->first_name}} {{$xver->last_name}}</p>
                        <p>{{__('DOB')}}: {{$xver->day}}/{{$xver->month}}/{{$xver->year}}</p>
                        <p>{{__('Nationality')}}: {{$xver->nationality}}</p>
                        <p>{{__('ID Document')}}: {{$xver->id_type}}</p>
                        @if($xver->idcard!=null)
                        <a href="{{url('/')}}/asset/profile/{{$xver->idcard}}">{{__('View ID Document
                            [Front]')}}</a><br><br>
                        <a href="{{url('/')}}/asset/profile/{{$xver->idcard_back}}">{{__('View ID Document
                            [Back]')}}</a><br><br>
                        @endif
                        @endif
                        @if($xver->status==1)
                        <a class="btn btn-sm btn-neutral"
                            href="{{url('/')}}/admin/approve-kyc/{{$xver->id}}">{{__('Approve')}}</a>
                        <a class="btn btn-sm btn-neutral"
                            href="{{url('/')}}/admin/reject-kyc/{{$xver->id}}">{{__('Reject')}}</a>
                        @endif
                        <br><br>
                        @if($client->business_level==1)
                        <span class="badge badge-pill badge-danger">Business Level: Unverified</span>
                        @elseif($client->business_level==2)
                        <span class="badge badge-pill badge-primary">Business Level: Starter</span>
                        @elseif($client->business_level==3)
                        <span class="badge badge-pill badge-primary">Business Level: Registered</span>
                        @endif
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="card-img-actions d-inline-block mb-3">
                                    <img class="img-fluid rounded-circle"
                                        src="https://enkpayapp.enkwave.com/public/upload/identification_image/{{$client->identification_image}}" width="120" height="120"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="card-img-actions d-inline-block mb-3">
                                    <img class="img-fluid rounded-circle"
                                    src="https://enkpayapp.enkwave.com/public/upload/selfie/{{$client->image}}" width="120" height="120"
                                    alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="card-img-actions d-inline-block mb-3">
                                    <img class="img-fluid rounded-circle"
                                    src="https://enkpayapp.enkwave.com/public/upload/utilitybill/{{$client->utility_bill}}" width="120" height="120"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                </div>














            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <h3 class="mb-0">{{__('Terminal Information')}}</h3>
                </div>

                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable">
                        <thead>
                            <tr>
                                <th>{{__('S / N')}}</th>
                                <th>{{__('Terminal ID')}}</th>
                                <th>{{__('Descrption')}}</th>
                                <th>{{__('V Account')}}</th>
                                <th>{{__('Transfer Status')}}</th>
                                <th>{{__('Terminal Status')}}</th>
                                <th>{{__('Action')}}</th>



                            </tr>
                        </thead>
                        <tbody>
                            @foreach($terminal as $k=>$val)
                            <tr>
                                <td>{{++$k}}.</td>
                                <td>{{$val->serial_no}}</td>
                                <td>{{$val->description}}</td>
                                <td>{{$val->v_account_no}}</td>
                                @if($val->transfer_status == "0")
                                <td><span class="badge rounded-pill bg-warning text-white">Cant Transfer</span></td>
                                @elseif($val->transfer_status == "1")
                                <td><span class="badge rounded-pill bg-success text-white">Transfer Active</span></td>
                                @else
                                <td><span class="badge rounded-pill bg-danger">NAN</span></td>
                                @endif

                                @if($val->status == "0")
                                <td><span class="badge rounded-pill bg-warning text-white">Inactive</span>
                                </td>
                                @elseif($val->status == "1")
                                <td><span class="badge rounded-pill bg-success text-white">Active</span></td>
                                @else
                                <td><span class="badge rounded-pill bg-danger">NAN</span></td>
                                @endif

                                @if ($val->transfer_status == 1)
                                <td>
                                    <form method="POST"
                                        action="{{route('deactivate.terminal', ['serial_no' => $val->serial_no])}}">
                                        @csrf
                                        @method('POST')

                                        <button type="submit" class="btn btn-warning btn-sm mt-2">Deactivate</button>
                                    </form>
                                </td>
                                @else
                                <td>
                                    <form method="POST"
                                        action="{{route('activate.terminal', ['serial_no' => $val->serial_no])}}">
                                        @csrf
                                        @method('POST')

                                        <button type="submit" class="btn btn-success btn-sm  mt-2">Activate</button>
                                    </form>
                                </td>

                                @endif


                                <td>
                                    <form method="POST"
                                        action="{{route('delete.terminal', ['serial_no' => $val->serial_no])}}">
                                        @csrf
                                        @method('POST')

                                        <button type="submit" class="btn btn-danger btn-sm  mt-2">Delete</button>
                                    </form>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="card-header">
                    <h3 class="mb-0">{{__('Add Terminal')}}</h3>
                </div>

                <div class="col-lg-12 flex-lg-nowrap">

                    <form action="{{route('add.terminal')}}" method="post">
                        @csrf

                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <input type="number" required name="serial_no"
                                            placeholder="Enter Terminla Serial No" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <input type="text" hidden name="user_id" value="{{ $client->id }}">




                            <div class="form-group">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <input type="text" name="description" placeholder="Endter Des "
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <input type="number" required placeholder="Enter Vaccount" name="v_account_no"
                                            value=" " class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-sm mt-3">{{__('Create
                                    Terminal')}}</button>
                            </div>

                        </div>

                </div>
                </form>
            </div>
        </div>




        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <h3 class="mb-0">{{__('V Account Information')}}</h3>
                </div>

                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable">
                        <thead>
                            <tr>
                                <th>{{__('S / N')}}</th>
                                <th>{{__('V Account No')}}</th>
                                <th>{{__('V Account Name')}}</th>
                                <th>{{__('Bank Name')}}</th>
                                <th>{{__('Serial No')}}</th>
                                <th>{{__('Action')}}</th>



                            </tr>
                        </thead>
                        <tbody>
                            @foreach($v_account as $k=>$val)
                            <tr>
                                <td>{{++$k}}.</td>
                                <td>{{$val->v_account_no}}</td>
                                <td>{{$val->v_account_name}}</td>
                                <td>{{$val->v_bank_name}}</td>
                                <td>{{$val->serial_no}}</td>

                                <td>
                                    <form method="POST"
                                        action="{{route('delete.v_account', ['v_account_no' => $val->v_account_no])}}">
                                        @csrf
                                        @method('POST')

                                        <button type="submit" class="btn btn-danger btn-sm  mt-2">Delete</button>
                                    </form>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="card-header">
                    <h3 class="mb-0">{{__('Add Account')}}</h3>
                </div>

                <div class="col-lg-12 flex-lg-nowrap">

                    <form action="{{route('add.vaccount')}}" method="post">
                        @csrf

                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <input type="number" required name="v_account_no" placeholder="Enter Account No"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <input type="text" hidden name="user_id" value="{{ $client->id }}">




                            <div class="form-group">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <input type="text" name="v_account_name" placeholder="Endter Account Name "
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <input type="text" placeholder="Enter Bank Name" name="v_bank_name" required
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <input type="number" placeholder="Enter Serial No" name="serial_no" required
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-sm mt-3">{{__('Create
                                    Account')}}</button>
                            </div>

                        </div>

                </div>
                </form>
            </div>
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
                                <th>Note</th>
                                <th>Status</th>
                                <th>Action</th>
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
                                <td>{{$item->note}}</td>

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

                                @if($item->status == "0")
                                <td>
                                    <form method="POST"
                                        action="{{route('reverse.transaction', ['ref_trans_id' => $item->ref_trans_id])}}">
                                        @csrf
                                        @method('POST')

                                        <button type="submit" class="btn btn-warning btn-sm  mt-2">Reverse</button>
                                    </form>
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
@stop
