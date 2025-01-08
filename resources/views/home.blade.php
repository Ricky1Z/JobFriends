@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('lang.Dashboard')</div>

                    <div class="card-body d-flex flex-column">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @lang('lang.You_are_logged_in')

                        @php
                            // Ambil data coins dari session jika ada, jika tidak ambil dari database
                            $userCoins = session('userCoins', Auth::user()->coin);
                        @endphp

                        {{-- <p>Your current balance is: {{ $userCoins }} coins</p> --}}

                        @if ($userCoins == 0)
                            <a href="{{ route('payment') }}" class="text-center mt-4 border p-2 text-white"
                                style="text-decoration: none; margin: 0 310px; background-color: #4379F2; border-radius: 5px;">@lang('lang.Pay_registration_fee')</a>
                        @elseif ($userCoins > 0)
                            <a href="{{ route('homepage') }}" class="text-center mt-4 border p-2 text-white"
                                style="text-decoration: none; margin: 0 350px; background-color: #4379F2; border-radius: 5px;">@lang('lang.Homepage')</a>
                        @endif


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
