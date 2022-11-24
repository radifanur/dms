@extends('layouts.main')

@push('css')
<link rel="stylesheet" href="{{asset('admin/dist/filepond/filepond.css')}}">
@endpush

@section('content')
<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-8">
    <form action="{{route('dokumen.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Tambah Document</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="nama">Nama Dokumen</label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan Nama Dokumen">
          </div>
          <div class="form-group">
            <label>Kategori</label>
            <select class="custom-select" name="kategori">
              @php
              $kategori = DB::table('kategori')->get();
              @endphp
              @foreach ($kategori as $data)
              <option value="{{$data->id}}">{{$data->nama}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Input Dokumen</label>
            <input type="file" accept="application/pdf" name="pdf" />
            <div class="input-group">
              
              {{-- <div class="custom-file">
                <input type="file" accept="application/pdf" name="pdf" class="custom-file-input" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Pilih Dokumen</label>
              </div> --}}
            </div>
          </div>  
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-success" style="float: right">Submit</button>
        </div>
      </div>
    </form>

  </div>
  <div class="col-sm-4 col-md-4 col-lg-4">
    <div class="small-box bg-olive">
      <div class="inner">
        <h3>{{$total}}</h3>
        <p>Total Dokumen</p>
      </div>
      <div class="icon">
        <i class="fas fa-file"></i>
      </div>
      <a href="{{route('dokumen.index')}}" class="small-box-footer">
        Lebih Lengkap <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
    <div class="small-box bg-lime">
      <div class="inner">
        <h3>{{$total}}</h3>
        <p>Dokumen Baru</p>
      </div>
      <div class="icon">
        <i class="fas fa-file-upload"></i>
      </div>
      <a href="{{route('dokumen.baru')}}" class="small-box-footer">
        Lebih Lengkap <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
</div>

@endsection

@push('js')
<script src="{{asset('admin/dist/filepond/filepond.js')}}"></script>
<script src="{{asset('admin/plugins/dropzone/min/dropzone.min.js')}}"></script>
<script src="{{asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>
  // Get a reference to the file input element
  const inputElement = document.querySelector('input[type="file"]');

  // Create a FilePond instance
  const pond = FilePond.create(inputElement);

  FilePond.setOptions({
    server: {
        process: '/pdf-upload',
        revert: '/pdf-delete',
        headers:{
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
        // restore: './restore/',
        // load: './load/',
        // fetch: './fetch/',
    },
  }); 
</script>
@endpush