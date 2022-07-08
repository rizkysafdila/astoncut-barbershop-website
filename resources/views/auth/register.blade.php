@extends('auth.layouts.main')

@section('container')
  <div class="row justify-content-center mb-4">
    <div class="col text-center">
      <img src="{{ asset('img/astoncut-logo.png') }}" alt="HIMATIK PNL" height="75">
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-4">
      @if (session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('loginError') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="card px-2 py-1 form-login shadow-sm border-0 rounded-3">
        <div class="card-body">
          <form action="/register" method="post">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control rounded-3 @error('name') is-invalid @enderror" name="name" id="name" autofocus required>
              @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="phone" class="form-label">Phone Number</label>
              <div class="input-group">
                <span class="input-group-text" id="basic-addon1">+62</span>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" aria-describedby="basic-addon1" required>
              </div>
              @error('phone')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control rounded-3 @error('email') is-invalid @enderror" name="email" id="email" required>
              @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control rounded-3 @error('password') is-invalid @enderror" name="password" id="password" required>
              @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-dark bg-slate-900 rounded-3">REGISTER</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
