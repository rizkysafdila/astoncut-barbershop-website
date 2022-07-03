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
    </div>

    <div class="row">
      <div class="col">
        <div class="card my-3">
          <div class="card-body">
            <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle" style="width:100%">
              <thead>
                <tr>
                  <th>Orded ID</th>
                  <th>Customer</th>
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
                    <td>{{ $customer->service->service }}</td>
                    <td>
                      @php
                        $datetime = $customer->time;
                        $time = explode(' ', $datetime);
                        $hm = explode(':', $time[1]);
                        
                        echo $hm[0] . ':' . $hm[1] . ' WIB';
                      @endphp
                    </td>
                    <td>{{ $customer->stylist->name }}</td>
                    <td>
                      @if ($customer->status == 1)
                        <button type="button" class="btn btn-sm badge btn-warning text-dark">Pending</button>
                      @elseif ($customer->status == 2)
                        <button type="button" class="btn btn-sm badge btn-success">Confirmed</button>
                      @elseif ($customer->status == 3)
                        <button type="button" class="btn btn-sm badge btn-danger">Canceled</button>
                      @endif
                    </td>
                    <td>
                      @if ($customer->status == 2)
                        <a class="btn btn-sm btn-primary" href="#modalPay{{ $loop->iteration }}" data-bs-toggle="modal">
                          <i class="fa-regular fa-money-bill-simple-wave me-1"></i>
                          Pay
                        </a>
                      @endif
                      @if ($customer->status != 3)
                        <a class="btn btn-sm btn-warning" href="#modalEdit{{ $loop->iteration }}" data-bs-toggle="modal">
                          <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                      @endif
                      <a class="btn btn-sm btn-danger" href="#modalDelete{{ $loop->iteration }}" data-bs-toggle="modal">
                        <i class="fa-regular fa-trash-can"></i>
                      </a>
                    </td>
                  </tr>
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
