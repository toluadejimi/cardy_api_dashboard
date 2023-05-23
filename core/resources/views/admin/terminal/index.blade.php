@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">


            <div class="row">



                <div class="card mr-5 ml-4">
                    <div class="card-body">
                      <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                        <div>
                          <h3 class="mb-2">Transaction Count</h3>
                          <ul class="list list-unstyled mb-0">
                            <h2><span class="text-default text-sm">{{($pcount)}}</span></h2>
                          </ul>
                        </div>
                      </div>
                    </div>
                 </div>

                 <div class="card mr-5 ml-4">
                    <div class="card-body">
                      <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                        <div>
                          <h3 class="mb-2">Sales Amount</h3>
                          <ul class="list list-unstyled mb-0">
                            <h2><span class="text-default text-sm">{{(number_format($amount))}}</span></h2>
                          </ul>
                        </div>
                      </div>
                    </div>
                 </div>
    
    
                 <div class="card">
                    <div class="card-body">
                      <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                        <div>
                          <h3 class="mb-2">Total Active Terminal</h3>
                          <ul class="list list-unstyled mb-0">
                            <h2><span class="text-default text-sm">{{($tcount)}}</span></h2>
                          </ul>
                        </div>
                      </div>
                    </div>
                 </div>
    
              
    
            </div> 
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

















            <div class="col-lg-12">
                <div class="card-body">
                    <a href="{{route('new.transaction')}}" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('New Transaction')}}</a>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">{{__('Terminals')}}</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th>{{__('S / N')}}</th>
                                    <th>{{__('Serial No')}}</th>
                                    <th>Customer</th>
                                    <th>State</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Purchase Type</th>
                                    <th>V_account</th>
                                    <th>Status</th>
                                    <th>Transfer Status</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_terminal as $k=>$item)
                                <tr>
                                    <td>{{++$k}}.</td>
                                    <td>{{$item->serial_no}}</td>
                                    <td>{{$item->user->first_name ?? "name"}} {{$item->user->last_name ?? "name"}} </td>
                                    <td>{{$item->user->state ?? "name"}} </td>
                                    <td>{{$item->description}}</td>
                                    <td>{{number_format($item->amount ?? 0) }}</td>

                                    @if($item->p_type == "1")
                                    <td><span class="badge rounded-pill bg-success text-white ">Outright</span></td>
                                    @elseif($item->p_type == "2")
                                    <td><span class="badge rounded-pill bg-warning text-white">Lease</span></td>
                                    @elseif($item->p_type == "3")
                                    <td><span class="badge rounded-pill bg-primary text-white">Installmental</span></td>
                                    @else
                                    <td><span class="badge rounded-pill bg-danger text-white">Not Paid</span></td>
                                    @endif

                                    <td>{{$item->user->v_account_no ?? "No Account"}}</td>
                                   
                                   
                                    @if($item->status == "1")
                                    <td><span class="badge rounded-pill bg-success text-white ">Active</span></td>
                                    @elseif($item->status == "0")
                                    <td><span class="badge rounded-pill bg-danger text-white">Inactive</span></td>
                                    @endif

                                    @if($item->transfer_status == "1")
                                    <td><span class="badge rounded-pill bg-success text-white ">Can Transfer</span></td>
                                    @elseif($item->transfer_status == "0")
                                    <td><span class="badge rounded-pill bg-warning text-white">Can not transfer</span></td>

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






@stop
