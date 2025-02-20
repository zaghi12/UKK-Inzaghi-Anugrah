<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Diskon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* body, h2, .form-label, .text-center, .btn-primary {
            color: #6c63ff;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        } */

        .btn-primary {
            background-color: #6c63ff;
        }

        .result-box {
            color: green;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">Aplikasi Perhitungan Diskon</h2>
            <form method="POST" class="border rounded bg-light p-4">
                <div class="mb-3">
                    <label class="form-label">Harga Barang (Rp)</label>
                    <div class="input-group">
                        <span class="input-group-text"></span>
                        <input type="text" name="harga" class="form-control" 
                               placeholder="Masukkan harga barang" required oninput="this.value = formatRupiah(this.value)">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Diskon (%)</label>
                    <div class="input-group">
                        <span class="input-group-text"></span>
                        <input type="text" name="diskon" class="form-control" 
                               placeholder="Masukkan diskon (contoh: 10 atau 10,5)" required oninput="this.value = formatDiskon(this.value)">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100" name="hitung">Hitung</button>
            </form>

            <?php 
            if (isset($_POST['hitung'])) {
                $harga = str_replace('.', '', $_POST['harga']);
                $diskon = str_replace(',', '.', $_POST['diskon']);

                if ($harga < 0) {
                    echo "<script>alert('Harga tidak boleh negatif')</script>";
                } elseif ($diskon < 0 || $diskon > 100) {
                    echo "<script>alert('Diskon harus di antara angka 0-100')</script>";
                } else {
                    $nilai_diskon = $harga * ($diskon / 100);
                    $total_harga = $harga - $nilai_diskon; ?>
                    <div class="border rounded p-3 result-box mt-3">
                        <p><strong>Harga Barang:</strong> Rp. <b><?php echo number_format($harga, 0, ',', '.'); ?></b></p>
                        <p><strong>Diskon <?php echo str_replace('.', ',', $diskon); ?>%:</strong> Rp. <b><?php echo number_format($nilai_diskon, 0, ',', '.'); ?></b></p>
                        <p><strong>Total Harga Setelah Diskon:</strong> Rp. <b><?php echo number_format($total_harga, 0, ',', '.'); ?></b></p>
                    </div>
                <?php }
            }
            ?> 
        </div>
    </div>
</div>

<footer class="text-center">&copy; UKK RPL 2025 | INZAGHI ANUGRAH | RPL 12 B</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function formatRupiah(angka) {
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    }

    function formatDiskon(angka) {
        return angka.replace(/[^\d.,]/g, '').replace(',', '.');
    }
</script>
</body>
</html>
