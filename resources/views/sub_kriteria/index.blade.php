@extends('layouts.app', ['title' => __('Kriteria')])

@section('content')
@include('layouts.headers.header')

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Sub Kriteria') }} {{$kriteria->nama_kriteria}}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ url('kriteria')}}/{{$kriteria->id_kriteria}}/{{'subkriteria/create'}}" class="btn btn-sm btn-primary">{{ __('Tambah Sub Kriteria') }}</a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('No') }}</th>
                                <th scope="col">{{ __('Sub Kriteria') }}</th>
                                <th scope="col">{{ __('Nilai') }}</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($no = 1)
                            @foreach($subkriteria as $data)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$data->subkriteria}}</td>
                                <td>{{$data->nilai}}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{ url('subkriteria/edit/' ) }}/{{$data->id_subkriteria}}">{{ __('Edit') }}</a>
                                                <a class="dropdown-item" href="{{ url('subkriteria/destroy/' ) }}/{{$data->id_subkriteria}}">{{ __('Delete') }}</a>
                                            </form>  
                                        </div>
                                    </div>  
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{-- {{ $users->links() }} --}}
                    </nav>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection