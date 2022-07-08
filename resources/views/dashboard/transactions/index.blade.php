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
                      <a class="btn btn-sm btn-dark" href="#modalPay{{ $loop->iteration }}" data-bs-toggle="modal">
                        <i class="fa-duotone fa-money-bill-simple-wave me-1"></i>
                        Pay
                      </a>
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
