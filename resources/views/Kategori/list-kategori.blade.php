@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

    <div class="container mt-4">
    <div class="card">
        <div class="card-header bg-warning text-white">
            <div class="">
                <span>Menu</span>
                <br>
                <span class="">
                    <a href="{{ route('artikel') }}"  class="text-white " style="text-decoration: none">Article</a> |
                    
                </span>
                <span >
                    <a href="{{ route('kategori') }}"  class="text-white" style="text-decoration: none">Kategori</a>
                    
                </span>
            </div>
        </div>
        <div class="card-body  ">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Ketegori
        </button>

        @if($msg = Session::get('success'))
        <script>
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: '<?= $msg ?>',
            showConfirmButton: false,
            timer: 1500
            })
        </script>
        @endif
        

        <table id="example" class="table table-striped table-bordered dt-responsive nowrap " style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>User</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>

            @foreach($data as $d)
            <tr>
                <td><?= $no++ ?></td>
                <td>{{$d->name}}</td>
                <td>
                    <?php
                    $data2 = DB::table('users')->where('id', $d->user_id)->get();
                    echo $data2[0]->name;
                    ?>
                </td>
                <td>
               <form action="{{route('kategori-post')}}" method="post">
                @method('delete')
                @csrf
                <input type="hidden" value="{{$d->id}}" name="id">
                <button type="submit" class="badge bg-danger" onClick="return confirm('Yakin Mau Hapus Data Ini?')">Hapus</button>
               </form>
               <button type="button" class="badge bg-primary  exampleModal2" data-ktgori="{{$d->name}}" id="ubahdata" data-id="{{$d->id}}"  data-bs-toggle="modal" data-bs-target="#exampleModal2">
                  Update
               </button>
                </td>
            </tr>
            @endforeach
        
        </tbody>
    </table>
        </div>
        </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kategori-post')}}" method="post">
                    @csrf
                <div class="modal-body">
                <label for="nama-kategori" class="form-label">Nama Ketegori</label>
                    <input type="text" class="form-control" name="name" id="nama-kategori" >
                </div>
                
                <button type="submit" class="btn btn-warning" style="width: 100%;">Simpan</button>
                    </div>
                    </form>
                </div>
                </div>

                <!-- Update Model -->
                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kategori-post')}}" method="post">
                    @csrf
                    @method('put')
                <div class="modal-body">
                <label for="nama-kategori" class="form-label">Nama Ketegori</label>
                    <input type="text" class="form-control" name="name" id="namakategori" value="">
                    <input type="hidden" class="id_kategori" name="id" value="">
                </div>
                
                <button type="submit" class="btn btn-warning" style="width: 100%;">Simpan</button>
                    </div>
                    </form>
                </div>
                </div>

            <script>
                $(document).ready(function () {
                    $('.exampleModal2').click(function(){
                        $('#namakategori').val($(this).data('ktgori'));
                        $('.id_kategori').val($(this).data('id'));
                    });
               $('#example').DataTable();
              });

            </script>
@endsection