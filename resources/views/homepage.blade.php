@extends('layout.master')
@section('konten')

    <div class="row d-flex gap-5 justify-content-center" style="background-color: ">
        @foreach ($users as $a)
            <div class="col-md-3 mb-3 border p-3" style="width: 14rem;">

                @if (empty($a->image))
                    <img src="{{ asset('asset/user/default_profile.jpg') }}"
                        style="width: 100%; height: 30vh; object-fit:cover" alt="">
                @else
                    <img src="data:image/jpeg;base64,{{ base64_encode($a->image) }}"
                        style="width: 100%; height: 30vh; object-fit:cover" alt="...">
                @endif

                <div class="mt-3">
                    <p class="fs-4 m-0" style="font-weight: 600">{{ $a->name }}</p>

                    <div class="mb-1">
                        @foreach ($a->field as $field)
                            <span class="m-0 px-2"
                                style="background-color: #7ea6fc; border-radius: 5px;">{{ $field }}</span>
                        @endforeach
                    </div>

                    <div class="mb-1">
                        <span class="m-0" style="font-weight: 650">@lang('lang.Gender'):</span>
                        <span class="m-0">{{ $a->gender }}</span>
                    </div>

                    <div class="mb-1">
                        <span class="m-0" style="font-weight: 650">@lang('lang.Profession'):</span>
                        <span class="m-0">{{ $a->profession }}</span>
                    </div>

                    <div class="mb-1">
                        <span class="m-0" style="font-weight: 650">@lang('lang.Skill'):</span>
                        <span class="m-0">{{ $a->skill }}</span>
                    </div>

                    <div class="mb-1">
                        <span class="m-0" style="font-weight: 650">@lang('lang.LinkedIn'):</span>
                        <span class="m-0" style="word-wrap: break-word;">{{ $a->linkedin }}</span>
                    </div>

                </div>

                {{-- <div class="mt-3 d-flex justify-content-end">
                    <i class="bi bi-hand-thumbs-up" style="font-size: 23px"></i>
                </div> --}}

                @auth
                    <div class="mt-3 d-flex justify-content-end">
                        @php
                            $liked = \App\Models\Connection::where('user_id', auth()->user()->id)
                                ->where('desired_user_id', $a->id)
                                ->whereIn('status', ['wishlist', 'connected'])
                                ->exists();
                        @endphp
                        <i id="like-btn-{{ $a->id }}"
                            class="bi {{ $liked ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up' }} like-btn"
                            style="font-size: 23px" data-desired-user-id="{{ $a->id }}"
                            data-user-name="{{ $a->name }}"></i>
                    </div>
                @endauth
            </div>
        @endforeach
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const likeButtons = document.querySelectorAll('.like-btn');

            likeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const desiredUserId = button.getAttribute('data-desired-user-id');
                    const userName = button.getAttribute('data-user-name');
                    toggleLike(desiredUserId, userName);
                });
            });

            function toggleLike(desiredUserId, userName) {
                // Cek apakah pengguna sudah login
                if (!{{ auth()->check() ? 'true' : 'false' }}) {
                    alert('You must be logged in to like users!');
                    return; // Jika pengguna tidak login, hentikan fungsi
                }

                var likeButton = document.getElementById('like-btn-' + desiredUserId);
                var userId = {{ auth()->check() ? auth()->user()->id : 'null' }}; // ID pengguna yang sedang login

                if (userId === null) {
                    alert('You must be logged in to perform this action.');
                    return; // Jika pengguna tidak ditemukan (belum login), hentikan
                }

                // Ambil status tombol saat ini (bi-hand-thumbs-up atau bi-hand-thumbs-up-fill)
                var status = (likeButton.classList.contains('bi-hand-thumbs-up')) ? 'wishlist' : 'connected';

                fetch('/like', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            user_id: userId,
                            desired_user_id: desiredUserId,
                            status: status
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Mengubah ikon tombol berdasarkan status yang dikirim
                        if (data.status === 'wishlist') {
                            likeButton.classList.remove('bi-hand-thumbs-up-fill');
                            likeButton.classList.add('bi-hand-thumbs-up');
                        } else if (data.status === 'connected') {
                            likeButton.classList.remove('bi-hand-thumbs-up');
                            likeButton.classList.add('bi-hand-thumbs-up-fill');
                        }
                    });
            }
        });
    </script>
@endsection
