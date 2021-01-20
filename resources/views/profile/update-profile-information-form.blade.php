<div class="card">
    <form method="POST" action="{{ route('user-profile-information.update') }}">
        @csrf @method('PUT')

        <div class="card-header">
            <h4>Edit Profile</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>@lang('Name')</label>
                <input type="hidden" class="form-control" name="id" value="{{ old('id') ?? auth()->user()->id_master_users }}"
                    required autofocus autocomplete="name" />
                <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? auth()->user()->username }}"
                    required autofocus autocomplete="name" />
                @error('name')
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                 @enderror
            </div>
            <div class="form-group">
                <label>@lang('Email')</label>
                <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror"
                    value="{{ old('email') ?? auth()->user()->email }}" required autofocus />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary" type="submit">
                @lang('Update Profile')
            </button>
        </div>
    </form>
</div>
