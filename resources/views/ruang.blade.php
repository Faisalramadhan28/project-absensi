@if(!isset($data))
@php
    info('$data is not set');
@endphp
{{view('404')}}

@else
{{-- Style for dots in chart --}}
<style>
    .hadir{
        background-color: rgb(153, 255, 153);
    }
    .tidak-hadir{
        background-color: rgb(255, 153, 153);
    }
</style>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ruang {{$data['ruang']}}</h1>
</div>

<div class="row g-4 align-items-center">
    {{-- Pie Chart --}}
    <div class="col-sm-6 col-xl-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Kehadiran</h5>
                <div class="col-12 mb-3">
                    <canvas id="lab"></canvas>
                </div>
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <div class="position-relative d-inline">
                            <span class="position-absolute translate-middle-y top-50 p-2 hadir rounded-circle"></span>
                        </div>
                        <div class="d-inline ml-4">
                            Hadir : {{$data['kehadiran']['hadir']}}
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="position-relative d-inline">
                            <span class="position-absolute translate-middle-y top-50 p-2 tidak-hadir rounded-circle"></span>
                        </div>
                        <div class="d-inline ml-4">
                            Tidak Hadir : {{$data['kehadiran']['tidak_hadir']}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Info Detail --}}
    <div class="col-sm-6 col-xl-6">
        <div class="row justify-content-center gy-4">
            <div class="col-xl-8">
                <div class="card border-left-info shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12 text-info">
                                <strong>Mata Pelajaran</strong>
                            </div>
                            <div class="col">
                                {{$data['mapel']}}
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-book fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card border-left-success shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12 text-success">
                                <strong>Guru</strong>
                            </div>
                            <div class="col">
                                {{$data['guru']}}
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-person-chalkboard fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card border-left-primary shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12 text-primary">
                                <strong>Kelas</strong>
                            </div>
                            <div class="col">
                                {{$data['kelas']}}
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-people-roof fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card border-left-danger shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12 text-danger">
                                <strong>Jam Mata Pelajaran</strong>
                            </div>
                            <div class="col">
                                {{$data['durasi']}}
                            </div>
                            <div class="col-auto">
                                <i class="fa-regular fa-clock fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <h5 class="card-title"><strong>Absensi</strong></h5>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Mapel</th>
                            <th scope="col">Status</th>
                            <th scope="col">Jam Masuk</th>
                            <th scope="col">Jam Keluar</th>
                            <th scope="col">Ruang</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['murid'] as $row)
                            <tr @php
                                if($row['status'] == 'Hadir') {
                                    echo 'class="table-success"';
                                }
                                else if($row['status'] == 'Tidak Hadir'){
                                    echo 'class="table-danger"';
                                }
                                else{
                                    echo 'class="table-warning"';
                                }
                            @endphp>
                                <td scope="row">{{$row['nama']}}</td>
                                <td scope="row">{{$row['kelas']}}</td>
                                <td scope="row">{{$row['tanggal']}}</td>
                                <td scope="row">{{$data['mapel']}}</td>
                                <td scope="row">{{$row['status']}}</td>
                                <td scope="row">{{$row['jam_masuk']}}</td>
                                <td scope="row">{{$row['jam_keluar']}}</td>
                                <td scope="row">{{$data['ruang']}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm edit-btn" data-id="{{$row['id_absensi']}}" data-status="{{$row['status']}}" data-toggle="modal" data-target="#modalEdit">Edit</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <table>

            </table>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Status Murid</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
      <form method="POST" action="/edit/absensi">
        @csrf
        <input type="text" class="d-none" id="editId" name="id">

        <div class="form-group">
            <label for="sel1">Status Murid</label>
            <select class="form-control" name="status">
                <option disabled selected value="">--Pilih Status Murid--</option>
              <option>Hadir</option>
              <option>Tidak Hadir</option>
              <option>Izin</option>
              <option>Sakit</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
  </form>
</div>
</div>
</div>

<script>
var editbtn = document.getElementsByClassName('edit-btn');
const lab = document.getElementById('lab');

for(var x = 0; x < editbtn.length; x++){
        editbtn[x].addEventListener('click', function () {
            document.getElementById('editId').value = this.dataset.id;
        })
    }

new Chart(lab, {
type: "pie",
data: {
    labels: [
        'Hadir',
        'Tidak Hadir'
    ],
    datasets: [{
        data: [{{$data['kehadiran']['hadir']}}, {{$data['kehadiran']['tidak_hadir']}}],
        backgroundColor: [
        'rgb(153, 255, 153)',
        'rgb(255, 153, 153)'
        ],
        hoverOffset: 4
    }]
},
options: {
    responsive: true,
    plugins: {
    legend: {
        display: true
    },
    title: {
        display: true,
        text: "Absensi {{$data['ruang']}}"
    }
    }
},
})
</script>

@endif
