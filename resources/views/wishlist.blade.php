@extends('layout.master')
@section('konten')
    <div class="d-flex flex-row gap-5" style="margin-bottom: 25%">
        <div class="p-3 border border-primary" style="border-radius: 5px; width:50%">
            <p class="fs-2 fw-bold">@lang('lang.Wishlists')</p>
            <div >
                @foreach ($wishlist as $w)
                    <div class="d-flex p-3 mb-3 gap-4 align-items-center border">
                        <div>
                            @if (empty($w->desiredUser->image))
                                <img src="{{ asset('asset/user/default_profile.jpg') }}"
                                    style="width: 100%; height: 20vh; object-fit:cover" alt="">
                            @else
                                <img src="data:image/jpeg;base64,{{ base64_encode($w->desiredUser->image) }}"
                                    style="width: 100%; height: 30vh; object-fit:cover" alt="...">
                            @endif
                        </div>
                        <div class="d-flex flex-column align-items-start mt-0">
                            <p class="fs-4 m-0" style="font-weight: 600">{{ $w->desiredUser->name }}</p>

                            <div class="mb-1">
                                @foreach ($w->desiredUser->field as $field)
                                    <span class="m-0 px-2"
                                        style="background-color: #7ea6fc; border-radius: 5px;">{{ $field }}</span>
                                @endforeach
                            </div>

                            <div class="mb-1">
                                <span class="m-0" style="font-weight: 650">@lang('lang.Profession'):</span>
                                <span class="m-0">{{ $w->desiredUser->profession }}</span>
                            </div>

                            <div class="mb-1">
                                <span class="m-0" style="font-weight: 650">@lang('lang.Skill'):</span>
                                <span class="m-0">{{ $w->desiredUser->skill }}</span>
                            </div>

                            <div class="mb-1">
                                <span class="m-0" style="font-weight: 650">@lang('lang.LinkedIn'):</span>
                                <span class="m-0" style="word-wrap: break-word;">{{ $w->desiredUser->linkedin }}</span>
                            </div>
                        </div>
                        <div class="ms-auto ">
                            <form action="{{ route('delete-wishlist', $w->id) }}" method="POST" style="margin-top: 10px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">@lang('lang.Delete')</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="p-3 border border-primary" style="border-radius: 5px; width:50%">
            <p class="fs-2 fw-bold">@lang('lang.Friends')</p>
            <div >
                @foreach ($friend as $w)
                    <div class="d-flex p-3 mb-3 gap-4 align-items-center border">
                        <div>
                            @if (empty($w->desiredUser->image))
                                <img src="{{ asset('asset/user/default_profile.jpg') }}"
                                    style="width: 100%; height: 20vh; object-fit:cover" alt="">
                            @else
                                <img src="data:image/jpeg;base64,{{ base64_encode($w->desiredUser->image) }}"
                                    style="width: 100%; height: 30vh; object-fit:cover" alt="...">
                            @endif
                        </div>
                        <div class="d-flex flex-column align-items-start mt-0">
                            <p class="fs-4 m-0" style="font-weight: 600">{{ $w->desiredUser->name }}</p>

                            <div class="mb-1">
                                @foreach ($w->desiredUser->field as $field)
                                    <span class="m-0 px-2"
                                        style="background-color: #7ea6fc; border-radius: 5px;">{{ $field }}</span>
                                @endforeach
                            </div>

                            <div class="mb-1">
                                <span class="m-0" style="font-weight: 650">@lang('lang.Profession'):</span>
                                <span class="m-0">{{ $w->desiredUser->profession }}</span>
                            </div>

                            <div class="mb-1">
                                <span class="m-0" style="font-weight: 650">@lang('lang.Skill'):</span>
                                <span class="m-0">{{ $w->desiredUser->skill }}</span>
                            </div>

                            <div class="mb-1">
                                <span class="m-0" style="font-weight: 650">@lang('lang.LinkedIn'):</span>
                                <span class="m-0" style="word-wrap: break-word;">{{ $w->desiredUser->linkedin }}</span>
                            </div>
                        </div>
                        <div class="ms-auto ">
                            <form action="{{ route('delete-friend', $w->id) }}" method="POST" style="margin-top: 10px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">@lang('lang.Delete')</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
