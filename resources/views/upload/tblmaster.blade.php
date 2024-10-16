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

<!-- Content Page -->
<div class="container">
    <div class="section-header">
        <h1>Data Table Master</h1><br>
    </div>
    <!-- Header -->
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

        <!-- Import Button -->
<a data-toggle="modal" data-target="#modalImport" class="btn btn-success btn-icon-split">
    <span class="icon text-white-50">
        <i class="fas fa-file-import"></i>
    </span>
    <span class="text">Import</span>
</a>
        <button type="button" class="btn btn-warning btn-icon-split" data-bs-toggle="modal" data-bs-target="#executeModal">
            <span class="icon text-white-50">
              <i class="fas fa-play"></i> Execute
            </span>
          </button>

        <br><br>
    </div>

    <!-- Table Transaction -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">tblmaster</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead class="text-center">
                    <tr>
                        <th class="border">NO_ACC</th>
                        <th class="border">NO_BRANCH</th>
                        <th class="border">DEB_NAME</th>
                        <th class="border">STATUS</th>
                        <th class="border">LN_TYPE</th>
                        <th class="border">ORG_DATE</th>
                        <th class="border">ORG_DATE_DT</th>
                        <th class="border">TERM</th>
                        <th class="border">MTR_DATE</th>
                        <th class="border">MTR_DATE_DT</th>
                        <th class="border">ORG_BAL</th>
                        <th class="border">RATE</th>
                        <th class="border">CBAL</th>
                        <th class="border">PREBAL</th>
                        <th class="border">BILPRN</th>
                        <th class="border">PMTAMT</th>
                        <th class="border">LREBD</th>
                        <th class="border">LREBD_DT</th>
                        <th class="border">NREBD</th>
                        <th class="border">NREBD_DT</th>
                        <th class="border">LN_GRP</th>
                        <th class="border">GROUP</th>
                        <th class="border">BILINT</th>
                        <th class="border">BISIFA</th>
                        <th class="border">BIREST</th>
                        <th class="border">FRELDT</th>
                        <th class="border">FRELDT_DT</th>
                        <th class="border">RESDT</th>
                        <th class="border">RESDT_DT</th>
                        <th class="border">RESTDT</th>
                        <th class="border">RESTDT_DT</th>
                        <th class="border">PROV</th>
                        <th class="border">TRXCOST</th>
                        <th class="border">gol</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($tblmaster as $item)
                    <tr class="text-center">
                        <td>{{ $item->no_acc }}</td>
                        <td>{{ $item->no_branch }}</td>
                        <td>{{ $item->deb_name }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->ln_type }}</td>
                        <td>{{ $item->org_date }}</td>
                        <td>{{ $item->org_date_dt }}</td>
                        <td>{{ $item->term }}</td>
                        <td>{{ $item->mtr_date }}</td>
                        <td>{{ $item->mtr_date_dt }}</td>
                        <td>{{ $item->org_bal }}</td>
                        <td>{{ $item->rate }}</td>
                        <td>{{ $item->cbal }}</td>
                        <td>{{ $item->prebal }}</td>
                        <td>{{ $item->bilprn }}</td>
                        <td>{{ $item->pmtamt }}</td>
                        <td>{{ $item->lrebd }}</td>
                        <td>{{ $item->lrebd_dt }}</td>
                        <td>{{ $item->nrebd }}</td>
                        <td>{{ $item->nrebd_dt }}</td>
                        <td>{{ $item->ln_grp }}</td>
                        <td>{{ $item->group }}</td>
                        <td>{{ $item->bilint }}</td>
                        <td>{{ $item->bisifa }}</td>
                        <td>{{ $item->birest }}</td>
                        <td>{{ $item->freldt }}</td>
                        <td>{{ $item->freldt_dt }}</td>
                        <td>{{ $item->resdt }}</td>
                        <td>{{ $item->resdt_dt }}</td>
                        <td>{{ $item->restdt }}</td>
                        <td>{{ $item->restdt_dt }}</td>
                        <td>{{ $item->prov }}</td>
                        <td>{{ $item->trxcost }}</td>
                        <td>{{ $item->gol }}</td>

                    </tr>
                    @endforeach

                    <!-- Empty State -->
                    @if(empty($tblmaster))
                    <tr class="text-center">
                        <td colspan="6">Data not found</td>
                    </tr>
                    @endif

                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- Modal HTML -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="importModalBody">
                <!-- Pesan akan dimuat di sini -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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


<!-- Load Modal Views -->
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
