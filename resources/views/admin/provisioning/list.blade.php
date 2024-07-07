@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <h3 class="">List of Services</h3>
            </div>
            <div class="col-auto ml-auto">
                <a href="{{route('services.create')}}">
                    <button type="button" class="btn btn-outline-primary">{{ __('Create') }}</button>
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Storage(GB)</th>
                    <th class="text-center">Bandwidth(GB)</th>
                    <th class="text-center">Service Type</th>
                    <th class="text-center">IP</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td class="text-center">{{ $service['id'] }}</td>
                        <td class="text-center">{{ $service['storage'] }}</td>
                        <td class="text-center">{{ $service['bandwidth'] }}</td>
                        <td class="text-center">{{ $service['service_type'] }}</td>
                        <td class="text-center">{{ $service['ip_address'] }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Service Actions">
                                <form action="{{route('services.suspend')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="service_id" value="{{ $service['id'] }}">
                                    <button type="submit" class="btn btn-outline-dark me-2">{{ __('Suspend') }}</button>
                                </form>
                                <form action="{{route('services.terminate')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="service_id" value="{{ $service['id'] }}">
                                    <button type="submit" class="btn btn-outline-danger">{{ __('Terminate') }}</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

