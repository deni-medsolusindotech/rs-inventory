$(document).ready(function() {
    // $(document).on('turbolinks:load', function () {
  var table = $('#myTable').DataTable({
    dom: 't<"bottom"p>', // Menampilkan elemen pagination di bawah tabel
    language: {
      emptyTable: "Tidak ada data yang tersedia",
      zeroRecords: "Tidak ditemukan data yang cocok",
      info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
      infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
      infoFiltered: "(disaring dari total _MAX_ entri)",
      search: "Cari:",
      paginate: {
        first: "Pertama",
        previous: "Sebelumnya",
        next: "Selanjutnya",
        last: "Terakhir"
      }
   
    }
  });

  table.on('draw', function() {
    updateCustomPagination();
    updateCustomInfo();
  });

  function updateCustomPagination() {
    var info = table.page.info();
    var currentPage = info.page + 1;
    var totalPages = info.pages;

    var paginationText = 'Halaman ' + currentPage + ' dari ' + totalPages;
    $('#customPagination').text(paginationText);
    $('#custom-bottom').addClass('mt-n3');
  }

  function updateCustomInfo() {
    var info = table.page.info();
    var totalRecords = info.recordsTotal;
    var currentPage = info.page + 1;
    var recordsText = 'Total ' + totalRecords + ' entri |';
    $('#customInfo').text(recordsText);
    $('#custom-bottom').addClass('mt-n3');
  }

  // Pencarian kustom
  $('#customSearch').on('keyup', function() {
        var searchText = $(this).val();
        table.search(searchText).draw();
    });
    $('#showEntriesSelect').on('change', function() {
    var entries = $(this).val();
    table.page.len(entries).draw();
  });

  $('#exportButton').on('click', function() {
    exportToExcel();
  });

  function exportToExcel() {
    var data = table.rows().data().toArray(); // Ambil data dari tabel

    var workbook = XLSX.utils.book_new();
    var worksheet = XLSX.utils.json_to_sheet(data, { header: ["#", "Nama Kegiatan", "Waktu"] });

    XLSX.utils.book_append_sheet(workbook, worksheet, "Sheet1");

    var filename = "data.xlsx";
    var wbout = XLSX.write(workbook, { bookType: "xlsx", type: "array" });
    saveAs(new Blob([wbout], { type: "application/octet-stream" }), filename);
  }
});