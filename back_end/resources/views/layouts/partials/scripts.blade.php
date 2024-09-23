<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

         window.showSwalMessage = function(icon, title, timer = 3000) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: timer,
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
                icon: icon,
                title: `<p class="m-0">${title}</p>`,
            });
        };

    })

    const textElement = document.querySelector(".text");
    const titleContent = "Thông tin đăng nhập, ";
    const textContent =
        "Name: Nguyễn Văn Quang, Email: quangnv1999@gmail.com, Đơn vị: FPL - HN - CNTT";
    const fullContent = titleContent + textContent;
    let index = 0;
    let isDeleting = false;

    function typeEffect() {
        const currentText = fullContent.slice(0, index);
        textElement.innerHTML = currentText.replace(/,/g, "<br>");

        if (!isDeleting && index < fullContent.length) {
            index++;
            setTimeout(typeEffect, 100);
        } else if (isDeleting && index > 0) {
            index--;
            setTimeout(typeEffect, 50);
        } else {
            isDeleting = !isDeleting;
            setTimeout(typeEffect, 1000);
        }
    }

    typeEffect();
</script>


@stack('scripts')
