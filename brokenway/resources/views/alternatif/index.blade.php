@extends('layouts.app', ['title' => __('Alternatif')])

@section('content')
@include('layouts.headers.header')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nilai Alternatif</h5>
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
                            <h3 class="mb-0">{{ __('Data Jalan Berlubang (Alternatif)') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                          <a href="{{ url('perhitungan') }}" class="btn btn-sm btn-primary">{{ __('Hasil Perhitungan') }}</a>
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
                        @php $i = 1; @endphp
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('No') }}</th>
                                <th scope="col">{{ __('Nama User') }}</th>
                                <th scope="col">{{ __('Tgl Input') }}</th>
                                <th scope="col">{{ __('Lokasi') }}</th>
                                <th scope="col">{{ __('Gambar') }}</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $data)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->tgl_input}}</td>
                                <td>
                                    <a href="#" onclick="bukaPeta({{$data->lat}}, {{$data->lang}});" data-toggle="modal" data-target=".bd-example-modal-lg1">show</a>
                                </td>
                                <td>
                                    <a href="#" onclick="setImage('{{$data->gambar}}');" data-toggle="modal" data-target=".bd-example-modal-lg">show</a>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" onclick="setId({{$data->id_mst}});" data-toggle="modal" data-target="#exampleModal">{{ __('Detail') }}</a>
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

@section('script')
<script>
    function setId($id) {
        var view_url = "{{url('det_alternatif')}}"+"/"+$id;
        $.getJSON(view_url,function(result){
            console.log(result);
         // console.log(result);
         $("#isi").empty();
         result.forEach(function(r){
            $("#isi").append("<li class='list-group-item'>"+r['nama_kriteria']+"<strong style='float: right;'>"+r['nilai']+"</strong>"+"</li>")
        });
     });
    }

    function setImage($gambar) {
        $("#gambar_aktif").attr('src', "{{asset('storage')}}/images/"+$gambar);
        // $("#gambar_aktif").attr('src', "{{url('../brokenway_api')}}/storage/app/public/images/"+$gambar);
    }

    function bukaPeta($lat, $lang) {
        var map = new google.maps.Map(document.getElementById('map-canvas'), {
          zoom: 17,
          center: new google.maps.LatLng($lat, $lang),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();
        number = {
          // url: '../images/mobile/map-marker.png',
          size: new google.maps.Size(32, 38),
          scaledSize: new google.maps.Size(32, 38),
          labelOrigin: new google.maps.Point(0, 0)
        };

        var marker, i;
        marker = new google.maps.Marker({
            position: new google.maps.LatLng($lat, $lang),
            animation: google.maps.Animation.DROP,
            labelAnchor: new google.maps.Point(20, 0),
            icon :number,
            label: {
              text: "lokasi",
              color: "black",
              fontSize: "16px",
              fontWeight: "bold"
            },
            map: map
          });

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent("lokasi");
              infowindow.open(map, marker);
            }
          })(marker, i));
    }
</script>

@endsection