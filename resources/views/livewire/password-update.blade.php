<div>
    <div class="card h-100">
        <div class="card-body">
          <h6 class="d-flex align-items-center mb-3"></i>Update Password</h6>

         <form wire:submit.prevent="updatePassword">
             @csrf

             @if (auth()->user()->password)
             <div class="form-group">
                <label for="currentPassword">{{ __('Current Password') }}</label>
                <div>
                    <input wire:model="currentPassword" id="currentPassword" type="password" class="form-control @error('currentPassword') is-invalid @enderror" name="currentPassword">

                    @error('currentPassword')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
             @endif

            <div class="form-group">
                <label for="newPassword">{{ __('New Password') }}</label>

                <div>
                    <input wire:model="newPassword" id="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" name="newPassword" autofocus>

                    @error('newPassword')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="newPassword-confirm">{{ __('Confirm Password') }}</label>

                <div>
                    <input wire:model="newPassword_confirmation" id="newPassword-confirm" type="password" class="form-control" name="newPassword_confirmation">
                </div>
            </div>

            <div class="form-group">
                <div>
                    <button type="submit"  class="btn btn-block w-100 btn-success">
                        {{ __('Update Password') }}
                    </button>
                </div>
            </div>
         </form>

        </div>
      </div>
</div>
