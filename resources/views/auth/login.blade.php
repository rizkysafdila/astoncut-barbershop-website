@extends('auth.layouts.main')

@section('container')
  <div class="row justify-content-center mb-4">
    <div class="col text-center">
      <img src="{{ asset('img/astoncut-logo.png') }}" alt="HIMATIK PNL" height="75">
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-4">
      @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if (session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('loginError') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="card px-2 py-1 form-login shadow-sm border-0 rounded-3">
        <div class="card-body">
          <form action="/login" method="post">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control rounded-3 @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" autofocus>
              @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control rounded-3" name="password" id="password" required>
            </div>
            <div class="mb-3 text-end" style="font-size: 14px">
              Not registered? <a class="text-decoration-none" href="/register">Register Now</a>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-dark bg-slate-900 rounded-3">LOGIN</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
