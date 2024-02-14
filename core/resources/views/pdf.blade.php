<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('') }}/asset/css/pdf.css" type="text/css"> 
    <title>Invoice</title>
</head>
<body>
    <table class="w-full">
        <tr>
            <td class="w-half">
             <div><h1 class="head">ENKPAY</h1></div>
             <div><p class="psmall">Seamless Transaction</p></div>

            </td>
            <td class="w-half">
                <h2>Transaction Report</h2>
               <p>From {{$from}} - To {{ $to }}</p>

            </td>

        </tr>
    </table>

    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div>
                        <h4>Customer Infomation</h4>
                    </div>
                    <div>Name: {{ $user->first_name }} {{ $user->last_name }}</div>
                    <div>Termainal NO: {{ $serial_no }}</div>
                </td>
                <td class="w-half">
                    <div>
                        <h4>Transaction Details</h4>
                    </div>
                    <div class="credit">Total Credit: NGN {{number_format($total_credit, 2)}}</div>
                    <div class="debit">Total Debit: NGN {{number_format($total_debit, 2)}}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="margin-top">
        <table class="products">
            <tr>
                <th>Date Time</th>
                <th>Debit</th>
                <th>Amount</th>
                <th>Credit</th>
                <th>Balance</th>
                <th>Remarks</th>

            </tr>
            <tr class="items">
                @foreach($transaction as $val)

            <tr>
                <td>{{date("d/m/Y h:i:A", strtotime($val->created_at))}}</td>
                <td>{{number_format($val->amount, 2)}}</td>
                <td style="color:#FF4500;">{{number_format($val->debit, 2)}}</td>
                <td style="color:#2E8B57;">{{number_format($val->credit, 2)}}</td>
                <td>{{number_format($val->balance, 2)}}</td>
                <td>{{$val->note}}</td>

            </tr>
            <td>
                @endforeach
                </tr>
        </table>
    </div>


    <div class="footer margin-top">
        <div>ENKPAY</div>
        <div>Info@enkwave.com</div>
    </div>
</body>
</html>
