$(document).ready(function () {
	tableRole();
	$("#id").val("");
	$("#roleForm").trigger("reset");

	$("#save-data").click(function (e) {
		e.preventDefault();

		$.ajax({
			data: $("#roleForm").serialize(),
			url: BASE_URL + "Role/store",
			type: "POST",
			datatype: "json",
			success: function (data) {
				$("#roleForm").trigger("reset");
				swal("Good job!", "Data Berhasil disimpan!", {
					icon: "success",
					buttons: false,
					timer: 1500,
				});
				tableRole();
				$("#cancel-edit").hide();
			},
			error: function (data) {
				console.log("Error:", data);
				$("$save-data").html("Simpan Data");
			},
		});
	});

	$("body").on("click", ".edit", function (e) {
		var id = $(this).data("id");
		$.ajax({
			url: BASE_URL + "Role/vedit/" + id,
			type: "GET",
			dataType: "json",
			success: function (data) {
				// console.log(data);
				$("#id").val(id);
				$("#nama_role").val(data.nama_role);
			},
		});
		$("#cancel-edit").show();
	});

	$("#cancel-edit").on("click", function () {
		// Reset form
		$("#roleForm")[0].reset();

		// Sembunyikan tombol cancel
		$(this).hide();
	});

	$("body").on("click", ".akses", function () {
		var id = $(this).data("id");
		$("#role_id").val(id);

		// Reset checkbox akses
		$('#aksesForm input[type="checkbox"]')
			.not("#aksesAll")
			.prop("checked", false);
		$("#aksesAll").prop("checked", false);
		$("#approve-levels input[type='checkbox']").prop("checked", false);
		$("#approve-levels").hide();

		// Ambil akses lama
		$.get(BASE_URL + "Role/get_akses/" + id, function (res) {
			var akses = JSON.parse(res);
			akses.forEach(function (a) {
				$('#aksesForm input[type="checkbox"][value="' + a + '"]').prop(
					"checked",
					true
				);
			});

			// Tampilkan approve-levels kalau akses approve dicentang
			if (akses.includes("5")) {
				$("#approve-levels").show();
			}

			// Update checkbox ALL
			var total = $('#aksesForm input[type="checkbox"]').not(
				"#aksesAll"
			).length;
			var checked = $('#aksesForm input[type="checkbox"]:checked').not(
				"#aksesAll"
			).length;
			$("#aksesAll").prop("checked", total === checked);
		});

		// Ambil approve level lama
		$.get(BASE_URL + "Role/get_approve_level/" + id, function (res) {
			var levels = JSON.parse(res);

			// reset semua approve level
			$('#approve-levels input[type="checkbox"]').prop("checked", false);

			// centang yang sesuai data
			if (levels.length > 0) {
				$("#approve-levels").slideDown(); // tampilkan kalau ada data
				levels.forEach(function (lvl) {
					$('#approve-levels input[type="checkbox"][value="' + lvl + '"]').prop(
						"checked",
						true
					);
				});
			} else {
				$("#approve-levels").slideUp(); // sembunyikan kalau kosong
			}
		});

		$("#aksesModal").modal("show");
	});

	// ✅ Tambahan: Submit Form Akses
	$("#aksesForm").on("submit", function (e) {
		e.preventDefault();

		// Cek apakah approve dicentang
		let approveChecked = $("input.akses-checkbox[data-id='5']").is(":checked");
		let approveLevelsChecked = $("#approve-levels input:checked").length;

		if (approveChecked && approveLevelsChecked === 0) {
			swal.fire({
				icon: "info",
				title: "Approve Aktif",
				text: "Silakan pilih level approve yang diinginkan",
				showConfirmButton: true,
				timer: 2000,
			});
			return;
		}

		var formData = $(this).serialize();

		$.ajax({
			url: BASE_URL + "Role/simpan_akses",
			type: "POST",
			data: formData,
			success: function (res) {
				if (res.trim() === "success") {
					$("#aksesModal").modal("hide");
					Swal.fire({
						icon: "success",
						title: "Berhasil",
						text: "Data Berhasil Disimpan",
						showConfirmButton: false,
						timer: 2000,
					});
					tableRole();
				} else if (res.trim() === "error_approve_level") {
					Swal.fire({
						icon: "warning",
						title: "Approve Nonaktif",
						text: "Semua level approve otomatis di-reset",
						showConfirmButton: false,
						timer: 2000,
					});
				} else {
					Swal.fire(
						"Gagal!",
						"Server mengembalikan respon tidak valid.",
						"error"
					);
				}
			},
			error: function () {
				Swal.fire("Gagal!", "Terjadi kesalahan saat menyimpan akses.", "error");
			},
		});
	});

	// $("#aksesForm").on("submit", function (e) {
	// 	e.preventDefault();
	// 	var formData = $(this).serialize();

	// 	$.ajax({
	// 		url: BASE_URL + "Role/simpan_akses",
	// 		type: "POST",
	// 		data: formData,
	// 		success: function (res) {
	// 			if (res.trim() === "success") {
	// 				$("#aksesModal").modal("hide");
	// 				Swal("Berhasil!", "Akses berhasil disimpan!", {
	// 					icon: "success",
	// 					buttons: false,
	// 					timer: 1500,
	// 				});
	// 				tableRole(); // Optional: reload data
	// 			} else {
	// 				swal("Gagal!", "Server mengembalikan respon tidak valid.", "error");
	// 			}
	// 		},
	// 		error: function () {
	// 			swal("Gagal!", "Terjadi kesalahan saat menyimpan akses.", "error");
	// 		},
	// 	});
	// });

	// $("#aksesAll").on("change", function () {
	// 	var isChecked = $(this).is(":checked");
	// 	$('#aksesForm input[type="checkbox"]')
	// 		.not("#aksesAll")
	// 		.prop("checked", isChecked);
	// });

	// Saat checkbox selain ALL diubah
	$('#aksesForm input[type="checkbox"]')
		.not("#aksesAll")
		.on("change", function () {
			var total = $('#aksesForm input[type="checkbox"]').not(
				"#aksesAll"
			).length;
			var checked = $('#aksesForm input[type="checkbox"]:checked').not(
				"#aksesAll"
			).length;
			$("#aksesAll").prop("checked", total === checked);
		});

	// $('#aksesAll').on('change', function () {
	//     var isChecked = $(this).is(':checked');
	//     // Cek atau uncek semua checkbox kecuali 'aksesAll'
	//     $('#aksesForm input[type="checkbox"]').not('#aksesAll').prop('checked', isChecked);
	// });

	// approve level
	$(document).on("change", ".akses-checkbox", function () {
		let id = $(this).data("id");

		if (id == 5) {
			// Approve
			if ($(this).is(":checked")) {
				$("#approve-levels").slideDown();
			} else {
				$("#approve-levels").slideUp();
				$("#approve-levels input").prop("checked", false); // reset kalau di-uncheck
			}
		}
	});

	// ALL check/uncheck semua
	$("#aksesAll").on("change", function () {
		let checked = $(this).is(":checked");
		$(".akses-checkbox").prop("checked", checked).trigger("change");
	});
});

function tableRole() {
	$.ajax({
		url: BASE_URL + "Role/tableRole",
		type: "POST",
		success: function (data) {
			$("#div-table-role").html(data);
			$("#tableRole").DataTable({
				processing: true,
				responsive: true,
			});
		},
	});
}
