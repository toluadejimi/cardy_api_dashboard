@extends('paymentlayout')

@section('content')

<div class="main-content">
    <div class="header py-7 py-lg-6 pt-lg-1">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                        <div class="card-profile-image mb-5">
                            <img src="http://enkpay.com/asset/wp-content/uploads/sites/110/2022/11/fintex-logo.png"
                                class="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt--8 pb-5 mb-0">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12 center">
                                <img src="{{url('/')}}/asset/profile/{{ $image }}" width="399" height="399" class="">

                            </div>

                        </div>
                        <form action="/pay-now" method="post" id="payment-form">
                            @csrf

                            <h2 class="my-5">{!!$name!!}</h2>


                            <div class="row">



                                <div class="col-6">
                                    <span class="form-text text-xl">{{$currency->symbol}}
                                        {{number_format($amount)}}.00</span>

                                </div>

                                <div class="col-6 mt-3">
                                    @if($quantity_status==0)
                                    @if($quantity!=0)
                                    <div class="col-lg-4">
                                        <span class="badge badge-pill badge-primary mb-3 ml-0">{{__('In stock')}}:
                                            {{$quantity}}</span>
                                    </div>
                                    @endif
                                    @endif
                                </div>



                            </div>



                            <div class="row justify-content-between align-items-center">
    
                                <div class="col-auto">
                                    <div class="text-right">

                                    </div>
                                </div>
                            </div>
                            @if(!empty($description))
                            <span class="form-text text-xs text-default">{!!$description!!}.</span>
                            @endif
                            @if($quantity_status==0)
                            <div class="form-group row">
                                @if($quantity!=0)
                                @if($shipping_status==1)
                                <div class="col-lg-3 mt-2">
                                    <input type="number" id="quantity" name="quantity" value="1" step="1" min="1"
                                        max="{{$quantity}}" title="Qty" size="4" inputmode="numeric"
                                        class="form-control" required="">
                                    <input type="hidden" id="amount" value="{{$amount}}" name="amount">
                                </div>
                                <label class="col-form-label col-lg-5">{{__('Quantity')}}</label>
                                @else
                                <div class="col-lg-3">
                                    <input type="number" id="quanz" name="quantity" value="1" step="1" min="1"
                                        max="{{$quantity}}" title="Qty" size="4" inputmode="numeric"
                                        class="form-control" required="">
                                    <input type="hidden" id="amount4" value="{{$amount}}" name="amount">
                                </div>
                                <label class="col-form-label col-lg-5">{{__('Quantity')}}</label>
                                @endif
                                @else
                                <div class="col-lg-3">
                                    <span class="badge badge-pill badge-primary mb-3">{{__('Out of stock')}}</span>
                                </div>
                                @endif
                            </div>
                            @else
                            <input type="hidden" id="quantity" value="1" name="quantity">
                            @endif
                            <input type="hidden" name="ref_id" value="{{$ref}}">
                            <input type="hidden" name="user_id" value="{{$user_id}}">
                            <input type="hidden" name="product_id" value="{{$id}}">
                            <input type="hidden" name="amount" value="{{$amount}}">
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <input type="text" name="first_name" class="form-control"
                                                placeholder="First Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <input type="text" name="last_name" class="form-control"
                                                placeholder="Last Name" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Your Email Address" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <input type="number" inputmode="numeric" name="phone" class="form-control"
                                                placeholder="Mobile Number" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       
                            @if($note_status!=0)
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <textarea type="text" name="note" class="form-control" rows=""
                                        placeholder="Delivery Note @if($note_status==1)(Optional) @endif"
                                        @if($note_status==2)required="" @endif></textarea>
                                </div>
                            </div>
                            @endif
                            @if($shipping_status==1)
                            {{-- <div class="form-group row">
                                <div class="col-lg-6">
                                    <select class="form-control custom-select" name="country" id="country" required>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <select class="form-control custom-select" name="state" id="state" required>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <input type="text" name="address" class="form-control" placeholder="Your Address"
                                        required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="town" class="form-control" placeholder="Town/City"
                                        required>
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                {{-- <label class="col-form-label col-lg-12">{{__('Shipping Fee')}}</label> --}}
                                <div class="col-lg-12">
                                    {{-- <select class="form-control custom-select" name="shipping" id="ship_fee"
                                        required>
                                        @foreach($ship as $fval)
                                        <option value="{{$fval->id}}-{{$fval->amount}}">{{$fval->region}}
                                            {{$currency->symbol.$fval->amount}}</option>
                                        @endforeach
                                    </select> --}}
                                </div>
                            </div>
                            <input type="hidden" id="xship" name="xship">
                            <input type="hidden" id="xship_fee" name="shipping_fee">
                            @endif
                            <div class="row justify-content-between align-items-center">
                                {{-- <div class="col">
                                    <span class="text-sm text-default">{{__('Product')}}</span><br>
                                    <span class="text-sm text-default">{{__('Subtotal')}}</span>
                                </div> --}}
                                <div class="col-auto">
                                    {{-- @if($shipping_status==1)
                                    <span class="text-sm text-default">{{$name}} x <span
                                            id="product1">1</span></span><br>
                                    <span class="text-sm text-default">{{$currency->symbol}}<span
                                            id="subtotal1">{{$subtotal}}</span>.00</span>
                                    @else
                                    <span class="text-sm text-default">{{$name}} x <span
                                            id="product4">1</span></span><br>
                                    <span class="text-sm text-default">{{$currency->symbol}}<span
                                            id="subtotal4">{{$subtotal}}</span>.00</span>
                                    @endif --}}
                                </div>
                            </div>
                            @if($shipping_status==1)
                            <div class="row justify-content-between align-items-center">
                                <div class="col">
                                    {{-- <span class="text-sm text-default">{{__('Shipping')}}</span> --}}
                                </div>
                                <div class="col-auto">
                                    {{-- <span class="text-sm text-default">{{__('Flat rate')}}: {{$currency->symbol}}<span
                                            id="flat"></span></span> --}}
                                </div>
                            </div>
                            {{-- <hr> --}}
                            @endif
                            <div class="row justify-content-between align-items-center mb-5">
                                <div class="col">
                                    {{-- <span class="text-sm text-default">{{__('Total')}}</span> --}}
                                </div>
                                <div class="col-auto">
                                    {{-- @if($shipping_status==1)
                                    <span class="text-sm text-default">{{$currency->symbol}}<span
                                            id="total1">{{$total}}</span>.00</span>
                                    @else
                                    <span class="text-sm text-default">{{$currency->symbol}}<span
                                            id="total4">{{$total}}</span>.00</span>
                                    @endif --}}
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                {{-- <div id="carouselExampleIndicators" class="carousel slide bg-transparent mb-2"
                    data-ride="carousel">
                    <div class="carousel-inner bg-transparent">
                        @if($new==0)
                        <div class="carousel-item active">
                            <img class="d-block w-80" src="{{url('/')}}/asset/images/product-placeholder.jpg"
                                alt="product image">
                        </div>
                        @else
                        @foreach($image as $k=>$val)
                        <div class="carousel-item bg-transparent @if($val->id==$first->id)active @endif">
                            <img class="d-block w-100" src="{{url('/')}}/asset/profile/{{$val->image}}"
                                alt="product image">
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">{{__('Previous')}}</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">{{__('Next')}}</span>
                    </a>
                </div> --}}
                <div class="card">
                    <div class="card-body">



                        <p class="text-muted">Product Name</p>
                        <h3 class="mb-4">{!!$name!!}</h3>
                        <input type="hidden" value="{{ $amount }}" name="type">
                        <p class="text-muted">Amount</p>
                        <h2> NGN {{ number_format($amount, 2) }}</h2>
                        <button type="submit" class="btn btn-neutral my-4 btn-block"><i
                                class="fad fa-external-link"></i> {{__('Pay')}} NGN {{ number_format($amount, 2) }}</button>
                        
                                </div>
                            </div>
                        </div>
                   
                        </form>
                        {{-- <div class="text-center">
                            @if($merchant->facebook!=null)
                            <a href="{{$merchant->facebook}}"><i class="sn fab fa-facebook"></i></a>
                            @endif
                            @if($merchant->twitter!=null)
                            <a href="{{$merchant->twitter}}"><i class="sn fab fa-twitter"></i></a>
                            @endif
                            @if($merchant->linkedin!=null)
                            <a href="{{$merchant->linkedin}}"><i class="sn fab fa-linkedin"></i></a>
                            @endif
                            @if($merchant->instagram!=null)
                            <a href="{{$merchant->instagram}}"><i class="sn fab fa-instagram"></i></a>
                            @endif
                            @if($merchant->youtube!=null)
                            <a href="{{$merchant->youtube}}"><i class="sn fab fa-youtube"></i></a>
                            @endif
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop