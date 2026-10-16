<?php
 
                    $q_trx = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total, SUM(nominal) as jml_nominal, SUM(fee_agen) as total_fee FROM transaksi WHERE status='Sukses'"));
                    $total_transaksi = $q_trx['total'] ?? 0;
                    $total_nominal = $q_trx['jml_nominal'] ?? 0;
                    $total_fee = $q_trx['total_fee'] ?? 0;
                ?>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="bg-white p-5 rounded-lg shadow border-l-4 border-blue-600 flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Total Transaksi Sukses</p>
                                <h3 class="text-2xl font-bold text-gray-800"><?= $total_transaksi; ?></h3>
                            </div>
                            <i class="fa-solid fa-receipt text-3xl text-blue-600"></i>
                        </div>
                        <div class="bg-white p-5 rounded-lg shadow border-l-4 border-emerald-500 flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Total Nominal Mutasi</p>
                                <h3 class="text-xl font-bold text-gray-800">Rp <?= number_format($total_nominal, 0, ',', '.'); ?></h3>
                            </div>
                            <i class="fa-solid fa-wallet text-3xl text-emerald-500"></i>
                        </div>
                        <div class="bg-white p-5 rounded-lg shadow border-l-4 border-amber-500 flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Total Pendapatan Fee Agen</p>
                                <h3 class="text-xl font-bold text-emerald-600">Rp <?= number_format($total_fee, 0, ',', '.'); ?></h3>
                            </div>
                            <i class="fa-solid fa-hand-holding-dollar text-3xl text-amber-500"></i>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-lg font-bold text-gray-800 mb-2">Selamat Datang di Aplikasi Pembukuan Agen BRILink</h2>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Catat setiap transaksi transfer, tarik tunai, pembayaran tagihan PLN, BPJS, dan pulsa dengan mudah. Pantau fee pendapatan harian Anda secara real-time.
                        </p>
                        <a href="index.php?page=transaksi" class="inline-block bg-blue-600 text-white px-4 py-2 rounded font-semibold hover:bg-blue-700 text-sm"><i class="fa-solid fa-plus"></i> Input Transaksi Baru</a>
                    </div>
