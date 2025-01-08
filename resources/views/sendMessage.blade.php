@extends('layout.master')
@section('konten')
    <div>
        <p class="fs-2 fw-bold">@lang('lang.Chat_with') {{ $desiredUser->name }}</p>
        <div class="d-flex flex-column gap-2" style="margin-bottom: 25%;">
            <div class="border border-primary p-4 mb-3" style="border-radius: 10px; height: 400px; overflow-y: auto;">
                @foreach ($chats as $chat)
                    <div class="{{ $chat->user_id == $user->id ? 'text-end' : 'text-start' }}">
                        <p class="m-0 p-2 mb-2" style="border-radius: 10px; background-color: #dedddd; display: inline-block;">
                            {{ $chat->chat }}
                        </p>
                    </div>
                @endforeach
            </div>

            <form action="{{ route('chat-send', $desiredUser->id) }}" method="POST">
                @csrf
                <div class="d-flex">
                    <input type="text" name="chat" class="form-control" placeholder="@lang('lang.Type_a_message')..." required>
                    <button type="submit" class="btn btn-primary ms-2">@lang('lang.Send')</button>
                </div>
            </form>
        </div>
    </div>
@endsection
