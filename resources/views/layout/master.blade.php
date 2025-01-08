<!DO CTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @include('custom.bootstrap5')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <title>JobFriends</title>
    </head>

    <body>
        <nav class="">
            <div class="d-flex flex-row justify-content-between align-items-center m-0 px-5 py-2" style="">
                <p class="m-0 fs-3 fw-bold" style="color: #4379F2">JobFriends</p>

                <div class="d-flex flex-row gap-5">
                    @if (Auth::check())
                        <div>
                            <a class="btn btn-primary" href="{{ route('home') }}">@lang('lang.Logout')</a>
                            {{-- <a href="{{ route('home') }}" class="border border-1 border-primary px-3 py-1"
                                style="color:white ;font-weight:700; text-decoration:none; border-radius:7px; background-color:#4379F2">Logout</a> --}}
                        </div>
                    @else
                        <div class="d-flex gap-4">
                            {{-- <a href="{{ route('login') }}" class="border border-1 border-primary px-3 py-1"
                                style="font-weight:700; text-decoration:none; border-radius:7px; ">Login</a>
                            <a href="{{ route('register') }}" class="border border-1 border-primary px-3 py-1"
                                style="color:white ;font-weight:700; text-decoration:none; border-radius:7px; background-color:#4379F2">Register</a> --}}
                            <a class="btn btn-outline-primary" href="{{ route('login') }}">@lang('lang.Login')</a>
                            <a class="btn btn-primary" href="{{ route('register') }}">@lang('lang.Register')</a>
                        </div>
                    @endif

                    <div>
                        <a class="btn btn-primary" href="{{ route('set-locale', 'en') }}">@lang('lang.English')</a> |
                        <a class="btn btn-primary" href="{{ route('set-locale', 'id') }}">@lang('lang.Indonesia')</a>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-row justify-content-between align-items-center m-0 px-5 py-3 gap-5"
                style="background-color: #4379F2;">

                @if (Auth::check())
                    <div class="d-flex gap-5">
                        <a href="{{ route('homepage') }}" class="bi bi-house" style="color: white; font-size:25px"></a>
                        <a href="{{ route('wishlist') }}" class="bi bi-people" style="color: white; font-size:25px"></a>
                        <a href="{{ route('notification') }}" class="bi bi-bell"
                            style="color: white; font-size:25px"></a>
                        <a href="{{ route('chat-index') }}" class="bi bi-chat-dots"
                            style="color: white; font-size:25px"></a>
                        <a href="{{ route('profile') }}" class="bi bi-person-circle"
                            style="color: white; font-size:25px"></a>
                        <a href="{{ route('shop') }}" class="bi bi-shop" style="color: white; font-size:25px"></a>
                    </div>
                @endif

                <form action="{{ route('homepage') }}" method="get"
                    class="d-flex flex-row align-items-center m-0 gap-2">
                    <input class="form-control" name="query" value="{{ request('query') }}" type="search"
                        placeholder="@lang('lang.Search')" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">@lang('lang.Search')</button>
                </form>

                <!-- Filter by Gender -->
                <form action="{{ route('filter') }}" method="get"
                    class="d-flex flex-row align-items-center m-0 gap-2">
                    <label for="gender" class="text-white me-1">@lang('lang.Gender'):</label>
                    <select name="gender" id="gender" class="form-select">
                        <option value="">All</option>
                        <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    <button class="btn btn-outline-light ms-2" type="submit">@lang('lang.Apply')</button>
                </form>

                <!-- Filter by Field -->
                <form action="{{ route('filter') }}" method="get"
                    class="d-flex flex-row align-items-center m-0 gap-2">
                    <label for="field" class="text-white me-1">@lang('lang.Field'):</label>
                    <select name="field" id="field" class="form-select">
                        <option value="">All</option>
                        @foreach (['Information Technology', 'Healthcare', 'Education', 'Finance', 'Marketing', 'Engineering', 'Construction', 'Hospitality', 'Retail', 'Manufacturing', 'Transportation', 'Logistics', 'Real Estate', 'Legal Services', 'Media and Entertainment'] as $field)
                            <option value="{{ $field }}" {{ request('field') == $field ? 'selected' : '' }}>
                                {{ $field }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-outline-light ms-2" type="submit">@lang('lang.Apply')</button>
                </form>

            </div>
        </nav>

        <div style="margin-left: 7%; margin-right:7%; margin-top: 3%; margin-bottom: 15%">
            @yield('konten')
        </div>

        <footer class="p-4 text-white sticky-bottom" style="background-color: #4379F2; margin-top: 3%">
            <div class="text-center m-0">
                <p class="m-0">Ricky | 2602141101</p>
                <p class="m-0">@ JobFriends 2024</p>
            </div>
        </footer>
        @include('custom.bootstrapjs')
    </body>

    </html>
