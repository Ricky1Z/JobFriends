<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('custom.bootstrap5')
</head>

<body>
    <div class="d-flex flex-column justify-content-center align-items-center" style="margin-top: 3%">
        <p class="fs-2 fw-bold mb-4">@lang('lang.Payment')</p>

        <form action="{{ route('process-payment') }}" method="POST">
            @csrf

            <!-- Payment Input -->
            <div class="row mb-3">
                <label for="payment"
                    class="col-md-4 col-form-label text-md-end">@lang('lang.Regis_fee')</label>

                <div class="col-md-6">
                    <input id="payment" type="number"
                        class="form-control @error('payment') is-invalid @enderror" name="payment"
                        value="{{ old('payment') }}" required>

                    <small class="form-text text-muted">@lang('lang.Fee_validation')</small>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row mb-3">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        @lang('lang.Submit_payment')
                    </button>
                </div>
            </div>
        </form>

        <!-- Confirmation and Error Messages -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('underpaid'))
            <div class="alert alert-warning">
                @lang('lang.Underpaid') {{ session('underpaid') }}.
            </div>
        @endif

        @if (session('overpaid'))
            <div class="alert alert-info">
                @lang('lang.Overpaid1') {{ session('overpaid') }}. @lang('lang.Overpaid2')
                <form action="{{ route('confirm-overpayment') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" name="confirm" value="yes" class="btn btn-success btn-sm">@lang('lang.Yes')</button>
                    <button type="submit" name="confirm" value="no" class="btn btn-danger btn-sm">@lang('lang.No')</button>
                </form>
            </div>
        @endif

    </div>
    @include('custom.bootstrapjs')
</body>

</html>
