
@extends('userlayout')

@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0 font-weight-bolder">{{__('Card Transaction History')}}</h3>
      </div>
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th>{{__('S / N')}}</th>
              <th>{{__('Amount')}}</th>
              <th>{{__('Description')}}</th>
              <th>{{__('Type')}}</th>
              <th>{{__('Created')}}</th>
            </tr>
          </thead>
          <tbody>
          {{-- @php
          $item=array();
          $item=json_decode($data, true);
          @endphp --}}
            @foreach($data as $k=>$val)
              <tr>
                <td>{{++$k}}.</td>
                <td>
                USD {{number_format($val->amount/100, 2, '.', '')}}
                </td>
                <td>{{$val->description}}</td>
                <td>
                @if($val->card_transaction_type=='CREDIT')
                  <span class="badge badge-pill badge-primary">{{__('Credit')}}</span>
                @elseif($val->card_transaction_type =='DEBIT')
                  <span class="badge badge-pill badge-danger">{{__('Debit')}}</span>
                @endif
                </td>
                <td>{{date("Y/m/d h:i:A", strtotime($val->transaction_date))}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

@stop
