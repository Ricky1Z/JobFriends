@extends('layout.master')
@section('konten')
    <div>
        <p class="fs-2 fw-bold">@lang('lang.Profile')</p>

        <div class="d-flex flex-column border border-primary px-4 py-2 mb-4" style="border-radius: 10px;">
            <p class="fs-5 m-0" style="font-weight: 600">@lang('lang.Friends'):</p>

            <div class="d-flex flex-row gap-4 mt-3">
                @foreach ($connection as $c)
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        @if (empty($c->desiredUser->image))
                            <img src="{{ asset('asset/user/default_profile.jpg') }}" class="rounded-circle"
                                style="width: 60px; height: 60px;" alt="">
                        @else
                            <img src="data:image/jpeg;base64,{{ base64_encode($c->desiredUser->image) }}" class="rounded-circle"
                                style="width: 60px; height: 60px;" alt="...">
                        @endif
                        <p class="m-0">{{ $c->desiredUser->name }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="d-flex flex-row gap-4">
            <div class="d-flex gap-5 border border-primary p-4" style="border-radius: 10px; width: 69%">
                <div>
                    @if (empty($user->image))
                        <img src="{{ asset('asset/user/default_profile.jpg') }}" style="width: 150px; height: 150px;"
                            alt="">
                    @else
                        <img src="data:image/jpeg;base64,{{ base64_encode($user->image) }}"
                            style="width: 150px; height: 150px;" alt="...">
                        {{-- <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(storage_path('app/' . $user->image))) }}"
                            style="width: 150px; height: 150px;" alt="..."> --}}
                    @endif

                    <div class="d-flex align-items-center gap-2">
                        <p class="mt-3" style="font-weight: 500">@lang('lang.Coin'): </p>
                        <p class="m-0">{{ $user->coin }}</p>
                    </div>
                </div>

                <div>
                    <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="image" class="form-label" style="font-weight: 500">@lang('lang.Upload_image')</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                name="image" accept="image/*">

                            <div id="imagePreview" class="mt-4">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="name" class="form-label" style="font-weight: 500">@lang('lang.Name')</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                style="width: 650px" id="name" name="name" value="{{ old('name', $user->name) }}"
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="gender" class="form-label" style="font-weight: 500">@lang('lang.Gender')</label>

                            <div class="d-flex gap-5 align-items-center">
                                <div>
                                    <input type="radio" class="form-check-input" id="male" name="gender"
                                        value="male" @if (old('gender', $user->gender) == 'male') checked @endif>
                                    <label for="male" class="form-check-label">@lang('lang.Male')</label>
                                </div>
                                <div>
                                    <input type="radio" class="form-check-input" id="female" name="gender"
                                        value="female" @if (old('gender', $user->gender) == 'female') checked @endif>
                                    <label for="female" class="form-check-label">@lang('lang.Female')</label>
                                </div>
                            </div>

                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="form-label" style="font-weight: 500">@lang('lang.Phone')</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" value="{{ old('phone', $user->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="field" class="form-label" style="font-weight: 500">@lang('lang.Field') (@lang('lang.Select_minimum_3'))</label>
                            @foreach (['Information Technology', 'Healthcare', 'Education', 'Finance', 'Marketing', 'Engineering', 'Construction', 'Hospitality', 'Retail', 'Manufacturing', 'Transportation', 'Logistics', 'Real Estate', 'Legal Services', 'Media and Entertainment'] as $field)
                                <div class="form-check">
                                    <input type="checkbox" name="field[]" value="{{ $field }}"
                                        class="form-check-input"
                                        {{ in_array($field, old('field', $user->field ?? [])) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $field }}</label>
                                </div>
                            @endforeach

                            @error('field')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="linkedin" class="form-label" style="font-weight: 500">@lang('lang.LinkedIn')
                                </label>
                            <input type="url" class="form-control @error('linkedin') is-invalid @enderror"
                                id="linkedin" name="linkedin" value="{{ old('linkedin', $user->linkedin) }}" required
                                placeholder="https://www.linkedin.com/in/yourprofile">
                            @error('linkedin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="profession" class="form-label" style="font-weight: 500">@lang('lang.Profession')</label>
                            <input type="text" class="form-control @error('profession') is-invalid @enderror"
                                id="profession" name="profession" value="{{ old('profession', $user->profession) }}"
                                required>
                            @error('profession')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="skill" class="form-label" style="font-weight: 500">@lang('lang.Skill')</label>
                            <input type="text" class="form-control @error('skill') is-invalid @enderror"
                                id="skill" name="skill" value="{{ old('skill', $user->skill) }}" required>
                            @error('skill')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label" style="font-weight: 500">@lang('lang.Email')</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">@lang('lang.Update')</button>
                        </div>

                        <div class="mt-4">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                    </form>

                </div>
            </div>

            <div class="d-flex flex-column border border-primary p-4 gap-2" style="border-radius: 10px; width: 100%">
                <p class="fs-5 m-0" style="font-weight: 600">@lang('lang.Your_avatar'):</p>
                <div class="d-flex flex-row gap-3">
                    @foreach ($avatar as $a)
                        <div>
                            <img src="data:image/jpeg;base64,{{ base64_encode($a->image) }}"
                                class="rounded-circle border border-primary" style="width: 70px; height: 70px;"
                                alt="...">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection
