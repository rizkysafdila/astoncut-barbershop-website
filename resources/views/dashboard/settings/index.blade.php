@extends('dashboard.layouts.main')

@section('container')
  <div class="container px-0">
    <div class="row">
      <div class="col">
        @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
      </div>
    </div>

    <div class="row">
      @can('admin')
        <div class="col-sm-6 col-md-7 col-lg-4">
          <div class="card">
            <div class="card-header fw-semibold d-flex justify-content-between align-items-center">
              Payment Method Setting
              <a class="btn btn-sm btn-dark" href="#modalCreate" data-bs-toggle="modal">
                <i class="fa-regular fa-plus"></i>
              </a>
            </div>
            <ul class="list-group list-group-flush">
              @foreach ($methods as $method)
                <li class="list-group-item">
                  <div class="row">
                    <div class="col d-flex justify-content-between align-items-center">
                      <div>{{ $method->method }}</div>
                      <div>
                        <a class="btn btn-sm btn-info" href="#modalEdit{{ $loop->iteration }}" data-bs-toggle="modal">
                          <i class="fa-regular fa-circle-exclamation"></i>
                        </a>
                        <a class="btn btn-sm btn-danger" href="#modalDelete{{ $loop->iteration }}" data-bs-toggle="modal">
                          <i class="fa-regular fa-trash-can"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </li>

                {{-- Modal Delete Payment Method --}}
                <div class="modal fade" id="modalDelete{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="/dashboard/delete-payment-method" method="post">
                        @csrf
                        <div class="modal-body">
                          <input type="hidden" name="id" value="{{ $method->id }}">
                          <p class="fs-6">Are you sure want to delete <b>{{ $method->method }}</b> ?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                {{-- End Modal Delete Payment Method --}}

                {{-- Modal Edit Payment Method --}}
                <div class="modal fade" id="modalEdit{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Payment Method</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="/dashboard/payment-method" method="post">
                        @method('put')
                        @csrf
                        <div class="modal-body">
                          <input type="hidden" name="id" value="{{ $method->id }}">
                          <div class="mb-3">
                            <label for="method" class="form-label">Payment Method</label>
                            <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-credit-card"></i></span>
                              <input type="text" class="form-control" id="method" name="method" aria-describedby="basic-addon1" value="{{ old('method', $method->method) }}">
                            </div>
                          </div>
                          <div class="mb-3">
                            <label for="acc_number" class="form-label">Account Number</label>
                            <div class="input-group">
                              <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-university"></i></span>
                              <input type="text" class="form-control" id="acc_number" name="acc_number" aria-describedby="basic-addon1" value="{{ old('acc_number', $method->acc_number) }}">
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-dark">Update</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                {{-- End Modal Edit Payment Method --}}
              @endforeach
            </ul>
          </div>
        </div>
      @endcan
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header fw-semibold">
            Change Password
          </div>
          <form action="/dashboard/update-password" method="post">
            @method('put')
            @csrf
            <div class="card-body">
              <div class="mb-3">
                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                <label for="password" class="form-label">New Password</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fa-regular fa-lock"></i></span>
                  <input type="password" class="form-control" id="password" name="password" aria-describedby="basic-addon1" required>
                </div>
              </div>
              <div class="mb-3">
                <label for="password2" class="form-label">Confirm New Password</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fa-regular fa-lock"></i></span>
                  <input type="password" class="form-control" id="password2" name="password2" aria-describedby="basic-addon1" required>
                </div>
              </div>
              <div class="text-end">
                <button type="submit" class="btn btn-dark">Change Password</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="row mt-3 my-5">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header fw-semibold">
            Account Setting
          </div>
          <form action="/dashboard/update-password" method="post">
            @method('put')
            @csrf
            <div class="card-body">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fa-regular fa-at"></i></span>
                  <input type="email" class="form-control" id="email" name="email" aria-describedby="basic-addon1" value="{{ auth()->user()->email }}" disabled>
                  <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                </div>
              </div>
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1">+62</span>
                  <input type="text" class="form-control" id="phone" name="phone" aria-describedby="basic-addon1" value="{{ old('phone', auth()->user()->phone) }}" required>
                </div>
              </div>
              <div class="text-end">
                <button type="submit" class="btn btn-dark">Update</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>

  {{-- Modal Create Payment Method --}}
  <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Payment Method</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/dashboard/payment-method" method="post">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="method" class="form-label">Payment Method</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-credit-card"></i></span>
                <input type="text" class="form-control" id="method" name="method" aria-describedby="basic-addon1">
              </div>
            </div>
            <div class="mb-3">
              <label for="acc_number" class="form-label">Account Number</label>
              <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-university"></i></span>
                <input type="text" class="form-control" id="acc_number" name="acc_number" aria-describedby="basic-addon1">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark">Create</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  {{-- End Modal Create Payment Method --}}
@endsection
