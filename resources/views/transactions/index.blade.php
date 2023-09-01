
@extends('layouts')

@section('content')
    <div class="container">
        <h1>Transactions</h1>
        <table id="transactions-table" class="table table-bordered">
            <thead>
            <tr>
                <th>Payment ID</th>
                <th>Amount</th>
                <th>Currency</th>
                <th>Created At</th>
                <th>Status</th>
            </tr>
            </thead>
        </table>
    </div>

    <script>
        $(function() {
            $('#transactions-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('transactions.data') }}',
                columns: [
                    { data: 'payment_id', name: 'payment_id' },
                    { data: 'amount', name: 'amount' },
                    { data: 'currency', name: 'currency' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'status', name: 'status' },
                ]
            });
        });
    </script>
@endsection
