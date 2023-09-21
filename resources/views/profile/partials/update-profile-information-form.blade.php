<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="text-secondary">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form method="post" action="{{ route('profile.update') }}">
        <div class="d-flex row-12">

            @csrf
            @method('patch')

            <div class="col-6">
                <x-form.form-floating name="first_name" placeholder="First Name">
                    <x-form.input name="first_name" :value="$user->profile->first_name" placeholder="First Name" />
                </x-form.form-floating>
                <div>
                    <x-form.form-floating name="email" placeholder="Email">
                        <x-form.input name="email" type="email" :value="$user->email" placeholder="Email" />
                    </x-form.form-floating>

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-4 text-gray-800 dark:text-gray-200">
                                {{ __('Your email address is unverified.') }}
                                <br>
                                <button form="send-verification" class="btn btn-outline-secondary">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
                <x-form.form-floating name="locale" placeholder="Language">
                    <select name="locale" id="language" class="form-select">
                        <option value="{{ $user->profile?->locale }}">{{ $user->profile?->locale }}</option>
                        <option value="en">English</option>
                        <option value="ar">Arabic</option>
                    </select>
                </x-form.form-floating>

                <x-form.form-floating name="gender" placeholder="Gender">
                    <select name="gender" id="gender" class="form-select">
                        <option value="{{ $user->profile?->gender }}">{{ $user->profile?->gender }}</option>
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                    </select>
                </x-form.form-floating>
            </div>

            <div class="col-6 ms-3">
                <x-form.form-floating name="last_name" placeholder="Last Name">
                    <x-form.input name="last_name" :value="$user->profile?->last_name" placeholder="Last Name" />
                </x-form.form-floating>
                <x-form.form-floating name="birthday" placeholder="Birthday">
                    <x-form.input name="birthday" type="date" :value="$user->profile?->birthday" placeholder="Birthday" />
                </x-form.form-floating>

                <x-form.form-floating name="timezone" placeholder="Timezone">
                    <select name="timezone" id="timezone" class="form-select">
                        <option value="{{ $user->profile?->timezone }}">{{ $user->profile?->timezone }}</option>
                        @foreach (timezone_identifiers_list() as $timezone)
                            <option value="{{ $timezone }}">{{ $timezone }}</option>
                        @endforeach
                    </select>
                </x-form.form-floating>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success my-3">{{ __('Save') }}</button>
                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </form>
</section>
