@extends('master')
@section('content')

    <div class="content-body">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 mb-0">
                        <div class="card-header">
                            <h3 class="mb-0">{{__('New Transaction')}}</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('create.transaction')}}" method="post">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-4  col-md-3 mb-md-0 mb-4">


                                        <div class="form-group">
                                            <h6>Choose Cutomers</h6>
                                            <select class="form-control" name="user_id" placeholder="Pick a user...">
                                                class="form-control " required>
                                                <option value="">Select Customer</option>
                                                @foreach ($users as $data)
                                                    <option value="{{ $data->id }}">{{ $data->first_name }} {{
                                                $data->last_name }} - NGN {{number_format($data->main_wallet) }}
                                                    </option>
                                                @endforeach
                                            </select>


                                        </div>
                                    </div>


                                    <div class="col-lg-2 col-md-3 mb-md-0 mb-4">
                                        <h6>Ref Trans ID</h6>
                                        <input class="form-control " name="ref_trans_id" autofocus
                                               value="{{$ref_trans_id}}">
                                    </div>


                                    <div class="col-lg-2 col-md-3 mb-md-0 mb-4">
                                        <h6>E Rrefrence</h6>
                                        <input class="form-control" name="e_ref" autofocus>
                                    </div>


                                    <div class="col-lg-2 col-md-6 mb-md-0 mb-4 form-group">
                                        <h6> Transaction Type </h6>
                                        <select class="form-control " name="transaction_type"
                                                id="exampleFormControlSelect2">
                                            <option value=" ">Select</option>
                                            <option value="CashOut">Cash Out</option>
                                            <option value="Refund">Refund</option>
                                            <option value="TerminalPayment">Terminal Payment Outright</option>
                                            <option value="TerminalPaymentDaily">Terminal Payment Daily</option>
                                            <option value="TerminalPaymentMonthly">Terminal Payment Daily</option>
                                            <option value="FundTransfer">Fund Transfer</option>
                                            <option value="EPVAS">EP VAS</option>
                                            <option value="EnkPayTransfer">EnkPay Transfer</option>
                                            <option value="CashOut">Cash Out</option>
                                            <option value="VasEletric">Vas Eletric</option>
                                            <option value="VirtualFundWallet">Virtual Fund Wallet</option>

                                        </select>

                                    </div>

                                    <div class="col-lg-2 col-md-6 mb-md-0 mb-4 form-group">
                                        <h6> Type </h6>
                                        <select class="form-control" name="type"
                                                id="exampleFormControlSelect2">
                                            <option value=" ">Select</option>
                                            <option value="outward">Outward</option>
                                            <option value="inAppTransfer">In App Transfer</option>
                                            <option value="FundWallet">VFD Fund Wallet</option>
                                            <option value="ProvidusFunding">Providus Funding</option>
                                            <option value="VirtualFundWallet">Virtual Fund Wallet</option>
                                            <option value="pos">POS</option>

                                        </select>

                                    </div>

                                    <div class="col-lg-2 col-md-6 mb-md-0 mb-4 form-group">
                                        <h6> Title </h6>
                                        <select class="form-control" name="title"
                                                id="exampleFormControlSelect2">
                                            <option value=" ">Select</option>
                                            <option value="outward">Outward</option>
                                            <option value="Bank Transfer">Bank Transfer</option>
                                            <option value="Fund Wallet">VFD Fund Wallet</option>
                                            <option value="Providus Funding">Providus Funding</option>
                                            <option value="Enkpay Transfer">Enkpay Transfer</option>
                                            <option value="POS Transaction">POS</option>

                                        </select>

                                    </div>


                                    <div class="col-lg-2 col-md-3 mb-md-0 mb-4">
                                        <h6>Amount</h6>
                                        <input type="number" class="form-control " name="amount" autofocus>
                                    </div>

                                    <div class="col-lg-2 col-md-3 mb-md-0 mb-4">
                                        <h6>debit</h6>
                                        <input type="number" class="form-control " name="debit" autofocus>
                                    </div>

                                    <div class="col-lg-2 col-md-3 mb-md-0 mb-4">
                                        <h6>Credit</h6>
                                        <input type="text" class="form-control " name="credit" autofocus>
                                    </div>


                                    <div class="col-lg-2 col-md-3 mb-md-0 mb-4">
                                        <h6>Fee</h6>
                                        <input type="text" class="form-control " name="fee" autofocus>
                                    </div>

                                    <div class="col-lg-2 col-md-3 mb-md-0 mb-4">
                                        <h6>ENKPay Fee</h6>
                                        <input type="text" class="form-control " name="enkPay_Cashout_profit"
                                               autofocus>
                                    </div>

                                    <div class="col-lg-5 col-md-3 mb-md-0 mb-4 mt-4">
                                        <h6>Note</h6>
                                        <input type="text" class="form-control " name="note" autofocus
                                               value="EP POS | 501226XXXXXXXXX083">
                                    </div>

                                    <div class="col-lg-2 col-md-3 mb-md-0 mb-4 mt-4">
                                        <h6>Terminal ID</h6>
                                        <input type="number" class="form-control " name="serial_no"
                                               autofocus>
                                    </div>

                                    <div class="col-lg-2 col-md-3 mb-md-0 mb-4 mt-4">
                                        <h6>Pin</h6>
                                        <input type="password" class="form-control " name="pin" autofocus>
                                    </div>

                                    <div class="text-right">
                                        <button type="submit"
                                                class="btn btn-success btn-md mt-5">{{__('Update')}}</button>
                                    </div>

                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop
