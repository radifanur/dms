@extends('layouts.main')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.cs')}}s">
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush

@section('judul')
Halaman Dokumen
@endsection

@section('content')

{{-- <iframe id="iframepdf" width="100%" src="{{asset('storage/pdf/f542e296af9bd593c4e06b5a31a6eab4.pdf')}}"></iframe> --}}

<div class="card">
    <div class="card-header">
      <h3 class="card-title">{{$title}}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      {{-- <div class="tambah">
        <a href="#">
          <button class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">Tambah Dokumen</button>
        </a>
      </div> --}}
      <table id="example2" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Nama Dokumen</th>
          <th>Kategori</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($doc as $no=>$data)
          <tr>
            <td>{{$no+1}}</td>
            <td><span class="badge bg-red">PDF</span> <a href="{{route('dokumen.show', ['kategori' => $data->kategori_id, 'slug'=>$data->slug])}}">{{$data->nama}}</a></td>
            <td>{{$data->kategori->nama}}</td>
            <td>{{$data->created_at}}</td>
            <td style="text-align: center">
              <a href="#"><button class="btn-danger" style="border-radius: 20px"><i class="fas fa-trash"></i></button></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>

  {{-- Modal --}}

  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Dokumen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
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