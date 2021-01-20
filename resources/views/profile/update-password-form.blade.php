<div class="card">
    <form method="POST" action="{{ route('user-password.update') }}">
        @csrf @method('PUT')

        @if (session('status') == "password-updated")
            <div class="alert alert-success">
                Password updated successfully.
            </div>
        @endif

        <div class="card-header">
            <h4>Update Password</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>@lang('Current Password')</label>
                <input type="hidden" class="form-control" name="id" value="{{ old('id') ?? auth()->user()->id_master_users }}"
                    required autofocus autocomplete="name" />
                <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" name="current_password" required
                    autocomplete="current-password" />
                @error('current_password', 'updatePassword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>@lang('Password')</label>
                <input type="password" name="password" required autocomplete="new-password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" />
                @error('password', 'updatePassword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>@lang('Confirm Password')</label>
                <input type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password" />
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary" type="submit">
                @lang('Update Password')
            </button>
        </div>
    </form>
</div>
