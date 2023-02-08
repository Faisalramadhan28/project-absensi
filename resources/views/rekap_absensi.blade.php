@php
    $kelas = App\Http\Controllers\GetDataController::getKelas();
    $data = array('kelas' => $kelas);
    $index = 1;
@endphp

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Rekap Absensi Murid</h1>
</div>

<!-- Button trigger modal -->
<form method="POST" action="/filter/rekap_absensi">
@csrf
<div class="row align-items-center mb-3">
    <div class="col-md-3">
        <label>Rekap</label>
        <div class="form-group m-0">
            <select class="form-control" name="rekap">
                <option style="display: none" disable selected></option>
                <option>Per 1 Minggu</option>
                <option>Per 2 Minggu</option>
                <option>Per 3 Minggu</option>
                <option>Per Bulan</option>
                <option>All</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <label>Kelas</label>
        <select class="form-control form-select" name="kelas">
            <option style="display: none" disable selected>Pilih Kelas</option>
            @foreach ($data['kelas'] as $row)
                <option>{{$row['kelas']}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 align-self-end">
        <div class="btn-group" role="group">
            <div>
                <button type="submit" class="btn btn-primary h-100">Find</button>
            </div>

            <button type="button" class="btn btn-success dropdown-toggle ml-3 rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Export
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">PDF</a>
                <a class="dropdown-item" href="#">Excel</a>
            </div>
        </div>
    </div>
</div>
</form>

<!--<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
+ Tambah
</button>-->
<div class="table-responsive">
<table class="table table-striped table-hover">
<thead>
  <tr>
    <th scope="col">No</th>
    <th scope="col">Nama</th>
    <th scope="col">Kelas</th>
    <th scope="col">Tanggal</th>
    <th scope="col">Mata Pelajaran</th>
    <th scope="col">Status</th>
    <th scope="col">Jam Masuk</th>
    <th scope="col">Jam Keluar</th>
    <th scope="col">Ruang</th>
  </tr>
</thead>
<tbody>
  <tr>
    <th scope="row">1</th>
    <td>Saya</td>
    <td>XI TKJ 1</td>
    <td>24/01/23</td>
    <td>Adm Sistem Jaringan</td>
    <td>Hadir</td>
    <td>08:20:06</td>
    <td>13:15:00</td>
    <td>Lab 1 TKJ</td>
  </tr>
  <tr>
    <th scope="row">1</th>
    <td>Kamu</td>
    <td>XI TKJ 1</td>
    <td>29/01/23</td>
    <td>Teknologi Layanan & Jaringan</td>
    <td>Hadir</td>
    <td>07:15:09</td>
    <td>09:25:00</td>
    <td>4</td>
  </tr>
</tbody>
</table>
</div>

<script>
    document.getElementById('test').onchange = function(s){
        console.log(this.option);
    }
</script>
