@foreach($paymentMethods as $method)
    <div class="payment-method">
        <label>
            <input type="radio" name="payment_method" value="{{ $method['paymentId'] }}">
            {{ $method['name_en'] }} ({{ $method['name_ar'] }})
        </label>
    </div>
@endforeach
