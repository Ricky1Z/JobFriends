@extends('layout.master')
@section('konten')
    <div>
        <p class="fs-2 fw-bold">@lang('lang.Notification')</p>
        <div style="margin-bottom: 25%">
            @foreach ($notif as $n)
                <div class="d-flex p-3 mb-2 align-items-center border" style="background-color: #d0d0d0">
                    <p class="m-0">{{$n->notification}}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
