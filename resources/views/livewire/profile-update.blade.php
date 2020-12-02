<div>
    <div class="card h-100">
        <div class="card-body">
          <h6 class="d-flex align-items-center mb-3"></i>Update Profile</h6>

          <form wire:submit.prevent="updateProfile">
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <div>
                    <input id="name" wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>

                <div>
                    <input id="email" wire:model="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="avatar">{{ __('Avatar') }}</label>

                <div>
                    <input id="avatar" wire:model="avatar" type="file" class="form-control border-0 @error('avatar') is-invalid @enderror" name="avatar" required autofocus>

                    @error('avatar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div>
                    <button type="submit" class="btn btn-block w-100 btn-primary">
                        <span>
                            {{ __('Update') }}
                        </span>
                    </button>
                </div>
            </div>
          </form>

        </div>
      </div>
</div>
