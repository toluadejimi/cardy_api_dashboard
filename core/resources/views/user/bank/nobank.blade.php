@extends('loginlayout')

@section('content')
<div class="main-content">
    <!-- Header -->
    <div class="header py-5 pt-7">
      <div class="container">
        <div class="header-body text-center mb-7">
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5 mb-0">
      <div class="row justify-content-center">
        <div class="col-lg-7 col-md-7">
          <div class="card border-0 mb-5">



            @if($set->notify == 1 && Auth::user()->is_email_verified == 0)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Alert!</strong> {{ Auth::user()->email }} {{ $set->email_message }},check your inbox or spam for otp code
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif



            <div class="card-body pt-7 px-5">
              <div class="text-center text-dark mb-5">
                <h3 class="text-dark font-weight-bolder">{{__('Default Bank Account')}}</h3>
                <span class="text-gray text-xs">{{__('Settlements will be paid to this account')}}</span>
              </div>
              <form role="form" action="{{ route('add.bank')}}" method="post">
                @csrf
                <div class="form-group row">
                    <div class="col-lg-12">
                        <select class="form-control select" name="bank" required>
                            <option value="">{{__('Select Bank')}}</option>
                                @foreach($bnk as $val)
                                <option value="{{$val->code}}">{{$val->bankName}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12">
                        <select class="form-control select" name="account_type" required>
                            <option value="">{{__('Account Type')}}</option>
                              <option value="individual">Individual</option>
                              <option value="company">Company</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                  <div class="col-lg-8">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text">#</span>
                            </div>
                            <input class="form-control" placeholder="{{ __('Account Number') }}" type="number" name="acct_no" required>
                        </div>
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <form action="/verify-account" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary  btn-block">{{__('Verify')}}</button>
                    </form>
                    
                  </div>


                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fad fa-user"></i></span>
                    </div>
                    <input class="form-control" placeholder="{{ __('Account Name') }}" type="text" name="acct_name" required>
                  </div>
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4 btn-block">{{__('Save Account')}}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop
