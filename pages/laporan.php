<?php
 
                ?>
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-4 bg-gray-50 border-b font-bold text-gray-700 flex justify-between items-center">
                            <span>Laporan Rekapitulasi & Fee Pendapatan Agen BRILink</span>
                            <button onclick="window.print()" class="bg-gray-800 text-white px-3 py-1.5 rounded text-xs font-semibold hover:bg-black"><i class="fa-solid fa-print"></i> Cetak Laporan</button>
                        </div>
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 border-b text-sm text-gray-600">
                                    <th class="p-3">No</th>
                                    <th class="p-3">No Ref</th>
                                    <th class="p-3">Tanggal</th>
                                    <th class="p-3">Jenis Layanan</th>
                                    <th class="p-3">Pelanggan</th>
                                    <th class="p-3">Nominal Transaksi</th>
                                    <th class="p-3">Admin Masuk</th>
                                    <th class="p-3">Fee Agen (Keuntungan)</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y">
                                <?php
                                $no = 1;
                                $total_omset = 0;
                                $total_fee_all = 0;
                                $res_lap = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE status='Sukses' ORDER BY id_transaksi DESC");
                                while($t = mysqli_fetch_assoc($res_lap)):
                                    $total_omset += $t['nominal'];
                                    $total_fee_all += $t['fee_agen'];
                                ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3"><?= $no++; ?></td>
                                    <td class="p-3 font-semibold text-blue-700"><?= $t['no_referensi']; ?></td>
                                    <td class="p-3 text-xs"><?= $t['tanggal']; ?></td>
                                    <td class="p-3"><?= $t['jenis_layanan']; ?></td>
                                    <td class="p-3"><?= $t['nama_pelanggan']; ?></td>
                                    <td class="p-3">Rp <?= number_format($t['nominal'],0,',','.'); ?></td>
                                    <td class="p-3">Rp <?= number_format($t['biaya_admin'],0,',','.'); ?></td>
                                    <td class="p-3 font-bold text-emerald-600">Rp <?= number_format($t['fee_agen'],0,',','.'); ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                            <tfoot>
                                <tr class="bg-gray-100 font-bold">
                                    <td colspan="5" class="p-3 text-right">Total Keseluruhan:</td>
                                    <td class="p-3 text-blue-700">Rp <?= number_format($total_omset,0,',','.'); ?></td>
                                    <td colspan="2" class="p-3 text-emerald-700 text-lg">Total Fee: Rp <?= number_format($total_fee_all,0,',','.'); ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
