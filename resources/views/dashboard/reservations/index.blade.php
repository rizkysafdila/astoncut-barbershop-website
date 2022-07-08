@extends('dashboard.layouts.main')

@section('container')
  <div class="container px-0">
    <div class="row pt-3">
      <div class="col-lg-9">
        <a class="btn btn-dark" href="/dashboard/my-reservations/create">
          <i class="fa-regular fa-plus me-2"></i>
          Create New
        </a>
      </div>
      <div class="col-lg-3">
        <input type="date" class="form-control rounded-3" name="date" id="theDate">
      </div>
      <div class="row">
        <div class="col-sm-6 col-lg-12">
          @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show mb-0 mt-3" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="card my-3">
          <div class="card-body">
            <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle" style="width:100%">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Service</th>
                  <th>Time</th>
                  <th>Stylist</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($customers as $customer)
                  <tr>
                    <td>{{ '#' . $customer->id }}</td>
                    <td>{{ $customer->service->service }}</td>
                    <td>
                      {{ $customer->time }}
                    </td>
                    <td>{{ $customer->stylist->name }}</td>
                    <td>
                      @php
                        if ($customer->status == 1) {
                            $bg = 'btn-warning text-dark';
                            $status = 'Pending';
                        } elseif ($customer->status == 2) {
                            $bg = 'btn-success';
                            $status = 'Confirmed';
                        } elseif ($customer->status == 3) {
                            $bg = 'btn-danger';
                            $status = 'Canceled';
                        } elseif ($customer->status == 4) {
                            $bg = 'btn-info text-dark';
                            $status = 'Change Time';
                        }
                      @endphp
                      <span class="btn btn-sm badge {{ $bg }}">{{ $status }}</span>
                    </td>
                    <td>
                      @if ($customer->status == 2)
                        <a class="btn btn-sm btn-primary" href="#modalPay{{ $loop->iteration }}" data-bs-toggle="modal">
                          <i class="fa-regular fa-money-bill-simple-wave me-1"></i>
                          Pay
                        </a>
                      @elseif ($customer->status != 3)
                        <a class="btn btn-sm btn-warning" href="#modalEdit{{ $loop->iteration }}" data-bs-toggle="modal">
                          <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <a class="btn btn-sm btn-danger" href="#modalCancel{{ $loop->iteration }}" data-bs-toggle="modal">
                          <i class="fa-regular fa-xmark fa-lg"></i>
                        </a>
                      @endif
                    </td>
                  </tr>

                  {{-- Modal Edit --}}
                  <div class="modal fade" id="modalEdit{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Reservation</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/dashboard/my-reservations/" method="post">
                          @method('put')
                          @csrf
                          <div class="modal-body">
                            <input type="hidden" name="id" value="{{ $customer->id }}">
                            <div class="mb-3">
                              <label for="name" class="form-label">Customer Name</label>
                              <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" disabled>
                              <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                            </div>

                            <div class="mb-3">
                              <label for="phone" class="form-label">Phone Number</label>
                              <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">+62</span>
                                <input type="text" class="form-control" id="phone" name="phone" aria-describedby="basic-addon1" value="{{ auth()->user()->phone }}" disabled>
                                <input type="hidden" name="phone" value="{{ auth()->user()->phone }}">
                              </div>
                            </div>

                            <div class="mb-3">
                              <label for="service_id" class="form-label">Service</label>
                              <select class="form-select" name="service_id" id="service_id" required>
                                @foreach ($services as $service)
                                  @if (old('service_id', $customer->service_id) == $service->id)
                                    <option value="{{ $service->id }}" selected>{{ $service->service }}</option>
                                  @else
                                    <option value="{{ $service->id }}">{{ $service->service }}</option>
                                  @endif
                                @endforeach
                              </select>
                            </div>

                            <div class="mb-3">
                              <label for="time" class="form-label">Time</label>
                              <input type="datetime-local" class="form-control @error('time') is-invalid @enderror" id="time" name="time" value="{{ old('time', $customer->time) }}" required>
                              <div id="timeHelp" class="form-text">Select time between <span class="fw-semibold">11:00 WIB</span> and <span class="fw-bold">22:00 WIB</span></div>
                              @error('time')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                              @enderror
                            </div>

                            <div class="mb-3">
                              <label for="stylist_id" class="form-label">Stylist</label>
                              <select class="form-select" name="stylist_id" id="stylist_id" required>
                                @foreach ($stylists as $stylist)
                                  @if (old('stylist_id', $customer->stylist_id) == $stylist->id)
                                    <option value="{{ $stylist->id }}" selected>{{ $stylist->name }}</option>
                                  @else
                                    <option value="{{ $stylist->id }}">{{ $stylist->name }}</option>
                                  @endif
                                @endforeach
                              </select>
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

                  {{-- Modal Cancel --}}
                  <div class="modal fade" id="modalCancel{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Delete Member</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/dashboard/my-reservations" method="post">
                          @method('put')
                          @csrf
                          <div class="modal-body">
                            <p class="fs-6">Are you sure want to cancel reservation ?</p>
                            <input type="hidden" name="id" value="{{ $customer->id }}">
                            <input type="hidden" name="status" value="3">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-outline-danger">Yes</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  {{-- End Modal Cancel --}}
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;

    var today = year + "-" + month + "-" + day;
    document.getElementById("theDate").value = today;
  </script>
@endsection
