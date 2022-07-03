@extends('dashboard.layouts.main')

@section('container')
  <div class="row">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <form action="" method="post">
            @csrf
            <div class="mb-3">
              <label for="customer" class="form-label">Customer Name</label>
              <input type="text" class="form-control @error('service') is-invalid @enderror" id="customer" name="customer" required>
            </div>
            @error('customer')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror

            <div class="mb-3">
              <label for="service" class="form-label">Service</label>
              <select class="form-select" name="service_id" id="service" required>
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
            </div>

            <div class="mb-3">
              <label for="stylist" class="form-label">Stylist</label>
              <select class="form-select" name="stylist_id" id="stylist" required>
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
