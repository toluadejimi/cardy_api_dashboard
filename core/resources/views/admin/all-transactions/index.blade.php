@extends('master')
@section('content')


<!--**********************************
        Content body start
    ***********************************-->
<div class="content-body">
    <div class="container-fluid">

        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <div class="card-heading">

                        <h4>Search Transaction</h4>

                    </div>


                    <form action="{{ route('admin.search-transactions') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-3">
                                <label for="from">Date From</label>
                                <input type="date"  placeholder="@php echo date('Y-m-d'); @endphp" class="form-control"
                                    name="from">
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-3">
                                <label for="from">Date To</label>
                                <input type="date" class="form-control"  name="to" placeholder="Date To">
                            </div>

                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-3">
                                <label for="from">Transaction Type</label>
                                <select name="trx_type" class="form-control">
                                    <option value="">Any</option>
                                    <option value="VasAirtime">Airtime</option>
                                    <option value="VasData">Data</option>
                                    <option value="VasCable">Cable</option>
                                    <option value="BankTransfer">Bank Tranfer</option>
                                    <option value="VirtualFundWallet">Funding</option>
                                    <option value="Reversal">Reversal</option>
                                    <option value="POS Transasction">Cash Out</option>
                                </select>
                            </div>


                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-3">
                                <label for="from">Status</label>
                                <select name="status" class="form-control">
                                    <option value="">Any</option>
                                    <option value="0">Pending</option>
                                    <option value="2">Successful</option>
                                    <option value="3">Reversed</option>
                                    <option value="4">Failed</option>

                                </select>
                            </div>

                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-3">
                                <label for="from">Transaction Refrence</label>
                                <input type="text" class="form-control" name="ref_trans_id"
                                    placeholder="Enter Refrence">
                            </div>


                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-3">
                                <label for="from">Session ID</label>
                                <input type="text" class="form-control" name="session_id"
                                    placeholder="Enter session ID">
                            </div>




                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.7666 20.7552C16.7309 20.7552 20.7552 16.7308 20.7552 11.7666C20.7552 6.80236 16.7309 2.77805 11.7666 2.77805C6.80239 2.77805 2.77808 6.80236 2.77808 11.7666C2.77808 16.7308 6.80239 20.7552 11.7666 20.7552Z"
                                            stroke="#EFE8E8" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M18.0183 18.4851L21.5423 22" stroke="#EFE8E8" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>


                                    Search</button>
                            </div>
                        </div>




                    </form>

                </div>
            </div>



        </div>

        <div class="col-12">

            <div class="row">

                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12">
                    <ul class="nav nav-pills mb-4 light">
                        <li class=" nav-item">
                            <a href="#navpills-1" class="nav-link active" data-bs-toggle="tab" aria-expanded="false">All
                                Transactions</a>
                        </li>
                        <li class="nav-item">
                            <a href="#navpills-2" class="nav-link" data-bs-toggle="tab" aria-expanded="false">Bank
                                Transfer</a>
                        </li>
                        <li class="nav-item">
                            <a href="#navpills-3" class="nav-link" data-bs-toggle="tab" aria-expanded="true">Bills
                                Payment</a>
                        </li>

                        <li class="nav-item">
                            <a href="#navpills-4" class="nav-link" data-bs-toggle="tab" aria-expanded="true">Web
                                Payment</a>
                        </li>

                        <li class="nav-item">
                            <a href="#navpills-5" class="nav-link" data-bs-toggle="tab" aria-expanded="true">
                                Reversal</a>
                        </li>

                        <li class="nav-item">
                            <a href="#navpills-6" class="nav-link" data-bs-toggle="tab" aria-expanded="true">
                                Cashout</a>
                        </li>


                    </ul>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">

                        <a href="/export" class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                            Export to Excel</a>

                            <div class="modal fade" id="exampleModalCenter">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Export to Excel</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>


                                        <form action="/export-transaction-excel" method="POST">
                                            @csrf

                                        <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-6 mb-3">
                                                        <label for="from">Date From</label>
                                                        <input type="date" value="{{ $date_from ?? "From Date" }}" class="form-control"
                                                            name="from">
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <label for="from">Date To</label>
                                                        <input type="date" class="form-control" name="to" value=" ">
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-6 mb-3">

                                                        <label for="from">Transaction Type</label>
                                                        <select name="trx_type" class="form-control">
                                                            <option value="">Any</option>
                                                            <option value="VasAirtime">Airtime</option>
                                                            <option value="VasData">Data</option>
                                                            <option value="VasCable">Cable</option>
                                                            <option value="BankTransfer">Bank Tranfer</option>
                                                            <option value="VirtualFundWallet">Funding</option>
                                                            <option value="Reversal">Reversal</option>
                                                            <option value="POS Transasction">Cash Out</option>

                                                        </select>
                                                    </div>


                                                    <div class="col-6 mb-3">
                                                        <label for="from">Status</label>
                                                        <select name="status" class="form-control">
                                                            <option value="">Any</option>
                                                            <option value="0">Pending</option>
                                                            <option value="2">Successful</option>
                                                            <option value="3">Reversed</option>
                                                            <option value="4">Failed</option>

                                                        </select>
                                                    </div>
                                                </div>




                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger light btn-sm" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-success btn-sm">Export Transaction</button>
                                        </div>

                                    </form>

                                    </div>
                                </div>
                            </div>


                </div>

            </div>










        </div>


        <div class="row p-2">

            <div class="tab-content">
                <div id="navpills-1" class="tab-pane active">

                    <div class="card">
                        <div class="col-lg-12">
                            <div class="card-body">
                                {{__('All Transactions')}}</h5>
                                <div class="table-responsive py-4">
                                    <table
                                        class="table-responsive-lg table display mb-4 dataTablesCard order-table card-table text-black dataTable no-footer student-tbl"
                                        id="example5">
                                        <thead>
                                            <tr>
                                                <th>{{__('Action')}}</th>
                                                <th>{{__('Reference ID')}}</th>
                                                <th>{{__('Date Time')}}</th>
                                                <th>{{__('Debit')}}</th>
                                                <th>{{__('Credit')}}</th>
                                                <th>{{__('Type')}}</th>
                                                <th>{{__('Status')}}</th>
                                                <th>{{__('Beneficiary Details')}}</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($all as $k=>$val)
                                            <tr>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);"
                                                            class="btn-link btn sharp tp-btn-light btn-primary pill"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.33319 9.99985C8.33319 10.9203 9.07938 11.6665 9.99986 11.6665C10.9203 11.6665 11.6665 10.9203 11.6665 9.99986C11.6665 9.07938 10.9203 8.33319 9.99986 8.33319C9.07938 8.33319 8.33319 9.07938 8.33319 9.99985Z"
                                                                    fill="#ffffff" />
                                                                <path
                                                                    d="M8.33319 3.33329C8.33319 4.25376 9.07938 4.99995 9.99986 4.99995C10.9203 4.99995 11.6665 4.25376 11.6665 3.33329C11.6665 2.41282 10.9203 1.66663 9.99986 1.66663C9.07938 1.66663 8.33319 2.41282 8.33319 3.33329Z"
                                                                    fill="#ffffff" />
                                                                <path
                                                                    d="M8.33319 16.6667C8.33319 17.5871 9.07938 18.3333 9.99986 18.3333C10.9203 18.3333 11.6665 17.5871 11.6665 16.6667C11.6665 15.7462 10.9203 15 9.99986 15C9.07938 15 8.33319 15.7462 8.33319 16.6667Z"
                                                                    fill="#ffffff" />
                                                            </svg>

                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item"
                                                                href="view-transaction?id={{$val->id}};"><svg
                                                                    width="20" height="20" viewBox="0 0 20 20"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.4"
                                                                        d="M18.3337 9.99984C18.3337 14.6032 14.6028 18.3332 10.0003 18.3332C5.39783 18.3332 1.66699 14.6032 1.66699 9.99984C1.66699 5.39817 5.39783 1.6665 10.0003 1.6665C14.6028 1.6665 18.3337 5.39817 18.3337 9.99984Z"
                                                                        fill="#FF9F00" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M10.7249 10.5256C10.7249 10.9272 10.3974 11.2547 9.99577 11.2547C9.5941 11.2547 9.2666 10.9272 9.2666 10.5256V6.84225C9.2666 6.44058 9.5941 6.11308 9.99577 6.11308C10.3974 6.11308 10.7249 6.44058 10.7249 6.84225V10.5256ZM9.27077 13.1696C9.27077 12.7679 9.5966 12.4404 9.99577 12.4404C10.4066 12.4404 10.7333 12.7679 10.7333 13.1696C10.7333 13.5712 10.4066 13.8987 10.0041 13.8987C9.59993 13.8987 9.27077 13.5712 9.27077 13.1696Z"
                                                                        fill="#FF9F00" />
                                                                </svg>
                                                                View Details</a>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="my-3">{{$val->ref_trans_id}}</td>
                                                <td>{{date("d/m/Y h:i:A", strtotime($val->created_at))}}</td>
                                                <td>₦{{number_format($val->debit, 2)}}</td>
                                                <td>₦{{number_format($val->credit, 2)}}</td>
                                                <td>
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
                                                        Reveresal
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
                                                        Cash Out
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
                                                        Purchase
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
                                                        Transfer
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
                                                        Airtime
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
                                                        Data
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
                                                        Funding
                                                    </span>

                                                    @endif
                                                </td>

                                                <td>
                                                    @if($val->status==2)
                                                    <span class=" btn btn-outline-danger btn-xs">Failed</span>
                                                    @elseif($val->status==1)
                                                    <span class=" btn btn-outline-success btn-xs">Successful</span>
                                                    @elseif($val->status==0)
                                                    <span class=" btn btn-outline-warning btn-xs">Pending</span>
                                                    @elseif($val->status==3)
                                                    <span class=" btn btn-outline-primary btn-xs">Refunded</span>
                                                    @endif
                                                </td>
                                                <td>{{$val->sender_name ?? " No Details" }}</td>


                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>


                <div id="navpills-2" class="tab-pane">


                    <div class="card">
                        <div class="col-lg-12">
                            <div class="card-body">
                                {{__('Bank Transfer')}}</h5>
                                <div class="table-responsive py-4">
                                    <table
                                        class="table-responsive-lg table display mb-4 dataTablesCard order-table card-table text-black dataTable no-footer student-tbl"
                                        id="example51">
                                        <thead>
                                            <tr>
                                                <th>{{__('Action')}}</th>
                                                <th>{{__('Reference ID')}}</th>
                                                <th>{{__('Date Time')}}</th>
                                                <th>{{__('Debit')}}</th>
                                                <th>{{__('Credit')}}</th>
                                                <th>{{__('Type')}}</th>
                                                <th>{{__('Status')}}</th>
                                                <th>{{__('Beneficiary Details')}}</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($bank_transfer as $k=>$val)
                                            <tr>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);"
                                                            class="btn-link btn sharp tp-btn-light btn-primary pill"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.33319 9.99985C8.33319 10.9203 9.07938 11.6665 9.99986 11.6665C10.9203 11.6665 11.6665 10.9203 11.6665 9.99986C11.6665 9.07938 10.9203 8.33319 9.99986 8.33319C9.07938 8.33319 8.33319 9.07938 8.33319 9.99985Z"
                                                                    fill="#ffffff" />
                                                                <path
                                                                    d="M8.33319 3.33329C8.33319 4.25376 9.07938 4.99995 9.99986 4.99995C10.9203 4.99995 11.6665 4.25376 11.6665 3.33329C11.6665 2.41282 10.9203 1.66663 9.99986 1.66663C9.07938 1.66663 8.33319 2.41282 8.33319 3.33329Z"
                                                                    fill="#ffffff" />
                                                                <path
                                                                    d="M8.33319 16.6667C8.33319 17.5871 9.07938 18.3333 9.99986 18.3333C10.9203 18.3333 11.6665 17.5871 11.6665 16.6667C11.6665 15.7462 10.9203 15 9.99986 15C9.07938 15 8.33319 15.7462 8.33319 16.6667Z"
                                                                    fill="#ffffff" />
                                                            </svg>

                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item"
                                                                href="view-transaction?id={{$val->id}};"><svg
                                                                    width="20" height="20" viewBox="0 0 20 20"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.4"
                                                                        d="M18.3337 9.99984C18.3337 14.6032 14.6028 18.3332 10.0003 18.3332C5.39783 18.3332 1.66699 14.6032 1.66699 9.99984C1.66699 5.39817 5.39783 1.6665 10.0003 1.6665C14.6028 1.6665 18.3337 5.39817 18.3337 9.99984Z"
                                                                        fill="#FF9F00" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M10.7249 10.5256C10.7249 10.9272 10.3974 11.2547 9.99577 11.2547C9.5941 11.2547 9.2666 10.9272 9.2666 10.5256V6.84225C9.2666 6.44058 9.5941 6.11308 9.99577 6.11308C10.3974 6.11308 10.7249 6.44058 10.7249 6.84225V10.5256ZM9.27077 13.1696C9.27077 12.7679 9.5966 12.4404 9.99577 12.4404C10.4066 12.4404 10.7333 12.7679 10.7333 13.1696C10.7333 13.5712 10.4066 13.8987 10.0041 13.8987C9.59993 13.8987 9.27077 13.5712 9.27077 13.1696Z"
                                                                        fill="#FF9F00" />
                                                                </svg>
                                                                View Details</a>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="my-3">{{$val->ref_trans_id}}</td>
                                                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                                <td>₦{{number_format($val->debit, 2)}}</td>
                                                <td>₦{{number_format($val->credit, 2)}}</td>
                                                <td>
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
                                                        Reveresal
                                                    </span>

                                                    @elseif($val->transaction_type == "Bank Transfer")
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
                                                        Transfer
                                                    </span>

                                                    @elseif($val->transaction_type == "VAS")
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
                                                        VAS
                                                    </span>

                                                    @elseif($val->transaction_type == "Wallet Funding")
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
                                                        Funding
                                                    </span>

                                                    @endif
                                                </td>

                                                <td>
                                                    @if($val->status==2)
                                                    <span class=" btn btn-outline-danger btn-xs">Failed</span>
                                                    @elseif($val->status==1)
                                                    <span class=" btn btn-outline-success btn-xs">Successful</span>
                                                    @elseif($val->status==4)
                                                    <span class=" btn btn-outline-white btn-xs">Refunded</span>
                                                    @endif
                                                </td>
                                                <td>{{$val->sender_name ?? " No Details" }}</td>


                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>



                </div>



                <div id="navpills-3" class="tab-pane">



                    <div class="card">
                        <div class="col-lg-12">
                            <div class="card-body">
                                {{__('Bill Payment')}}</h5>
                                <div class="table-responsive py-4">
                                    <table
                                        class="table-responsive-lg table display mb-4 dataTablesCard order-table card-table text-black dataTable no-footer student-tbl"
                                        id="example52">
                                        <thead>
                                            <tr>
                                                <th>{{__('Action')}}</th>
                                                <th>{{__('Reference ID')}}</th>
                                                <th>{{__('Date Time')}}</th>
                                                <th>{{__('Debit')}}</th>
                                                <th>{{__('Credit')}}</th>
                                                <th>{{__('Type')}}</th>
                                                <th>{{__('Status')}}</th>
                                                <th>{{__('Beneficiary Details')}}</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($bill_payment as $k=>$val)
                                            <tr>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);"
                                                            class="btn-link btn sharp tp-btn-light btn-primary pill"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.33319 9.99985C8.33319 10.9203 9.07938 11.6665 9.99986 11.6665C10.9203 11.6665 11.6665 10.9203 11.6665 9.99986C11.6665 9.07938 10.9203 8.33319 9.99986 8.33319C9.07938 8.33319 8.33319 9.07938 8.33319 9.99985Z"
                                                                    fill="#ffffff" />
                                                                <path
                                                                    d="M8.33319 3.33329C8.33319 4.25376 9.07938 4.99995 9.99986 4.99995C10.9203 4.99995 11.6665 4.25376 11.6665 3.33329C11.6665 2.41282 10.9203 1.66663 9.99986 1.66663C9.07938 1.66663 8.33319 2.41282 8.33319 3.33329Z"
                                                                    fill="#ffffff" />
                                                                <path
                                                                    d="M8.33319 16.6667C8.33319 17.5871 9.07938 18.3333 9.99986 18.3333C10.9203 18.3333 11.6665 17.5871 11.6665 16.6667C11.6665 15.7462 10.9203 15 9.99986 15C9.07938 15 8.33319 15.7462 8.33319 16.6667Z"
                                                                    fill="#ffffff" />
                                                            </svg>

                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item"
                                                                href="view-transaction?id={{$val->id}};"><svg
                                                                    width="20" height="20" viewBox="0 0 20 20"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.4"
                                                                        d="M18.3337 9.99984C18.3337 14.6032 14.6028 18.3332 10.0003 18.3332C5.39783 18.3332 1.66699 14.6032 1.66699 9.99984C1.66699 5.39817 5.39783 1.6665 10.0003 1.6665C14.6028 1.6665 18.3337 5.39817 18.3337 9.99984Z"
                                                                        fill="#FF9F00" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M10.7249 10.5256C10.7249 10.9272 10.3974 11.2547 9.99577 11.2547C9.5941 11.2547 9.2666 10.9272 9.2666 10.5256V6.84225C9.2666 6.44058 9.5941 6.11308 9.99577 6.11308C10.3974 6.11308 10.7249 6.44058 10.7249 6.84225V10.5256ZM9.27077 13.1696C9.27077 12.7679 9.5966 12.4404 9.99577 12.4404C10.4066 12.4404 10.7333 12.7679 10.7333 13.1696C10.7333 13.5712 10.4066 13.8987 10.0041 13.8987C9.59993 13.8987 9.27077 13.5712 9.27077 13.1696Z"
                                                                        fill="#FF9F00" />
                                                                </svg>
                                                                View Details</a>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="my-3">{{$val->ref_trans_id}}</td>
                                                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                                <td>₦{{number_format($val->debit, 2)}}</td>
                                                <td>₦{{number_format($val->credit, 2)}}</td>
                                                <td>
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
                                                        Reveresal
                                                    </span>

                                                    @elseif($val->transaction_type == "Bank Transfer")
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
                                                        Transfer
                                                    </span>

                                                    @elseif($val->transaction_type == "VAS")
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
                                                        VAS
                                                    </span>

                                                    @elseif($val->transaction_type == "Wallet Funding")
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
                                                        Funding
                                                    </span>

                                                    @endif
                                                </td>

                                                <td>
                                                    @if($val->status==2)
                                                    <span class=" btn btn-outline-danger btn-xs">Failed</span>
                                                    @elseif($val->status==1)
                                                    <span class=" btn btn-outline-success btn-xs">Successful</span>
                                                    @elseif($val->status==4)
                                                    <span class=" btn btn-outline-white btn-xs">Refunded</span>
                                                    @endif
                                                </td>
                                                <td>{{$val->sender_name ?? " No Details" }}</td>


                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>



                </div>


                <div id="navpills-4" class="tab-pane">

                    <div class="card">
                        <div class="col-lg-12">
                            <div class="card-body">
                                {{__('Web Payment')}}</h5>
                                <div class="table-responsive py-4">
                                    <table
                                        class="table-responsive-lg table display mb-4 dataTablesCard order-table card-table text-black dataTable no-footer student-tbl"
                                        id="example53">
                                        <thead>
                                            <tr>
                                                <th>{{__('Action')}}</th>
                                                <th>{{__('Reference ID')}}</th>
                                                <th>{{__('Date Time')}}</th>
                                                <th>{{__('Debit')}}</th>
                                                <th>{{__('Credit')}}</th>
                                                <th>{{__('Type')}}</th>
                                                <th>{{__('Status')}}</th>
                                                <th>{{__('Beneficiary Details')}}</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($web_pay as $k=>$val)
                                            <tr>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);"
                                                            class="btn-link btn sharp tp-btn-light btn-primary pill"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.33319 9.99985C8.33319 10.9203 9.07938 11.6665 9.99986 11.6665C10.9203 11.6665 11.6665 10.9203 11.6665 9.99986C11.6665 9.07938 10.9203 8.33319 9.99986 8.33319C9.07938 8.33319 8.33319 9.07938 8.33319 9.99985Z"
                                                                    fill="#ffffff" />
                                                                <path
                                                                    d="M8.33319 3.33329C8.33319 4.25376 9.07938 4.99995 9.99986 4.99995C10.9203 4.99995 11.6665 4.25376 11.6665 3.33329C11.6665 2.41282 10.9203 1.66663 9.99986 1.66663C9.07938 1.66663 8.33319 2.41282 8.33319 3.33329Z"
                                                                    fill="#ffffff" />
                                                                <path
                                                                    d="M8.33319 16.6667C8.33319 17.5871 9.07938 18.3333 9.99986 18.3333C10.9203 18.3333 11.6665 17.5871 11.6665 16.6667C11.6665 15.7462 10.9203 15 9.99986 15C9.07938 15 8.33319 15.7462 8.33319 16.6667Z"
                                                                    fill="#ffffff" />
                                                            </svg>

                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item"
                                                                href="view-transaction?id={{$val->id}};"><svg
                                                                    width="20" height="20" viewBox="0 0 20 20"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.4"
                                                                        d="M18.3337 9.99984C18.3337 14.6032 14.6028 18.3332 10.0003 18.3332C5.39783 18.3332 1.66699 14.6032 1.66699 9.99984C1.66699 5.39817 5.39783 1.6665 10.0003 1.6665C14.6028 1.6665 18.3337 5.39817 18.3337 9.99984Z"
                                                                        fill="#FF9F00" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M10.7249 10.5256C10.7249 10.9272 10.3974 11.2547 9.99577 11.2547C9.5941 11.2547 9.2666 10.9272 9.2666 10.5256V6.84225C9.2666 6.44058 9.5941 6.11308 9.99577 6.11308C10.3974 6.11308 10.7249 6.44058 10.7249 6.84225V10.5256ZM9.27077 13.1696C9.27077 12.7679 9.5966 12.4404 9.99577 12.4404C10.4066 12.4404 10.7333 12.7679 10.7333 13.1696C10.7333 13.5712 10.4066 13.8987 10.0041 13.8987C9.59993 13.8987 9.27077 13.5712 9.27077 13.1696Z"
                                                                        fill="#FF9F00" />
                                                                </svg>
                                                                View Details</a>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="my-3">{{$val->ref_trans_id}}</td>
                                                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                                <td>₦{{number_format($val->debit, 2)}}</td>
                                                <td>₦{{number_format($val->credit, 2)}}</td>
                                                <td>
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
                                                        Reveresal
                                                    </span>

                                                    @elseif($val->transaction_type == "Bank Transfer")
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
                                                        Transfer
                                                    </span>

                                                    @elseif($val->transaction_type == "VAS")
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
                                                        VAS
                                                    </span>

                                                    @elseif($val->transaction_type == "Wallet Funding")
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
                                                        Funding
                                                    </span>

                                                    @endif
                                                </td>

                                                <td>
                                                    @if($val->status==2)
                                                    <span class=" btn btn-outline-danger btn-xs">Failed</span>
                                                    @elseif($val->status==1)
                                                    <span class=" btn btn-outline-success btn-xs">Successful</span>
                                                    @elseif($val->status==4)
                                                    <span class=" btn btn-outline-white btn-xs">Refunded</span>
                                                    @endif
                                                </td>
                                                <td>{{$val->sender_name ?? " No Details" }}</td>


                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>



                </div>



                <div id="navpills-5" class="tab-pane">



                    <div class="card">
                        <div class="col-lg-12">
                            <div class="card-body">
                                {{__('Reversal')}}</h5>
                                <div class="table-responsive py-4">
                                    <table
                                        class="table-responsive-lg table display mb-4 dataTablesCard order-table card-table text-black dataTable no-footer student-tbl"
                                        id="example54">
                                        <thead>
                                            <tr>
                                                <th>{{__('Action')}}</th>
                                                <th>{{__('Reference ID')}}</th>
                                                <th>{{__('Date Time')}}</th>
                                                <th>{{__('Debit')}}</th>
                                                <th>{{__('Credit')}}</th>
                                                <th>{{__('Type')}}</th>
                                                <th>{{__('Status')}}</th>
                                                <th>{{__('Beneficiary Details')}}</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($reversal as $k=>$val)
                                            <tr>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);"
                                                            class="btn-link btn sharp tp-btn-light btn-primary pill"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.33319 9.99985C8.33319 10.9203 9.07938 11.6665 9.99986 11.6665C10.9203 11.6665 11.6665 10.9203 11.6665 9.99986C11.6665 9.07938 10.9203 8.33319 9.99986 8.33319C9.07938 8.33319 8.33319 9.07938 8.33319 9.99985Z"
                                                                    fill="#ffffff" />
                                                                <path
                                                                    d="M8.33319 3.33329C8.33319 4.25376 9.07938 4.99995 9.99986 4.99995C10.9203 4.99995 11.6665 4.25376 11.6665 3.33329C11.6665 2.41282 10.9203 1.66663 9.99986 1.66663C9.07938 1.66663 8.33319 2.41282 8.33319 3.33329Z"
                                                                    fill="#ffffff" />
                                                                <path
                                                                    d="M8.33319 16.6667C8.33319 17.5871 9.07938 18.3333 9.99986 18.3333C10.9203 18.3333 11.6665 17.5871 11.6665 16.6667C11.6665 15.7462 10.9203 15 9.99986 15C9.07938 15 8.33319 15.7462 8.33319 16.6667Z"
                                                                    fill="#ffffff" />
                                                            </svg>

                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item"
                                                                href="view-transaction?id={{$val->id}};"><svg
                                                                    width="20" height="20" viewBox="0 0 20 20"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.4"
                                                                        d="M18.3337 9.99984C18.3337 14.6032 14.6028 18.3332 10.0003 18.3332C5.39783 18.3332 1.66699 14.6032 1.66699 9.99984C1.66699 5.39817 5.39783 1.6665 10.0003 1.6665C14.6028 1.6665 18.3337 5.39817 18.3337 9.99984Z"
                                                                        fill="#FF9F00" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M10.7249 10.5256C10.7249 10.9272 10.3974 11.2547 9.99577 11.2547C9.5941 11.2547 9.2666 10.9272 9.2666 10.5256V6.84225C9.2666 6.44058 9.5941 6.11308 9.99577 6.11308C10.3974 6.11308 10.7249 6.44058 10.7249 6.84225V10.5256ZM9.27077 13.1696C9.27077 12.7679 9.5966 12.4404 9.99577 12.4404C10.4066 12.4404 10.7333 12.7679 10.7333 13.1696C10.7333 13.5712 10.4066 13.8987 10.0041 13.8987C9.59993 13.8987 9.27077 13.5712 9.27077 13.1696Z"
                                                                        fill="#FF9F00" />
                                                                </svg>
                                                                View Details</a>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="my-3">{{$val->ref_trans_id}}</td>
                                                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                                <td>₦{{number_format($val->debit, 2)}}</td>
                                                <td>₦{{number_format($val->credit, 2)}}</td>
                                                <td>
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
                                                        Reveresal
                                                    </span>

                                                    @elseif($val->transaction_type == "Bank Transfer")
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
                                                        Transfer
                                                    </span>

                                                    @elseif($val->transaction_type == "VAS")
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
                                                        VAS
                                                    </span>

                                                    @elseif($val->transaction_type == "Wallet Funding")
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
                                                        Funding
                                                    </span>

                                                    @endif
                                                </td>

                                                <td>
                                                    @if($val->status==2)
                                                    <span class=" btn btn-outline-danger btn-xs">Failed</span>
                                                    @elseif($val->status==1)
                                                    <span class=" btn btn-outline-success btn-xs">Successful</span>
                                                    @elseif($val->status==4)
                                                    <span class=" btn btn-outline-white btn-xs">Refunded</span>
                                                    @endif
                                                </td>
                                                <td>{{$val->sender_name ?? " No Details" }}</td>


                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>



                </div>


                <div id="navpills-6" class="tab-pane">



                    <div class="card">
                        <div class="col-lg-12">
                            <div class="card-body">
                                {{__('Cash Out')}}</h5>
                                <div class="table-responsive py-4">
                                    <table
                                        class="table-responsive-lg table display mb-4 dataTablesCard order-table card-table text-black dataTable no-footer student-tbl"
                                        id="example55">
                                        <thead>
                                            <tr>
                                                <th>{{__('Action')}}</th>
                                                <th>{{__('Reference ID')}}</th>
                                                <th>{{__('Date Time')}}</th>
                                                <th>{{__('Debit')}}</th>
                                                <th>{{__('Credit')}}</th>
                                                <th>{{__('Type')}}</th>
                                                <th>{{__('Status')}}</th>
                                                <th>{{__('Beneficiary Details')}}</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cash_out as $k=>$val)
                                            <tr>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);"
                                                            class="btn-link btn sharp tp-btn-light btn-primary pill"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.33319 9.99985C8.33319 10.9203 9.07938 11.6665 9.99986 11.6665C10.9203 11.6665 11.6665 10.9203 11.6665 9.99986C11.6665 9.07938 10.9203 8.33319 9.99986 8.33319C9.07938 8.33319 8.33319 9.07938 8.33319 9.99985Z"
                                                                    fill="#ffffff" />
                                                                <path
                                                                    d="M8.33319 3.33329C8.33319 4.25376 9.07938 4.99995 9.99986 4.99995C10.9203 4.99995 11.6665 4.25376 11.6665 3.33329C11.6665 2.41282 10.9203 1.66663 9.99986 1.66663C9.07938 1.66663 8.33319 2.41282 8.33319 3.33329Z"
                                                                    fill="#ffffff" />
                                                                <path
                                                                    d="M8.33319 16.6667C8.33319 17.5871 9.07938 18.3333 9.99986 18.3333C10.9203 18.3333 11.6665 17.5871 11.6665 16.6667C11.6665 15.7462 10.9203 15 9.99986 15C9.07938 15 8.33319 15.7462 8.33319 16.6667Z"
                                                                    fill="#ffffff" />
                                                            </svg>

                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item"
                                                                href="view-transaction?id={{$val->id}};"><svg
                                                                    width="20" height="20" viewBox="0 0 20 20"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.4"
                                                                        d="M18.3337 9.99984C18.3337 14.6032 14.6028 18.3332 10.0003 18.3332C5.39783 18.3332 1.66699 14.6032 1.66699 9.99984C1.66699 5.39817 5.39783 1.6665 10.0003 1.6665C14.6028 1.6665 18.3337 5.39817 18.3337 9.99984Z"
                                                                        fill="#FF9F00" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M10.7249 10.5256C10.7249 10.9272 10.3974 11.2547 9.99577 11.2547C9.5941 11.2547 9.2666 10.9272 9.2666 10.5256V6.84225C9.2666 6.44058 9.5941 6.11308 9.99577 6.11308C10.3974 6.11308 10.7249 6.44058 10.7249 6.84225V10.5256ZM9.27077 13.1696C9.27077 12.7679 9.5966 12.4404 9.99577 12.4404C10.4066 12.4404 10.7333 12.7679 10.7333 13.1696C10.7333 13.5712 10.4066 13.8987 10.0041 13.8987C9.59993 13.8987 9.27077 13.5712 9.27077 13.1696Z"
                                                                        fill="#FF9F00" />
                                                                </svg>
                                                                View Details</a>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="my-3">{{$val->ref_trans_id}}</td>
                                                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                                <td>₦{{number_format($val->debit, 2)}}</td>
                                                <td>₦{{number_format($val->credit, 2)}}</td>
                                                <td>
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
                                                        Reveresal
                                                    </span>

                                                    @elseif($val->transaction_type == "Bank Transfer")
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
                                                        Transfer
                                                    </span>

                                                    @elseif($val->transaction_type == "VAS")
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
                                                        VAS
                                                    </span>

                                                    @elseif($val->transaction_type == "Wallet Funding")
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
                                                        Funding
                                                    </span>

                                                    @endif
                                                </td>

                                                <td>
                                                    @if($val->status==2)
                                                    <span class=" btn btn-outline-danger btn-xs">Failed</span>
                                                    @elseif($val->status==1)
                                                    <span class=" btn btn-outline-success btn-xs">Successful</span>
                                                    @elseif($val->status==4)
                                                    <span class=" btn btn-outline-white btn-xs">Refunded</span>
                                                    @endif
                                                </td>
                                                <td>{{$val->sender_name ?? " No Details" }}</td>


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




    @stop
