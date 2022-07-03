@extends('dashboard.layouts.main')

@section('container')
  <section id="info">
    <div class="container px-0">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body d-flex align-items-center">
              <i class="fa-duotone fa-square-check fa-3x text-success"></i>
              <div class="d-flex flex-column ms-3">
                <h5 class="card-title fs-6 mb-0">Confirmed</h5>
                <p class="card-text fs-4 fw-semibold">4</p>
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
                <p class="card-text fs-4 fw-semibold">1</p>
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
                <p class="card-text fs-4 fw-semibold">2</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="card">
            <div class="card-body d-flex align-items-start">
              <div class="col-md-4">
                <img class="img-fluid" src="{{ asset('img/rizky.jpg') }}" alt="{{ auth()->user()->name }}">
              </div>
              <div class="d-flex flex-column ms-3">
                <h5 class="card-title fs-5 mb-0">{{ auth()->user()->name }}</h5>
                <p class="card-text fw-semibold">Member Gold</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
