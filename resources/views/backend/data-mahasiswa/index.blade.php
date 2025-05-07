@extends('layouts.template')

@push('title')
    {{ $title }}
@endpush

@push('card-header')
    {{ $header }}
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">NIM</th>
                            <th class="text-center">Nama Ketua</th>
                            <th class="text-center">Tempat Magang</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Proposal</th> {{-- Tambahan --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->kelompok->ketua->no_identitas ?? '-' }}</td>
                                <td class="text-center">{{ $item->kelompok->ketua->name ?? '-' }}</td>
                                <td class="text-center">
                                    @if ($item->tempatMagang)
                                        {{ strtoupper($item->tempatMagang->nama_tempat) }}
                                    @elseif($item->tempat_magang)
                                        {{ strtoupper($item->tempat_magang) }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">{{ ucwords($item->status_proposal) }}</td>
                                <td class="text-center">
                                    @if ($item->file_proposal)
                                        <a href="{{ asset('storage/' . $item->file_proposal) }}" target="_blank">Lihat</a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak Ada Data Tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                columnDefs: [{
                    targets: '_all',
                    defaultContent: '-'
                }]
            });
        });
    </script>
@endpush