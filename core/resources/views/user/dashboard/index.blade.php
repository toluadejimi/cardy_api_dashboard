@extends('userlayout')

@section('content')



<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">



        <div class="row">

            <div class="col-xl-12">


                @if($set->notify == 1 && Auth::user()->status == 0)
                <div class="alert alert-danger  alert-end-icon alert-dismissible fade show">
                    <span><i class="mdi mdi-help"></i></span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    </button>
                    <strong>Alert!</strong> {{ $set->verify_message }}. <a class="text-white" </div>


                        @endif

                        @if($set->notify == 1 && Auth::user()->is_email_verified == 0)
                        <div class="alert alert-warning  alert-end-icon alert-dismissible fade show">
                            <span><i class="mdi mdi-alert"></i></span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                            </button>
                            <strong>Alert!</strong> {{ Auth::user()->email }} {{ $set->email_message }},verify
                            your
                        </div>
                        @endif

                </div>



                <div class="col-xl-12">


                    <div class="row">
                        <!----column-- -->
                        <div class="col-xl-8">


                            <div class="card balance-data">
                                <div class="card-header border-0 flex-wrap">
                                    <h4 class="fs-18 font-w600">Your Balance Summary</h4>
                                    <div class="d-flex align-items-center">
                                        <div class="round" id="dzNewSeries">
                                            <input type="checkbox" id="checkbox" name="balance_summary" value="monthly">
                                            <label for="checkbox" class="checkmark monthy"></label>
                                            <span>Monthly</span>
                                        </div>
                                        <div class="round" id="dzOldSeries">
                                            <input type="checkbox" id="checkbox1" name="balance_summary" value="weekly">
                                            <label for="checkbox1" class="checkmark weekly"></label>
                                            <span>Weekly</span>
                                        </div>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);"
                                                class="btn-link btn sharp tp-btn-light btn-primary"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.33319 9.99985C8.33319 10.9203 9.07938 11.6665 9.99986 11.6665C10.9203 11.6665 11.6665 10.9203 11.6665 9.99986C11.6665 9.07938 10.9203 8.33319 9.99986 8.33319C9.07938 8.33319 8.33319 9.07938 8.33319 9.99985Z"
                                                        fill="#B9A8FF" />
                                                    <path
                                                        d="M8.33319 3.33329C8.33319 4.25376 9.07938 4.99995 9.99986 4.99995C10.9203 4.99995 11.6665 4.25376 11.6665 3.33329C11.6665 2.41282 10.9203 1.66663 9.99986 1.66663C9.07938 1.66663 8.33319 2.41282 8.33319 3.33329Z"
                                                        fill="#B9A8FF" />
                                                    <path
                                                        d="M8.33319 16.6667C8.33319 17.5871 9.07938 18.3333 9.99986 18.3333C10.9203 18.3333 11.6665 17.5871 11.6665 16.6667C11.6665 15.7462 10.9203 15 9.99986 15C9.07938 15 8.33319 15.7462 8.33319 16.6667Z"
                                                        fill="#B9A8FF" />
                                                </svg>

                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body py-0 custome-tooltip">
                                    <div class="d-flex align-items-center flex-wrap income">
                                        <div class="d-flex align-items-center mb-2 me-3 arrow">
                                            <div class="me-3">
                                                <svg class="theme-col" width="45" height="45" viewBox="0 0 52 52"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="26" cy="26" r="26" fill="var(--bs-body-bg)" />
                                                    <g clip-path="url(#clip0)">
                                                        <path
                                                            d="M34.9293 30.4004C34.9294 30.3966 34.9293 30.3927 34.9293 30.3889L34.9371 18.5152C34.9369 18.4212 34.9264 18.3275 34.906 18.2357L34.8284 17.9716L34.7507 17.8163L34.6653 17.7309C34.5585 17.5759 34.4243 17.4417 34.2693 17.3348L34.1916 17.2572L34.0984 17.164L33.8965 17.1019C33.783 17.0683 33.6654 17.0499 33.547 17.0475L21.6112 17.0708C20.8167 17.0676 20.17 17.7092 20.1668 18.5037C20.1668 18.5075 20.1668 18.5114 20.1668 18.5152C20.1853 19.3009 20.8178 19.9334 21.6035 19.9519L28.6935 19.9596C28.9967 19.9626 29.2402 20.2109 29.2372 20.5141C29.2358 20.6552 29.1802 20.7903 29.0818 20.8915L17.5187 32.4546C16.9568 33.0164 16.9568 33.9273 17.5186 34.4892C18.0804 35.0511 18.9913 35.0511 19.5532 34.4893C19.5533 34.4893 19.5533 34.4892 19.5534 34.4892L31.1164 22.9261C31.3338 22.7147 31.6815 22.7196 31.8929 22.937C31.9912 23.0382 32.0469 23.1733 32.0483 23.3144L32.0405 30.3889C32.0551 31.1805 32.6933 31.8188 33.4849 31.8333C34.2795 31.8365 34.9262 31.195 34.9293 30.4004Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath>
                                                            <rect width="24" height="24" fill="white"
                                                                transform="translate(26 9.02945) rotate(45)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="fs-14">Wallet Balance</span>
                                                <h4 class="fs-5 font-w600">NGN {{
                                                    number_format(Auth::user()->main_wallet, 2) }}</h4>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center ms-sm-2 mb-2 arrow">
                                            <div class="me-3">
                                                <svg class="" width="45" height="45" viewBox="0 0 52 52" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="26" cy="26" r="26" transform="rotate(-180 26 26)"
                                                        fill="#5E3ED0" />
                                                    <g clip-path="url(#clip0)">
                                                        <path
                                                            d="M17.0707 21.5996C17.0706 21.6034 17.0707 21.6073 17.0707 21.6111L17.0629 33.4848C17.0631 33.5788 17.0736 33.6725 17.094 33.7643L17.1716 34.0284L17.2493 34.1837L17.3347 34.2691C17.4415 34.4241 17.5757 34.5583 17.7307 34.6652L17.8084 34.7428L17.9016 34.836L18.1035 34.8981C18.217 34.9317 18.3346 34.9501 18.453 34.9525L30.3888 34.9292C31.1833 34.9324 31.83 34.2908 31.8332 33.4963C31.8332 33.4925 31.8332 33.4886 31.8332 33.4848C31.8147 32.6991 31.1822 32.0666 30.3965 32.0481L23.3065 32.0404C23.0033 32.0374 22.7598 31.7891 22.7628 31.4859C22.7642 31.3448 22.8198 31.2097 22.9182 31.1085L34.4813 19.5454C35.0432 18.9836 35.0432 18.0727 34.4814 17.5108C33.9196 16.9489 33.0087 16.9489 32.4468 17.5107C32.4467 17.5107 32.4467 17.5108 32.4466 17.5108L20.8836 29.0739C20.6662 29.2853 20.3185 29.2804 20.1071 29.063C20.0088 28.9618 19.9531 28.8267 19.9517 28.6856L19.9595 21.6111C19.9449 20.8195 19.3067 20.1812 18.5151 20.1667C17.7205 20.1635 17.0738 20.805 17.0707 21.5996Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath>
                                                            <rect width="24" height="24" fill="white"
                                                                transform="translate(26 42.9706) rotate(-135)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="fs-14">Bonus Wallet</span>
                                                <h4 class="fs-5 font-w700">NGN {{
                                                    number_format(Auth::user()->bonus_wallet, 2) }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="reservationChart" class="reservationChart"></div>
                                </div>
                            </div>
                        </div>
                        <!----/column-- -->
                        <!----column-- -->
                        <div class="col-xl-4">
                            <div class="row">
                                <div class="col-xl-12 col-lg-4 col-md-6">
                                    <div class="card Expense overflow-hidden">
                                        <div class="card-body p-4 p-lg-3 p-xl-4 ">
                                            <div
                                                class="students1 one d-flex align-items-center justify-content-between ">
                                                <div class="content">
                                                    <h2 class="mb-0">NGN {{ number_format($total_out, 2) }}</h2>
                                                    <span class="mb-2 fs-14">Total Out</span>
                                                    <h5>+0,5% than last month</h5>
                                                </div>
                                                <div>
                                                    <div class="d-inline-block position-relative donut-chart-sale mb-3">
                                                        <svg width="60" height="58" viewBox="0 0 60 58" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M39.0469 2.3125C38.3437 3.76563 38.9648 5.52344 40.418 6.22657C44.4609 8.17188 47.8828 11.1953 50.3203 14.9805C52.8164 18.8594 54.1406 23.3594 54.1406 28C54.1406 41.3125 43.3125 52.1406 30 52.1406C16.6875 52.1406 5.85937 41.3125 5.85937 28C5.85937 23.3594 7.18359 18.8594 9.66797 14.9688C12.0937 11.1836 15.5273 8.16016 19.5703 6.21485C21.0234 5.51173 21.6445 3.76563 20.9414 2.30079C20.2383 0.847664 18.4922 0.226569 17.0273 0.929694C12 3.34376 7.74609 7.09375 4.73437 11.8047C1.64062 16.6328 -1.56336e-06 22.2344 -1.31134e-06 28C-9.60967e-07 36.0156 3.11719 43.5508 8.78906 49.2109C14.4492 54.8828 21.9844 58 30 58C38.0156 58 45.5508 54.8828 51.2109 49.2109C56.8828 43.5391 60 36.0156 60 28C60 22.2344 58.3594 16.6328 55.2539 11.8047C52.2305 7.10547 47.9766 3.34375 42.9609 0.929693C41.4961 0.238287 39.75 0.84766 39.0469 2.3125V2.3125Z"
                                                                fill="#53CAFD" />
                                                            <path
                                                                d="M41.4025 26.4414C41.9767 25.8671 42.258 25.1171 42.258 24.3671C42.258 23.6171 41.9767 22.8671 41.4025 22.2929L34.0314 14.9218C32.9533 13.8437 31.5236 13.2578 30.0119 13.2578C28.5002 13.2578 27.0587 13.8554 25.9923 14.9218L18.6212 22.2929C17.4728 23.4414 17.4728 25.2929 18.6212 26.4414C19.7697 27.5898 21.6212 27.5898 22.7697 26.4414L27.0939 22.1171L27.0939 38.7695C27.0939 40.3867 28.4064 41.6992 30.0236 41.6992C31.6408 41.6992 32.9533 40.3867 32.9533 38.7695L32.9533 22.1054L37.2775 26.4296C38.4025 27.5781 40.2541 27.5781 41.4025 26.4414Z"
                                                                fill="#53CAFD" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!----/column-- -->
                                <!----column-- -->
                                <div class="col-xl-12 col-lg-4 col-md-6">
                                    <div class="card">
                                        <div class="card-body p-4 p-lg-3 p-xl-4 ">
                                            <div
                                                class="students1 two d-flex align-items-center justify-content-between">
                                                <div class="content">
                                                    <h2 class="mb-0">NGN {{ number_format($total_in, 2) }}</h2>
                                                    </h2>
                                                    <span class="mb-2 fs-14">Total In</span>
                                                    <h5 class="fs-13">NGN {{ number_format($total_in, 2) }} this month
                                                    </h5>
                                                </div>
                                                <div class="d-inline-block position-relative donut-chart-sale">
                                                    <span class="donut3"
                                                        data-peity='{ "fill": ["rgba(204, 97, 255, 0.9)", "rgba(255, 255, 255, 0.1"],   "innerRadius": 30, "radius": {{ $percentage }}}'>4/8</span>
                                                    <small>{{ $percentage }}%</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!----/column-- -->
                                <!----column-- -->
                                <div class="col-xl-12 col-lg-4 col-md-12">
                                    <div class="card overflow-hidden">
                                        <div class="card-body p-4 p-lg-3 p-xl-4">
                                            <div
                                                class="students1 three d-flex align-items-center justify-content-between">
                                                <div class="content">
                                                    <h2 class="mb-0">{{number_format($set->ngn_rate) }}/$</h2>
                                                    <span class="fs-14">NGN/USD Today</span>
                                                </div>
                                                <div class="newCustomers">
                                                    <div class="d-inline-block position-relative donut-chart-sale mb-3">
                                                        <div id="NewCustomers"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!---/-column-- -->
                            </div>
                        </div>



                        <div class="col-xl-12 mt-4">
                            <div class="card">
                                <div class="col-lg-12">
                                    <div class="card-body">
                                        {{__('Latest Transaction')}}</h5>
                                        <div class="table-responsive py-4">
                                            <table id="example" class="display" style="width:250%">
                                                <thead>
                                                    <tr>
                                                        <th>{{__('S / N')}}</th>
                                                        <th>{{__('Reference ID')}}</th>
                                                        <th>{{__('Session ID')}}</th>
                                                        <th>{{__('Debit')}}</th>
                                                        <th>{{__('Credit')}}</th>
                                                        <th>{{__('Type')}}</th>
                                                        <th>{{__('Status')}}</th>
                                                        <th>{{__('Sender Name')}}</th>
                                                        <th>{{__('Sender Bank')}}</th>
                                                        <th>{{__('Sender Account No')}}</th>
                                                        <th>{{__('Note')}}</th>
                                                        <th>{{__('Date Time')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($all as $k=>$val)
                                                    <tr>
                                                        <td>{{++$k}}.</td>
                                                        <td>{{$val->ref_trans_id}}</td>
                                                        <td>{{$val->e_ref}}</td>
                                                        <td>NGN {{number_format($val->debit, 2)}}</td>
                                                        <td>NGN {{number_format($val->credit, 2)}}</td>
                                                        <td>{{$val->title}}</td>
                                                        <td>@if($val->status==2) <span
                                                                class="badge badge-pill badge-danger"><i
                                                                    class="fad fa-ban"></i>Failed</span>
                                                            @elseif($val->status==1)
                                                            <span class="badge badge-pill badge-success"><i
                                                                    class="fad fa-check"></i>Successful
                                                                @elseif($val->status==4)
                                                                Refunded @endif
                                                        </td>
                                                        <td>{{$val->sender_name ?? " No Details" }}</td>
                                                        <td>{{$val->sender_bank ?? " No Details"}}</td>
                                                        <td>{{$val->sender_account_no ?? " No Details"}}</td>
                                                        <td>{{$val->note}}</td>
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


                    </div>
                </div>
            </div>
            <!----/column-- -->
        </div>
        <!--/row-->
    </div>

</div>
@stop