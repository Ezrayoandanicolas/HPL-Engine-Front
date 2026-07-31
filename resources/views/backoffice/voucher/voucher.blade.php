@extends('backoffice.layouts.main')
@section('content')
    <div class="card mt-3">
        <div class="card-header">
            Data Voucher
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-12 text-right">
                    <button data-toggle="modal" data-target="#tambah" type="button" class="btn btn-success btn-add"><i
                            class="fa fa-plus"></i> Buat Voucher</button>
                </div>
            </div>
            <form method="GET" class="form-inline mb-3 justify-content-end">
                <input type="date" name="date_from" class="form-control mr-2" value="{{ request('date_from') }}" placeholder="Dari">
                <input type="date" name="date_to" class="form-control mr-2" value="{{ request('date_to') }}" placeholder="Sampai">
                <input type="text" name="search" class="form-control mr-2" placeholder="Cari voucher..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
            </form>
            <div class="table-responsive">
                <table id="voucher-table" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Exp</th>
                            <th>Nominal</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($voucher as $v)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $v->title ?? $v['title'] }}</td>
                            <td>{{ $v->exp ?? $v['exp'] }}</td>
                            <td>{{ $v->nominal ?? $v['nominal'] }}</td>
                            <td class="text-right">
                                <form action="/Admin/Dashboard/Voucher/{{ $v->id ?? $v['id'] }}" method="POST" onsubmit="return confirm('Hapus voucher?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada voucher</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="modalUserBaru" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/Admin/Dashboard/Voucher" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_member">Buat Voucher</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="id" type="hidden" name="id" value="">
                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input id="title" type="text" class="form-control" name="title" value="">
                        </div>
                        <div class="form-group">
                            <label for="exp">Exp</label>
                            <input id="exp" type="text" class="form-control" name="exp" value="">
                        </div>
                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <input id="nominal" type="text" class="form-control" name="nominal" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
