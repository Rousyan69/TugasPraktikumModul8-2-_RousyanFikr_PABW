@extends('layouts.app')
@section('title', 'Aduan Infrastruktur Warga')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h4 class="fw-bolder mb-1">Laporan Aduan Masyarakat</h4>
        <p class="text-muted small mb-0">Pengelolaan laporan kerusakan fasilitas desa secara realtime (AJAX tanpa reload).</p>
    </div>
    <button class="btn btn-sr-primary" id="btnTambah">
        <i class="bi bi-plus-lg me-1"></i> Buat Aduan Baru
    </button>
</div>

<div id="alert-container"></div>

<div class="card-sr overflow-hidden">
    <div class="table-responsive">
        <table class="table table-sr table-hover align-middle mb-0" id="tableAduan">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pelapor</th>
                    <th>Judul Aduan</th>
                    <th>Lokasi Detail</th>
                    <th>Urgensi</th>
                    <th>Status</th>
                    <th>Lampiran Bukti</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- Modal Form AJAX -->
<div class="modal fade" id="modalAduan" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-bottom px-4 py-3">
                <h5 class="modal-title fw-bold" id="modalTitle">Buat Laporan Aduan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formAduan">
                <div class="modal-body p-4">
                    <input type="hidden" id="aduan_id">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Nama Pelapor *</label>
                        <input type="text" class="form-control" id="nama_pelapor" name="nama_pelapor" value="{{ auth()->user()->name }}">
                        <div class="invalid-feedback" id="err-nama_pelapor"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Judul Aduan Kerusakan *</label>
                        <input type="text" class="form-control" id="judul_aduan" name="judul_aduan" placeholder="Contoh: Lampu PJU Mati Total di Pertigaan">
                        <div class="invalid-feedback" id="err-judul_aduan"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Lokasi Detail *</label>
                        <input type="text" class="form-control" id="lokasi_detail" name="lokasi_detail" placeholder="Contoh: Jl. Merdeka RT 04 / RW 02">
                        <div class="invalid-feedback" id="err-lokasi_detail"></div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold small">Tingkat Urgensi *</label>
                            <select class="form-select" id="tingkat_urgensi" name="tingkat_urgensi">
                                <option value="Rendah">Rendah</option>
                                <option value="Sedang" selected>Sedang</option>
                                <option value="Tinggi">Tinggi</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold small">Status Penanganan *</label>
                            <select class="form-select" id="status" name="status">
                                <option value="Menunggu">Menunggu</option>
                                <option value="Diproses">Diproses</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label class="form-label fw-semibold small">Foto / Berkas Bukti (JPG, PNG, PDF max 2MB) *</label>
                        <input type="file" class="form-control" id="foto_bukti" name="foto_bukti" accept=".jpg,.jpeg,.png,.pdf">
                        <div class="invalid-feedback" id="err-foto_bukti"></div>
                        <small class="text-muted d-block mt-1" id="current-file-hint"></small>
                    </div>
                </div>
                <div class="modal-footer border-top px-4 py-3 bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-light border rounded-3 px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sr-primary px-4" id="btnSimpan">Kirim Laporan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        }
    });

    function loadData() {
        $.get("{{ route('aduan.data') }}", function(data) {
            let html = '';
            if(data.length === 0) {
                html = '<tr><td colspan="8" class="text-center text-muted py-5"><i class="bi bi-clipboard-x fs-1 d-block mb-2 opacity-50"></i>Belum ada aduan warga yang masuk.</td></tr>';
            } else {
                data.forEach((item, index) => {
                    let urgensiBadge = item.tingkat_urgensi === 'Tinggi' ? 'badge-soft-danger' : (item.tingkat_urgensi === 'Sedang' ? 'badge-soft-warning' : 'badge-soft-info');
                    let statusBadge = item.status === 'Selesai' ? 'badge-soft-success' : (item.status === 'Diproses' ? 'badge-soft-info' : 'badge-soft-slate');
                    let fileLink = item.foto_url 
                        ? `<a href="${item.foto_url}" target="_blank" class="btn btn-sm btn-light border rounded-pill px-3 text-success fw-semibold"><i class="bi bi-paperclip me-1"></i>${item.nama_file || 'Lihat File'}</a>` 
                        : '<span class="text-muted small">-</span>';

                    html += `
                        <tr>
                            <td class="text-muted">${index + 1}</td>
                            <td class="fw-bold">${item.nama_pelapor}</td>
                            <td>${item.judul_aduan}</td>
                            <td class="text-muted"><i class="bi bi-pin-map me-1 text-success"></i>${item.lokasi_detail}</td>
                            <td><span class="badge rounded-pill ${urgensiBadge}">${item.tingkat_urgensi}</span></td>
                            <td><span class="badge rounded-pill ${statusBadge}">${item.status}</span></td>
                            <td>${fileLink}</td>
                            <td class="text-end text-nowrap">
                                <button class="btn btn-sm btn-outline-primary rounded-3 btn-edit" data-id="${item.id}" title="Edit"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-sm btn-outline-danger rounded-3 btn-delete" data-id="${item.id}" title="Hapus"><i class="bi bi-trash3"></i></button>
                            </td>
                        </tr>
                    `;
                });
            }
            $('#tableAduan tbody').html(html);
        });
    }

    loadData();
    const modal = new bootstrap.Modal(document.getElementById('modalAduan'));

    $('#btnTambah').click(function() {
        $('#formAduan')[0].reset();
        $('#aduan_id').val('');
        $('#current-file-hint').text('');
        $('.is-invalid').removeClass('is-invalid');
        $('#modalTitle').text('Buat Laporan Aduan Baru');
        modal.show();
    });

    $('#formAduan').submit(function(e) {
        e.preventDefault();
        let id = $('#aduan_id').val();
        let url = id ? `/aduan/${id}` : "{{ route('aduan.store') }}";
        let formData = new FormData(this);
        if(id) formData.append('_method', 'PUT');

        $('.is-invalid').removeClass('is-invalid');
        $('#btnSimpan').prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                modal.hide();
                loadData();
                $('#alert-container').html(`
                    <div class="alert alert-success border-0 shadow-sm rounded-3 alert-dismissible fade show d-flex align-items-center">
                        <i class="bi bi-check-circle-fill fs-5 me-2 text-success"></i>
                        <div class="fw-medium">${res.success}</div>
                        <button class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `);
            },
            error: function(xhr) {
                if(xhr.status === 422) {
                    $.each(xhr.responseJSON.errors, function(key, val) {
                        $(`#${key}`).addClass('is-invalid');
                        $(`#err-${key}`).text(val[0]);
                    });
                }
            },
            complete: function() {
                $('#btnSimpan').prop('disabled', false).text('Kirim Laporan');
            }
        });
    });

    $(document).on('click', '.btn-edit', function() {
        let id = $(this).data('id');
        $.get(`/aduan/${id}/edit`, function(data) {
            $('#aduan_id').val(data.id);
            $('#nama_pelapor').val(data.nama_pelapor);
            $('#judul_aduan').val(data.judul_aduan);
            $('#lokasi_detail').val(data.lokasi_detail);
            $('#tingkat_urgensi').val(data.tingkat_urgensi);
            $('#status').val(data.status);
            $('#current-file-hint').text(data.nama_file ? `File terpasang: ${data.nama_file} (kosongkan jika tidak diganti)` : '');
            $('.is-invalid').removeClass('is-invalid');
            $('#modalTitle').text('Edit Laporan Aduan');
            modal.show();
        });
    });

    $(document).on('click', '.btn-delete', function() {
        if(!confirm('Hapus laporan aduan ini beserta berkas buktinya?')) return;
        let id = $(this).data('id');
        $.ajax({
            url: `/aduan/${id}`,
            type: 'DELETE',
            success: function(res) {
                loadData();
                $('#alert-container').html(`
                    <div class="alert alert-success border-0 shadow-sm rounded-3 alert-dismissible fade show d-flex align-items-center">
                        <i class="bi bi-check-circle-fill fs-5 me-2 text-success"></i>
                        <div class="fw-medium">${res.success}</div>
                        <button class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `);
            }
        });
    });
});
</script>
@endpush