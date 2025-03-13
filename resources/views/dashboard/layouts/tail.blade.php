<div id="kt_activities" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="activities" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'lg': '900px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_activities_toggle" data-kt-drawer-close="#kt_activities_close">

	<div class="card shadow-none border-0 rounded-0">
		<div class="card-header" id="kt_activities_header">
			<h3 class="card-title fw-bold text-gray-900">Chat</h3>
			<div class="card-toolbar">
				<button type="button" class="btn btn-sm btn-icon btn-active-light-primary me-n5" id="kt_activities_close">
					<i class="ki-outline ki-cross fs-1"></i>
				</button>
			</div>
		</div>
		<div class="card-body position-relative" id="kt_activities_body">
			<div id="kt_activities_scroll" class="position-relative scroll-y me-n5 pe-5" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_activities_body" data-kt-scroll-dependencies="#kt_activities_header, #kt_activities_footer" data-kt-scroll-offset="5px">
			</div>
		</div>
	</div>
</div>

<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
	<i class="ki-outline ki-arrow-up"></i>
</div>

<script src="{{ asset('/sw.js') }}"></script>
<script>
	if ("serviceWorker" in navigator) {
		navigator.serviceWorker.register("/sw.js").then(
			(registration) => {
				console.log("Service worker registration succeeded:", registration);
			},
			(error) => {
				console.error(`Service worker registration failed: ${error}`);
			},
		);
	} else {
		console.error("Service workers are not supported.");
	}
</script>

<!--begin::Javascript-->
<script>
	var hostUrl = "{{ asset('assets/') }}";
