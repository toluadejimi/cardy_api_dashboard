@extends('userlayout')

@section('content')


<div class="content-body">
    <div class="container-fluid">


        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Bank Transfer</a></li>
            </ol>
        </div>

        
        <div class="row">

            <div class="col-xl-6">
               


                <div class="card p-4">
                    <div class="card-body p-3">


                        <div class="alert text-center">
                            <h4>Transfer to all Nigerian Banks</h4>
                            <span class="badge badge-lg light badge-danger">NGN 250,000 Max per Transaction</span><br>
                        </div>



                        <form action="preview" method="POST">
                            @csrf


                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="card info">
                                    <div class="card-body d-flex align-items-center p-3">
                                        <div class="info-icon pe-3 ">
                                            <svg width="24" height="24" viewBox="0 0 20 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M14.5156 0C17.9644 0 20 1.98459 20 5.3818H15.7689V5.41647C13.8052 5.41647 12.2133 6.96849 12.2133 8.883C12.2133 10.7975 13.8052 12.3495 15.7689 12.3495H20V12.6615C20 16.0154 17.9644 18 14.5156 18H5.48444C2.03556 18 0 16.0154 0 12.6615V5.33847C0 1.98459 2.03556 0 5.48444 0H14.5156ZM19.2533 6.87241C19.6657 6.87241 20 7.19834 20 7.60039V10.131C19.9952 10.5311 19.6637 10.8543 19.2533 10.8589H15.8489C14.8548 10.872 13.9855 10.2084 13.76 9.26432C13.6471 8.67829 13.8056 8.07357 14.1931 7.61222C14.5805 7.15087 15.1573 6.88007 15.7689 6.87241H19.2533ZM16.2489 8.04237H15.92C15.7181 8.04005 15.5236 8.11664 15.38 8.25504C15.2364 8.39344 15.1556 8.58213 15.1556 8.77901C15.1555 9.19205 15.4964 9.52823 15.92 9.53298H16.2489C16.6711 9.53298 17.0133 9.1993 17.0133 8.78767C17.0133 8.37605 16.6711 8.04237 16.2489 8.04237ZM10.3822 3.89119H4.73778C4.31903 3.89116 3.9782 4.2196 3.97333 4.62783C3.97333 5.04087 4.31415 5.37705 4.73778 5.3818H10.3822C10.8044 5.3818 11.1467 5.04812 11.1467 4.6365C11.1467 4.22487 10.8044 3.89119 10.3822 3.89119Z"
                                                    fill="#1DAAFF" />
                                            </svg>
                                        </div>
                                        <div class="info-content">
                                            <span class="fs-16 mb-2">Choose Account</span>
                                            <select name="acct" class="form-control">
                                                <option value="main">Main Account - NGN
                                                    {{number_format(Auth::user()->main_wallet, 2)}}</option>
                                                <option value="bonus">Bonus Account - NGN
                                                    {{number_format(Auth::user()->bonus_wallet, 2)}}</option>

                                            </select>


                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="row">



                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card info">
                                        <div class="card-body d-flex align-items-center p-3">
                                            <div class="info-icon pe-3 ">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.1581 16.885H9.34306C8.92906 16.885 8.59306 16.549 8.59306 16.135C8.59306 15.721 8.92906 15.385 9.34306 15.385H15.1581C15.5721 15.385 15.9081 15.721 15.9081 16.135C15.9081 16.549 15.5721 16.885 15.1581 16.885ZM19.4991 6.158C19.1361 5.838 18.7231 5.476 18.2311 5.021C18.0081 4.841 17.7641 4.635 17.5051 4.417C16.0451 3.186 14.0451 1.5 12.2221 1.5C10.4201 1.5 8.54906 3.092 7.04606 4.371C6.76806 4.607 6.50806 4.829 6.24306 5.044C5.77706 5.476 5.36406 5.839 5.00006 6.16C2.61306 8.261 2.16406 8.812 2.16406 13.713C2.16406 22.5 4.70506 22.5 12.2501 22.5C19.7941 22.5 22.3361 22.5 22.3361 13.713C22.3361 8.811 21.8871 8.26 19.4991 6.158Z"
                                                        fill="#1DAAFF" />
                                                </svg>
                                            </div>
                                            <div class="info-content">
                                                <span class="fs-16 mb-2">Choose Bank</span>
                                                <select name="bank" required data-live-search="true" id="selectOption"
                                                    onchange="updateForm2()" class="form-control">
                                                    <option selected value="">Select Bank</option>
                                                    @foreach ($bank as $data)
                                                    <option value="{{$data->code}}">{{$data->bankName}}</option>
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card info">
                                        <div class="card-body d-flex align-items-center p-3">
                                            <div class="info-icon pe-3 ">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12 15.1739C16.3386 15.1739 20 15.8789 20 18.599C20 21.32 16.3146 22 12 22C7.66237 22 4 21.295 4 18.575C4 15.8539 7.68538 15.1739 12 15.1739ZM12 2C14.9391 2 17.294 4.35402 17.294 7.29105C17.294 10.2281 14.9391 12.5831 12 12.5831C9.0619 12.5831 6.70601 10.2281 6.70601 7.29105C6.70601 4.35402 9.0619 2 12 2Z"
                                                        fill="#1DAAFF" />
                                                </svg>

                                            </div>
                                            <div class="info-content">
                                                <span class="fs-16 mb-2">Enter Account Number</span>
                                                <input type="number" maxlength="10" required name="account_no"
                                                    class="form-control" id="inputField" onkeyup="updateForm3()"
                                                    oninput="limitInputLength()">

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>




                            <div class="row mt-3">

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card info">
                                        <div class="card-body d-flex align-items-center p-3">
                                            <div class="info-icon pe-3 ">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12 15.1739C16.3386 15.1739 20 15.8789 20 18.599C20 21.32 16.3146 22 12 22C7.66237 22 4 21.295 4 18.575C4 15.8539 7.68538 15.1739 12 15.1739ZM12 2C14.9391 2 17.294 4.35402 17.294 7.29105C17.294 10.2281 14.9391 12.5831 12 12.5831C9.0619 12.5831 6.70601 10.2281 6.70601 7.29105C6.70601 4.35402 9.0619 2 12 2Z"
                                                        fill="#1DAAFF" />
                                                </svg>

                                            </div>
                                            <div class="info-content">
                                                <span class="fs-16 mb-2">Beneficary Name</span>
                                                <div id="result" style="color: rgb(255, 255, 255); font-size: 16px;">
                                                </div>


                                                <div id="loadingIndicator"
                                                    style="display: none; color: rgb(255, 255, 255);">fetching
                                                    account...</div>




                                            </div>

                                        </div>
                                    </div>
                                </div>




                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card info">
                                        <div class="card-body d-flex align-items-center p-3">
                                            <div class="info-icon pe-3 ">
                                                <svg width="24" height="24" viewBox="0 0 20 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14.5156 0C17.9644 0 20 1.98459 20 5.3818H15.7689V5.41647C13.8052 5.41647 12.2133 6.96849 12.2133 8.883C12.2133 10.7975 13.8052 12.3495 15.7689 12.3495H20V12.6615C20 16.0154 17.9644 18 14.5156 18H5.48444C2.03556 18 0 16.0154 0 12.6615V5.33847C0 1.98459 2.03556 0 5.48444 0H14.5156ZM19.2533 6.87241C19.6657 6.87241 20 7.19834 20 7.60039V10.131C19.9952 10.5311 19.6637 10.8543 19.2533 10.8589H15.8489C14.8548 10.872 13.9855 10.2084 13.76 9.26432C13.6471 8.67829 13.8056 8.07357 14.1931 7.61222C14.5805 7.15087 15.1573 6.88007 15.7689 6.87241H19.2533ZM16.2489 8.04237H15.92C15.7181 8.04005 15.5236 8.11664 15.38 8.25504C15.2364 8.39344 15.1556 8.58213 15.1556 8.77901C15.1555 9.19205 15.4964 9.52823 15.92 9.53298H16.2489C16.6711 9.53298 17.0133 9.1993 17.0133 8.78767C17.0133 8.37605 16.6711 8.04237 16.2489 8.04237ZM10.3822 3.89119H4.73778C4.31903 3.89116 3.9782 4.2196 3.97333 4.62783C3.97333 5.04087 4.31415 5.37705 4.73778 5.3818H10.3822C10.8044 5.3818 11.1467 5.04812 11.1467 4.6365C11.1467 4.22487 10.8044 3.89119 10.3822 3.89119Z"
                                                        fill="#1DAAFF" />
                                                </svg>

                                            </div>
                                            <div class="info-content">
                                                <span class="fs-16 mb-2">Amoumt(NGN)</span>
                                                <h4 class=""> </h4>

                                                <input type="number" required name="amount" class="form-control">


                                            </div>
                                        </div>
                                    </div>
                                </div>




                            </div>

                    </div>


                </div>

                </form>


            </div>


            <div class="col-xl-6">


                <div class="card p-4">
                    <div class="card-body p-3">


                        <div class="alert text-center">
                            <h4>Transfer to all Nigerian Banks</h4>
                            <span class="badge badge-lg light badge-danger">NGN 250,000 Max per Transaction</span><br>
                        </div>



                        <form action="preview" method="POST">
                            @csrf


                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="card info">
                                    <div class="card-body d-flex align-items-center p-3">
                                        <div class="info-icon pe-3 ">
                                            <svg width="24" height="24" viewBox="0 0 20 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M14.5156 0C17.9644 0 20 1.98459 20 5.3818H15.7689V5.41647C13.8052 5.41647 12.2133 6.96849 12.2133 8.883C12.2133 10.7975 13.8052 12.3495 15.7689 12.3495H20V12.6615C20 16.0154 17.9644 18 14.5156 18H5.48444C2.03556 18 0 16.0154 0 12.6615V5.33847C0 1.98459 2.03556 0 5.48444 0H14.5156ZM19.2533 6.87241C19.6657 6.87241 20 7.19834 20 7.60039V10.131C19.9952 10.5311 19.6637 10.8543 19.2533 10.8589H15.8489C14.8548 10.872 13.9855 10.2084 13.76 9.26432C13.6471 8.67829 13.8056 8.07357 14.1931 7.61222C14.5805 7.15087 15.1573 6.88007 15.7689 6.87241H19.2533ZM16.2489 8.04237H15.92C15.7181 8.04005 15.5236 8.11664 15.38 8.25504C15.2364 8.39344 15.1556 8.58213 15.1556 8.77901C15.1555 9.19205 15.4964 9.52823 15.92 9.53298H16.2489C16.6711 9.53298 17.0133 9.1993 17.0133 8.78767C17.0133 8.37605 16.6711 8.04237 16.2489 8.04237ZM10.3822 3.89119H4.73778C4.31903 3.89116 3.9782 4.2196 3.97333 4.62783C3.97333 5.04087 4.31415 5.37705 4.73778 5.3818H10.3822C10.8044 5.3818 11.1467 5.04812 11.1467 4.6365C11.1467 4.22487 10.8044 3.89119 10.3822 3.89119Z"
                                                    fill="#1DAAFF" />
                                            </svg>
                                        </div>
                                        <div class="info-content">
                                            <span class="fs-16 mb-2">Choose Account</span>
                                            <select name="acct" class="form-control">
                                                <option value="main">Main Account - NGN
                                                    {{number_format(Auth::user()->main_wallet, 2)}}</option>
                                                <option value="bonus">Bonus Account - NGN
                                                    {{number_format(Auth::user()->bonus_wallet, 2)}}</option>

                                            </select>


                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="row">



                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card info">
                                        <div class="card-body d-flex align-items-center p-3">
                                            <div class="info-icon pe-3 ">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.1581 16.885H9.34306C8.92906 16.885 8.59306 16.549 8.59306 16.135C8.59306 15.721 8.92906 15.385 9.34306 15.385H15.1581C15.5721 15.385 15.9081 15.721 15.9081 16.135C15.9081 16.549 15.5721 16.885 15.1581 16.885ZM19.4991 6.158C19.1361 5.838 18.7231 5.476 18.2311 5.021C18.0081 4.841 17.7641 4.635 17.5051 4.417C16.0451 3.186 14.0451 1.5 12.2221 1.5C10.4201 1.5 8.54906 3.092 7.04606 4.371C6.76806 4.607 6.50806 4.829 6.24306 5.044C5.77706 5.476 5.36406 5.839 5.00006 6.16C2.61306 8.261 2.16406 8.812 2.16406 13.713C2.16406 22.5 4.70506 22.5 12.2501 22.5C19.7941 22.5 22.3361 22.5 22.3361 13.713C22.3361 8.811 21.8871 8.26 19.4991 6.158Z"
                                                        fill="#1DAAFF" />
                                                </svg>
                                            </div>
                                            <div class="info-content">
                                                <span class="fs-16 mb-2">Choose Bank</span>
                                                <select name="bank" required data-live-search="true" id="selectOption"
                                                    onchange="updateForm2()" class="form-control">
                                                    <option selected value="">Select Bank</option>
                                                    @foreach ($bank as $data)
                                                    <option value="{{$data->code}}">{{$data->bankName}}</option>
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card info">
                                        <div class="card-body d-flex align-items-center p-3">
                                            <div class="info-icon pe-3 ">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12 15.1739C16.3386 15.1739 20 15.8789 20 18.599C20 21.32 16.3146 22 12 22C7.66237 22 4 21.295 4 18.575C4 15.8539 7.68538 15.1739 12 15.1739ZM12 2C14.9391 2 17.294 4.35402 17.294 7.29105C17.294 10.2281 14.9391 12.5831 12 12.5831C9.0619 12.5831 6.70601 10.2281 6.70601 7.29105C6.70601 4.35402 9.0619 2 12 2Z"
                                                        fill="#1DAAFF" />
                                                </svg>

                                            </div>
                                            <div class="info-content">
                                                <span class="fs-16 mb-2">Enter Account Number</span>
                                                <input type="number" maxlength="10" required name="account_no"
                                                    class="form-control" id="inputField" onkeyup="updateForm3()"
                                                    oninput="limitInputLength()">

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>




                            <div class="row mt-3">

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card info">
                                        <div class="card-body d-flex align-items-center p-3">
                                            <div class="info-icon pe-3 ">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12 15.1739C16.3386 15.1739 20 15.8789 20 18.599C20 21.32 16.3146 22 12 22C7.66237 22 4 21.295 4 18.575C4 15.8539 7.68538 15.1739 12 15.1739ZM12 2C14.9391 2 17.294 4.35402 17.294 7.29105C17.294 10.2281 14.9391 12.5831 12 12.5831C9.0619 12.5831 6.70601 10.2281 6.70601 7.29105C6.70601 4.35402 9.0619 2 12 2Z"
                                                        fill="#1DAAFF" />
                                                </svg>

                                            </div>
                                            <div class="info-content">
                                                <span class="fs-16 mb-2">Beneficary Name</span>
                                                <div id="result" style="color: rgb(255, 255, 255); font-size: 16px;">
                                                </div>


                                                <div id="loadingIndicator"
                                                    style="display: none; color: rgb(255, 255, 255);">fetching
                                                    account...</div>




                                            </div>

                                        </div>
                                    </div>
                                </div>




                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card info">
                                        <div class="card-body d-flex align-items-center p-3">
                                            <div class="info-icon pe-3 ">
                                                <svg width="24" height="24" viewBox="0 0 20 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14.5156 0C17.9644 0 20 1.98459 20 5.3818H15.7689V5.41647C13.8052 5.41647 12.2133 6.96849 12.2133 8.883C12.2133 10.7975 13.8052 12.3495 15.7689 12.3495H20V12.6615C20 16.0154 17.9644 18 14.5156 18H5.48444C2.03556 18 0 16.0154 0 12.6615V5.33847C0 1.98459 2.03556 0 5.48444 0H14.5156ZM19.2533 6.87241C19.6657 6.87241 20 7.19834 20 7.60039V10.131C19.9952 10.5311 19.6637 10.8543 19.2533 10.8589H15.8489C14.8548 10.872 13.9855 10.2084 13.76 9.26432C13.6471 8.67829 13.8056 8.07357 14.1931 7.61222C14.5805 7.15087 15.1573 6.88007 15.7689 6.87241H19.2533ZM16.2489 8.04237H15.92C15.7181 8.04005 15.5236 8.11664 15.38 8.25504C15.2364 8.39344 15.1556 8.58213 15.1556 8.77901C15.1555 9.19205 15.4964 9.52823 15.92 9.53298H16.2489C16.6711 9.53298 17.0133 9.1993 17.0133 8.78767C17.0133 8.37605 16.6711 8.04237 16.2489 8.04237ZM10.3822 3.89119H4.73778C4.31903 3.89116 3.9782 4.2196 3.97333 4.62783C3.97333 5.04087 4.31415 5.37705 4.73778 5.3818H10.3822C10.8044 5.3818 11.1467 5.04812 11.1467 4.6365C11.1467 4.22487 10.8044 3.89119 10.3822 3.89119Z"
                                                        fill="#1DAAFF" />
                                                </svg>

                                            </div>
                                            <div class="info-content">
                                                <span class="fs-16 mb-2">Amoumt(NGN)</span>
                                                <h4 class=""> </h4>

                                                <input type="number" required name="amount" class="form-control">


                                            </div>
                                        </div>
                                    </div>
                                </div>




                            </div>

                    </div>


                </div>

                </form>


            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/fetch-jsonp/1.3.0/fetch-jsonp.min.js"></script>

<script>
    window.onload = function () {
        document.getElementById('inputField').disabled = true;
      };

      function updateForm2() {
        document.getElementById('inputField').disabled = false;
      }


      function limitInputLength() {
        const inputValue = document.getElementById('inputField').value;
        if (inputValue.length > 10) {
          document.getElementById('inputField').value = inputValue.slice(0, 10);
        }
      }

    function updateForm3() {
        const selectValue = document.getElementById('selectOption').value;
        const inputValue = document.getElementById('inputField').value;

        if (inputValue.length === 10) {
            document.getElementById('loadingIndicator').style.display = 'block';
            const proxyUrl = `/proxy?callback=handleResponse&bank_code=${selectValue}&account_number=${inputValue}`;

          // Use fetch to make the request via the Laravel proxy
          fetch(proxyUrl)
            .then(response => response.json())
            .then(data => {

                console.log(data.status);
                if (data.status === true) {

                    document.getElementById('result').innerHTML = data.customer_name;

                } else{
                    document.getElementById('result').innerHTML = data.message;
                }
                })
            .catch(error => {
              console.error('Error fetching data:', error);
            })
            .finally(() => {
                document.getElementById('loadingIndicator').style.display = 'none';
              });
        }
      }
</script>











@stop