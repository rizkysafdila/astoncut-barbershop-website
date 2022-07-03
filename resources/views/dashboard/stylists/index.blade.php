@extends('dashboard.layouts.main')

@section('container')
  <div class="container px-0">
    <div class="row pt-3">
      <div class="col-lg-12">
        <a class="btn btn-dark" href="#modalCreate" data-bs-toggle="modal">
          <i class="fa-regular fa-plus me-2"></i>
          Add New
        </a>
      </div>
      <div class="col-sm-6 col-lg-12">
        @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show mb-0 mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="card my-3">
          <div class="card-body">
            <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle" style="width:100%">
              <thead>
                <tr>
                  <th>Stylist ID</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($stylists as $stylist)
                  <tr>
                    <td>{{ '#' . $stylist->id }}</td>
                    <td>{{ $stylist->name }}</td>
                    <td>{{ $stylist->phone }}</td>
                    <td>{{ $stylist->address }}</td>
                    <td>
                      @if ($stylist->status == 1)
                        <button type="button" class="btn btn-sm badge btn-success">Available</button>
                      @elseif ($stylist->status == 2)
                        <button type="button" class="btn btn-sm badge btn-danger">Not Available</button>
                      @endif
                    </td>
                    <td>
                      <a class="btn btn-sm btn-warning" href="#modalEdit{{ $loop->iteration }}" data-bs-toggle="modal">
                        <i class="fa-regular fa-pen-to-square"></i>
                      </a>
                      <a class="btn btn-sm btn-danger" href="#modalDelete{{ $loop->iteration }}" data-bs-toggle="modal">
                        <i class="fa-regular fa-trash-can"></i>
                      </a>
                    </td>
                  </tr>

                  {{-- Modal Edit --}}
                  <div class="modal fade" id="modalEdit{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Add New Stylist</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/dashboard/stylists/{{ $stylist->id }}" method="post">
                          @csrf
                          @method('put')
                          <div class="modal-body">
                            <div class="mb-3">
                              <label for="name" class="form-label">Name</label>
                              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $stylist->name) }}" required autofocus>
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
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" aria-describedby="basic-addon1" value="{{ old('phone', $stylist->phone) }}" required>
                              </div>
                              @error('phone')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <label for="address" class="form-label">Address</label>
                              <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $stylist->address) }}" required>
                              @error('address')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                              @enderror
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
                  {{-- End Modal Edit --}}

                  {{-- Modal Delete --}}
                  <div class="modal fade" id="modalDelete{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Delete Member</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/dashboard/stylists/{{ $stylist->id }}" method="post">
                          @method('delete')
                          @csrf
                          <div class="modal-body">
                            <p class="fs-6">Are you sure want to delete <b>{{ $stylist->name }}</b> ?</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  {{-- End Modal Delete --}}
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal Create --}}
  <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Stylist</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/dashboard/stylists" method="post">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus>
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
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" required autofocus>
              @error('address')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
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
  {{-- End Modal Create --}}
@endsection
