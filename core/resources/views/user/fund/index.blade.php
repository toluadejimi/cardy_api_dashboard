@extends('userlayout')

@section('content')


<div class="content-body">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-12">
        <div class="row page-titles">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Fund Account</a></li>
          </ol>
        </div>


        <div class="card p-4">
          <div class="card-body p-3">
            <div class="row">
              @foreach($account as $val)
              <div class="col-xl-4 col-lg-12 col-sm-12">
                <div class="card">
                  <div class="card-header border-0 pb-0">
                    <h4 class="mb-2 text-primary">{{$val->v_bank_name}}</h4>
                  </div>
                  <div class="card-body pb-0">
                    <p>Receive your salary or money from any bank account locally directly into your ENKPAY
                      Wallet</p>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>Account No</strong>
                        <span class="mb-0">{{$val->v_account_no}}</span>
                      </li>

                      <li class="list-group-item d-flex px-0 justify-content-between">
                        <strong>Account Name</strong>
                        <span class="mb-0">{{$val->v_account_name}}</span>
                      </li>
                    </ul>
                  </div>
                  <div class="card-footer pt-0 pb-0 text-center p-3">

                    <p class="mb-3 text-muted  mt-2">Money sent to this bank account will automatically top up your ENKPAY
                      Wallet</p>
                   <br> <p class="text-danger">{{$charges}}% Transaction fee applies. <br>NGN 50 stamp duty for funds above NGN 10,000</p>

                  </div>
                </div>
              </div>
              @endforeach

            </div>
          </div>
        </div>
      </div>



    </div>
  </div>
</div>











@stop
