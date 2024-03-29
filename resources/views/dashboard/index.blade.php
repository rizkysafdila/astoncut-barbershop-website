@extends('dashboard.layouts.main')

@section('container')
  <section id="info">
    <div class="container px-0">
      <div class="row mb-3">
        <div class="col-sm-6">
          <h1 class="fs-4">Welcome Back, {{ auth()->user()->name }}</h1>
        </div>
      </div>

      @can('admin')
        <div class="row gap-2">
          <div class="col">
            <div class="card">
              <div class="card-body d-flex align-items-center">
                <i class="fa-duotone fa-square-check fa-3x text-success"></i>
                <div class="d-flex flex-column ms-3">
                  <h5 class="card-title fs-6 mb-0">Confirmed</h5>
                  <p class="card-text fs-4 fw-semibold">{{ $confirmed_amount }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="card-body d-flex align-items-center">
                <i class="fa-duotone fa-spinner fa-2x text-warning"></i>
                <div class="d-flex flex-column ms-3">
                  <h5 class="card-title fs-6 mb-0">Pending</h5>
                  <p class="card-text fs-4 fw-semibold">{{ $pending_amount }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="card-body d-flex align-items-center">
                <i class="fa-duotone fa-square-xmark fa-3x text-danger"></i>
                <div class="d-flex flex-column ms-3">
                  <h5 class="card-title fs-6 mb-0">Canceled</h5>
                  <p class="card-text fs-4 fw-semibold">{{ $canceled_amount }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="card-body d-flex align-items-center">
                <i class="fa-duotone fa-clock fa-2x text-info"></i>
                <div class="d-flex flex-column ms-3">
                  <h5 class="card-title fs-6 mb-0">Change Time</h5>
                  <p class="card-text fs-4 fw-semibold">{{ $change_time_amount }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-9">
            <div class="card my-3">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <h2 class="fs-5">Reservation</h2>
                  <a class="btn btn-sm btn-link text-decoration-none" href="/dashboard/customers">
                    View All
                  </a>
                </div>
                <table id="myTableDashboard" class="table responsive nowrap table-bordered table-striped align-middle" style="width:100%">
                  <thead>
                    <tr>
                      <th>Customer</th>
                      <th>Service</th>
                      <th>Time</th>
                      <th>Stylist</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($customers as $customer)
                      <tr>
                        <td>{{ $customer->name }}</td>
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
                          <button type="button" class="btn btn-sm badge {{ $bg }}">{{ $status }}</button>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      @endcan
    </div>
  </section>

  <script>
    $(document).ready(function() {
      $("#myTableDashboard").DataTable({
        "scrollX": true,
        "searching": false,
        "language": {
          "search": "",
          "searchPlaceholder": "Search...",
          "decimal": ",",
          "thousands": ".",
          "info": "",
        },
        "paging": false
      });
    });
  </script>
@endsection
