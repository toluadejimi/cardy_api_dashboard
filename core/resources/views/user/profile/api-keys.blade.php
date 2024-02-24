@extends('userlayout')

@section('content')
    <!-- Page content -->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">



                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header header-elements-inline">
                                    <h3 class="mb-0 font-weight-bolder text-white">{{__('Api Keys')}}</h3>
                                </div>
                                <div class="card-body">

                                    <div class="">
                                        <p>Use Api for authentication
                                        </p>

                                    </div>

                                    <hr>


                                    <div class="">

                                        <div class="row">

                                            <div class="col-6">

                                                @if(Auth::user()->tpublic_key == null)
                                                    <a href="generate-test-key" class="btn btn-warning btn-sm">Generate
                                                        Test Key</a>
                                                @else

                                                    <label>Test API Key</label>
                                                    <input disabled class="form-control"
                                                           value="{{Auth::user()->tpublic_key}}">

                                                @endif

                                            </div>


                                            <div class="col-6">

                                                @if(Auth::user()->public_key == null)
                                                    <a href="generate-test-key" class="btn btn-warning btn-sm">Generate
                                                        Test Key</a>
                                                @elseif(Auth::user()->status == 2)

                                                    <label>Live API Key</label>
                                                    <input disabled class="form-control"
                                                           value="{{$web_key}}">
                                                @else

                                                    <label>Live API Key</label>
                                                    <input disabled class="form-control"
                                                           placeholder="Account under review">

                                                @endif

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
