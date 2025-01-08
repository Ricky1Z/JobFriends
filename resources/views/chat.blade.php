@extends('layout.master')
@section('konten')
    <div style="margin-bottom:20%">
        <p class="fs-2 fw-bold">@lang('lang.Chat')</p>

        <div class="d-flex flex-column justify-content-center gap-4">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <p class="fs-4 m-0" style="font-weight: 600">@lang('lang.Friends'):</p>
                <p class="fs-5 m-0" style="font-weight: 400; color:rgb(137, 137, 137)">@lang('lang.Choose_friend')</p>
            </div>
            <div class="d-flex flex-row justify-content-center gap-4">
                @foreach ($connections as $c)
                    <a href="{{ route('chat-show', $c->desiredUser->id) }}" class="text-decoration-none">
                        <div class="d-flex flex-column justify-content-center align-items-center border p-3"
                            style="border-radius: 5px">
                            @if (empty($c->desiredUser->image))
                                <img src="{{ asset('asset/user/default_profile.jpg') }}"
                                    style="width: 100px; height: 100px; border-radius:3px" alt="">
                            @else
                                <img src="data:image/jpeg;base64,{{ base64_encode($c->desiredUser->image) }}"
                                    style="width: 100px; height: 100px; border-radius:3px" alt="...">
                            @endif
                            <div class="mt-2">
                                <p class="m-0 fs-5" style="color:black">{{ $c->desiredUser->name }}</p>
                            </div>
                            {{-- <p>{{$c->desiredUser->id}}</p> --}}
                        </div>
                    </a>
                @endforeach
            </div>

        </div>

    </div>
@endsection
