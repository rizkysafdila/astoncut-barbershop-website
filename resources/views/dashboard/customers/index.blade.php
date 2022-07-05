@extends('dashboard.layouts.main')

@section('container')
  <div class="container px-0">
    <div class="row pt-3">
      <div class="col-lg-9">
        <a class="btn btn-dark" href="/dashboard/customers/create">
          <i class="fa-regular fa-plus me-2"></i>
          Add New
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
                  <th>Customer</th>
                  <th>Phone Number</th>
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
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->phone }}</td>
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
                      <button type="button" class="btn btn-sm badge {{ $bg }}" data-bs-toggle="modal" data-bs-target="#modalStatus{{ $loop->iteration }}">{{ $status }}</button>
                    </td>
                    <td>
                      @if ($customer->status == 2)
                        <a class="btn btn-sm btn-primary" href="#modalPay{{ $loop->iteration }}" data-bs-toggle="modal">
                          <i class="fa-regular fa-money-bill-simple-wave me-1"></i>
                          Pay
                        </a>
                      @elseif ($customer->status != 3)
                        <a class="btn btn-sm btn-warning" href="customers/{{ $customer->id }}/edit">
                          <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                      @elseif ($customer->status != 1)
                        <a class="btn btn-sm btn-danger" href="#modalDelete{{ $loop->iteration }}" data-bs-toggle="modal">
                          <i class="fa-regular fa-trash-can"></i>
                        </a>
                      @endif
                    </td>
                  </tr>

                  {{-- Modal Update Status --}}
                  <div class="modal fade" id="modalStatus{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Update Reservation Status</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/dashboard/customers" method="post">
                          @method('put')
                          @csrf
                          <div class="modal-body">
                            <input type="hidden" name="id" value="{{ $customer->id }}">
                            <div class="mb-3">
                              <label for="status" class="form-label">Status</label>
                              <select class="form-select" name="status" id="status" required>
                                <option class="text-muted" selected disabled>-Select One-</option>
                                <option value="1">Pending</option>
                                <option value="2">Confirmed</option>
                                <option value="3">Canceled</option>
                                <option value="4">Change Time</option>
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
                  {{-- End Modal Update Status --}}
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
