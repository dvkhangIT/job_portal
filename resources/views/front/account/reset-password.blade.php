@extends("front.layout.app")
@section("title", "Forgot Password")
@section("main")
  <section class="section-5">
    <div class="container my-5">
      <div class="py-lg-2">&nbsp;</div>
      <div class="row d-flex justify-content-center">
        <div class="col-md-5">
          @include("front.message")
          <div class="card border-0 p-5 shadow">
            <h1 class="h3">Resest Password</h1>
            <form action="{{ route("account.processResestPassword") }}" method="post">
              @csrf
              <input type="hidden" value="{{ $tokenString }}" name="token">
              <div class="mb-3">
                <label for="" class="mb-2">New Password*</label>
                <input type="password" name="new_password" id="new_password"
                  class="form-control @error("new_password")
                    is-invalid
                @enderror"
                  value="{{ old("new_password") }}">
                @error("new_password")
                  <p class="invalid-feedback">{{ $message }}</p>
                @enderror
              </div>
              <div class="mb-3">
                <label for="" class="mb-2">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password"
                  class="form-control @error("confirm_password")
                    is-invalid
                @enderror"
                  value="{{ old("confirm_password") }}">
                @error("confirm_password")
                  <p class="invalid-feedback">{{ $message }}</p>
                @enderror
              </div>
              <div class="justify-content-between d-flex">
                <button class="btn btn-primary mt-2">Submit</button>
              </div>
            </form>
          </div>
          <div class="mt-4 text-center">
            <p>Do not have an account? <a href="{{ route("account.login") }}">Back to Login</a></p>
          </div>
        </div>
      </div>
      <div class="py-lg-5">&nbsp;</div>
    </div>
  </section>

@endsection
