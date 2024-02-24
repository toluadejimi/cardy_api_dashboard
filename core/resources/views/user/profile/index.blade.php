@extends('userlayout')

@section('content')
    <!-- Page content -->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif


                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade @if(route('user.profile')==url()->current())show active @endif"
                             id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">


                            @if(Auth::user()->status == 0)
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header header-elements-inline">
                                                <h3 class="mb-0 font-weight-bolder">{{__('Verify Account')}}</h3>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{url('user/account')}}" enctype="multipart/form-data"
                                                      method="post">
                                                    @csrf


                                                    <div class="form-group row">
                                                        <label
                                                            class="col-form-label col-lg-3">{{__('Personal Info')}}</label>
                                                        <div class="col-lg-9">
                                                            <div class="row">
                                                                <div class="col-6 mb-3">
                                                                    <input type="text" name="first_name"
                                                                           class="form-control"
                                                                           required placeholder="First Name"
                                                                           value="{{$user->first_name}}">
                                                                </div>
                                                                <div class="col-6 mb-3">
                                                                    <input type="text" name="last_name"
                                                                           class="form-control"
                                                                           required placeholder="Last Name"
                                                                           value="{{$user->last_name}}">
                                                                </div>

                                                                <div class="col-6">
                                                                    <input type="text" name="email" class="form-control"
                                                                           required placeholder="Email"
                                                                           value="{{$user->email}}">
                                                                </div>

                                                                <div class="col-6">
                                                                    <input type="text" name="phone" class="form-control"
                                                                           required placeholder="Phone"
                                                                           value="{{$user->phone}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr>


                                                    <div class="form-group row">
                                                        <label
                                                            class="col-form-label col-lg-3">{{__('Business Info')}}</label>
                                                        <div class="col-lg-9">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <input type="text" name="business_name"
                                                                           class="form-control"
                                                                           required placeholder=""
                                                                           value="{{Auth::user()->b_name}}">
                                                                </div>
                                                                <div class="col-6 mb-3">
                                                                    <select name="b_type"
                                                                            class="form-control"
                                                                            value="{{Auth::user()->b_type}}"
                                                                    <option value="">select one</option>
                                                                    <option value="finance">Finance</option>
                                                                    <option value="agric">Agriculture</option>
                                                                    <option value="econnerce">Ecommerce</option>
                                                                    <option value="education">Education</option>

                                                                    </select>

                                                                </div>


                                                                <div class="col-6">
                                                                    <input type="text" name="b_number"
                                                                           class="form-control"
                                                                           placeholder="Enter CAC number"
                                                                           value="{{$user->b_number}}">
                                                                </div>

                                                                <div class="col-6">
                                                                    <input type="text" name="b_address"
                                                                           class="form-control"
                                                                           required placeholder="Enter Business Address"
                                                                           value="{{$user->b_address}}">
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>


                                                    <hr>

                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-3">{{__('Address')}}</label>
                                                        <div class="col-lg-9">
                                                            <div class="row">

                                                                <div class="col-3">
                                                                    <input type="text" name="hos_no"
                                                                           class="form-control"
                                                                           required placeholder="NO"
                                                                           value="{{$user->hos_no}}">
                                                                </div>
                                                                <div class="col-9">
                                                                    <input type="text" name="address_line_1"
                                                                           class="form-control" required
                                                                           placeholder="Street"
                                                                           value="{{$user->address_line_1}}">
                                                                </div>
                                                                <div class="col-4 mt-3">
                                                                    <input type="text" name="city" class="form-control"
                                                                           required
                                                                           placeholder="City" value="{{$user->city}}">
                                                                </div>

                                                                <div class="col-4 mt-3">
                                                                    <input type="text" name="state" class="form-control"
                                                                           required placeholder="State"
                                                                           value="{{$user->state}}">
                                                                </div>
                                                                <div class="col-4 mt-3">
                                                                    <input type="text" name="postal_code"
                                                                           class="form-control"
                                                                           required placeholder="Postal Code"
                                                                           value="10001">
                                                                </div>


                                                                <input type="text" name="counrty" value="Nigeria" hidden
                                                                       class="form-control" required>


                                                                <div class="col-lg-4 mt-3">
                                                                    <input type="text" name="counrty" value="Nigeria"
                                                                           class="form-control" required>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>


                                                    <hr>


                                                    <div class="form-group row">
                                                        <label
                                                            class="col-form-label col-lg-3">{{__('Identification')}}</label>
                                                        <div class="col-lg-9">
                                                            <div class="row">


                                                                {{-- <div class="col-lg-12 mt-3">
                                                                    <select class="form-control select"
                                                                        name="identification_type" required>
                                                                        <option value="">{{__('Select Type')}}</option>
                                                                        <option value="NIGERIAN_NIN">NIN</option>
                                                                        <option value="NIGERIAN_PVC">VOTER CARD</option>
                                                                        <option value="NIGERIAN_DRIVERS_LICENSE">DRIVER LICENSE
                                                                        </option>

                                                                    </select>
                                                                    <span class="form-text text-xs">{{__('Identification must be
                                                                        a vaild ID.')}}</span>

                                                                </div> --}}



                                                                {{--
                                                                <div class="col-6 mt-3">
                                                                    <input type="text" name="identification_number"
                                                                        class="form-control" required placeholder="ID Number"
                                                                        value="{{$user->identification_number}}">
                                                                    <span class="form-text text-xs">{{__('Enter ID no on
                                                                        card.')}}</span>
                                                                </div> --}}


                                                                {{-- <div class="col-md-6">
                                                                    <div id="my_camera"></div>
                                                                    <br />
                                                                    <input type=file class="btn btn-primary btn-sm"
                                                                        value="choose picture" onClick="take_snapshot()">
                                                                    <input type="hidden" name="image" class="image-tag">
                                                                </div> --}}

                                                                <div class="col-md-6">

                                                                    <div class="form-group">
                                                                        <div class="custom-file">
                                                                            <input type="file" class="form-control"
                                                                                   id="customFileLang" name="image"
                                                                                   accept="image/*" required>
                                                                            <label class="custom-file-label"
                                                                                   for="customFileLang">{{__('Choose
                                                                        Picture')}}</label>
                                                                        </div>
                                                                    </div>

                                                                </div>


                                                                <div class="col-md-6">

                                                                    <div class="form-group">

                                                                        <img
                                                                            src="https://i.ytimg.com/vi/SeriHm824hA/maxresdefault.jpg"
                                                                            style="width: 250px; max-width: 600px; height: auto; margin: right; display: block;">

                                                                    </div>

                                                                </div>


                                                                {{-- <div class="col-md-6">
                                                                    <div id="results">Your captured image will appear here...
                                                                    </div>
                                                                </div> --}}


                                                                {{-- <script language="JavaScript">
                                                                    Webcam.set({
                                            width: 200,
                                            height: 200,
                                            image_format: 'jpeg',
                                            jpeg_quality: 50
                                        });

                                        Webcam.attach( '#my_camera' );
                                        "use strict";
                                        function take_snapshot() {
                                            Webcam.snap( function(data_uri) {
                                                $(".image-tag").val(data_uri);
                                                document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
                                            } );
                                        }
                                                                </script> --}}

                                                                <span class="form-text text-xs text-center">{{__('Choose a clear
                                                            picture of your face to avoild disapproval')}}</span>


                                                                <hr>


                                                                <div class="col-12 mt-3">
                                                                    <label class="custom-file-label"
                                                                           for="customFileLang">{{__('Enter Valid BVN')}}</label>
                                                                    <input type="number" name="bvn" class="form-control"
                                                                           required placeholder="BVN"
                                                                           value="{{$user->bvn}}"><br>
                                                                    <span class="form-text text-xs">{{__('Enter your Vaild BVN |
                                                                Dial *565*0# to check your
                                                                BVN')}}</span><br>

                                                                </div>

                                                                <hr>


                                                                <div class="row">

                                                                    <div class="col-6">
                                                                        <label class="custom-file-label"
                                                                               for="customFileLang">{{__('Enter Valid NIN')}}</label>
                                                                        <input type="number" name="nin"
                                                                               class="form-control"
                                                                               required placeholder="Enter your NIN"
                                                                               required
                                                                               value="{{$user->identification_number}}">

                                                                    </div>

                                                                    <div class="col-6">

                                                                        <div class="form-group">
                                                                            <label class="custom-file-label"
                                                                                   for="customFileLang">{{__('Choose
                                                                        Utility Bill')}}</label>
                                                                            <div class="custom-file">
                                                                                <input type="file"
                                                                                       class="form-control"
                                                                                       id="customFileLang"
                                                                                       name="utility"
                                                                                       accept="image/*"
                                                                                       required>

                                                                            </div>

                                                                        </div>


                                                                    </div>


                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>


                                                    <hr>


                                                    <div class="text-right">
                                                        <button type="submit"
                                                                class="btn btn-warning btn-lg">{{__('Verify')}}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4">


                                        <div class="card">
                                            <div class="card-body text-center">
                                                <h3 class="mb-0 font-weight-bolder">{{__('Delete Account')}}</h3>

                                                <p class="card-text text-sm mb-2">{{__('Closing this account means you will no
                                            longer be able to
                                            access this account on')}} {{$set->site_name}}</p>
                                                <div class="text-right">
                                                    <a data-toggle="modal" data-target="#modal-formp" href=""
                                                       class="btn btn-danger btn-block"><i class="fa fa-trash"></i>
                                                        {{__('Delete Account')}}</a>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>


                        </div>
                        @endif

                        @if(Auth::user()->status == 1)

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header header-elements-inline">
                                            <h3 class="mb-0 font-weight-bolder text-warning">{{__('Verification Pending')}}</h3>
                                        </div>
                                        <div class="card-body">

                                            <div class="">
                                                <p>We are still verifying your account, its usualy takes 24-48 hours,
                                                    <br>
                                                    Update will be sent to your email
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
                                                                   value="{{Auth::user()->public_key}}">
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

                        @endif





                        @if(Auth::user()->status == 2)
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header header-elements-inline">
                                            <h3 class="mb-0 font-weight-bolder">{{__('Profile')}}</h3>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{url('user/account')}}" method="post">
                                                @csrf
                                                <div class="form-group row">
                                                    <label
                                                        class="col-form-label col-lg-3">{{__('Personal Info')}}</label>
                                                    <div class="col-lg-9">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <input type="text" name="first_name"
                                                                       class="form-control"
                                                                       placeholder="First Name"
                                                                       value="{{$user->first_name}}">
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="text" name="last_name" class="form-control"
                                                                       placeholder="Last Name"
                                                                       value="{{$user->last_name}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label
                                                        class="col-form-label col-lg-3">{{__('Business Name')}}</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="business_name" class="form-control"
                                                               placeholder="Your Business Name"
                                                               value="{{$user->business_name}}"
                                                               required>
                                                        <span class="form-text text-xs">{{__('Your business name is the official
                                                    name of your company.
                                                    It should be the same as the name on your registration
                                                    documents.')}}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label
                                                        class="col-form-label col-lg-3">{{__('Phone Number')}}</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fad fa-phone-alt"></i></span>
                                                            </div>
                                                            <input type="number" inputmode="numeric" name="phone"
                                                                   maxlength="14"
                                                                   class="form-control" value="{{$user->phone}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label
                                                        class="col-form-label col-lg-3">{{__('Email Address')}}</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fad fa-envelope"></i></span>
                                                            </div>
                                                            <input type="email" name="email" class="form-control"
                                                                   placeholder="{{__('Email Address')}}"
                                                                   value="{{$user->email}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label
                                                        class="col-form-label col-lg-3">{{__('Support Email')}}</label>
                                                    <div class="col-lg-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fad fa-envelope"></i></span>
                                                            </div>
                                                            <input type="email" name="support_email"
                                                                   class="form-control"
                                                                   placeholder="{{__('Email Address')}}"
                                                                   value="{{$user->support_email}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-lg-3">{{__('Country')}}</label>
                                                    <div class="col-lg-9">
                                                        <select class="form-control select" disabled name="country"
                                                                required>
                                                            <option value="">{{__('Select Country')}}</option>
                                                            @foreach($country as $val)
                                                                <option value="{{$val->country_id}}" @if($val->
                                                        country_id==$user->country) selected
                                                                    @endif>{{$val->real['nicename']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-neutral btn-sm">{{__('Save
                                                Changes')}}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h3 class="mb-0 font-weight-bolder">{{__('Business Logo')}}</h3>
                                            <p class="card-text text-sm">{{__('We recommend you use a square logo with
                                        dimensions 172px by 172px
                                        for best results on checkout forms.')}}</p>
                                            <a href="#" class="avatar text-center">
                                                <img src="{{url('/')}}/asset/profile/{{$cast}}"/>
                                            </a>
                                            <form action="{{url('user/avatar')}}" enctype="multipart/form-data"
                                                  method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFileLang"
                                                               name="image" accept="image/*" required>
                                                        <label class="custom-file-label" for="customFileLang">{{__('Choose
                                                    Media')}}</label>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-neutral btn-block">{{__('Change
                                                Logo')}}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h3 class="mb-0 font-weight-bolder">{{__('Delete Account')}}</h3>
                                            <p class="card-text text-sm mb-2">{{__('Closing this account means you will no
                                        longer be able to
                                        access this account on')}} {{$set->site_name}}</p>
                                            <div class="text-right">
                                                <a data-toggle="modal" data-target="#modal-formp" href=""
                                                   class="btn btn-danger btn-block"><i class="fa fa-trash"></i> {{__('Delete
                                            Account')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="modal fade" id="modal-formp" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="mb-0 font-weight-bolder">{{__('Delete Account')}}</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('delaccount')}}" method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                        <textarea type="text" name="reason" class="form-control" rows="5"
                                                  placeholder="{{__('Sorry to see you leave, Please tell us why you are leaving')}}"
                                                  required></textarea>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-neutral btn-block">{{__('Delete
                                        account')}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                         aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">

                        </div>
                    </div>
                </div>
            </div>
@stop
