@extends('dashboard.layouts.app')

@section('content')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">

        <div class="container mt-5">
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card shadow-sm p-5 border-0 d-flex flex-column h-100">
                        <div class="d-flex align-items-center">
                            <div class="me-4 p-5" style="background-color:rgb(220, 239, 255)">
                                <i class="bi bi-cash-stack text-primary fs-1"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-primary">Pendapatan Pembelian</h5>
                                <!-- Menampilkan total pendapatan dalam format Rupiah -->
                                @if(isset($totalPendapatanProduk) && $totalPendapatanProduk > 0)
                                <h3 class="fw-bold">Rp {{ number_format($totalPendapatanProduk, 0, ',', '.') }}</h3>
                                @else
                                <h3 class="fw-bold">Rp 0</h3>
                                @endif
                                <p class="text-muted mb-0">Total pendapatan bulan ini</p>
                            </div>
                        </div>
                        <div class="mt-auto"></div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card shadow-sm p-5 border-0 d-flex flex-column h-100">
                        <div class="d-flex align-items-center">
                            <div class="me-4 p-5" style="background-color:rgb(220, 239, 255)">
                                <i class="bi bi-cash-stack text-primary fs-1"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-primary">Pendapatan Servis Jasa</h5>
                                @if(isset($totalPendapatanServis) && $totalPendapatanServis > 0)
                                <h3 class="fw-bold">Rp {{ number_format($totalPendapatanServis, 0, ',', '.') }}</h3>
                                @else
                                <h3 class="fw-bold">Rp 0</h3>
                                @endif
                                <p class="text-muted mb-0">Total pendapatan bulan ini</p>
                            </div>
                        </div>
                        <div class="mt-auto"></div>
                    </div>
                </div>
                <!-- Total Layanan Barang -->
                <div class="col-xl-3 col-md-12 mb-4">
                    <div class="card shadow-sm p-5 border-0 d-flex flex-column h-100">
                        <div class="d-flex align-items-center">
                            <div class="me-4 p-5" style="background-color:rgb(220, 239, 255)">
                                <i class="bi bi-cash-stack text-primary fs-1"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-primary">Pendapatan Servis Barang</h5>
                                @if(isset($totalPendapatanJasa) && $totalPendapatanJasa > 0)
                                <h3 class="fw-bold">Rp {{ number_format($totalPendapatanJasa, 0, ',', '.') }}</h3>
                                @else
                                <h3 class="fw-bold">Rp 0</h3>
                                @endif
                                <p class="text-muted mb-0">Total pendapatan bulan ini</p>
                            </div>
                        </div>
                        <div class="mt-auto"></div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card shadow-sm p-5 border-0 d-flex flex-column h-100">
                        <div class="d-flex align-items-center">
                            <div class="me-4 p-5" style="background-color:rgb(220, 239, 255)">
                                <i class="bi bi-cash-stack text-primary fs-1"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-primary">Pendapatan Keseluruhan Bulan Ini</h5>
                                <!-- Menampilkan total pendapatan keseluruhan dalam format Rupiah -->
                                @if(isset($totalPendapatanKeseluruhan) && $totalPendapatanKeseluruhan > 0)
                                <h3 class="fw-bold">Rp {{ number_format($totalPendapatanKeseluruhan, 0, ',', '.') }}</h3>
                                @else
                                <h3 class="fw-bold">Rp 0</h3>
                                @endif
                                <p class="text-muted mb-0">Total pendapatan bulan ini</p>
                            </div>
                        </div>
                        <div class="mt-auto"></div>
                    </div>
                </div>
            </div>
            <div class="row mt-4 mb-5">
                <div class="col-xl-12 mb-5 pb-4">
                    <div class="card shadow-sm p-5 border-0">
                        <div class="d-xl-flex d-md-flex justify-content-between mb-3">
                            <div class="d-flex align-items-center mb-5">
                                <div class="me-5 p-3" style="background-color:rgb(220, 239, 255)">
                                    <i class="bi bi-cart3 text-primary fs-1"></i>
                                </div>
                                <div class="d-flex flex-column">
                                    <h4 class="fw-bold mb-0">Pendapatan Pembelian</h4>
                                    <p class="text-muted mb-0">Grafik Pendapatan Pembelian</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start filter-container mb-5">
                                <select id="filterGrafik" class="form-select w-auto">
                                    <option value="year">1 Tahun</option>
                                    <option value="month">Bulan Ini</option>
                                    <option value="last_month">Bulan Lalu</option>
                                    <option value="week">Minggu Ini</option>
                                    <option value="custom">Custom Tanggal</option>
                                </select>
                                <input type="date" id="customDate" class="form-control w-auto ms-lg-2 ms-md-2 ms-0 d-none">
                            </div>
                        </div>
                        <div class="chart-container" style="overflow-x: auto; width: 100%;">
                            <canvas id="chartTransaksi" style="min-width: 600px; max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 mb-5 pb-4">
                    <div class="card shadow-sm p-5 border-0">
                        <div class="d-xl-flex d-md-flex justify-content-between mb-3">
                            <div class="d-flex align-items-center mb-5">
                                <div class="me-5 p-3" style="background-color:rgb(220, 239, 255)">
                                    <i class="bi bi-tools text-primary fs-1"></i>
                                </div>
                                <div class="d-flex flex-column">
                                    <h4 class="fw-bold mb-0">Pendapatan Layanan Servis</h4>
                                    <p class="text-muted mb-0">Grafik Pendapatan Servis Barang</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start filter-container mb-5">
                                <select id="filterServis" class="form-select w-auto">
                                    <option value="year">1 Tahun</option>
                                    <option value="month">Bulan Ini</option>
                                    <option value="last_month">Bulan Lalu</option>
                                    <option value="week">Minggu Ini</option>
                                    <option value="custom">Custom Tanggal</option>
                                </select>
                                <input type="date" id="customDateServis" class="form-control w-auto ms-lg-2 ms-md-2 ms-0 d-none">
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="chartServis" style="min-width: 600px; max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 mb-5 pb-4">
                    <div class="card shadow-sm p-5 border-0">
                        <div class="d-xl-flex d-md-flex justify-content-between mb-3">
                            <div class="d-flex align-items-center mb-5">
                                <div class="me-5 p-3" style="background-color:rgb(220, 239, 255)">
                                    <i class="bi bi-wrench text-primary fs-1"></i>
                                </div>
                                <div class="d-flex flex-column">
                                    <h4 class="fw-bold mb-0">Pendapatan Layanan Servis</h4>
                                    <p class="text-muted mb-0">Grafik Pendapatan Servis Jasa</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start filter-container mb-5">
                                <select id="filterJasa" class="form-select w-auto">
                                    <option value="year">1 Tahun</option>
                                    <option value="month">Bulan Ini</option>
                                    <option value="last_month">Bulan Lalu</option>
                                    <option value="week">Minggu Ini</option>
                                    <option value="custom">Custom Tanggal</option>
                                </select>
                                <input type="date" id="customDateJasa" class="form-control w-auto ms-lg-2 ms-md-2 ms-0  d-none">
                            </div>
                        </div>
                        <div class="chart-container" style="overflow-x: auto; width: 100%;">
                            <canvas id="chartJasa" style="min-width: 600px; max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- js grafik pembelian -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const ctx = document.getElementById("chartTransaksi").getContext("2d");
                let chartTransaksi;
                const filterGrafik = document.getElementById("filterGrafik");
                const customDate = document.getElementById("customDate");

                function responsiveFontSize() {
                    if (window.innerWidth <= 480) return 6;
                    if (window.innerWidth <= 500) return 7;
                    if (window.innerWidth <= 768) return 10;
                    return 12;
                }

                function generateChart(labels, data) {
                    if (chartTransaksi) {
                        chartTransaksi.destroy();
                    }

                    chartTransaksi = new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Pendapatan (Rp)",
                                data: data,
                                backgroundColor: "#74a0ff",
                                borderRadius: 5,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            layout: {
                                padding: {
                                    left: 10,
                                    right: 10,
                                    top: 20,
                                    bottom: 10
                                }
                            },
                            scales: {
                                x: {
                                    ticks: {
                                        autoSkip: true,
                                        maxRotation: 45,
                                        font: {
                                            size: responsiveFontSize()
                                        }
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    max: 5000000,
                                    ticks: {
                                        stepSize: 500000,
                                        font: {
                                            size: responsiveFontSize()
                                        },
                                        callback: function(value) {
                                            return 'Rp ' + value.toLocaleString();
                                        }
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    labels: {
                                        font: {
                                            size: responsiveFontSize()
                                        }
                                    }
                                },
                                tooltip: {
                                    bodyFont: {
                                        size: responsiveFontSize()
                                    },
                                    titleFont: {
                                        size: responsiveFontSize() + 2
                                    }
                                }
                            }
                        }
                    });
                }

                function updateChart(filter) {
                    fetch(`/api/get-pendapatan-grafik?filter=${filter}`)
                        .then(response => response.json())
                        .then(data => {
                            generateChart(data.labels, data.data);
                        });
                }

                filterGrafik.addEventListener("change", function() {
                    const selectedFilter = this.value;

                    if (selectedFilter === "custom") {
                        customDate.classList.remove("d-none");
                    } else {
                        customDate.classList.add("d-none");
                        updateChart(selectedFilter);
                    }
                });

                customDate.addEventListener("change", function() {
                    if (this.value) {
                        fetch(`/api/get-servisproduk-by-date?date=${this.value}`)
                            .then(response => response.json())
                            .then(data => {
                                console.log("Custom Date Data:", data); // Debugging
                                if (chartTransaksi) chartTransaksi.destroy();
                                generateChart(data.labels, data.data); // Sesuai format Chart.js
                            })
                            .catch(error => console.error("Error fetching custom date data:", error));
                    }
                });

                window.addEventListener("resize", function() {
                    generateChart(
                        chartTransaksi.data.labels,
                        chartTransaksi.data.datasets[0].data
                    );
                });

                updateChart("year");
            });
        </script>

        <!-- js grafik layanan servis barang -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const ctx = document.getElementById("chartServis").getContext("2d");
                let chartTransaksi;
                const filterServis = document.getElementById("filterServis"); // Ganti nama variabel
                const customDateServis = document.getElementById("customDateServis");

                function responsiveFontSize() {
                    if (window.innerWidth <= 480) return 6;
                    if (window.innerWidth <= 500) return 7;
                    if (window.innerWidth <= 768) return 10;
                    return 12;
                }

                function generateChart(labels, data) {
                    if (chartTransaksi) {
                        chartTransaksi.destroy();
                    }

                    chartTransaksi = new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Pendapatan (Rp)",
                                data: data,
                                backgroundColor: "#74a0ff",
                                borderRadius: 5,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            layout: {
                                padding: {
                                    left: 10,
                                    right: 10,
                                    top: 20,
                                    bottom: 10
                                }
                            },
                            scales: {
                                x: {
                                    ticks: {
                                        autoSkip: true,
                                        maxRotation: 45,
                                        font: {
                                            size: responsiveFontSize()
                                        }
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    suggestedMax: 1000000,
                                    ticks: {
                                        stepSize: 100000,
                                        font: {
                                            size: responsiveFontSize()
                                        },
                                        callback: function(value) {
                                            return 'Rp ' + value.toLocaleString();
                                        }
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    labels: {
                                        font: {
                                            size: responsiveFontSize()
                                        }
                                    }
                                },
                                tooltip: {
                                    bodyFont: {
                                        size: responsiveFontSize()
                                    },
                                    titleFont: {
                                        size: responsiveFontSize() + 2
                                    }
                                }
                            }
                        }
                    });
                }

                function updateChart(filter) {
                    fetch(`/api/get-servisbarang-grafik?filter=${filter}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log("Data API:", data);
                            if (data.labels && data.data) {
                                generateChart(data.labels, data.data);
                            } else {
                                console.error("Data dari API tidak valid");
                            }
                        })
                        .catch(error => console.error("Error fetch data:", error));
                }

                filterServis.addEventListener("change", function() { // Ubah event listener ke filterServis
                    const selectedFilter = this.value;

                    if (selectedFilter === "custom") {
                        customDateServis.classList.remove("d-none");
                    } else {
                        customDateServis.classList.add("d-none");
                        updateChart(selectedFilter);
                    }
                });

                customDateServis.addEventListener("change", function() {
                    if (this.value) {
                        fetch(`/api/get-servisbarang-by-date?date=${this.value}`)
                            .then(response => response.json())
                            .then(data => {
                                console.log("Custom Date Data:", data); // Debugging
                                if (chartTransaksi) chartTransaksi.destroy();
                                generateChart(data.labels, data.data); // Sesuai format Chart.js
                            })
                            .catch(error => console.error("Error fetching custom date data:", error));
                    }
                });

                window.addEventListener("resize", function() {
                    if (chartTransaksi) {
                        generateChart(
                            chartTransaksi.data.labels,
                            chartTransaksi.data.datasets[0].data
                        );
                    }
                });

                updateChart("year");
            });
        </script>

        <!-- js grafik layanan servis jasa -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const ctx = document.getElementById("chartJasa").getContext("2d");
                let chartTransaksi;
                const filterJasa = document.getElementById("filterJasa"); // Ganti nama variabel
                const customDateJasa = document.getElementById("customDateJasa");

                function responsiveFontSize() {
                    if (window.innerWidth <= 480) return 6;
                    if (window.innerWidth <= 500) return 7;
                    if (window.innerWidth <= 768) return 10;
                    return 12;
                }

                function generateChart(labels, data) {
                    if (chartTransaksi) {
                        chartTransaksi.destroy();
                    }

                    chartTransaksi = new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Pendapatan (Rp)",
                                data: data,
                                backgroundColor: "#74a0ff",
                                borderRadius: 5,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            layout: {
                                padding: {
                                    left: 10,
                                    right: 10,
                                    top: 20,
                                    bottom: 10
                                }
                            },
                            scales: {
                                x: {
                                    ticks: {
                                        autoSkip: true,
                                        maxRotation: 45,
                                        font: {
                                            size: responsiveFontSize()
                                        }
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    suggestedMax: 1000000,
                                    ticks: {
                                        stepSize: 100000,
                                        font: {
                                            size: responsiveFontSize()
                                        },
                                        callback: function(value) {
                                            return 'Rp ' + value.toLocaleString();
                                        }
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    labels: {
                                        font: {
                                            size: responsiveFontSize()
                                        }
                                    }
                                },
                                tooltip: {
                                    bodyFont: {
                                        size: responsiveFontSize()
                                    },
                                    titleFont: {
                                        size: responsiveFontSize() + 2
                                    }
                                }
                            }
                        }
                    });
                }

                function updateChart(filter) {
                    fetch(`/api/get-servislayanan-grafik?filter=${filter}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log("Data API:", data);
                            if (data.labels && data.data) {
                                generateChart(data.labels, data.data);
                            } else {
                                console.error("Data dari API tidak valid");
                            }
                        })
                        .catch(error => console.error("Error fetch data:", error));
                }

                filterJasa.addEventListener("change", function() { // Ubah event listener ke filterJasa
                    const selectedFilter = this.value;

                    if (selectedFilter === "custom") {
                        customDateJasa.classList.remove("d-none");
                    } else {
                        customDateJasa.classList.add("d-none");
                        updateChart(selectedFilter);
                    }
                });

                customDateJasa.addEventListener("change", function() {
                    if (this.value) {
                        fetch(`/api/get-servislayanan-by-date?date=${this.value}`)
                            .then(response => response.json())
                            .then(data => {
                                console.log("Custom Date Data:", data); // Debugging
                                if (chartTransaksi) chartTransaksi.destroy();
                                generateChart(data.labels, data.data); // Sesuai format Chart.js
                            })
                            .catch(error => console.error("Error fetching custom date data:", error));
                    }
                });

                window.addEventListener("resize", function() {
                    if (chartTransaksi) {
                        generateChart(
                            chartTransaksi.data.labels,
                            chartTransaksi.data.datasets[0].data
                        );
                    }
                });

                updateChart("year");
            });
        </script>

        @endsection