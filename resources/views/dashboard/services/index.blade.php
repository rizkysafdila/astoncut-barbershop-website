@extends('dashboard.layouts.main')

@section('container')
  <div class="container px-0">
    <div class="row pt-3">
      <div class="col-sm-6 col-lg-8">
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalCreate">
          <i class="fa-regular fa-plus me-2"></i>
          Add New
        </button>
      </div>
      <div class="col-sm-8">
        @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show mb-0 mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6 col-md-12 col-lg-8">
        <div class="card my-3">
          <div class="card-body">
            <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Service ID</th>
                  <th>Service</th>
                  <th>Price</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($services as $service)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                      {{ '#' . $service->id }}
                    </td>
                    <td>{{ $service->service }}</td>
                    <td>
                      {{ 'Rp' . number_format($service->price, 0, ',', '.') }}
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
                          <h5 class="modal-title" id="exampleModalLabel">Add New Service</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/dashboard/services/{{ $service->id }}" method="post">
                          @method('put')
                          @csrf
                          <div class="modal-body">
                            <div class="mb-3">
                              <label for="service" class="form-label">Service</label>
                              <input type="text" class="form-control @error('service') is-invalid @enderror" id="service" name="service" value="{{ old('service', $service->service) }}" required autofocus>
                              @error('service')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <label for="price" class="form-label">Price</label>
                              <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" aria-describedby="basic-addon1" value="{{ old('price', $service->price) }}" required>
                              </div>
                              @error('price')
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
                        <form action="/dashboard/services/{{ $service->id }}" method="post">
                          @method('delete')
                          @csrf
                          <div class="modal-body">
                            <p class="fs-6">Are you sure want to delete <b>{{ $service->service }}</b> ?</p>
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

    {{-- Modal Create --}}
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Service</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="/dashboard/services" method="post">
            @csrf
            <div class="modal-body">
              <div class="mb-3">
                <label for="service" class="form-label">Service</label>
                <input type="text" class="form-control @error('service') is-invalid @enderror" id="service" name="service" required autofocus>
                @error('service')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon1">Rp</span>
                  <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" aria-describedby="basic-addon1" required>
                </div>
                @error('price')
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
  </div>
@endsection
