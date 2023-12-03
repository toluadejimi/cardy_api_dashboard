
<h1>User Transactions</h1>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
                <td>{{ $transaction->amount }}</td>
                <!-- Add more columns as needed -->
            </tr>
        @endforeach
    </tbody>
</table>
