@extends('layouts.main')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.cs')}}s">
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush

@section('judul')
    Halaman Kategori
@endsection

@section('content')
<form action="{{route('kategori.store')}}" method="post">
  @csrf
  <div class="card card-default">
    <div class="card-header">
      <div class="card-title">Tambah Kategori</div>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label for="nama">Nama Kategori</label>
        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan Nama Kategori">
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-success" style="float: right">Submit</button>
    </div>
  </div>
</form>

<div class="card">
    <div class="card-header">
      <h3 class="card-title">Kategori</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example2" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Kategori</th>
          <th >Aksi</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($kategori as $no=>$data)
          <tr>
            <td>{{$no+1}}</td>
            <td>{{$data->nama}}</td>
            <td style="text-align: center">
              <a href="{{route('kategori.delete', $data->id)}}"><button class="btn-danger" style="border-radius: 20px"><i class="fas fa-trash"></i></button></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
@endsection

@push('js')
{{-- datatables --}}
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
{{-- datatables page source --}}
<script>
    $(function(){
        $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        
    });
    })
</script>
@endpush