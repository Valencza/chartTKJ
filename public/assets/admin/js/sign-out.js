document.addEventListener("DOMContentLoaded", function() {
    var logoutLink = document.getElementById("logout-link");

    if (logoutLink) {
        logoutLink.addEventListener("click", function(event) {
            event.preventDefault();

            Swal.fire({
                text: "Apakah anda yakin ingin keluar?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, keluar!",
                cancelButtonText: "Tidak, batal",
                customClass: {
                    confirmButton: "btn btn-dark",
                    cancelButton: "btn btn-active-light",
                },
            }).then(function(result) {
                if (result.value) {
                    window.location.href = "{{route ('login') }}";
                } else if (result.dismiss === "cancel") {
                    Swal.fire({
                        text: "Keluar dibatalkan.",
                        icon: "error",
                        buttonsStyling: false,
                        showConfirmButton: false,
                        timer: 900,
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary"
                        }
                    });
                }
            });
        });
    }
});


document.addEventListener("DOMContentLoaded", function() {
    var logoutLink = document.getElementById("logout-link-2");

    if (logoutLink) {
        logoutLink.addEventListener("click", function(event) {
            event.preventDefault();

            Swal.fire({
                text: "Apakah anda yakin ingin keluar?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, keluar!",
                cancelButtonText: "Tidak, batal",
                customClass: {
                    confirmButton: "btn btn-dark",
                    cancelButton: "btn btn-active-light",
                },
            }).then(function(result) {
                if (result.value) {
                    window.location.href = "{{route ('login') }}";
                } else if (result.dismiss === "cancel") {
                    Swal.fire({
                        text: "Keluar dibatalkan.",
                        icon: "error",
                        buttonsStyling: false,
                        showConfirmButton: false,
                        timer: 900,
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary"
                        }
                    });
                }
            });
        });
    }
});
