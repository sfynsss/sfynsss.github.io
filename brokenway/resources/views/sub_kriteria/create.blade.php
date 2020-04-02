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
                                <h3 class="mb-0">{{ __('Input Sub Kriteria') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('kriteria') }}/{{$data->id_kriteria}}/{{ 'subkriteria' }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ url('subkriteria/store') }}/{{$data->id_kriteria}}" autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Create Sub Kriteria') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">{{ __('ID') }}</label>
                                    <input type="text" id="id" class="form-control form-control-alternative" placeholder="{{ __('ID') }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">{{ __('Nama Kritera') }}</label>
                                    <input type="text" name="nama_kriteria" id="nama_kriteria" class="form-control form-control-alternative" required autofocus value="{{$data->nama_kriteria}}" readonly="">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">{{ __('Nama Sub Kriteria') }}</label>
                                    <input type="text" name="nama_sub_kriteria" id="nama_sub_kriteria" class="form-control form-control-alternative" placeholder="{{ __('Nama Sub Kriteria') }}" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">{{ __('Nilai') }}</label>
                                    <input type="number" id="nilai" name="nilai" class="form-control form-control-alternative" placeholder="{{ __('0') }}" min="0" max="100">
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