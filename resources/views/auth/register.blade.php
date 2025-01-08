@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('lang.Register')</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">@lang('lang.Name')</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="gender"
                                    class="col-md-4 col-form-label text-md-end">@lang('lang.Gender')</label>

                                <div class="col-md-6 d-flex gap-5 align-items-center">
                                    <div class="form-check">
                                        <input id="male" type="radio"
                                            class="form-check-input @error('gender') is-invalid @enderror" name="gender"
                                            value="male" {{ old('gender') == 'male' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="male">
                                            @lang('lang.Male')
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input id="female" type="radio"
                                            class="form-check-input @error('gender') is-invalid @enderror" name="gender"
                                            value="female" {{ old('gender') == 'female' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="female">
                                            @lang('lang.Female')
                                        </label>
                                    </div>

                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="phone"
                                    class="col-md-4 col-form-label text-md-end">@lang('lang.Phone')</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <small class="form-text text-muted">
                                        @lang('lang.Must_be_digit')
                                    </small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="linkedin"
                                    class="col-md-4 col-form-label text-md-end">@lang('lang.LinkedIn')</label>

                                <div class="col-md-6">
                                    <input id="linkedin" type="url"
                                        class="form-control @error('linkedin') is-invalid @enderror" name="linkedin"
                                        value="{{ old('linkedin') }}" required autocomplete="linkedin" autofocus>

                                    @error('linkedin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <small class="form-text text-muted">
                                        Format "https://www.linkedin.com/in/<name>"
                                    </small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="field"
                                    class="col-md-4 col-form-label text-md-end">@lang('lang.Field')</label>

                                <div class="col-md-6">
                                    @foreach (['Information Technology', 'Healthcare', 'Education', 'Finance', 'Marketing', 'Engineering', 'Construction', 'Hospitality', 'Retail', 'Manufacturing', 'Transportation', 'Logistics', 'Real Estate', 'Legal Services', 'Media and Entertainment'] as $field)
                                        <div class="form-check">
                                            <input type="checkbox" name="field[]" value="{{ $field }}"
                                                class="form-check-input"
                                                {{ in_array($field, old('field', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="field">{{ $field }}</label>
                                        </div>
                                    @endforeach

                                    @error('field')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <small class="form-text text-muted">
                                        @lang('lang.Select_minimum_3')
                                    </small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="profession"
                                    class="col-md-4 col-form-label text-md-end">@lang('lang.Profession')</label>

                                <div class="col-md-6">
                                    <input id="profession" type="text"
                                        class="form-control @error('profession') is-invalid @enderror" name="profession"
                                        value="{{ old('profession') }}" required autocomplete="profession" autofocus>

                                    @error('profession')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="skill"
                                    class="col-md-4 col-form-label text-md-end">@lang('lang.Skill')</label>

                                <div class="col-md-6">
                                    <input id="skill" type="text"
                                        class="form-control @error('skill') is-invalid @enderror" name="skill"
                                        value="{{ old('skill') }}" required autocomplete="skill" autofocus>

                                    @error('skill')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">@lang('lang.Email')</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <small class="form-text text-muted">
                                        @lang('lang.Email_validation') "@gmail.com"
                                    </small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">@lang('lang.Password')</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">@lang('lang.Confirm_password')</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        @lang('lang.Register')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
