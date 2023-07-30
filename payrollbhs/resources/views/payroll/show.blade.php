<html>
<head>
    <title>Slip Gaji Karyawan</title>
</head>
<style>
    *{
        margin-left: auto;
        margin-right: auto;
        font-family: sans-serif;
    }
    table{
        border-collapse: collapse;
    }
    table tr td{
        padding:10px;
    }
    span{
        float:right;
    }
</style>
<body>
    <table>
        <tr>
            <td colspan="3" align="center">
                <h3>Slip Gaji Karyawan</h3>
                <h3>{{ $payroll['nama'] }}</h3>
            </td>
        </tr>
        <tr>
            <td width="300">Nomor Induk Karyawan</td>
            <td>:</td>
            <td>{{ $payroll['nik'] }}</td>
        </tr>
        <tr>
            <td width="300">Nama Karyawan</td>
            <td>:</td>
            <td>{{ $payroll['nama'] }}</td>
        </tr>
        <tr>
            <td width="300">Tahun</td>
            <td>:</td>
            <td>{{ $payroll['tahun'] }}</td>
        </tr>
        <tr>
            <td width="300">Bulan</td>
            <td>:</td>
            <td>{{ $payroll['bulan'] }}</td>
        </tr>
        <tr>
            <td width="300">Jabatan</td>
            <td>:</td>
            <td>{{ $payroll['jabatan'] }}</td>
        </tr>
        <tr>
            <td width="300">Status</td>
            <td>:</td>
            <td>{{ $payroll['status'] }}</td>
        </tr>
    </table>
    <table border="1" class="table_detail">
        <tr>
            <td align="center">No</td>
            <td width="200" align="center">Keterangan</td>
            <td width="200" align="center">Nominal</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Gaji Pokok</td>
            <td align="right">{{ number_format($payroll['gaji_pokok'] ,0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Tunjangan</td>
            <td align="right">{{ number_format($payroll['tunjangan'] ,0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Insentif</td>
            <td align="right">{{ number_format($payroll['insentif'] ,0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Lembur <span>({{ $payroll['jam_lembur'] }} Jam)</span></td>
            <td align="right">{{ number_format($payroll['upah_lembur'] ,0, ',', '.') }} </td>
        </tr>
        <tr>
            <td>5</td>
            <td>No Work No Pay <span>({{ $payroll['bolos'] }} Hari)</span></td>
            <td align="right">{{ number_format($payroll['npwp'] ,0, ',', '.') }} </td>
        </tr>
        <tr>
            <td>6</td>
            <td>BPJS <span>({{ $payroll['has_bpjs'] }})</span></td>
            <td align="right">{{ number_format($payroll['bpjs'] ,0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>TOTAL GAJI</strong></td>
            <td align="right" style="color:green;font-weight:bold">{{ number_format($payroll['total_gaji'] ,0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <a href="{{ route('payroll.index') }}">Kembali</a>
            </td>
        </tr>
    </table>
</body>
</html>