@extends('layout.master')
@section('konten')
    <div>
        <p class="fs-2 fw-bold">@lang('lang.Shop')</p>

        <div class="mt-4" style="margin-bottom: 25%;">
            <div class="mb-3">
                <p class="fs-4 m-0" style="font-weight: 600">@lang('lang.Top_up_coins')</p>
                <div class="d-flex flex-row gap-3 mt-2">
                    <div class="">
                        <form action="{{ route('topup') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                @lang('lang.Top_up_100_coins')
                            </button>
                        </form>
                    </div>
                    <div class="d-flex flex-row gap-2 pt-2">
                        <p class="m-0">@lang('lang.Your_coin')</p>
                        <p class="m-0">{{ auth()->user()->coin }} @lang('lang.Coin')</p>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div>
                <p class="fs-4 m-0" style="font-weight: 600">@lang('lang.Avatars')</p>
                <div class="d-flex flex-row gap-4 mt-2" style="margin: 0 30px">
                    @foreach ($avatar as $a)
                        <div class="d-flex flex-column gap-2 align-items-center">
                            <img src="data:image/jpeg;base64,{{ base64_encode($a->image) }}"
                                class="rounded-circle border border-primary" style="width: 70px; height: 70px;"
                                alt="...">
                            <p class="m-0">{{$a->price}} @lang('lang.Coin')</p>
                            <form action="{{ route('buy-avatar', $a->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    @lang('lang.Buy')
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
                @if (session('successs'))
                    <div class="alert alert-success">
                        {{ session('successs') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
