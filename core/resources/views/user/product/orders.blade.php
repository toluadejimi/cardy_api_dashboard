@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row"> 
    @if(count($orders)>0)  
        <div class="col-md-12">
          <div class="card bg-white">
            <!-- Card body -->
            <div class="card">
                <div class="col-md-12">
                    <div class="card-header">
                        <h5 class="h3 mb-0">{{__('Client Orders')}}</h5>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons1">
                            <thead>
                                <tr>
                                    <th>{{__('S / N')}}</th>
                                    <th>{{__('Ref ID')}}</th>
                                    <th>{{__('Product')}}</th>
                                    <th>{{__('Customer Name')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Phone')}}</th>
                                    <th>{{__('Amount')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Created')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(count($orders)<0) <h3 class="text-dark">No Product Found</h3>
                                    <p class="text-dark text-sm card-text">We couldnt find any product to this
                                        account
                                    </p>
                                    @endif


                                    @foreach($orders as $k=>$val)
                                    <tr>
                                        <td>{{++$k}}.</td>
                                        <td>{{$val->ref_id}}</td>
                                        <td>{{$val->product->name}}</td>
                                        <td>{{$val->buyer->first_name}} {{$val->buyer->last_name}}</td>
                                        <td>{{$val->buyer->email}}</td>
                                        <td>{{$val->buyer->phone}}</td>
                                        <td>{{$currency->symbol.number_format($val->amount, 2)}}</td>
                                        <td>
                                            @if($val->status == 0)
                                            <span class="badge badge-pill badge-warning">{{__('Pending')}}</span>
                                            @elseif($val->status == 1)
                                            <span class="badge badge-pill badge-success">{{__('Completed')}}</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">{{__('Cancled')}}</span>
                                            @endif
                                        </td>

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
   
    @else
      <div class="col-md-12 mb-5">
        <div class="text-center mt-8">
          <div class="mb-3">
            <img src="{{url('/')}}/asset/images/empty.svg">
          </div>
          <h3 class="text-dark">No Orders</h3>
          <p class="text-dark text-sm card-text">We couldn't find any product order to this account</p>
        </div>
      </div>
    @endif
    </div> 
@stop