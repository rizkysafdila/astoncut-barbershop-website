@extends('dashboard.layouts.main')

@section('container')
  <div class="row">
    <div class="col-sm-6">
      <a class="btn btn-secondary mb-3" href="/dashboard/my-reservations">
        <i class="fa-regular fa-chevron-left me-2"></i>
        Back
      </a>
      <div class="card">
        <div class="card-body">
          <form action="/dashboard/my-reservations" method="post">
            @csrf
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
                  @if (old('service_id') == $service->id)
                    <option value="{{ $service->id }}" selected>{{ $service->service }}</option>
                  @else
                    <option value="{{ $service->id }}">{{ $service->service }}</option>
                  @endif
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="time" class="form-label">Time</label>
              <input type="datetime-local" class="form-control @error('time') is-invalid @enderror" id="time" name="time" required>
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
                  @if (old('stylist_id') == $stylist->id)
                    <option value="{{ $stylist->id }}" selected>{{ $stylist->name }}</option>
                  @else
                    <option value="{{ $stylist->id }}">{{ $stylist->name }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-dark px-4">Create</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
