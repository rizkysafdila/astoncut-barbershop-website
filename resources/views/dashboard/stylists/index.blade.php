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
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
