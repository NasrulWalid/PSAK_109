<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfigurasi Akuntansi</title>
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
            display: flex;
            flex-grow: 1;
        }

        .content {
            margin-left: 270px; /* Berikan margin agar konten tidak tertutup sidebar */
            flex-grow: 1;
            padding: 20px;
            overflow-x: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
        }

        .company-type {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #495057;
        }

        select {
            padding: 5px;
            font-size: 16px;
            margin-left: 10px;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        table {
            width: 100%; /* Lebar tabel 100% */
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #f1f1f1;
        }

        tbody tr:hover {
            background-color: #e2e6ea;
        }

        td input[type="checkbox"] {
            transform: scale(1.5);
            cursor: pointer;
        }


        .save-button {
            display: block;
            width: 150px;
            padding: 10px;
            margin: 20px auto;
            background-color: #007bff;
            color: white;
            text-align: center;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .save-button:hover {
            background-color: #0056b3;
        }
        .form-group{
            width: 20%;
        }
        .form-group{
            position:relative;
        }
        .form-group label {
        margin-right: 15px;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h1>Tabel PSAK 71</h1>
            <div class="form-group">
                <label for="nama_pt">Nama PT</label>
                <div>
                    <input type="text" class="form-control d-flex" value="{{ Auth::user()->company_type }}" disabled>
                    <input type="hidden" name="nama_pt" value="{{ Auth::user()->company_type }}">
                    @error('nama_pt')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="bisnis-type">
                <label for="bisnis_type">Bussiness Type:</label>
                <select id="bisnis_type" name="bisnis_type" onchange="showModules()">
                    <option value="retailbanking">Retail Banking</option>
                    <option value="smebanking">SME Banking</option>
                    <option value="corporatebanking">Corporate Banking</option>
                </select>
            </div>

            <div id="modules-Bank">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Modules</th>
                            <th colspan="2">Method</th>
                            <th>Journal</th>
                            <th colspan="2">Method</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Effective</th>
                            <th>Simple Interest</th>
                            <th></th>
                            <th>Effective</th>
                            <th>Simple Interest</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Opening Balance</td>
                            <td><input type="checkbox"></td>
                            <td><input type="checkbox"></td>
                            <td>Initial Recognition Journal</td>
                            <td><input type="checkbox"></td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Outstanding Balance</td>
                            <td><input type="checkbox"></td>
                            <td><input type="checkbox"></td>
                            <td>Amortized Journal</td>
                            <td><input type="checkbox"></td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Expected Cash Flow</td>
                            <td><input type="checkbox"></td>
                            <td><input type="checkbox"></td>
                            <td>Time Gap Negative Journal</td>
                            <td><input type="checkbox"></td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Calculated Accrual Interest</td>
                            <td><input type="checkbox"></td>
                            <td><input type="checkbox"></td>
                            <td>Full CP Prepayment Journal</td>
                            <td><input type="checkbox"></td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Amortized Fee</td>
                            <td><input type="checkbox"></td>
                            <td><input type="checkbox"></td>
                            <td>Partial CP Prepayment Journal</td>
                            <td><input type="checkbox"></td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Amortized Cost</td>
                            <td><input type="checkbox"></td>
                            <td><input type="checkbox"></td>
                            <td>Restructuring Journal</td>
                            <td><input type="checkbox"></td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Expenses Off market</td>
                            <td><input type="checkbox"></td>
                            <td><input type="checkbox"></td>
                            <td>Impairment Journal</td>
                            <td><input type="checkbox"></td>
                            <td><input type="checkbox"></td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Interest Deferred Restructuring</td>
                            <td><input type="checkbox"></td>
                            <td><input type="checkbox"></td>
                            <td>General/Special Journal</td>
                            <td><input type="checkbox"></td>
                            <td><input type="checkbox"></td>
                        </tr>
                    </tbody>
                </table>
                <button class="save-button" onclick="saveConfiguration()">Simpan Konfigurasi</button>
            </div>
        </div>
    </div>

    <script>
        function showModules() {
            const selectedType = document.getElementById('company_type').value;
            document.getElementById('modules-Bank').classList.add('hidden');
            document.getElementById('modules-Perusahaan Pembiayaan').classList.add('hidden');
            document.getElementById('modules-Perusahaan Asuransi').classList.add('hidden');

            if (selectedType === 'Bank') {
                document.getElementById('modules-Bank').classList.remove('hidden');
            } else if (selectedType === 'Perusahaan Pembiayaan') {
                document.getElementById('modules-Perusahaan Pembiayaan').classList.remove('hidden');
            } else if (selectedType === 'Perusahaan Asuransi') {
                document.getElementById('modules-Perusahaan Asuransi').classList.remove('hidden');
            }
        }

        function saveConfiguration() {
            alert("Konfigurasi berhasil disimpan!");
        }
    </script>
</body>
</html>
