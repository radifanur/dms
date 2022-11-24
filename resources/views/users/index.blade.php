@extends('layouts.main')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.cs')}}s">
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush

@section('judul')
Halaman Akun
@endsection

@section('content')
<div class="card card-default">
  <div class="card-header">
    <div class="card-title">Aktivasi Akun</div>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
      @forelse ($aktivasi as $no => $data)
          <tr>
              <td>{{$no+1}}</td>
              <td>{{$data->name}}</td>
              <td>{{$data->email}}</td>
              <td style="text-align: center">
                <a href="{{route('users.aktivasi', ['id'=>$data->id, 'aktivasi'=>$acc])}}"><button class="btn btn-success"><i class="fas fa-check-circle"></i> Terima</button></a>
                <a href="#"><button class="btn btn-danger"><i class="fas fa-times-circle"></i> Tolak</button></a>
              </td>
          </tr>
      @empty
          <tr>
              <td colspan="4" style="text-align: center">Tidak ada data</td>
          </tr>
      @endforelse
      </tbody>
    </table>
  </div>
</div>
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Akun</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example2" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($user as $no => $data)
            <tr>
                <td>{{$no+1}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->email}}</td>
                <td style="text-align: center">
                  <a href="#"><button class="btn-danger" style="border-radius: 20px"><i class="fas fa-trash"></i></button></a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align: center">Data Tidak Ditemukan</td>
            </tr>
        @endforelse
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
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    })
</script>
@endpush