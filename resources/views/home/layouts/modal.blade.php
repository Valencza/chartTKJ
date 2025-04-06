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
    <div class="modal-dialog modal-dialog-scrollable">
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
                <div class="list-group" id="notifikasiContainer">
                    <div class="text-center py-3 text-muted">Memuat notifikasi...</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajukan Tanggal Baru -->
<div class="modal fade" id="ajukanTanggalModal" tabindex="-1" aria-labelledby="ajukanTanggalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="submitNewDate">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="ajukanTanggalLabel">Ajukan Tanggal Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="servis_jasa_id" id="servisJasaId">
                    <label for="tanggal" class="form-label">Pilih Tanggal Baru:</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

        alamatModal.addEventListener('show.bs.modal', function() {
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

<!-- script notif -->

<script>
    function loadNotifikasi() {
        fetch('/notifikasi')
            .then(response => response.json())
            .then(data => {
                let notifikasiContainer = document.getElementById('notifikasiContainer');
                notifikasiContainer.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(notif => {
                        let notifItem = document.createElement('div');
                        notifItem.className = `list-group-item py-3 ${notif.status === 'negosiasi' ? 'bg-light' : ''}`;

                        // Ekstrak tanggal dari pesan notifikasi (format yang sudah ditentukan)
                        let tanggalTerakhir = notif.pesan.match(/\d{2} \w{3} \d{4}/g);
                        let tanggalTersimpan = tanggalTerakhir ? formatTanggalToInput(tanggalTerakhir[tanggalTerakhir.length - 1]) : '';

                        // Menambahkan konten untuk notifikasi
                        notifItem.innerHTML = `
    <small class="text-primary">${new Date(notif.created_at).toLocaleString()}</small>
    <h6 class="my-2"><strong>Pemberitahuan</strong></h6>
    <p class="mb-0 text-muted">${notif.pesan}</p>
    <div class="mt-2">
        ${notif.type === 'servis_jasa' && notif.status !== 'disetujui' ? `
            <button class="btn btn-sm btn-outline-success btn-approve" data-id="${notif.id}">Setujui</button>
            <button class="btn btn-sm btn-outline-warning btn-change-date" data-id="${notif.servis_jasa_id}" data-tanggal="${tanggalTersimpan}">Ajukan Tanggal Baru</button>
        ` : ''}
    </div>
`;

                        notifikasiContainer.appendChild(notifItem);
                    });
                } else {
                    notifikasiContainer.innerHTML = '<div class="text-center py-3 text-muted">Tidak ada notifikasi</div>';
                }
            });
    }

    document.getElementById('notifikasiContainer').addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-approve')) {
            let servisJasaId = e.target.getAttribute('data-id');
            console.log('Servis Jasa ID:', servisJasaId); // Debugging

            fetch(`/notifikasi/disetujui/${servisJasaId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        _method: 'PUT', // Pastikan ini sesuai dengan apa yang diharapkan server
                        id: servisJasaId,
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Response Data:', data); // Menampilkan data dari respons
                    if (data.success) {
                        // Menampilkan SweetAlert setelah permintaan berhasil
                        Swal.fire('Berhasil!', data.message, 'success')
                            .then(() => {
                                // Melakukan reload halaman setelah SweetAlert muncul
                                location.reload(); // Ini akan me-refresh halaman setelah alert ditutup
                            });
                    } else {
                        Swal.fire('Gagal!', data.message || 'Terjadi kesalahan saat mengubah status notifikasi.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat mengubah status notifikasi.', 'error');
                });
        }
    });

    document.getElementById('notifikasiContainer').addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-change-date')) {
            let servisJasaId = e.target.getAttribute('data-id');
            let tanggalTersimpan = e.target.getAttribute('data-tanggal');

            // Set nilai input dalam modal
            document.getElementById('servisJasaId').value = servisJasaId;
            document.getElementById('tanggal').value = tanggalTersimpan;

            // Tampilkan modal menggunakan Bootstrap 5
            let modal = new bootstrap.Modal(document.getElementById('ajukanTanggalModal'));
            modal.show();
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        loadNotifikasi();

        document.getElementById('notifikasiModal').addEventListener('show.bs.modal', function() {
            loadNotifikasi();
        });

        // Menangani submit form
        document.getElementById('submitNewDate').addEventListener('submit', function(event) {
            event.preventDefault();

            const servisJasaId = document.getElementById('servisJasaId').value;
            const tanggal = document.getElementById('tanggal').value;

            fetch(`/notifikasi/change-date/${servisJasaId}`, {
                    method: 'POST', // Gunakan POST agar Laravel menerima FormData
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        _method: 'PUT', // Tambahkan agar dikenali sebagai PUT
                        servis_jasa_id: servisJasaId, // Pastikan ini dikirim
                        tanggal: tanggal
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Berhasil!', data.message, 'success');
                        window.location.reload();
                    } else {
                        console.log(data.errors); // Debugging
                        Swal.fire('Gagal!', 'Validasi gagal: ' + JSON.stringify(data.errors), 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan perubahan.', 'error');
                });
        });

        document.getElementById('markAllRead').addEventListener('click', function() {
            fetch('/notifikasi/read-all', {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(() => {
                    loadNotifikasi();
                });
        });
    });

    function formatTanggalToInput(tanggal) {
        const bulanMapping = {
            "Jan": "01",
            "Feb": "02",
            "Mar": "03",
            "Apr": "04",
            "May": "05",
            "Jun": "06",
            "Jul": "07",
            "Aug": "08",
            "Sep": "09",
            "Oct": "10",
            "Nov": "11",
            "Dec": "12"
        };

        let parts = tanggal.split(' ');
        if (parts.length === 3) {
            let day = parts[0].padStart(2, '0');
            let month = bulanMapping[parts[1]];
            let year = parts[2];
            return `${year}-${month}-${day}`;
        }
        return '';
    }
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
</script><!-- modal alamat -->
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
    <div class="modal-dialog modal-dialog-scrollable">
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
                <div class="list-group" id="notifikasiContainer">
                    <div class="text-center py-3 text-muted">Memuat notifikasi...</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajukan Tanggal Baru -->
<div class="modal fade" id="ajukanTanggalModal" tabindex="-1" aria-labelledby="ajukanTanggalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="submitNewDate">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="ajukanTanggalLabel">Ajukan Tanggal Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="servis_jasa_id" id="servisJasaId">
                    <label for="tanggal" class="form-label">Pilih Tanggal Baru:</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

        alamatModal.addEventListener('show.bs.modal', function() {
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

<!-- script notif -->

<script>
    function loadNotifikasi() {
        fetch('/notifikasi')
            .then(response => response.json())
            .then(data => {
                let notifikasiContainer = document.getElementById('notifikasiContainer');
                notifikasiContainer.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(notif => {
                        let notifItem = document.createElement('div');
                        notifItem.className = `list-group-item py-3 ${notif.status === 'negosiasi' ? 'bg-light' : ''}`;

                        // Ekstrak tanggal dari pesan notifikasi (format yang sudah ditentukan)
                        let tanggalTerakhir = notif.pesan.match(/\d{2} \w{3} \d{4}/g);
                        let tanggalTersimpan = tanggalTerakhir ? formatTanggalToInput(tanggalTerakhir[tanggalTerakhir.length - 1]) : '';

                        // Menambahkan konten untuk notifikasi
                        notifItem.innerHTML = `
    <small class="text-primary">${new Date(notif.created_at).toLocaleString()}</small>
    <h6 class="my-2"><strong>Pemberitahuan</strong></h6>
    <p class="mb-0 text-muted">${notif.pesan}</p>
    <div class="mt-2">
        ${notif.type === 'servis_jasa' && notif.status !== 'disetujui' ? `
            <button class="btn btn-sm btn-outline-success btn-approve" data-id="${notif.id}">Setujui</button>
            <button class="btn btn-sm btn-outline-warning btn-change-date" data-id="${notif.servis_jasa_id}" data-tanggal="${tanggalTersimpan}">Ajukan Tanggal Baru</button>
        ` : ''}
    </div>
`;

                        notifikasiContainer.appendChild(notifItem);
                    });
                } else {
                    notifikasiContainer.innerHTML = '<div class="text-center py-3 text-muted">Tidak ada notifikasi</div>';
                }
            });
    }

    document.getElementById('notifikasiContainer').addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-approve')) {
            let servisJasaId = e.target.getAttribute('data-id');
            console.log('Servis Jasa ID:', servisJasaId); // Debugging

            fetch(`/notifikasi/disetujui/${servisJasaId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        _method: 'PUT', // Pastikan ini sesuai dengan apa yang diharapkan server
                        id: servisJasaId,
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Response Data:', data); // Menampilkan data dari respons
                    if (data.success) {
                        // Menampilkan SweetAlert setelah permintaan berhasil
                        Swal.fire('Berhasil!', data.message, 'success')
                            .then(() => {
                                // Melakukan reload halaman setelah SweetAlert muncul
                                location.reload(); // Ini akan me-refresh halaman setelah alert ditutup
                            });
                    } else {
                        Swal.fire('Gagal!', data.message || 'Terjadi kesalahan saat mengubah status notifikasi.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat mengubah status notifikasi.', 'error');
                });
        }
    });

    document.getElementById('notifikasiContainer').addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-change-date')) {
            let servisJasaId = e.target.getAttribute('data-id');
            let tanggalTersimpan = e.target.getAttribute('data-tanggal');

            // Set nilai input dalam modal
            document.getElementById('servisJasaId').value = servisJasaId;
            document.getElementById('tanggal').value = tanggalTersimpan;

            // Tampilkan modal menggunakan Bootstrap 5
            let modal = new bootstrap.Modal(document.getElementById('ajukanTanggalModal'));
            modal.show();
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        loadNotifikasi();

        document.getElementById('notifikasiModal').addEventListener('show.bs.modal', function() {
            loadNotifikasi();
        });

        // Menangani submit form
        document.getElementById('submitNewDate').addEventListener('submit', function(event) {
            event.preventDefault();

            const servisJasaId = document.getElementById('servisJasaId').value;
            const tanggal = document.getElementById('tanggal').value;

            fetch(`/notifikasi/change-date/${servisJasaId}`, {
                    method: 'POST', // Gunakan POST agar Laravel menerima FormData
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        _method: 'PUT', // Tambahkan agar dikenali sebagai PUT
                        servis_jasa_id: servisJasaId, // Pastikan ini dikirim
                        tanggal: tanggal
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Berhasil!', data.message, 'success');
                        window.location.reload();
                    } else {
                        console.log(data.errors); // Debugging
                        Swal.fire('Gagal!', 'Validasi gagal: ' + JSON.stringify(data.errors), 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan perubahan.', 'error');
                });
        });

        document.getElementById('markAllRead').addEventListener('click', function() {
            fetch('/notifikasi/read-all', {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(() => {
                    loadNotifikasi();
                });
        });
    });

    function formatTanggalToInput(tanggal) {
        const bulanMapping = {
            "Jan": "01",
            "Feb": "02",
            "Mar": "03",
            "Apr": "04",
            "May": "05",
            "Jun": "06",
            "Jul": "07",
            "Aug": "08",
            "Sep": "09",
            "Oct": "10",
            "Nov": "11",
            "Dec": "12"
        };

        let parts = tanggal.split(' ');
        if (parts.length === 3) {
            let day = parts[0].padStart(2, '0');
            let month = bulanMapping[parts[1]];
            let year = parts[2];
            return `${year}-${month}-${day}`;
        }
        return '';
    }
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