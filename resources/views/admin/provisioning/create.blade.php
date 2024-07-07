@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <h3 class="col-12 text-center">Create Service</h3>
        </div>
        <form method="POST" action="{{ route('services.store') }}">
            @csrf

            <div class="row mb-3">
                <label for="service_type" class="col-md-3 col-form-label text-md-right">{{ __('Service Type') }}*</label>
                <div class="col-md-9">
                    <select id="service_type" class="form-control @error('service_type') is-invalid @enderror" name="service_type" required>
                        <option value="">Select Service Type</option>
                        <option value="shared" {{ old('service_type') == 'shared' ? 'selected' : '' }}>Shared Hosting</option>
                        <option value="vps" {{ old('service_type') == 'vps' ? 'selected' : '' }}>Virtual Private Server (VPS)</option>
                        <option value="dedicated" {{ old('service_type') == 'dedicated' ? 'selected' : '' }}>Dedicated Server</option>
                    </select>
                    @error('service_type')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="billing_cycle" class="col-md-3 col-form-label text-md-right">{{ __('Billing Cycle') }}*</label>
                <div class="col-md-9">
                    <select id="billing_cycle" class="form-control @error('billing_cycle') is-invalid @enderror" name="billing_cycle" required>
                        <option value="">Select Billing Cycle</option>
                        <option value="monthly" {{ old('billing_cycle') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                        <option value="annually" {{ old('billing_cycle') == 'annually' ? 'selected' : '' }}>Annually</option>
                    </select>
                    @error('billing_cycle')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" {{old('auto_renewal') == 1 ? 'checked' : ''}} id="auto_renewal" value="1" name="auto_renewal">
                        <label class="form-check-label" for="auto_renewal">
                            {{ __('Enable Auto-Renewal') }}
                        </label>
                    </div>
                    @error('auto_renewal')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="ip_address" class="col-md-3 col-form-label text-md-right">{{ __('IP Address') }}</label>
                <div class="col-md-9">
                    <input id="ip_address" type="text" class="form-control @error('ip_address') is-invalid @enderror" name="ip_address" value="{{ old('ip_address') }}">
                    @error('ip_address')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="storage" class="col-md-3 col-form-label text-md-right">{{ __('Storage Space (GB)') }}*</label>
                <div class="col-md-9">
                    <input id="storage" type="number" class="form-control @error('storage') is-invalid @enderror" name="storage" value="{{ old('storage') }}" required>
                    @error('storage')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="bandwidth" class="col-md-3 col-form-label text-md-right">{{ __('Bandwidth (GB)') }}*</label>
                <div class="col-md-9">
                    <input id="bandwidth" type="number" class="form-control @error('bandwidth') is-invalid @enderror" name="bandwidth" value="{{ old('bandwidth') }}" required>
                    @error('bandwidth')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 col-form-label text-md-right">
                    <label>{{ __('Email Notifications') }}</label>
                </div>
                <div class="col-md-9">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" {{old('email_notifications') == 1 ? 'checked' : ''}} id="email_notifications" name="email_notifications">
                        <label class="form-check-label" for="email_notifications">
                            {{ __('Send email notifications related to this service') }}
                        </label>
                    </div>
                    @error('email_notifications')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="description" class="col-md-3 col-form-label text-md-right">{{ __('Service Description') }}</label>
                <div class="col-md-9">
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12  text-center">
                    <a href="{{route('services.index')}}">
                        <button type="button" class="btn btn-outline-dark">{{ __('Back') }}</button>
                    </a>
                    <button type="submit" class="btn btn-outline-primary">{{ __('Create Service') }}</button>
                </div>
            </div>
          </form>
    </div>
@endsection

