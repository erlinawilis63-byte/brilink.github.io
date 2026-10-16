<?php
 
                    if (isset($_POST['simpan_transaksi'])) {
                        $jenis_layanan = mysqli_real_escape_string($koneksi, $_POST['jenis_layanan']);
                        $nama_pelanggan = mysqli_real_escape_string($koneksi, $_POST['nama_pelanggan']);
                        $nomor_tujuan = mysqli_real_escape_string($koneksi, $_POST['nomor_tujuan']);
                        $nominal = $_POST['nominal'];
                        $biaya_admin = $_POST['biaya_admin'];
                        $fee_agen = $_POST['fee_agen'];
                        $status = $_POST['status'];
                        $no_referensi = 'BRZ-' . date('YmdHis');

                        mysqli_query($koneksi, "INSERT INTO transaksi (no_referensi, tanggal, jenis_layanan, nama_pelanggan, nomor_tujuan, nominal, biaya_admin, fee_agen, status) VALUES ('$no_referensi', NOW(), '$jenis_layanan', '$nama_pelanggan', '$nomor_tujuan', '$nominal', '$biaya_admin', '$fee_agen', '$status')");
                        echo "<script>alert('Transaksi berhasil dicatat! Ref: $no_referensi'); window.location='index.php?page=transaksi';</script>";
                        exit();
                    }

                    if (isset($_GET['hapus'])) {
                        $id = $_GET['hapus'];
                        mysqli_query($koneksi, "DELETE FROM transaksi WHERE id_transaksi='$id'");
                        echo "<script>window.location='index.php?page=transaksi';</script>";
                        exit();
                    }
                ?>
                    <div class="space-y-6">
                        <div class="bg-white p-6 rounded-lg shadow">
                            <h2 class="text-lg font-bold text-gray-800 mb-4">Form Pencatatan Transaksi BRILink</h2>
                            <form action="index.php?page=transaksi" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Jenis Layanan</label>
                                    <select name="jenis_layanan" required class="mt-1 w-full border rounded-md p-2 text-sm">
                                        <option value="">-- Pilih Layanan --</option>
                                        <option value="Transfer BRI">Transfer Sesama BRI</option>
                                        <option value="Transfer Bank Lain">Transfer Antar Bank</option>
                                        <option value="Tarik Tunai">Tarik Tunai</option>
                                        <option value="Setor Tunai">Setor Tunai</option>
                                        <option value="Token PLN">Pembelian Token PLN</option>
                                        <option value="Tagihan PLN">Bayar Tagihan PLN</option>
                                        <option value="BPJS Kesehatan">Bayar BPJS Kesehatan</option>
                                        <option value="Top Up Dompet Digital">Top Up Dompet Digital (DANA/OVO/Shopee)</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
                                    <input type="text" name="nama_pelanggan" required class="mt-1 w-full border rounded-md p-2 text-sm" placeholder="Nama pengirim/penerima">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nomor Rekening / No HP Tujuan</label>
                                    <input type="text" name="nomor_tujuan" required class="mt-1 w-full border rounded-md p-2 text-sm" placeholder="No Rekening / No HP">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nominal Transaksi (Rp)</label>
                                    <input type="number" name="nominal" required class="mt-1 w-full border rounded-md p-2 text-sm" placeholder="Contoh: 500000">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Biaya Admin Dibebankan ke Klien (Rp)</label>
                                    <input type="number" name="biaya_admin" required class="mt-1 w-full border rounded-md p-2 text-sm" placeholder="Contoh: 5000">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Fee / Keuntungan Bersih Agen (Rp)</label>
                                    <input type="number" name="fee_agen" required class="mt-1 w-full border rounded-md p-2 text-sm" placeholder="Contoh: 3000">
                                </div>
                                <input type="hidden" name="status" value="Sukses">
                                <div class="md:col-span-3 flex justify-end">
                                    <button type="submit" name="simpan_transaksi" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 font-semibold text-sm">Simpan Transaksi</button>
                                </div>
                            </form>
                        </div>

                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="p-4 bg-gray-50 border-b font-bold text-gray-700">Riwayat Transaksi Masuk</div>
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-100 border-b text-sm text-gray-600">
                                        <th class="p-3">No Ref</th>
                                        <th class="p-3">Waktu</th>
                                        <th class="p-3">Layanan</th>
                                        <th class="p-3">Pelanggan</th>
                                        <th class="p-3">Nominal</th>
                                        <th class="p-3">Admin</th>
                                        <th class="p-3">Fee Agen</th>
                                        <th class="p-3">Status</th>
                                        <th class="p-3 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y">
                                    <?php
                                    $res = mysqli_query($koneksi, "SELECT * FROM transaksi ORDER BY id_transaksi DESC");
                                    while ($r = mysqli_fetch_assoc($res)) :
                                    ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="p-3 font-semibold text-blue-700"><?= $r['no_referensi']; ?></td>
                                        <td class="p-3 text-xs text-gray-500"><?= $r['tanggal']; ?></td>
                                        <td class="p-3 font-medium"><?= $r['jenis_layanan']; ?></td>
                                        <td class="p-3">
                                            <div><?= $r['nama_pelanggan']; ?></div>
                                            <div class="text-xs text-gray-400"><?= $r['nomor_tujuan']; ?></div>
                                        </td>
                                        <td class="p-3 font-bold">Rp <?= number_format($r['nominal'], 0, ',', '.'); ?></td>
                                        <td class="p-3 text-blue-600">Rp <?= number_format($r['biaya_admin'], 0, ',', '.'); ?></td>
                                        <td class="p-3 font-bold text-emerald-600">Rp <?= number_format($r['fee_agen'], 0, ',', '.'); ?></td>
                                        <td class="p-3">
                                            <span class="px-2 py-1 rounded text-xs font-bold bg-emerald-100 text-emerald-800">
                                                <?= $r['status']; ?>
                                            </span>
                                        </td>
                                        <td class="p-3 text-center">
                                            <a href="index.php?page=transaksi&hapus=<?= $r['id_transaksi']; ?>" onclick="return confirm('Hapus catatan transaksi ini?')" class="text-red-600 hover:text-red-800"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
