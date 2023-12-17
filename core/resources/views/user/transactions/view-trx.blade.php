@extends('userlayout')
@section('content')


<!--**********************************
        Content body start
    ***********************************-->
<div class="content-body">
    <div class="container-fluid">



				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<!----column-- -->
							<div class="col-xl-6">
								<div class="card  ">
									<div class="card-header mb-3">
                                        <div >
                                            <span class="font-w400 d-block">Transaction ID</span>
                                            <p class="small me-2">{{$val->ref_trans_id}}</p>
                                        </div>
										<div class="add-btn me-2">
                                            <button class="btn btn-primary"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="1" d="M2 13C2 12.5 2.5 12 3 12C3.5 12 4 12.5 4 13C4 13.3333 4 15 4 18C4 19.1046 4.89543 20 6 20H18C19.1046 20 20 19.1046 20 18V13C20 12.4477 20.4477 12 21 12C21.5523 12 22 12.4477 22 13V18C22 20.2091 20.2091 22 18 22H6C3.79086 22 2 20.2091 2 18C2 15 2 13.3333 2 13Z" fill="white"/>
                                                <path opacity="1" d="M11 14C11 14.5523 11.4477 15 12 15C12.5523 15 13 14.5523 13 14L13 2C13 1.44771 12.5523 1 12 1C11.4477 1 11 1.44771 11 2L11 14Z" fill="white"/>
                                                <path d="M16.2929 9.29289C16.6834 8.90237 17.3166 8.90237 17.7071 9.29289C18.0976 9.68341 18.0976 10.3166 17.7071 10.7071L12.7071 15.7071C12.331 16.0832 11.7264 16.0991 11.331 15.7433L6.33104 11.2433C5.92053 10.8738 5.88725 10.2415 6.25671 9.83103C6.62617 9.42052 7.25845 9.38724 7.66896 9.7567L11.9638 13.622L16.2929 9.29289Z" fill="white"/>
                                                </svg> Download Recepit</button>
                                        </div>
									</div>
									<div class="card-body d-flex align-items-center justify-content-between flex-wrap pt-0">


										<div class="row">
											<!----column-- -->
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
												<div class="card info">
													<div class="card-body d-flex align-items-center p-3">
														<div class="info-icon pe-3 ">
															<svg width="24" height="24" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M14.5156 0C17.9644 0 20 1.98459 20 5.3818H15.7689V5.41647C13.8052 5.41647 12.2133 6.96849 12.2133 8.883C12.2133 10.7975 13.8052 12.3495 15.7689 12.3495H20V12.6615C20 16.0154 17.9644 18 14.5156 18H5.48444C2.03556 18 0 16.0154 0 12.6615V5.33847C0 1.98459 2.03556 0 5.48444 0H14.5156ZM19.2533 6.87241C19.6657 6.87241 20 7.19834 20 7.60039V10.131C19.9952 10.5311 19.6637 10.8543 19.2533 10.8589H15.8489C14.8548 10.872 13.9855 10.2084 13.76 9.26432C13.6471 8.67829 13.8056 8.07357 14.1931 7.61222C14.5805 7.15087 15.1573 6.88007 15.7689 6.87241H19.2533ZM16.2489 8.04237H15.92C15.7181 8.04005 15.5236 8.11664 15.38 8.25504C15.2364 8.39344 15.1556 8.58213 15.1556 8.77901C15.1555 9.19205 15.4964 9.52823 15.92 9.53298H16.2489C16.6711 9.53298 17.0133 9.1993 17.0133 8.78767C17.0133 8.37605 16.6711 8.04237 16.2489 8.04237ZM10.3822 3.89119H4.73778C4.31903 3.89116 3.9782 4.2196 3.97333 4.62783C3.97333 5.04087 4.31415 5.37705 4.73778 5.3818H10.3822C10.8044 5.3818 11.1467 5.04812 11.1467 4.6365C11.1467 4.22487 10.8044 3.89119 10.3822 3.89119Z" fill="#1DAAFF"/>
                                                                </svg>

														</div>
														<div class="info-content">
															<span class="fs-16">Amoumt</span>
															<h4 class="">NGN{{number_format($val->amount, 2)}}</h4>
														</div>
													</div>
												</div>
											</div>
											<!----/column-- -->
											<!----column-- -->
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">

												<div class="card info">
													<div class="card-body d-flex align-items-center p-3">

														<div class="info-icon pe-3 ">

                                                            @if($val->transaction_type == "Reversal")
                                                            <span class="income">
                                                                <span class="me-2">
                                                                    <svg width="39" height="39" viewBox="0 0 39 39" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <rect x="39" y="39" width="39" height="39" rx="19.5"
                                                                            transform="rotate(-180 39 39)" fill="#2BC155"
                                                                            fill-opacity="0.11" />
                                                                        <path opacity="1"
                                                                            d="M11.667 19.8333C11.667 19.4167 12.0837 19 12.5003 19C12.917 19 13.3337 19.4167 13.3337 19.8333C13.3337 20.1111 13.3337 21.5 13.3337 24C13.3337 24.9205 14.0799 25.6667 15.0003 25.6667H25.0003C25.9208 25.6667 26.667 24.9205 26.667 24V19.8333C26.667 19.3731 27.0401 19 27.5003 19C27.9606 19 28.3337 19.3731 28.3337 19.8333V24C28.3337 25.8409 26.8413 27.3333 25.0003 27.3333H15.0003C13.1594 27.3333 11.667 25.8409 11.667 24C11.667 21.5 11.667 20.1111 11.667 19.8333Z"
                                                                            fill="#13C28F" />
                                                                        <path opacity="1"
                                                                            d="M19.1663 20.6667C19.1663 21.1269 19.5394 21.5 19.9997 21.5C20.4599 21.5 20.833 21.1269 20.833 20.6667V10.6667C20.833 10.2064 20.4599 9.83333 19.9997 9.83333C19.5394 9.83333 19.1663 10.2064 19.1663 10.6667V20.6667Z"
                                                                            fill="#13C28F" />
                                                                        <path
                                                                            d="M23.5774 16.7441C23.9028 16.4186 24.4305 16.4186 24.7559 16.7441C25.0814 17.0695 25.0814 17.5972 24.7559 17.9226L20.5893 22.0893C20.2759 22.4027 19.772 22.4159 19.4425 22.1194L15.2759 18.3694C14.9338 18.0615 14.906 17.5346 15.2139 17.1925C15.5218 16.8504 16.0487 16.8227 16.3908 17.1306L19.9698 20.3517L23.5774 16.7441Z"
                                                                            fill="#13C28F" />
                                                                    </svg>
                                                                </span>
                                                            </span>


                                                            @elseif($val->transaction_type == "CashOut")
                                                            <span class="income">
                                                                <span class="me-2">
                                                                    <svg width="39" height="39" viewBox="0 0 39 39" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <rect x="39" y="39" width="39" height="39" rx="19.5"
                                                                            transform="rotate(-180 39 39)" fill="#2BC155"
                                                                            fill-opacity="0.11" />
                                                                        <path opacity="1"
                                                                            d="M11.667 19.8333C11.667 19.4167 12.0837 19 12.5003 19C12.917 19 13.3337 19.4167 13.3337 19.8333C13.3337 20.1111 13.3337 21.5 13.3337 24C13.3337 24.9205 14.0799 25.6667 15.0003 25.6667H25.0003C25.9208 25.6667 26.667 24.9205 26.667 24V19.8333C26.667 19.3731 27.0401 19 27.5003 19C27.9606 19 28.3337 19.3731 28.3337 19.8333V24C28.3337 25.8409 26.8413 27.3333 25.0003 27.3333H15.0003C13.1594 27.3333 11.667 25.8409 11.667 24C11.667 21.5 11.667 20.1111 11.667 19.8333Z"
                                                                            fill="#13C28F" />
                                                                        <path opacity="1"
                                                                            d="M19.1663 20.6667C19.1663 21.1269 19.5394 21.5 19.9997 21.5C20.4599 21.5 20.833 21.1269 20.833 20.6667V10.6667C20.833 10.2064 20.4599 9.83333 19.9997 9.83333C19.5394 9.83333 19.1663 10.2064 19.1663 10.6667V20.6667Z"
                                                                            fill="#13C28F" />
                                                                        <path
                                                                            d="M23.5774 16.7441C23.9028 16.4186 24.4305 16.4186 24.7559 16.7441C25.0814 17.0695 25.0814 17.5972 24.7559 17.9226L20.5893 22.0893C20.2759 22.4027 19.772 22.4159 19.4425 22.1194L15.2759 18.3694C14.9338 18.0615 14.906 17.5346 15.2139 17.1925C15.5218 16.8504 16.0487 16.8227 16.3908 17.1306L19.9698 20.3517L23.5774 16.7441Z"
                                                                            fill="#13C28F" />
                                                                    </svg>
                                                                </span>
                                                            </span>

                                                            @elseif($val->transaction_type == "Purchase")
                                                            <span class="income">
                                                                <span class="me-2">
                                                                    <svg width="39" height="39" viewBox="0 0 39 39" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <rect x="39" y="39" width="39" height="39" rx="19.5"
                                                                            transform="rotate(-180 39 39)" fill="#2BC155"
                                                                            fill-opacity="0.11" />
                                                                        <path opacity="1"
                                                                            d="M11.667 19.8333C11.667 19.4167 12.0837 19 12.5003 19C12.917 19 13.3337 19.4167 13.3337 19.8333C13.3337 20.1111 13.3337 21.5 13.3337 24C13.3337 24.9205 14.0799 25.6667 15.0003 25.6667H25.0003C25.9208 25.6667 26.667 24.9205 26.667 24V19.8333C26.667 19.3731 27.0401 19 27.5003 19C27.9606 19 28.3337 19.3731 28.3337 19.8333V24C28.3337 25.8409 26.8413 27.3333 25.0003 27.3333H15.0003C13.1594 27.3333 11.667 25.8409 11.667 24C11.667 21.5 11.667 20.1111 11.667 19.8333Z"
                                                                            fill="#13C28F" />
                                                                        <path opacity="1"
                                                                            d="M19.1663 20.6667C19.1663 21.1269 19.5394 21.5 19.9997 21.5C20.4599 21.5 20.833 21.1269 20.833 20.6667V10.6667C20.833 10.2064 20.4599 9.83333 19.9997 9.83333C19.5394 9.83333 19.1663 10.2064 19.1663 10.6667V20.6667Z"
                                                                            fill="#13C28F" />
                                                                        <path
                                                                            d="M23.5774 16.7441C23.9028 16.4186 24.4305 16.4186 24.7559 16.7441C25.0814 17.0695 25.0814 17.5972 24.7559 17.9226L20.5893 22.0893C20.2759 22.4027 19.772 22.4159 19.4425 22.1194L15.2759 18.3694C14.9338 18.0615 14.906 17.5346 15.2139 17.1925C15.5218 16.8504 16.0487 16.8227 16.3908 17.1306L19.9698 20.3517L23.5774 16.7441Z"
                                                                            fill="#13C28F" />
                                                                    </svg>
                                                                </span>
                                                            </span>

                                                            @elseif($val->transaction_type == "BankTransfer")
                                                            <span class="income">
                                                                <span class="me-2">
                                                                    <svg width="39" height="39" viewBox="0 0 39 39" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <rect width="39" height="39" rx="19.5" fill="#FF2E2E"
                                                                            fill-opacity="0.08" />
                                                                        <path opacity="1"
                                                                            d="M11.667 19.8333C11.667 19.4167 12.0837 19 12.5003 19C12.917 19 13.3337 19.4167 13.3337 19.8333C13.3337 20.1111 13.3337 21.5 13.3337 24C13.3337 24.9205 14.0799 25.6667 15.0003 25.6667H25.0003C25.9208 25.6667 26.667 24.9205 26.667 24V19.8333C26.667 19.3731 27.0401 19 27.5003 19C27.9606 19 28.3337 19.3731 28.3337 19.8333V24C28.3337 25.8409 26.8413 27.3333 25.0003 27.3333H15.0003C13.1594 27.3333 11.667 25.8409 11.667 24C11.667 21.5 11.667 20.1111 11.667 19.8333Z"
                                                                            fill="#FD5353" />
                                                                        <path opacity="1"
                                                                            d="M20.8337 11.5C20.8337 11.0398 20.4606 10.6667 20.0003 10.6667C19.5401 10.6667 19.167 11.0398 19.167 11.5V21.5C19.167 21.9602 19.5401 22.3333 20.0003 22.3333C20.4606 22.3333 20.8337 21.9602 20.8337 21.5V11.5Z"
                                                                            fill="#FD5353" />
                                                                        <path
                                                                            d="M20.0302 11.815L16.4226 15.4226C16.0972 15.748 15.5695 15.748 15.2441 15.4226C14.9186 15.0972 14.9186 14.5695 15.2441 14.2441L19.4107 10.0774C19.7241 9.76402 20.228 9.75077 20.5575 10.0473L24.7241 13.7973C25.0662 14.1051 25.094 14.6321 24.7861 14.9741C24.4782 15.3162 23.9513 15.344 23.6092 15.0361L20.0302 11.815Z"
                                                                            fill="#FD5353" />
                                                                    </svg>
                                                                </span>
                                                            </span>


                                                            @elseif($val->transaction_type == "VasAirtime")
                                                            <span class="income">
                                                                <span class="me-2">
                                                                    <svg width="39" height="39" viewBox="0 0 39 39" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <rect width="39" height="39" rx="19.5" fill="#FF2E2E"
                                                                            fill-opacity="0.08" />
                                                                        <path opacity="1"
                                                                            d="M11.667 19.8333C11.667 19.4167 12.0837 19 12.5003 19C12.917 19 13.3337 19.4167 13.3337 19.8333C13.3337 20.1111 13.3337 21.5 13.3337 24C13.3337 24.9205 14.0799 25.6667 15.0003 25.6667H25.0003C25.9208 25.6667 26.667 24.9205 26.667 24V19.8333C26.667 19.3731 27.0401 19 27.5003 19C27.9606 19 28.3337 19.3731 28.3337 19.8333V24C28.3337 25.8409 26.8413 27.3333 25.0003 27.3333H15.0003C13.1594 27.3333 11.667 25.8409 11.667 24C11.667 21.5 11.667 20.1111 11.667 19.8333Z"
                                                                            fill="#FD5353" />
                                                                        <path opacity="1"
                                                                            d="M20.8337 11.5C20.8337 11.0398 20.4606 10.6667 20.0003 10.6667C19.5401 10.6667 19.167 11.0398 19.167 11.5V21.5C19.167 21.9602 19.5401 22.3333 20.0003 22.3333C20.4606 22.3333 20.8337 21.9602 20.8337 21.5V11.5Z"
                                                                            fill="#FD5353" />
                                                                        <path
                                                                            d="M20.0302 11.815L16.4226 15.4226C16.0972 15.748 15.5695 15.748 15.2441 15.4226C14.9186 15.0972 14.9186 14.5695 15.2441 14.2441L19.4107 10.0774C19.7241 9.76402 20.228 9.75077 20.5575 10.0473L24.7241 13.7973C25.0662 14.1051 25.094 14.6321 24.7861 14.9741C24.4782 15.3162 23.9513 15.344 23.6092 15.0361L20.0302 11.815Z"
                                                                            fill="#FD5353" />
                                                                    </svg>
                                                                </span>
                                                            </span>

                                                            @elseif($val->transaction_type == "VasData")
                                                            <span class="income">
                                                                <span class="me-2">
                                                                    <svg width="39" height="39" viewBox="0 0 39 39" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <rect width="39" height="39" rx="19.5" fill="#FF2E2E"
                                                                            fill-opacity="0.08" />
                                                                        <path opacity="1"
                                                                            d="M11.667 19.8333C11.667 19.4167 12.0837 19 12.5003 19C12.917 19 13.3337 19.4167 13.3337 19.8333C13.3337 20.1111 13.3337 21.5 13.3337 24C13.3337 24.9205 14.0799 25.6667 15.0003 25.6667H25.0003C25.9208 25.6667 26.667 24.9205 26.667 24V19.8333C26.667 19.3731 27.0401 19 27.5003 19C27.9606 19 28.3337 19.3731 28.3337 19.8333V24C28.3337 25.8409 26.8413 27.3333 25.0003 27.3333H15.0003C13.1594 27.3333 11.667 25.8409 11.667 24C11.667 21.5 11.667 20.1111 11.667 19.8333Z"
                                                                            fill="#FD5353" />
                                                                        <path opacity="1"
                                                                            d="M20.8337 11.5C20.8337 11.0398 20.4606 10.6667 20.0003 10.6667C19.5401 10.6667 19.167 11.0398 19.167 11.5V21.5C19.167 21.9602 19.5401 22.3333 20.0003 22.3333C20.4606 22.3333 20.8337 21.9602 20.8337 21.5V11.5Z"
                                                                            fill="#FD5353" />
                                                                        <path
                                                                            d="M20.0302 11.815L16.4226 15.4226C16.0972 15.748 15.5695 15.748 15.2441 15.4226C14.9186 15.0972 14.9186 14.5695 15.2441 14.2441L19.4107 10.0774C19.7241 9.76402 20.228 9.75077 20.5575 10.0473L24.7241 13.7973C25.0662 14.1051 25.094 14.6321 24.7861 14.9741C24.4782 15.3162 23.9513 15.344 23.6092 15.0361L20.0302 11.815Z"
                                                                            fill="#FD5353" />
                                                                    </svg>
                                                                </span>
                                                            </span>

                                                            @elseif($val->transaction_type == "VirtualFundWallet")
                                                            <span class="income">
                                                                <span class="me-2">
                                                                    <svg width="39" height="39" viewBox="0 0 39 39" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <rect x="39" y="39" width="39" height="39" rx="19.5"
                                                                            transform="rotate(-180 39 39)" fill="#2BC155"
                                                                            fill-opacity="0.11" />
                                                                        <path opacity="1"
                                                                            d="M11.667 19.8333C11.667 19.4167 12.0837 19 12.5003 19C12.917 19 13.3337 19.4167 13.3337 19.8333C13.3337 20.1111 13.3337 21.5 13.3337 24C13.3337 24.9205 14.0799 25.6667 15.0003 25.6667H25.0003C25.9208 25.6667 26.667 24.9205 26.667 24V19.8333C26.667 19.3731 27.0401 19 27.5003 19C27.9606 19 28.3337 19.3731 28.3337 19.8333V24C28.3337 25.8409 26.8413 27.3333 25.0003 27.3333H15.0003C13.1594 27.3333 11.667 25.8409 11.667 24C11.667 21.5 11.667 20.1111 11.667 19.8333Z"
                                                                            fill="#13C28F" />
                                                                        <path opacity="1"
                                                                            d="M19.1663 20.6667C19.1663 21.1269 19.5394 21.5 19.9997 21.5C20.4599 21.5 20.833 21.1269 20.833 20.6667V10.6667C20.833 10.2064 20.4599 9.83333 19.9997 9.83333C19.5394 9.83333 19.1663 10.2064 19.1663 10.6667V20.6667Z"
                                                                            fill="#13C28F" />
                                                                        <path
                                                                            d="M23.5774 16.7441C23.9028 16.4186 24.4305 16.4186 24.7559 16.7441C25.0814 17.0695 25.0814 17.5972 24.7559 17.9226L20.5893 22.0893C20.2759 22.4027 19.772 22.4159 19.4425 22.1194L15.2759 18.3694C14.9338 18.0615 14.906 17.5346 15.2139 17.1925C15.5218 16.8504 16.0487 16.8227 16.3908 17.1306L19.9698 20.3517L23.5774 16.7441Z"
                                                                            fill="#13C28F" />
                                                                    </svg>
                                                                </span>
                                                            </span>

                                                            @endif


														</div>



                                                        <div class="info-content">
															<span class="fs-16">Type</span>
                                                            @if($val->transaction_type == "Reversal")
                                                            <h4 class="">Reversal</h4>
                                                            </span>
                                                            @elseif($val->transaction_type == "CashOut")
                                                            <h4 class="">Cash Out</h4>

                                                            @elseif($val->transaction_type == "Purchase")
                                                            <h4 class="">Purchase</h4>
                                                            @elseif($val->transaction_type == "BankTransfer")
                                                            <span class="income">
                                                                <h4 class="">Bank Transfer</h4>
                                                            </span>
                                                            @elseif($val->transaction_type == "VasAirtime")
                                                            <h4 class="">Airtime</h4>
                                                            @elseif($val->transaction_type == "VasData")
                                                            <h4 class="">Data</h4>
                                                            @elseif($val->transaction_type == "VirtualFundWallet")
                                                            <h4 class="">Funding</h4>
                                                            @endif


                                                        </div>



													</div>
												</div>
											</div>
											<!----/column-- -->
											<!----column-- -->
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
												<div class="card info">
													<div class="card-body d-flex align-items-center p-3">
														<div class="info-icon pe-3 ">
															<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12 15.1739C16.3386 15.1739 20 15.8789 20 18.599C20 21.32 16.3146 22 12 22C7.66237 22 4 21.295 4 18.575C4 15.8539 7.68538 15.1739 12 15.1739ZM12 2C14.9391 2 17.294 4.35402 17.294 7.29105C17.294 10.2281 14.9391 12.5831 12 12.5831C9.0619 12.5831 6.70601 10.2281 6.70601 7.29105C6.70601 4.35402 9.0619 2 12 2Z" fill="#1DAAFF"/>
                                                                </svg>

														</div>
														<div class="info-content">
															<span class="fs-16">Beneficiary</span>
                                                            @if($val->transaction_type == "Reversal")
                                                            <h4 class="">{{ $val->sender_name ?? $val->receiver_name  }}</h4>
                                                            </span>
                                                            @elseif($val->transaction_type == "CashOut")
                                                            <h4 class="">{{ $val->sender_name ?? $val->receiver_name  }}</h4>
                                                            @elseif($val->transaction_type == "Purchase")
                                                            <h4 class="">{{ $val->sender_name ?? $val->receiver_name  }}</h4>
                                                            @elseif($val->transaction_type == "BankTransfer")
                                                                <h4 class="">{{ $val->sender_name ?? $val->receiver_name  }}</h4>
                                                            @elseif($val->transaction_type == "VasAirtime")
                                                            <h4 class="">{{ $val->sender_name ?? $val->receiver_name  }}</h4>
                                                            @elseif($val->transaction_type == "VasData")
                                                            <h4 class="">{{ $val->sender_name ?? $val->receiver_name  }}</h4>
                                                            @elseif($val->transaction_type == "VirtualFundWallet")
                                                            <h4 class="">{{ $val->sender_name ?? $val->receiver_name  }}</h4>
                                                            @endif
														</div>

													</div>
												</div>
											</div>



                                            @if($val->transaction_type == "BankTransfer")

                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
												<div class="card info">
													<div class="card-body d-flex align-items-center p-3">
														<div class="info-icon pe-3 ">
															<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1581 16.885H9.34306C8.92906 16.885 8.59306 16.549 8.59306 16.135C8.59306 15.721 8.92906 15.385 9.34306 15.385H15.1581C15.5721 15.385 15.9081 15.721 15.9081 16.135C15.9081 16.549 15.5721 16.885 15.1581 16.885ZM19.4991 6.158C19.1361 5.838 18.7231 5.476 18.2311 5.021C18.0081 4.841 17.7641 4.635 17.5051 4.417C16.0451 3.186 14.0451 1.5 12.2221 1.5C10.4201 1.5 8.54906 3.092 7.04606 4.371C6.76806 4.607 6.50806 4.829 6.24306 5.044C5.77706 5.476 5.36406 5.839 5.00006 6.16C2.61306 8.261 2.16406 8.812 2.16406 13.713C2.16406 22.5 4.70506 22.5 12.2501 22.5C19.7941 22.5 22.3361 22.5 22.3361 13.713C22.3361 8.811 21.8871 8.26 19.4991 6.158Z" fill="#1DAAFF"/>
                                                                </svg>
														</div>
														<div class="info-content">
															<span class="fs-16">Account Details</span>
															<h4 class="text-break">{{ $val->sender_bank ?? $val->receiver_bank ?? $val->sender_account_no ?? $val->receiver_account_no  }}</h4>
                                                            <span class="fs-16">Account No - {{ $val->sender_account_no ?? $val->receiver_account_no ??  $val->sender_bank ?? $val->receiver_bank  }}</span>

														</div>
													</div>
												</div>
											</div>

                                            @endif


                                            @if($val->transaction_type == "BankTransfer")

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
												<div class="card info">
													<div class="card-body d-flex align-items-center p-3">
														<div class="info-icon pe-3 ">
															<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1581 16.885H9.34306C8.92906 16.885 8.59306 16.549 8.59306 16.135C8.59306 15.721 8.92906 15.385 9.34306 15.385H15.1581C15.5721 15.385 15.9081 15.721 15.9081 16.135C15.9081 16.549 15.5721 16.885 15.1581 16.885ZM19.4991 6.158C19.1361 5.838 18.7231 5.476 18.2311 5.021C18.0081 4.841 17.7641 4.635 17.5051 4.417C16.0451 3.186 14.0451 1.5 12.2221 1.5C10.4201 1.5 8.54906 3.092 7.04606 4.371C6.76806 4.607 6.50806 4.829 6.24306 5.044C5.77706 5.476 5.36406 5.839 5.00006 6.16C2.61306 8.261 2.16406 8.812 2.16406 13.713C2.16406 22.5 4.70506 22.5 12.2501 22.5C19.7941 22.5 22.3361 22.5 22.3361 13.713C22.3361 8.811 21.8871 8.26 19.4991 6.158Z" fill="#1DAAFF"/>
                                                                </svg>
														</div>
														<div class="info-content">
															<span class="fs-16">Session ID</span>
															<h4 class="text-break">{{ $val->p_sessionId  }}</h4>

														</div>
													</div>
												</div>
											</div>

                                            @elseif($val->transaction_type == "VirtualFundWallet")

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
												<div class="card info">
													<div class="card-body d-flex align-items-center p-3">
														<div class="info-icon pe-3 ">
															<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M15.3131 4C15.2659 4.243 15.2423 4.49001 15.2428 4.73756C15.2428 6.95855 17.0459 8.75902 19.2702 8.75902C19.5151 8.75782 19.7594 8.73431 20 8.68878V16.6615C20 20.0156 18.0215 22 14.6624 22H7.34636C3.97851 22 2 20.0156 2 16.6615V9.3561C2 6.00195 3.97851 4 7.34636 4H15.3131ZM15.3167 10.0016C15.1211 10.0297 14.9453 10.1358 14.8295 10.2956L12.4201 13.3951L9.6766 11.2351C9.51997 11.1131 9.32071 11.0592 9.12381 11.0856C8.92691 11.1121 8.74898 11.2166 8.63019 11.3756L5.67562 15.1863C5.57177 15.3158 5.51586 15.4771 5.51734 15.6429L5.51994 15.7533C5.54858 16.0433 5.74748 16.2939 6.03238 16.3838C6.35288 16.485 6.70138 16.3573 6.88031 16.0732L9.35125 12.8771L12.0948 15.0283C12.2508 15.1541 12.4514 15.2111 12.6504 15.1863C12.8494 15.1615 13.0297 15.0569 13.15 14.8966L16.0078 11.2088V11.1912C16.2525 10.8625 16.1901 10.3989 15.8671 10.1463C15.7108 10.0257 15.5122 9.97346 15.3167 10.0016Z" fill="#1DAAFF"/>
                                                                <path opacity="0.4" d="M19.5 7C20.8807 7 22 5.88071 22 4.5C22 3.11929 20.8807 2 19.5 2C18.1193 2 17 3.11929 17 4.5C17 5.88071 18.1193 7 19.5 7Z" fill="#1DAAFF"/>
                                                                </svg>

														</div>
														<div class="info-content">
															<span class="fs-16">Session ID</span>
															<h4 class="text-break">{{ $val->p_sessionId  }}</h4>

														</div>
													</div>
												</div>
											</div>

                                            @endif

											<!----/column-- -->
											<!----column-- -->
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
												<div class="card info">
													<div class="card-body d-flex align-items-center p-3">
														<div class="info-icon pe-3 ">
															<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M17.208 0C21.276 0 24 2.856 24 7.104V16.9092C24 21.1452 21.276 24 17.208 24H6.804C2.736 24 0 21.1452 0 16.9092V7.104C0 2.856 2.736 0 6.804 0H17.208ZM11.988 10.1772C11.412 10.1772 10.944 10.656 10.944 11.2332V16.5372C10.944 17.1132 11.412 17.5812 11.988 17.5812C12.576 17.5812 13.044 17.1132 13.044 16.5372V11.2332C13.044 10.656 12.576 10.1772 11.988 10.1772ZM12.012 6.3732C11.424 6.3732 10.956 6.8412 10.956 7.4292C10.956 8.004 11.424 8.4732 11.988 8.4732C12.588 8.4732 13.056 8.004 13.056 7.4292C13.056 6.8412 12.588 6.3732 12.012 6.3732Z" fill="#1DAAFF"/>
                                                                </svg>

														</div>
														<div class="info-content">
															<span class="fs-16">Note</span>
															<h4 class="text-break">{{ $val->note }}</h4>
														</div>
													</div>
												</div>
											</div>
											<!----/column-- -->
										</div>
                                        <div class="d-flex w-100 justify-content-between  flex-wrap pyment-card">

                                            <div class="pe-4 py-2 py-sm-0">
                                                <span class="fs-16">Status</span>
                                                <br>
                                                    @if($val->status==2)
                                                    <h4 class="text-danger">Failed</h4>
                                                    @elseif($val->status==1)
                                                    <h4 class=" text-success">Successful</h4>
                                                    @elseif($val->status==0)
                                                    <h4 class=" text-warning">Pending</h4>
                                                    @elseif($val->status==4)
                                                    <span class=" text-white">Refunded</span>
                                                    @endif
                                            </div>


                                            <div class="pe-4 py-2 py-sm-0">
                                                <span class="fs-16">Date</span>
                                                <h4 class="mb-0">{{date('F j, Y', strtotime($val->created_at))}}</h4>
                                            </div>

                                            <div class="pe-4 py-2 py-sm-0">
                                                <span class="fs-16">Time</span>
                                                <h4 class="mb-0">{{date("h:i:A", strtotime($val->created_at))}}</h4>
                                            </div>

                                        </div>
									</div>

								</div>
							</div>
							<!----/column-- -->
							<!----column-- -->
							<div class="col-xl-6">

                                @if($val->transaction_type == "BankTransfer" && $val->status == 2)

                                <div class="col-xl-12 col-lg-12 col-sm-12">
                                    <div class="card overflow-hidden">
                                        <div class="text-center p-5 overlay-box" style="background: rgb(255 255 255); opacity:2;">
                                            <img src="{{url('')}}/asset/img/success.gif" width="200" height="150"  alt="">
                                            <h3 class="mt-3 mb-0 text-primary">Congratulations</h3>
                                            <p class="mt-2 mb-0 text-small text-dark">You earned NGN 1 Bonus on this transaction</p>

                                        </div>

                                        <div class="card-body">
                                            <div class="row text-center">
                                                    <div class="bgl-primary rounded p-3">
                                                        <h4 class="mb-0">Bonus Balance</h4>
                                                        <h5>NGN{{ number_format(Auth::user()->bonus_wallet, 2) }}</h5>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="card-footer mt-0">
                                            <a herf="#" class="btn btn-primary btn-lg btn-block">Withdraw Bonus</a>
                                        </div>
                                    </div>
                                </div>

                                @elseif($val->transaction_type == "BankTransfer" && $val->status == 0)
                                <div class="col-xl-12 col-lg-12 col-sm-12">
                                    <div class="card overflow-hidden">
                                        <div class="text-center p-5 overlay2-box" style="background: rgb(229 239 241); opacity:2;">
                                            <img src="{{url('')}}/asset/img/pending.gif" width="150" height="150"  alt="">
                                            <h3 class="mt-3 mb-0 text-primary">Transaction in Progress</h3>
                                            <p class="mt-2 mb-0 text-small text-dark">Click Check Status to update transaction status</p>

                                        </div>

                                        
                                        <div class="card-footer mt-0">
                                            <a herf="#" class="btn btn-warning btn-lg btn-block">Check Status</a>
                                        </div>
                                    </div>
                                </div>


                                @endif


                                <!-- --row-- -->
								{{-- <div class="row">
                                    <!----column-- -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="card  wallet blue">
											<div class="boxs">
												<span class="box one"></span>
												<span class="box two"></span>
												<span class="box three"></span>
												<span class="box four"></span>
											</div>
                                            <div class="card-header border-0">
                                                <div class="wallet-info">
                                                    <span class="font-w400 d-block">Main Balance</span>
                                                    <h4 class="fs-24 font-w600 mb-0 d-inline-flex me-2">$824,571.93</h4>
                                                </div>
                                                <div class="wallet-icon">
                                                    <svg width="62" height="39" viewBox="0 0 62 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="42.7722" cy="19.2278" r="19.2278" fill="white" fill-opacity="0.2"/>
                                                        <circle cx="19.2278" cy="19.2278" r="19.2278" fill="white" fill-opacity="0.2"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="card-body d-flex align-items-center flex-wrap py-3">
                                                <div class="value-data p-0 me-3">
                                                    <span class="fs-14 font-w400 ">VALID THRU</span>
                                                    <span class="value fs-16 "><span class="text-black pe-2 "></span>08/21</span>
                                                </div>
                                                <div class="value-data p-0 me-3">
                                                    <span class="fs-14 font-w400 ">CARD HOLDER</span>
                                                    <span class="value fs-16"><span class="text-black pe-2 "></span>Adam Jackson</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!----/column-- -->
                                    <!----column-- -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="card  wallet org">
											<div class="boxs">
												<span class="box one"></span>
												<span class="box two"></span>
												<span class="box three"></span>
												<span class="box four"></span>
											</div>
                                            <div class="card-header border-0">
                                                <div class="wallet-info">
                                                    <span class="font-w400 d-block">Main Balance</span>
                                                    <h4 class="fs-24 font-w600 mb-0 d-inline-flex me-2">$523.56</h4>
                                                </div>
                                                <div class="wallet-icon">
                                                    <svg width="62" height="39" viewBox="0 0 62 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="42.7722" cy="19.2278" r="19.2278" fill="white" fill-opacity="0.2"/>
                                                        <circle cx="19.2278" cy="19.2278" r="19.2278" fill="white" fill-opacity="0.2"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="card-body d-flex align-items-center flex-wrap py-3">
                                                <div class="value-data px-2">
                                                    <span class="fs-14 font-w400 ">VALID THRU</span>
                                                    <span class="value fs-16 "><span class="text-black pe-2 "></span>08/21</span>
                                                </div>
                                                <div class="value-data px-2">
                                                    <span class="fs-14 font-w400 ">CARD HOLDER</span>
                                                    <span class="value fs-16"><span class="text-black pe-2 "></span>Adam Jackson</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!----/column-- -->
                                </div> --}}
                                <!-- --/row-- -->
                                <!----column-- -->
                                {{-- <div class="col-xl-12 ">
                                    <div class="card">
                                        <div class="card-body d-flex justify-content-between p-4">
                                            <div class="specifics-info">
                                                <h4 class="fs-18">Specifics</h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur</p>
                                                <span class="fs-16">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tem</span>
                                            </div>
                                            <div class="d-inline-block position-relative donut-chart-sale two">
                                                <div id="pieChart1"></div>
                                                <small>35%</small>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between align-items-center flex-wrap px-4 py-4 py-sm-5">
                                            <div class="position-relative ps-4 stick">
                                                <div class="side-stick one"></div>
                                                <h4 class="mb-0">63,876</h4>
                                                <span>Property Sold</span>
                                            </div>
                                            <div  class="position-relative ps-4 stick">
                                                <div class="side-stick two"></div>
                                                <h4 class="mb-0">$97,125</h4>
                                                <span>Income</span>
                                            </div>
                                            <div  class="position-relative ps-4 stick">
                                                <div class="side-stick three"></div>
                                                <h4 class="mb-0">$872,335</h4>
                                                <span>Expense</span>
                                            </div>
                                            <div class="position-relative ps-4 stick">
                                                <div class="side-stick four"></div>
                                                <h4 class="mb-0">21,224</h4>
                                                <span>Property Rented</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <!----/column-- -->

							</div>
							<!----/column-- -->
						</div>
						<!-- --/row-- -->
					<!--/column-->
					</div>
							<!--column-->
				{{-- <div class="col-xl-12">

					<div class="row">
						<!--column-->
						<div class="col-xl-3">
							<div class="card py-2 pia-chart">
                                <div class="card-header border-0 pb-0 flex-wrap">
                                    <div>
                                        <h5 class="fs-18 font-w700">Pie Chart</h5>
                                    </div>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" class="btn-link btn sharp tp-btn-light btn-primary" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.33319 9.99985C8.33319 10.9203 9.07938 11.6665 9.99986 11.6665C10.9203 11.6665 11.6665 10.9203 11.6665 9.99986C11.6665 9.07938 10.9203 8.33319 9.99986 8.33319C9.07938 8.33319 8.33319 9.07938 8.33319 9.99985Z" fill="#B9A8FF"/>
                                        <path d="M8.33319 3.33329C8.33319 4.25376 9.07938 4.99995 9.99986 4.99995C10.9203 4.99995 11.6665 4.25376 11.6665 3.33329C11.6665 2.41282 10.9203 1.66663 9.99986 1.66663C9.07938 1.66663 8.33319 2.41282 8.33319 3.33329Z" fill="#B9A8FF"/>
                                        <path d="M8.33319 16.6667C8.33319 17.5871 9.07938 18.3333 9.99986 18.3333C10.9203 18.3333 11.6665 17.5871 11.6665 16.6667C11.6665 15.7462 10.9203 15 9.99986 15C9.07938 15 8.33319 15.7462 8.33319 16.6667Z" fill="#B9A8FF"/>
                                        </svg>

                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body d-flex justify-content-center align-items-center py-2">
                                    <div id="pieChart2"></div>
                                </div>
                                <div class=" d-flex justify-content-center flex-wrap color-tag">
                                    <span class="application d-flex align-items-center">
                                        <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">
                                          <rect width="13" height="13" rx="6.5" fill="#DD3CFF"></rect>
                                        </svg>
                                        Pink
                                    </span>
                                    <span class="application d-flex align-items-center">
                                        <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">
                                          <rect width="13" height="13" rx="6.5" fill="#FFE27A"></rect>
                                        </svg>
                                        Yellow
                                    </span>
                                    <span class="application d-flex align-items-center">
                                        <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">
                                          <rect width="13" height="13" rx="6.5" fill="#53CAFD"></rect>
                                        </svg>
                                        Blue
                                    </span>
                                </div>
                            </div>
						</div>
						<!--/column-->
                        <!--column-->
                        <div class="col-xl-9">
                            <div class="card">
                                <div class="card-header d-sm-flex d-block border-0">
                                    <div class="mr-auto pr-3">
                                        <h4 class="font-w700">Chart Activity</h4>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap">
										<div class="d-flex align-items-center me-3">
											<span class="fs-16 me-2"> Spendings</span>
											<label class="switch">
												<input type="checkbox">
												<span class="slider round"></span>
											</label>
										</div>
										<div class="d-flex align-items-center me-3">
											<span class="fs-16 me-2"> Income</span>
											<label class="switch">
												<input type="checkbox">
												<span class="slider round"></span>
											</label>
										</div>
										<div class="d-flex align-items-center me-4">
											<span class="fs-16 me-2"> Others</span>
											<label class="switch">
												<input type="checkbox">
												<span class="slider round"></span>
											</label>
										</div>
                                        <select class="default-select dashboard-select">
                                          <option data-display="This Month">This Month</option>
                                          <option value="2">This Weekly</option>
                                           <option value="2">This Day</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body py-0 custome-tooltip">
                                    <div id="areaChart" class="area-theme"></div>
                                </div>
                            </div>
                        </div>
                        <!--/column-->
					</div>
					<!-- --/row-- -->
				</div> --}}
				<!----/column-- -->
			<!--/row-->
			</div>
			<!--/row-->


            </div>






    @stop
