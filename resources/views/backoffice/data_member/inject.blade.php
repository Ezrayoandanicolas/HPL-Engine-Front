<?php
use App\Http\API\fiver;
?>

@extends('backoffice.layouts.main')

@section('content')

@php
    $api = new fiver();
@endphp

<div class="card mt-3">
    <div class="card-header">
        Data Member
    </div>

    <div class="card-body">

        @include('backoffice.layouts.msg_bar')

        <div class="table-responsive">

            <table id="example2" class="table table-bordered table-hover">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Username</th>
                        <th>Ref</th>
                        <th>Saldo</th>
                        <th>Email</th>
                        <th>No WA</th>
                        <th>Bank</th>
                        <th>Nama Rekening</th>
                        <th>No Rekening</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($user as $member)

                    @php

                        $saldo = 0;

                        try {

                            $response = json_decode($api->userbalance($member->extplayer));

                            if(isset($response->user->balance)){
                                $saldo = $response->user->balance;
                            }
                            elseif(isset($response->balance)){
                                $saldo = $response->balance;
                            }
                            elseif(isset($response->credit)){
                                $saldo = $response->credit;
                            }

                        } catch (\Throwable $e) {
                            $saldo = 0;
                        }

                    @endphp

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $member->created_at }}</td>

                        <td>{{ $member->username }}</td>

                        <td>{{ $member->ref }}</td>

                        <td>{{ number_format($saldo) }}</td>

                        <td>{{ $member->email }}</td>

                        <td>{{ $member->whatsapp }}</td>

                        <td>{{ $member->bank }}</td>

                        <td>{{ $member->accName }}</td>

                        <td>{{ $member->accNumber }}</td>

                        <td>

                            <button
                                class="btn btn-warning"
                                data-toggle="modal"
                                data-target="#modal{{ $member->id }}">
                                Inject
                            </button>

                        </td>

                    </tr>

                    <div class="modal fade" id="modal{{ $member->id }}">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <form action="{{ route('saldo.update',$member->id) }}" method="POST">

                                    @csrf
                                    @method('PUT')

                                    <div class="modal-header">

                                        <h5>Inject Saldo</h5>

                                        <button class="close" data-dismiss="modal">
                                            &times;
                                        </button>

                                    </div>

                                    <div class="modal-body">

                                        <div class="form-group">

                                            <label>Username</label>

                                            <input
                                                type="text"
                                                class="form-control"
                                                value="{{ $member->username }}"
                                                readonly>

                                        </div>

                                        <div class="form-group">

                                            <label>Saldo</label>

                                            <input
                                                type="number"
                                                class="form-control"
                                                name="saldo"
                                                value="{{ $saldo }}">

                                        </div>

                                        <div class="form-group">

                                            <label>Aksi</label>

                                            <select
                                                class="form-control"
                                                name="action">

                                                <option value="">Pilih</option>
                                                <option value="deposit">Tambah Saldo</option>
                                                <option value="withdraw">Tarik Saldo</option>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="modal-footer">

                                        <button
                                            class="btn btn-secondary"
                                            data-dismiss="modal">
                                            Tutup
                                        </button>

                                        <button
                                            type="submit"
                                            class="btn btn-primary">
                                            Simpan
                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

<script>
$(function(){

    $('#example2').DataTable({
        paging:true,
        searching:false,
        ordering:false,
        info:false,
        responsive:true
    });

});
</script>

@endsection