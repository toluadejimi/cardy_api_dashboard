@extends('master')

@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="col-xl-12">

            <div class="content-wrapper">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h3 class="mb-0">{{__('Users')}}</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th>{{__('S/N')}}</th>
                                    <th class="scope"></th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Phone')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Balance')}}</th>
                                    <th>{{__('State')}}</th>
                                    <th>{{__('Type')}}</th>
                                    <th>{{__('POS Count')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Date Joied')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $k=>$val)
                                <tr>
                                    <td>{{++$k}}.</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="text-dark" href="#" role="button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="fad fa-chevron-circle-down"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a href="{{route('user.manage', ['id' => $val->id])}}"
                                                    class="dropdown-item">{{__('Manage customer')}}</a>
                                                @if($val->status==1)
                                                <a class='dropdown-item'
                                                    href="{{route('user.block', ['id' => $val->id])}}">{{__('Block')}}</a>
                                                @else
                                                <a class='dropdown-item'
                                                    href="{{route('user.unblock', ['id' => $val->id])}}">{{__('Unblock')}}</a>
                                                @endif
                                                <a href="{{route('user.destory', ['id' => $val->id])}}"
                                                    class="dropdown-item">{{__('Delete')}}</a>
                                                <a href="{{route('report', ['userId' => $val->id])}}"
                                                    class="dropdown-item">{{__('Transaction Report')}}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$val->first_name.' '.$val->last_name}}</td>
                                    <td>{{$val->phone}}</td>
                                    <td>{{$val->email}}</td>
                                    <td>{{$currency->symbol.number_format($val->main_wallet,2 )}}</td>

                                    <td>{{$val->state}}</td>
                                    <td>
                                        @if($val->type==1)
                                        <span class="badge badge-pill badge-primary">{{__('Agent')}}</span>
                                        @elseif($val->type==2)
                                        <span class="badge badge-pill badge-danger">{{__('Customer')}}</span>
                                        @elseif($val->type==3)
                                        <span class="badge badge-pill badge-warning">{{__('Business')}}</span>
                                        @endif
                                    </td>
                                    <td>{{ $val->pos_count }}</td>
                                    <td>
                                        @if($val->status==2)
                                        <span class="badge badge-pill badge-primary">{{__('Active')}}</span>
                                        @elseif($val->status==4)
                                        <span class="badge badge-pill badge-danger">{{__('Blocked')}}</span>
                                        @endif
                                    </td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal fade" id="delete{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                    aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card bg-white border-0 mb-0">
                                    <div class="card-header">
                                        <h3 class="mb-0">{{__('Are you sure you want to delete this?')}}</h3>
                                    </div>
                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                        <button type="button" class="btn btn-neutral btn-sm"
                                            data-dismiss="modal">{{__('Close')}}</button>
                                        <a href="{{route('user.delete', ['id' => $val->id])}}"
                                            class="btn btn-danger btn-sm">{{__('Proceed')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
    @stop