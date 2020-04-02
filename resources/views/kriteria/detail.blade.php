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
                            <h3 class="mb-0">{{ __('Kriteria') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('kriteria.create')}}" class="btn btn-sm btn-primary">{{ __('Tambah Kriteria') }}</a>
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
                                <th scope="col">{{ __('Nama Kriteria') }}</th>
                                <th scope="col">{{ __('Bobot (Wj)') }}</th>
                                <th scope="col">{{ __('Normalisasi (Wj / ∑Wj)') }}</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; $tot = 0; $tot_normalisasi = 0; @endphp
                            @foreach($data as $data)
                            @php 
                            $tot += $data->bobot;
                            $tot_normalisasi += $data->normalisasi;
                            @endphp
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$data->nama_kriteria}}</td>
                                <td>{{$data->bobot}}</td>
                                <td>{{$data->normalisasi}}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <form action="{{ route('kriteria.destroy', $data->id_kriteria ) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a class="dropdown-item" href="{{ url('kriteria/detail' ) }}/{{ $data->id_kriteria }}">{{ __('Detail') }}</a>
                                                <a class="dropdown-item" href="{{ route('kriteria.edit', $data->id_kriteria ) }}">{{ __('Edit') }}</a>
                                                <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this record?") }}') ? this.parentElement.submit() : ''">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>  
                                        </div>
                                    </div>  
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1"></th>
                                <th rowspan="1" colspan="1">∑Wj</th>
                                <th rowspan="1" colspan="1">{{$tot}}</th>
                                <th rowspan="1" colspan="1">{{$tot_normalisasi}}</th>
                                <th rowspan="1" colspan="1"></th>
                            </tr>
                        </tfoot>
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