@foreach($paymentMethods as $method)
    <div class="payment-method">
        <label>
            <input type="radio" name="payment_method" value="{{ $method['paymentId'] }}">
            {{ $method['name_en'] }} ({{ $method['name_ar'] }})
            <form action="{{route('payment.choose-method')}}" method="POST">
                <input type="hidden" value="{{$method['paymentId']}}">
                <button type="submit">Choose Method</button>
            </form>
        </label>
    </div>
@endforeach
