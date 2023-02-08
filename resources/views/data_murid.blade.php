@php
    $index = 1;
@endphp
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Murid</h1>
</div>

<!-- Content Row -->

<!-- Button trigger modal -->
<form method="POST" action="/filter/data_murid">
@csrf
<div class="row align-items-center mb-3">
<div class="col-md-5">
    Kelas
</div>
<div class="col-md-5">
    Jurusan
</div>
<div class="col-md-5">
    <div class="form-group m-0">
        <select class="form-select form-control" name="kelas">
          <option value=" " disabled selected>Pilih Kelas</option>
          <option>X</option>
          <option>XI</option>
          <option>XII</option>
          <option>All</option>
        </select>
    </div>
</div>
<div class="col-md-5">
    <div class="form-group m-0">
        <select class="form-select form-control" name="jurusan">
          <option value=" " disabled selected>Pilih Jurusan</option>
          <option>TJKT 1</option>
          <option>TJKT 2</option>
          <option>TJKT 3</option>
          <option>TKJ 1</option>
          <option>TKJ 2</option>
          <option>TKJ 3</option>
          <option>All</option>
        </select>
    </div>
</div>

<div class="col-auto">
    <div>
     <button type="submit" class="btn btn-primary h-100">Find</button>
    </div>
</div>
</div>
</form>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahData">
+ Tambah
</button>
<div class="table-responsive">
<table class="table table-striped table-hover">
<thead>
  <tr>
    <th scope="col">No</th>
    <th scope="col">ID kartu</th>
    <th scope="col">Nama</th>
    <th scope="col">Kelas</th>
    <th scope="col">Aksi</th>
  </tr>
</thead>
<tbody>
    @if (isset($data['murid']) && count($data['murid']) > 0)
        @foreach ($data['murid'] as $row)
            <tr>
                <th scope="row">@php
                    echo $index;
                    $index++;
                @endphp</th>
                <td>{{$row['id_kartu']}}</td>
                <td>{{$row['nama']}}</td>
                <td>{{$row['kelas']}}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm edit-btn" data-id="{{$row['id_murid']}}" data-toggle="modal" data-target="#modalEdit">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{$row['id_murid']}}" data-toggle="modal" data-target="#modalDelete">Hapus</button>
                </td>
            </tr>
        @endforeach
    @endif
</tbody>
</table>
</div>

<!-- Modal Add -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Tambah Data Murid</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form>
<div>
    <label for="exampleInputIDKartu" class="form-label">ID Kartu</label>
    <input type="text" class="form-control" id="exampleInputIDKartu" placeholder="Tempelkan Kartu RFID" aria-describedby="IDKartuHelp">
</div>

<div>
    <label for="exampleInputnama" class="form-label">Nama</label>
    <input type="text" class="form-control" id="exampleInputnama" placeholder="Enter Nama Murid" aria-describedby="namaHelp">
</div>

<div class="form-group">
    <label>Kelas</label>
    <select class="form-select form-control">
        <option selected disabled value=" ">--Pilih Kelas--</option>
        @if (isset($data['kelas']) && count($data['kelas']) > 0)
            @foreach ($data['kelas'] as $row)
                <option>{{$row['kelas']}}</option>
            @endforeach
        @endif
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

<!-- Modal Delete -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
      <form method="POST" action="/delete/data_murid">
        @csrf
        <input type="text" class="d-none" value="" id="deleteId" name="deleteId">
     <div>
        Apakah yakin ingin menghapus Data Tersebut??
     </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
    </div>
  </form>
</div>
</div>
</div>

<script>
    var editbtn = document.getElementsByClassName('edit-btn');
    var delbtn = document.getElementsByClassName('delete-btn');

    for(var x = 0; x < delbtn.length; x++){
        delbtn[x].addEventListener('click', function () {
            document.getElementById('deleteId').value = this.dataset.id;
        })
    }
</script>
