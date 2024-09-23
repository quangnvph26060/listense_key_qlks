let debounceTimer;
let currentPage = 1;
let apiUrl = "";

// Hàm khởi tạo
function initDataFetch(url, columnId) {
    apiUrl = url; // Lưu URL vào biến toàn cục
    fetchData(); // Tải dữ liệu ban đầu
}

function fetchData(page = 1) {
    currentPage = page;
    const search = $(".searchInput").val();

    $.ajax({
        url: apiUrl,
        method: "GET",
        data: {
            search,
            page,
        },
        success: function (data) {
            $("#data-table tbody").html(data.results);
            $("#pagination").html(data.pagination);
            notData();
        },
    });
}

// Tìm kiếm
$(".searchInput").on("input", function () {
    clearTimeout(debounceTimer);
    const searchValue = $(this).val();

    if (searchValue === "") {
        // Khi ô tìm kiếm trống, gọi fetchData để lấy dữ liệu ban đầu
        fetchData(1);
        return;
    }
    debounceTimer = setTimeout(() => {
        fetchData(1); // Gọi fetchData nếu có giá trị tìm kiếm
    }, 500);
});


// Phân trang
$(document).on("click", ".pagination a", function (e) {
    e.preventDefault();
    let page = $(this).attr("href").split("page=")[1];
    fetchData(page);
});

// Hàm kiểm tra dữ liệu
function notData() {
    // Check if there are no rows in the tbody
    if ($(".table tbody tr").length === 0) {
        console.log("no data");

        // Calculate the number of columns
        var colspan = $(".table thead th").length;

        // Append the "No data" row
        $(".table tbody").append(
            `<tr id="no-data-row"><td colspan="${colspan}" class="text-center">Không tìm thấy dữ liệu</td></tr>`
        );
    } else {
        console.log("has data");

        // Remove the "No data" row if it exists
        $("#no-data-row").remove();
    }
}

