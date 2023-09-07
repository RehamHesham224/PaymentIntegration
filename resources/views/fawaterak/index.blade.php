@foreach($paymentMethods as $method)
    <div class="payment-method">
        <label>
            <input type="radio" name="payment_method" value="{{ $method['paymentId'] }}">
            {{ $method['name_en'] }} ({{ $method['name_ar'] }})
            <form action="{{route('payment.choose-method')}}" method="POST">
                @csrf
                {{$method['paymentId']}}
                <input type="hidden" name="payment_method_id" value="{{$method['paymentId']}}">
                <button type="submit">Choose Method</button>
            </form>
        </label>
    </div>
@endforeach



Id:::{{$paymentMethodId}}


<form action="{{route('payment.process-payment')}}" method="POST">
    @csrf
<input type="hidden" name="cart_total" value="50">
    <button type="submit">Process</button>
</form>


<form action="{{route('payment.create-invoice')}}" method="POST">
    @csrf
    <input type="hidden" name="cart_total" value="50">
    <button type="submit">Create Invoice</button>
</form>


<form action="{{route('payment.store_credit_card')}}" method="POST">
    @csrf
    <button type="submit">Store Credit Card</button>
</form>
