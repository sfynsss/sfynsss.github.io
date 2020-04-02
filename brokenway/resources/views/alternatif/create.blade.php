@extends('layouts.app', ['title' => __('Create Kriteria')])

@section('content')
    @include('layouts.headers.header')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Kriteria Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('kriteria.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('kriteria.store') }}" autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Create Kriteria') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">{{ __('ID') }}</label>
                                    <input type="text" id="id" class="form-control form-control-alternative" placeholder="{{ __('ID') }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">{{ __('Nama Kritera') }}</label>
                                    <input type="text" name="nama_kriteria" id="nama_kriteria" class="form-control form-control-alternative" placeholder="{{ __('Nama Kriteria') }}" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">{{ __('Bobot') }}</label>
                                    <input type="number" id="bobot" name="bobot" class="form-control form-control-alternative" placeholder="{{ __('0') }}" min="0" max="100">
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection