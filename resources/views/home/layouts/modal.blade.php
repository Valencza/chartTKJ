<!-- modal alamat -->
<div class="modal fade" id="alamatModal" tabindex="-1" aria-labelledby="alamatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex align-items-center">
                    <div class="icon-container text-white d-flex align-items-center justify-content-center py-2 rounded-circle me-2" style="background-color: #e3f7ff; padding: 0px 15px;">
                        <i class="bi bi-geo-alt-fill fs-5 text-primary"></i>
                    </div>
                    <h5 class="modal-title mb-0" id="alamatModalLabel">Pengaturan Alamat</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="alamat" class="form-labe text-primary" style="font-weight: 600;">Alamat Saya</label>
                    </div>
                </form>
                <div class="list-group" id="alamatList">
                    <p class="text-muted">Memuat data...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary py-2" data-bs-toggle="modal" data-bs-target="#tambahAlamatModal">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Alamat
                </button>
            </div>
        </div>
    </div>
</div>

<!-- modal tambah alamat -->
<div class="modal fade" id="tambahAlamatModal" tabindex="-1" aria-labelledby="tambahAlamatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex align-items-center">
                    <div class="icon-container text-white d-flex align-items-center justify-content-center py-2 rounded-circle me-2" style="background-color: #e3f7ff; padding: 0px 15px;">
                        <i class="bi bi-geo-alt-fill fs-5 text-primary"></i>
                    </div>
                    <h5 class="modal-title mb-0" id="alamatModalLabel">Tambah Alamat Baru</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="alamatForm" action="{{ route('alamat.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label" style="font-weight: 600;">Nama Lengkap :</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama">
                    </div>
                    <div class="mb-3">
                        <label for="no_telpon" class="form-label" style="font-weight: 600;">Nomor Telepon :</label>
                        <input type="number" class="form-control text-start" name="no_telpon" id="no_telpon" placeholder="Masukkan nomor telepon" style="max-width: 100%;">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label" style="font-weight: 600;">Alamat Lengkap :</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Masukkan alamat lengkap (Kota, Kecamatan, Provinsi, Kode Pos)"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal" id="batalButton">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Alamat</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .modal-content {
        max-height: 80vh;
    }

    .modal-body {
        overflow-y: auto;
        max-height: 80vh;
    }

    /* Styling scrollbar untuk browser berbasis WebKit (Chrome, Edge, Safari) */
    .modal-body::-webkit-scrollbar {
        width: 10px;
    }

    .modal-body::-webkit-scrollbar-track {
        background: #e3f7ff;
        border-radius: 5px;
    }

    .modal-body::-webkit-scrollbar-thumb {
        background: #1687ff;
        border-radius: 5px;
    }

    .modal-body::-webkit-scrollbar-thumb:hover {
        background: #0056b3;
    }

    /* Styling untuk Firefox */
    .modal-body {
        scrollbar-color: #007bff #e3f7ff;
        scrollbar-width: thin;
    }

    .list-group-item.read {
        background-color: #fcfcfc;
        /* Warna abu-abu muda untuk notifikasi yang sudah dibaca */
    }
</style>

<!-- Modal Notifikasi -->
<div class="modal fade" id="notifikasiModal" tabindex="-1" aria-labelledby="notifikasiModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex align-items-center">
                    <div class="icon-container text-white d-flex align-items-center justify-content-center py-2 rounded-circle me-2" style="background-color: #e3f7ff; padding: 0px 15px;">
                        <i class="bi bi-bell-fill fs-5 text-primary"></i>
                    </div>
                    <h5 class="modal-title mb-0" id="notifikasiModalLabel">Notifikasi</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="list-group">
                    <div class="list-group-item py-3 read">
                        <small class="text-primary timestamp"></small>
                        <h6 class="my-2"><strong>Reminder : Tagihan jatuh tempo</strong></h6>
                        <p class="mb-0 text-muted">Segera lunasi tagihan Anda sebelum 5 Februari 2025 yyy.</p>
                    </div>
                    <div class="list-group-item py-3">
                        <small class="text-primary timestamp"></small>
                        <h6 class="my-2"><strong>Fitur baru tersedia!</strong></h6>
                        <p class="mb-0 text-muted">Coba fitur baru di aplikasi kami sekarang.</p>
                    </div>
                    <div class="list-group-item py-3">
                        <small class="text-primary timestamp"></small>
                        <h6 class="my-2"><strong>Pembayaran sukses!</strong></h6>
                        <p class="mb-0 text-muted">Pembayaran Anda telah berhasil diproses.</p>
                    </div>
                    <div class="list-group-item py-3">
                        <small class="text-primary timestamp"></small>
                        <h6 class="my-2"><strong>Promo Spesial!</strong></h6>
                        <p class="mb-0 text-muted">Dapatkan diskon 50% untuk pembelian pertama.</p>
                    </div>
                    <div class="list-group-item py-3">
                        <small class="text-primary timestamp"></small>
                        <h6 class="my-2"><strong>Update Sistem</strong></h6>
                        <p class="mb-0 text-muted">Sistem akan diperbarui pada 10 Februari 2025.Sistem akan diperbarui pada 10 Februari 2025.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex align-items-center">
                    <div class="icon-container text-white d-flex align-items-center justify-content-center py-2 rounded-circle me-2" style="background-color: #e3f7ff; padding: 0px 15px;">
                        <i class="bi bi-bell-fill fs-5 text-primary"></i>
                    </div>
                    <h5 class="modal-title mb-0" id="detailModalLabel">Detail Alamat</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detailModalBody">
                <!-- Detail teks akan ditampilkan di sini -->
            </div>
        </div>
    </div>
</div>

<!-- js tanggal -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let timestamps = document.querySelectorAll(".timestamp");

        timestamps.forEach(timestamp => {
            let now = new Date();
            let options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            timestamp.innerText = now.toLocaleDateString('id-ID', options);
        });
    });
</script>

<!-- sweet alert modal create alamat -->

<script>
    function formatNomor(input) {
        let value = input.value.replace(/\D/g, ''); // Hanya angka
        if (value.length > 4) {
            input.value = value.substring(0, 4) + '-' + value.substring(4);
        } else {
            input.value = value;
        }
    }

    function simpanAlamat() {
        console.log("Mengirim data..."); // Debugging
        let formData = new FormData();
        formData.append('nama', document.getElementById('nama').value);
        formData.append('no_telpon', document.getElementById('no_telpon').value);
        formData.append('alamat', document.getElementById('alamat').value);

        fetch("{{ route('alamat.store') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log("Response:", data); // Debugging respons
                if (data.success) {
                    swal("Berhasil!", data.message, "success").then(() => {
                        location.reload();
                    });
                } else {
                    swal("Gagal!", data.message, "error");
                }
            })
            .catch(error => {
                console.error("Fetch error:", error); // Debugging jika terjadi error
                swal("Error!", "Terjadi kesalahan saat mengirim data!", "error");
            });
    }
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let alamatModal = document.getElementById('alamatModal');

    alamatModal.addEventListener('show.bs.modal', function () {
        let alamatList = document.getElementById('alamatList');
        alamatList.innerHTML = '<p class="text-muted">Memuat data...</p>';
        
        fetch("{{ route('alamat.get') }}")
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    alamatList.innerHTML = "";
                    data.forEach(function(alamat) {
                        let fullText = `${alamat.alamat}`;
                        let words = fullText.split(" ");
                        let shortText = words.length > 8 ? words.slice(0, 8).join(" ") + "..." : fullText;

                        let listItem = document.createElement("div");
                        listItem.className = "list-group-item py-3";
                        listItem.innerHTML = `
                            <h6 class="mb-2"><strong>${alamat.nama}</strong> | ${alamat.no_telpon}</h6>
                            <p class="mb-0 text-muted">${shortText} ${words.length > 8 ? '<a href="#" class="lihat-detail text-primary">Lihat Detail</a>' : ''}</p>
                        `;

                        // Jika teks panjang, tambahkan event listener untuk menampilkan detail
                        if (words.length > 8) {
                            listItem.querySelector(".lihat-detail").addEventListener("click", function(e) {
                                e.preventDefault();
                                document.getElementById("detailModalBody").innerHTML = `
                                    <h6 class="mb-2"><strong>${alamat.nama}</strong> | ${alamat.no_telpon}</h6>
                                    <p class="mb-0">${fullText}</p>
                                `;
                                let detailModal = new bootstrap.Modal(document.getElementById("detailModal"));
                                detailModal.show();
                            });
                        }

                        alamatList.appendChild(listItem);
                    });
                } else {
                    alamatList.innerHTML = '<p class="text-muted">Belum ada alamat yang ditambahkan.</p>';
                }
            })
            .catch(error => {
                console.error("Error fetching data:", error);
                alamatList.innerHTML = '<p class="text-danger">Gagal memuat data.</p>';
            });
    });
});
</script>



<script>
    document.querySelectorAll('.dropdown-toggle').forEach(function(dropdown) {
        new bootstrap.Dropdown(dropdown, {
            popperConfig: function() {
                return {
                    modifiers: [{
                        name: 'preventOverflow',
                        options: {
                            boundary: 'window'
                        }, // Ubah boundary ke 'window'
                    }, ],
                };
            },
        });
    });
</script>