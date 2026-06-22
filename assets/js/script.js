// Custom JavaScript functions

// Auto dismiss alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });
});

// Preview image before upload
document.querySelector('input[type="file"]')?.addEventListener('change', function(e) {
    if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.querySelector('#imagePreview');
            if (preview) {
                preview.src = e.target.result;
            }
        }
        reader.readAsDataURL(e.target.files[0]);
    }
});

// Active nav link highlight
document.querySelectorAll('.nav-link').forEach(link => {
    if (link.href === window.location.href) {
        link.classList.add('active', 'fw-bold', 'text-primary');
    }
});