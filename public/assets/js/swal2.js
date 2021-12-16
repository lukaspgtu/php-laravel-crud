function swal2Show(options) {
    Swal.fire({
        icon: options.icon,
        title: options.message,
        showCancelButton: options.showCancelButton !== undefined ? options.showCancelButton : true,
        showConfirmButton: options.showConfirmButton !== undefined ? options.showCancelButton : true,
        confirmButtonText: options.confirmButtonText ? options.confirmButtonText : 'Continue',
        cancelButtonText: options.cancelButtonText ? options.cancelButtonText : 'Cancel',
        confirmButtonColor: '#0084ff',
        reverseButtons: true,
        heightAuto: false,
        allowOutsideClick: false,
    }).then(result => {
        if (result.value) {
            if (options.onConfirm) {
                options.onConfirm();
            }
        }
        else {
            if (options.onCancel) {
                options.onCancel();
            }
        }
    });
}

function swal2Toast(options = {}) {
    const Toast = Swal.mixin({
        toast: true,
        position: options.position ?? 'top-end',
        showConfirmButton: false,
        timer: options.duration ?? 4500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: options.icon,
        title: options.message
    });
}