@extends('dashboard.layouts.main')

@section('container')
  <div class="container px-0">
    <div class="row pt-3">
      <div class="col-lg-3 ms-auto">
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
                  <th>Transaction ID</th>
                  <th>Order ID</th>
                  <th>Time</th>
                  <th>Total</th>
                  <th>Payment Method</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($transactions as $transaction)
                  <tr>
                    <td>{{ '#' . $transaction->id }}</td>
                    <td>{{ '#' . $transaction->order_id }}</td>
                    <td>{{ $transaction->time }}</td>
                    <td>{{ 'Rp' . number_format($transaction->price, 0, ',', '.') }}</td>
                    <td>
                      {{ $transaction->paymentMethod->method }}
                      @if ($transaction->status == 1)
                        <a class="btn btn-sm btn-info ms-1" href="#modalPaymentInfo{{ $loop->iteration }}" data-bs-toggle="modal">
                          <i class="fa-regular fa-circle-exclamation"></i>
                        </a>
                      @endif
                    </td>
                    <td>
                      @php
                        if ($transaction->status == 1) {
                            $bg = 'btn-warning text-dark';
                            $status = 'Pending';
                        } elseif ($transaction->status == 2) {
                            $bg = 'btn-success';
                            $status = 'Success';
                        } elseif ($transaction->status == 3) {
                            $bg = 'btn-danger';
                            $status = 'Failed';
                        }
                      @endphp
                      <span class="badge {{ $bg }}">{{ $status }}</span>
                    </td>
                    <td>
                      @if ($transaction->status == 1)
                        <a class="btn btn-sm btn-dark" href="#modalPay{{ $loop->iteration }}" data-bs-toggle="modal">
                          <i class="fa-regular fa-check"></i>
                        </a>
                      @endif
                    </td>
                  </tr>

                  {{-- Modal Payment Info --}}
                  <div class="modal fade" id="modalPaymentInfo{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Payment Informations</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col">
                              @if ($transaction->payment_method == 1)
                                Please make cash payment at the cashier
                              @else
                                <div class="mb-3">
                                  <label for="rek_number" class="form-label">Please make payment to the following account number:</label>
                                  <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-university"></i></span>
                                    <input type="text" class="form-control fw-semibold" id="rek_number" name="rek_number" aria-describedby="basic-addon1" value="{{ $transaction->paymentMethod->acc_number }}" disabled>
                                  </div>
                                  <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                                    <input type="text" class="form-control" id="on_behalf_of" name="on_behalf_of" aria-describedby="basic-addon1" value="Aston Cut Barbershop" disabled>
                                  </div>
                                </div>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- End Modal Payment Info --}}

                  {{-- Modal Confirm Payment --}}
                  <div class="modal fade" id="modalPay{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Confirm Payment</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/dashboard/transactions" method="post">
                          @method('put')
                          @csrf
                          <div class="modal-body">
                            <input type="hidden" name="id" value="{{ $transaction->id }}">
                            <input type="hidden" name="status" value="2">
                            <div class="mb-3">
                              <label for="status" class="form-label">Confirm Payment</label>
                              <select class="form-select" name="status" id="status" required>
                                <option value="2">Accepted</option>
                                <option value="3">Declined</option>
                              </select>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-dark">Confirm</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  {{-- End Modal Confirm Payment --}}
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
