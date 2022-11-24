@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-md-8 col-lg-7    embed-responsive embed-responsive-16by9" style="height: 500px; width:100%">
        <iframe class="embed-responsive-item" src="{{asset('storage/pdf/'. $data->path)}}"></iframe>
    </div>
    <div class="col-md-4 col-lg-5">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="text-center">{{$data->nama}}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th colspan="3" style="text-align: center">Deskripsi Dokumen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Nama Pengirim</td>
                                        <td>:</td>
                                        <td>{{$data->uploader}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email Pengirim</td>
                                        <td>:</td>
                                        <td>{{$data->uploader_email}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tangggal Upload</td>
                                        <td>:</td>
                                        <td>{{$data->created_at->format('d F Y')}}</td>
                                    </tr>
                                    <tr>
                                        <td>Kategori Dokumen</td>
                                        <td>:</td>
                                        <td>{{$data->kategori->nama}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="qrcode">
                            {!! QrCode::size(150)->generate(Request::url()); !!}
                        </div>
                    </div>
                </div>
                {{-- <div class="download">
                    <a class="btn btn-primary" href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(250)->generate(Request::url())) !!} " download="QrCode_{{str_replace(' ','_',$data->nama)}}">Download QrCode</a>
                </div> --}}
            
            </div>
        </div>
        
        
    </div>
</div>

@endsection