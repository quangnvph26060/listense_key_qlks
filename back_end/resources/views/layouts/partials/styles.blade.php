<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet" />

<style>
    body {
        font-family: "VT323", monospace;
        /* Font chữ cổ điển */
        font-size: 1.2rem;
        background-color: #f9f9f9;
        /* Màu nền sáng hơn */
        color: #333;
        /* Màu chữ tối hơn để dễ đọc */
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        /* Chiều cao tối thiểu là 100% chiều cao viewport */
    }

    .txtelegantshadow {
        height: auto;
        /* Để chiều cao tự động */
        min-height: 195px;
        /* Chiều cao tối thiểu */
        background-color: #3c8dbc;
        /* Màu nền nhẹ nhàng hơn */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Thêm bóng nhẹ cho khối */
    }

    .footer {
        background-color: #2c3e50;
        /* Màu nền tối hơn cho footer */
        color: #ecf0f1;
        /* Màu chữ sáng hơn cho footer */
    }

    .footer p {
        margin: 0 !important;
    }

    .text-container {
        height: 181.6px;
    }

    .input-group-append button {
        border-radius: 0 0.25rem 0.25rem 0;
        background-color: #2c3e50;
        /* Màu nưới xanh cho button */
        color: #ecf0f1;
        /* Màu chữ sáng hơn cho button */
    }

    /* Căn giữa nội dung chính */
    main {
        flex: 1;
        /* Cho phép main chiếm không gian còn lại */
        display: flex;
        justify-content: center;
        /* Căn giữa theo chiều ngang */
        /* align-items: center; */
        padding: 20px;
        /* Thêm padding cho main */
    }

    @keyframes blink {
        0% {
            border-right-color: rgba(0, 255, 0, 1);
        }

        50% {
            border-right-color: transparent;
        }

        100% {
            border-right-color: rgba(0, 255, 0, 1);
        }
    }

    .text {
        display: inline-block;
        white-space: nowrap;
        overflow: hidden;
        border-right: 2px solid #2ecc71;
        /* Màu xanh nhẹ hơn */
        animation: blink 0.75s step-end infinite;
        font-size: 1.8rem;
        /* Giảm kích thước một chút */
    }

    .d--flex {
        display: flex;
        align-items: center;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .d--flex {
            display: block;
            align-items: center;
        }

        .txtelegantshadow {
            min-height: 0;
        }

        .text {
            font-size: 1.5rem;
            /* Giảm kích thước chữ cho màn hình nhỏ */
        }

        .footer {
            padding: 1rem;
            /* Điều chỉnh padding cho footer */
        }

        table {
            display: block;
            width: 100%;
        }

        thead {
            display: none;
            /* Ẩn tiêu đề bảng */
        }

        tbody,
        tr {
            display: block;
            /* Chuyển sang dạng khối để dễ dàng hiển thị */
            width: 100%;
            margin-bottom: 1rem;
            /* Khoảng cách giữa các hàng */
        }

        td {
            display: flex;
            justify-content: space-between;
            /* Căn chỉnh nội dung */
            padding: 0.5rem;
            border: 1px solid #dee2e6;
            /* Thêm viền */
        }

        td::before {
            content: attr(data-label);
            /* Hiển thị tên cột */
            font-weight: bold;
            margin-right: 1rem;
            /* Khoảng cách giữa tên cột và nội dung */
        }

        .d-none {
            display: none;
        }
    }

    .custom-toast {
        width: auto !important;
        /* Cho phép chiều rộng tự động */
        max-width: 500px;
        /* Bạn có thể điều chỉnh giá trị này theo nhu cầu */
        white-space: nowrap;
        /* Ngăn việc xuống dòng */
    }

    .swal2-popup.swal2-toast {
        padding: 10px;
    }
</style>


@stack('styles')
