<!DOCTYPE html>
<html>
<head>
  <title>Data Table Corporate Loan Cabang Detail</title>
  <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;

    }

    .container {
        flex-grow: 1;
        margin-top: 100px;
        margin-left: 270px;
    }

    .content {
        margin-left: 270px; /* Berikan margin agar konten tidak tertutup sidebar */
        flex-grow: 1;
        padding: 20px;
        overflow-x: auto;
    }

    h1 {
        text-align: left;
        margin-bottom: 30px;
        color: #343a40;
        font-weight: bold;
        font-size: 30px;
    }


    label {
        font-weight: bold;
        color: #495057;
    }


</style>
  </head>
<body>

<div class="container">
  <div class="section-header">
    <h1>Data Table Corporate Loan Cabang Detail</h1>
  </div>

  <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="notificationModalLabel">Notifikasi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="notificationMessage">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="okButton" data-bs-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>

  <div class="content-header">
    <button type="button" class="btn btn-success btn-icon-split" data-bs-toggle="modal" data-bs-target="#importModal">
      <span class="icon text-white-50">
        <i class="fas fa-file-import"></i> Import
      </span>
    </button>

    <button type="button" class="btn btn-info btn-icon-split" data-bs-toggle="modal" data-bs-target="#modalExport">
      <span class="icon text-white-50">
        <i class="fas fa-file-export"></i> Export
      </span>
    </button>

    <button type="button" class="btn btn-warning btn-icon-split" data-bs-toggle="modal" data-bs-target="#executeModal">
      <span class="icon text-white-50">
        <i class="fas fa-play"></i> Execute
      </span>
    </button>

    <br><br>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">tblCorporateLoanCabangDetail</h6>
    </div>
    <div class="table-responsive">
      <table class="table table-hover table-striped table-bordered">
        <thead class="text-center">
          <tr>
            <th class="border">IDTRX</th>
            <th class="border">ID_KTR_CABANG</th>
            <th class="border">CIF_BANK</th>
            <th class="border">NO_REKENING</th>
            <th class="border">STATUS</th>
            <th class="border">NAMA_DEBITUR</th>
            <th class="border">MAKSIMAL_KREDIT</th>
            <th class="border">TANGGAL_REALISASI</th>
            <th class="border">SUKU_BUNGA</th>
            <th class="border">JANGKA_WAKTU</th>
            <th class="border">TGL_JATUH_TEMPO</th>
            <th class="border">SIFAT_KREDIT</th>
            <th class="border">JENIS_KREDIT</th>
            <th class="border">JNS_TRANSAKSI</th>
            <th class="border">TGL_TRANSAKSI</th>
            <th class="border">NILAI_PENARIKAN</th>
            <th class="border">NILAI_PENGEMBALIAN</th>
            <th class="border">CBAL</th>
            <th class="border">CUTOFF_DATE</th>
            <th class="border">KELONGGARAN_TARIK</th>
            <th class="border">TGL_RESTRUCT</th>
            <th class="border">TGL_RESTRUCT_REVIEW</th>
            <th class="border">KET_RESTRUCT</th>
            <th class="border">NOMINAL_ANGSURAN</th>
            <th class="border">STATUS_PSAK</th>
          </tr>
        </thead>
        <tbody>
          @foreach($tblcorporateloancabangdetail as $tb)
            <tr class="text-center">
              <td class="border">{{ $tb->idtrx }}</td>
              <td class="border">{{ $tb->id_ktr_cabang }}</td>
              <td class="border">{{ $tb->cif_bank }}</td>
              <td class="border">{{ $tb->no_rekening }}</td>
              <td class="border">{{ $tb->status }}</td>
              <td class="border">{{ $tb->nama_debitur }}</td>
              <td class="border">{{ $tb->maksimal_kredit }}</td>
              <td class="border">{{ $tb->tanggal_realisasi }}</td>
              <td class="border">{{ $tb->suku_bunga }}</td>
              <td class="border">{{ $tb->jangka_waktu }}</td>
              <td class="border">{{ $tb->tgl_jatuh_tempo }}</td>
              <td class="border">{{ $tb->sifat_kredit }}</td>
              <td class="border">{{ $tb->jenis_kredit }}</td>
              <td class="border">{{ $tb->jns_transaksi }}</td>
              <td class="border">{{ $tb->tgl_transaksi }}</td>
              <td class="border">{{ $tb->nilai_penarikan }}</td>
              <td class="border">{{ $tb->nilai_pengembalian }}</td>
              <td class="border">{{ $tb->cbal }}</td>
              <td class="border">{{ $tb->cutoff_date }}</td>
              <td class="border">{{ $tb->kelonggaran_tarik }}</td>
              <td class="border">{{ $tb->tgl_restruct }}</td>
              <td class="border">{{ $tb->tgl_restruct_review }}</td>
              <td class="border">{{ $tb->ket_restruct }}</td>
              <td class="border">{{ $tb->nominal_angsuran }}</td>
              <td class="border">{{ $tb->status_psak }}</td>
            </tr>
          @endforeach

          @if(empty($tblcorporateloancabangdetail))
            <tr class="text-center"><td colspan="25">Data not found</td></tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Upload File Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="uploadFile">Pilih File Excel:</label>
                        <input type="file" name="uploadFile" id="uploadFile" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalExport" tabindex="-1" aria-labelledby="modalExportLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalExportLabel">Export Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" style="margin: 0;">
          @csrf
          <button type="submit" class="dropdown-item">Export to PDF</button>
        </form>

        <form action="" method="post" style="margin: 0;">
          @csrf
          <button type="submit" class="dropdown-item">Export to Excel</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-close"   data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="executeModal" tabindex="-1" aria-labelledby="executeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="executeModalLabel">Execute Stored Procedure</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('execute.stored.procedure') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="bulan">Bulan:</label>
            <input type="number" name="bulan" id="bulan" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="tahun">Tahun:</label>
            <input type="number" name="tahun" id="tahun" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="no_acc">Nomor Akun:</label>
            <input type="text" name="no_acc" id="no_acc" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="pilihan">Pilihan (365/360):</label>
            <select name="pilihan" id="pilihan" class="form-control" required>
              <option value="365">365</option>
              <option value="360">360</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Execute</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function() {
    @if(session('success'))
      $('#notificationMessage').text("{{ session('success') }}");
      $('#notificationModal').modal('show');
    @elseif(session('error'))
      $('#notificationMessage').text("{{ session('error') }}");
      $('#notificationModal').modal('show');
    @endif

    $('#okButton').click(function() {
      $('#notificationModal').modal('hide');
    });
  });
</script>

</body>
</html>