</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{asset ('assets/admin/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{asset ('assets/admin/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{asset ('assets/admin/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
<script src="{{asset ('assets/admin/plugins/custom/datatables/datatables.bundle.js') }}"></script>

<!--end::Vendors Javascript-->

<!-- Dropify JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
	$('.dropify').dropify({
		messages: {
			default: 'Drag or drop your image',
			replace: 'Drag or drop to replace',
			remove: 'Remove image',
			error: 'Oops, invalid file!'
		},
		tpl: {
			message: `
                <div class="dropify-message">
                    <img src="{{ asset('assets/admin/media/drop-file.png') }}" alt="Upload Icon" style="width: 100px; margin-bottom: 5px;">
                    <p>Drag or drop your image</p>
                </div>
            `
		}
	});
</script>

<script type="importmap">
	{
                "imports": {
                    "ckeditor5": "{{asset ('assets/admin/plugins/ckeditor5/ckeditor5.js') }}",
                    "ckeditor5/": "{{asset ('assets/admin/plugins/ckeditor5/') }}"
                }
            }
        </script>
<script type="module">
	import {
		ClassicEditor,
		Essentials,
		Paragraph,
		Bold,
		Italic,
		Font
	} from 'ckeditor5';

	ClassicEditor
		.create(document.querySelector('.editor-tambah'), {
			licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3Mzk0MDQ3OTksImp0aSI6IjMyMjYzZjczLWFjMTUtNGJkYS05ZWVmLTJjNDBmODZjNjBmOSIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6IjhmZDIwYWY3In0.Jq_U45S6bHP2iPoEwUTM64K2mdwdpuE8H9qDFTCOz1S5vocorw06zhFDpv2dZBkgbeeyuHW6ueckX-4b4zLumg', // Or 'GPL'.
			plugins: [Essentials, Paragraph, Bold, Italic, Font],
			toolbar: [
				'undo', 'redo', '|', 'bold', 'italic', '|',
				'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
			]
		})
		.then(editor => {
			window.editor = editor;
		})
		.catch(error => {
			console.error(error);
		});
</script>
<script type="module">
	import {
		ClassicEditor,
		Essentials,
		Paragraph,
		Bold,
		Italic,
		Font
	} from 'ckeditor5';

	ClassicEditor
		.create(document.querySelector('.editor-tambah2'), {
			licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3Mzk0MDQ3OTksImp0aSI6IjMyMjYzZjczLWFjMTUtNGJkYS05ZWVmLTJjNDBmODZjNjBmOSIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6IjhmZDIwYWY3In0.Jq_U45S6bHP2iPoEwUTM64K2mdwdpuE8H9qDFTCOz1S5vocorw06zhFDpv2dZBkgbeeyuHW6ueckX-4b4zLumg', // Or 'GPL'.
			plugins: [Essentials, Paragraph, Bold, Italic, Font],
			toolbar: [
				'undo', 'redo', '|', 'bold', 'italic', '|',
				'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
			]
		})
		.then(editor => {
			window.editor = editor;
		})
		.catch(error => {
			console.error(error);
		});
</script>

<script type="module">
	import {
		ClassicEditor,
		Essentials,
		Paragraph,
		Bold,
		Italic,
		Font
	} from 'ckeditor5';

	ClassicEditor
		.create(document.querySelector('.editor-edit'), {
			licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3Mzk0MDQ3OTksImp0aSI6IjMyMjYzZjczLWFjMTUtNGJkYS05ZWVmLTJjNDBmODZjNjBmOSIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6IjhmZDIwYWY3In0.Jq_U45S6bHP2iPoEwUTM64K2mdwdpuE8H9qDFTCOz1S5vocorw06zhFDpv2dZBkgbeeyuHW6ueckX-4b4zLumg', // Or 'GPL'.
			plugins: [Essentials, Paragraph, Bold, Italic, Font],
			toolbar: [
				'undo', 'redo', '|', 'bold', 'italic', '|',
				'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
			]
		})
		.then(editor => {
			window.editor = editor;
		})
		.catch(error => {
			console.error(error);
		});
</script>

<!--begin::Custom Javascript(used for this page only)-->
<script src="{{asset ('assets/admin/js/widgets.bundle.js') }}"></script>
<script src="{{asset ('assets/admin/js/custom/widgets.js') }}"></script>
<script src="{{asset ('assets/admin/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{asset ('assets/admin/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
<script src="{{asset ('assets/admin/js/custom/utilities/modals/create-app.js') }}"></script>
<script src="{{asset ('assets/admin/js/custom/utilities/modals/create-project/type.js') }}"></script>
<script src="{{asset ('assets/admin/js/custom/utilities/modals/create-project/budget.js') }}"></script>
<script src="{{asset ('assets/admin/js/custom/utilities/modals/create-project/settings.js') }}"></script>
<script src="{{asset ('assets/admin/js/custom/utilities/modals/create-project/team.js') }}"></script>
<script src="{{asset ('assets/admin/js/custom/utilities/modals/create-project/targets.js') }}"></script>
<script src="{{asset ('assets/admin/js/custom/utilities/modals/create-project/files.js') }}"></script>
<script src="{{asset ('assets/admin/js/custom/utilities/modals/create-project/complete.js') }}"></script>
<script src="{{asset ('assets/admin/js/custom/utilities/modals/create-project/main.js') }}"></script>
<script src="{{asset ('assets/admin/js/custom/utilities/modals/users-search.js') }}"></script>
<script src="{{asset ('assets/admin/js/sign-out.js') }}"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->

<!--custom js-->
<script src="{{asset ('assets/admin/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!--js datatables-->
<script>
	"use strict";

	var KTAppEcommerceReportSales = function() {
		var dataTable;

		return {
			init: function() {
				// Initialize DataTable
				(dataTable = document.querySelector("#table")) && (dataTable.querySelectorAll("tbody tr").forEach((row => {
					const cells = row.querySelectorAll("td");
					const dateValue = moment(cells[0].innerHTML, "MMM DD, YYYY").format();
					cells[0].setAttribute("data-order", dateValue);
				})), dataTable = $(dataTable).DataTable({
					info: !1,
					order: [],
					pageLength: 10,
					scrollX: true,
					scrollCollapse: true,
				}));

				// Add event listener for search input
				document.querySelector('[table-search="search"]').addEventListener("keyup", (function(event) {
					dataTable.search(event.target.value).draw();
				}));
			}
		}
	}();

	KTUtil.onDOMContentLoaded((function() {
		KTAppEcommerceReportSales.init();
	}));
</script>

<!--js alert delete-->
<!-- <script>
	document.addEventListener("DOMContentLoaded", function() {
		document.querySelectorAll('[data-kt-permissions-table-filter="delete_row"]').forEach(button => {
			button.addEventListener("click", function() {
				Swal.fire({
					title: "Apakah Anda yakin?",
					text: "Data yang dihapus tidak dapat dikembalikan!",
					icon: "warning",
					showCancelButton: true,
					confirmButtonText: "Ya, Hapus!",
					cancelButtonText: "Batal",
					reverseButtons: true,
					customClass: {
						confirmButton: "btn btn-primary",
						cancelButton: "btn btn-dark"
					},
					buttonsStyling: false
				}).then((result) => {
					if (result.isConfirmed) {
						let row = button.closest("tr");
						row.remove();
						Swal.fire({
							title: "Dihapus!",
							text: "Data berhasil dihapus.",
							icon: "success",
							confirmButtonText: "OK",
							customClass: {
								confirmButton: "btn btn-primary"
							},
							buttonsStyling: false
						});
					}
				});

			});
		});
	});
</script> -->

<!--js alert tambah data-->
<!-- <script>
	document.getElementById("formTambahProduk").addEventListener("submit", function(event) {
		event.preventDefault();

		let form = document.getElementById("formTambahProduk");
		let inputs = form.querySelectorAll("input, textarea");
		// let isEmpty = false;


		// inputs.forEach(input => {
		// 	if (!input.value.trim()) {
		// 		isEmpty = true;
		// 	}
		// });


		// if (isEmpty) {
		// 	Swal.fire({
		// 		icon: "warning",
		// 		title: "Gagal!",
		// 		text: "Semua kolom harus diisi sebelum menyimpan.",
		// 		confirmButtonText: "OK",
		// 		customClass: {
		// 			confirmButton: "btn btn-primary"
		// 		},
		// 		buttonsStyling: false
		// 	});
		// 	return;
		// }


		Swal.fire({
			icon: "success",
			title: "Berhasil!",
			text: "Data berhasil ditambahkan.",
			confirmButtonText: "OK",
			customClass: {
				confirmButton: "btn btn-primary"
			},
			buttonsStyling: false
		}).then(() => {

			form.reset();


			let modalElement = document.getElementById("modalTambahProduk");
			let modalInstance = bootstrap.Modal.getInstance(modalElement);
			modalInstance.hide();
		});
	});
</script> -->

<!-- js alert keluar -->
<script>
	document.getElementById("btnLogout").addEventListener("click", function(event) {
    event.preventDefault();

    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Anda akan keluar dari sesi ini!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Keluar",
        cancelButtonText: "Batal",
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logoutForm').submit();
        } else {
            Swal.fire({
                icon: "info",
                title: "Logout Dibatalkan",
                text: "Anda tetap berada di halaman ini.",
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
});

</script>

<!-- alert edit -->
<!-- <script>
	document.addEventListener('DOMContentLoaded', function() {
		const editButtons = document.querySelectorAll('.btn-edit');

		editButtons.forEach(button => {
			button.addEventListener('click', function(event) {
				event.preventDefault();

				const row = this.closest('tr');

				const productImageSrc = row.querySelector('td:nth-child(2) img').src; // Gambar
				const productName = row.querySelector('td:nth-child(3)').innerText; // Nama Produk
				const productPrice = row.querySelector('td:nth-child(4)').innerText; // Harga
				const productDescription = row.querySelector('td:nth-child(5)').innerText; // Deskripsi
				const productSpesifikasi = row.querySelector('td:nth-child(6)').innerText; // Spesifikasi
				const productSold = row.querySelector('td:nth-child(7)').innerText; // Terjual
				const productStock = row.querySelector('td:nth-child(8) .badge').innerText; // Stok

				const modal = new bootstrap.Modal(document.getElementById('editProductModal'));
				modal.show();

				const inputs = document.querySelectorAll('#editProductForm input, #editProductForm textarea');
				const data = {
					productName,
					productPrice,
					productDescription,
					productSpesifikasi,
					productSold,
					productStock,
					productImageSrc
				};

				inputs.forEach(input => {
					const id = input.id;
					if (data[id]) {
						input.value = data[id];
					}
				});

				const productImage = document.getElementById('productImage');
				productImage.setAttribute('data-src', productImageSrc); // Menyimpan gambar jika perlu diubah
			});
		});

		const form = document.getElementById('editProductForm');
		form.addEventListener('submit', function(event) {
			event.preventDefault();

			Swal.fire({
				title: 'Apakah Anda yakin ingin menyimpan perubahan?',
				text: "Perubahan tidak bisa dibatalkan setelah disimpan.",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, simpan!',
				cancelButtonText: 'Tidak, batalkan',
				customClass: {
					confirmButton: 'btn btn-primary',
					cancelButton: 'btn btn-dark'
				}
			}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire(
						'Berhasil!',
						'Perubahan telah disimpan.',
						'success'
					).then(() => {

						const modal = bootstrap.Modal.getInstance(document.getElementById('editProductModal'));
						modal.hide();
					});
				} else {
					Swal.fire(
						'Dibatalkan',
						'Perubahan tidak disimpan.',
						'error'
					).then(() => {
						const modal = bootstrap.Modal.getInstance(document.getElementById('editProductModal'));
						modal.hide();
					});
				}
			});
		});
	});
</script> -->

</body>

</html>