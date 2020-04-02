@extends('layouts.app', ['title' => __('Alternatif')])

@section('content')
@include('layouts.headers.header')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hasil Perhitungan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-flush" id="isi">

        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Large modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Gambar Jalan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img id="gambar_aktif" style="width: 100%; height: 100%;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Large modal -->
<div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Gambar Jalan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="map-canvas" class="map-canvas" style="height: 600px; width: 100%;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt--7">
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">{{ __('Nilai Utility Alternatif') }}</h3>
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
            @php $no = 1; @endphp
            <thead class="thead-light">
              <tr>
                <th scope="col">{{ __('No') }}</th>
                <th scope="col">{{ __('Alternatif') }}</th>
                @foreach ($kriteria as $k)
                <th scope="col">{{ $k->nama_kriteria }}</th>
                @endforeach
                <th scope="col">hasil</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($alternatif as $i => $alter)
              <tr>
                <td>{{$no++}}</td>
                <td>{{'A'.$alter->id_mst}}</td>
                @foreach ($penilaian as $p => $pen)
                @if ($pen->id_alternatif == $alter->id_mst)
                <td>{{$pen->nilai_utility}}</td>
                @endif
                @endforeach
                <td>{{$alter->hasil}}</td>
                <td>
                  <a href="{{url('updateAlternatif')}}/{{$alter->id_mst}}" class="btn btn-sm btn-primary">{{ __('Proses') }}</a>
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

@section('script')
<script>



</script>

@endsection