@if (session('success') || session('error'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            },
            customClass: {
                container: "custom-toast", // Áp dụng lớp CSS tùy chỉnh
            },
        });
        Toast.fire({
            icon: "{{ session('success') ? 'success' : 'error' }}",
            title: "<h4>{{ session('success') ?? session('error') }}</h4>",
        });
    </script>
@endif
