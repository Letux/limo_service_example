<x-app-layout>
    <x-slot:title>
        Step 1
    </x-slot:title>

    @push('css')
        <link rel="stylesheet" href="/css/jquery-ui-1.8.20.custom.css">
    @endpush

    @push('js')
        <script src="/js/jquery-ui-1.8.20.custom.min.js"></script>
        <script src="/js/jquery.validate.min.js"></script>
    @endpush

    <x-order-progress></x-order-progress>

    <form method="post">
        @csrf

        <input type="hidden" name="id" value="{{old('id')}}">

        <input type="hidden" name="return_from" value="{{old('return_from')}}">
        <input type="hidden" name="similar_order_id" value="{{old('similar_order_id')}}">

        <div class="form-group">
            <label for="OrderTo">Where do you want to go?</label>
            <select name="to" class="form-control" id="OrderTo" >
                @foreach($to as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>
                @endforeach
            </select>
            @error('to')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            @php $passRange = range(1, $maxPassengers); @endphp
            <label for="order_pass_number">Number of People</label>
            <select name="pass_number" class="form-control" id="order_pass_number" >
                @foreach($passRange as $value)
                    <option value="{{$value}}">{{$value}}</option>
                @endforeach
            </select>
            @error('pass_number')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="OrderDate" style="display:block;">Date of pickup</label>
            @mobile
                <input type="date" name="date" class="form-control" id="OrderDate" maxlength="10" value="{{old('date', $order->pick_up_date_mobile)}}">
            @elsemobile
                <input type="text" name="date" class="form-control" id="OrderDate" maxlength="10" value="{{old('date', $order->pick_up_date)}}">
            @endmobile
            @error('date')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>

        <div class="row form-group">
            <div class="col-xs-6">
                <select name="hour" class="form-control" id="OrderHour">
                    <option>Pick up time</option>
                    @foreach(\App\Models\Order::$hours as $key => $value)
                        <option value="{{$key}}" @selected(old('hour', $order->pick_up_hour) == $key)>{{$value}}</option>
                    @endforeach
                </select>
                @error('hour')
                    <label class="error">{{ $message }}</label>
                @enderror
            </div>

            <div class="col-xs-6">
                <select name="minutes" class="form-control" id="OrderMinutes" >
                    @foreach(\App\Models\Order::$minutes as $key => $value)
                        <option value="{{$key}}" @selected(old('minutes', $order->pick_up_minutes) == $key)>{{$value}}</option>
                    @endforeach
                </select>
                @error('minutes')
                    <label class="error">{{ $message }}</label>
                @enderror
            </div>
        </div>

        <div class="form-group" id="dropoffTime">
            <select name="charter_minutes" class="form-control" id="OrderCharterMinutes" >
                <option>Charter Time</option>
                @foreach($charterMinutes as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>
                @endforeach
            </select>
            @error('charter_minutes')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>

        <div class="form-group" id="divFromAirport">
            <label for="order_from_airport">From Airport</label>
            <select name="from_airport" class="form-control" id="order_from_airport" >
                @foreach($airports as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>
                @endforeach
            </select>
            @error('from_airport')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>

        <div class="form-group" id="divPickupAdress">
            <label for="OrderPickupAddress">Pick up city, state or ZIP code</label>
            <input type="text" class="form-control" id="OrderPickupAddress" name="pickup_address" value="">
            @error('pickup_address')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>

        <div class="form-group" id="divToAirport">
            <label for="order_to_airport">To Airport</label>
            <select name="to_airport" class="form-control" id="order_to_airport" data-inline="true" >
                @foreach($airports as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>
                @endforeach
            </select>
            @error('to_airport')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>

        <div class="form-group" id="divDropoffAdress">
            <label for="OrderDropoffAddress">Drop off city, state or ZIP code</label>
            <input type="text" class="form-control" id="OrderDropoffAddress" name="dropoff_address" value="">
            @error('dropoff_address')
                <label class="error">{{ $message }}</label>
            @enderror
        </div>

        <div class="submit">
            <input class="btn btn-primary btn-lg active" type="submit" value="Select a car">
        </div>

    </form>

    <script>
        var minDate = {{ $minDate }};
        var minTime = {{$minTime}};
        var minDay = @mobile '{{$minDay->format('Y-m-d')}}' @elsemobile '{{$minDay->format('m/d/Y')}}' @endmobile;
        var holidays = '{{$holidays}}'.split(' ');
        var minCharterHours = {{$minCharterHours}};
        var zipExistsCache = {};
        IS_MOBILE = @mobile true @elsemobile false @endmobile;

        $(function() {
            Step1.init();
        });
    </script>

</x-app-layout>
