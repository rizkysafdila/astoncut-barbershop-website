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
                        <a class="btn btn-sm btn-dark" href="#modalPay{{ $loop->iteration }}" data-bs-toggle="modal">
                          <i class="fa-duotone fa-money-bill-simple-wave me-1"></i>
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

                  {{-- Modal Pay --}}
                  <div class="modal fade" id="modalPay{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Payment Process</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/dashboard/transactions" method="post">
                          @csrf
                          <div class="modal-body">
                            <input type="hidden" name="order_id" value="{{ $customer->id }}">
                            <div class="mb-3">
                              <label for="name" class="form-label">Customer Name</label>
                              <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}" disabled>
                              <input type="hidden" name="name" value="{{ $customer->name }}">
                            </div>

                            <div class="mb-3">
                              <label for="phone" class="form-label">Phone Number</label>
                              <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">+62</span>
                                <input type="text" class="form-control" id="phone" name="phone" aria-describedby="basic-addon1" value="{{ $customer->phone }}" disabled>
                                <input type="hidden" name="phone" value="{{ $customer->phone }}">
                              </div>
                            </div>

                            <div class="mb-3">
                              <label for="service_id" class="form-label">Service</label>
                              <input type="text" class="form-control" id="service_id" name="service_id" value="{{ $customer->service->service }}" disabled>
                              <input type="hidden" name="service_id" value="{{ $customer->service_id }}">
                            </div>

                            <div class="mb-3">
                              <label for="price" class="form-label">Price</label>
                              <input type="text" class="form-control" id="price" name="price" value="{{ 'Rp' . number_format($customer->service->price, 0, ',', '.') }}" disabled>
                              <input type="hidden" name="price" value="{{ $customer->service->price }}">
                            </div>

                            <div class="mb-3">
                              <label for="payment_method" class="form-label">Payment Method</label>
                              <select class="form-select" name="payment_method" id="payment_method" required>
                                @foreach ($methods as $method)
                                  @if (old('payment_method') == $method->id)
                                    <option value="{{ $method->id }}" selected>{{ $method->method }}</option>
                                  @else
                                    <option value="{{ $method->id }}">{{ $method->method }}</option>
                                  @endif
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark">Continue</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  {{-- End Modal Pay --}}

                  @if ($customer->status == 1)
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
                  @else
                    {{-- Modal Status Alert --}}
                    <div class="modal fade" id="modalStatus{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                              <i class="fa-regular fa-circle-exclamation me-1"></i>
                              Alert
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Status can only be changed when it's still <span class="badge text-bg-warning">Pending</span>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- End Modal Status Alert --}}
                  @endif

                  {{-- Modal Delete --}}
                  <div class="modal fade" id="modalDelete{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Delete Member</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/dashboard/customers/{{ $customer->id }}" method="post">
                          @method('delete')
                          @csrf
                          <div class="modal-body">
                            <p class="fs-6">Are you sure want to delete reservation <b>{{ '#' . $customer->id }}</b> ?</p>
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
