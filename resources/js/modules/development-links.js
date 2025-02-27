import Swal from "sweetalert2";

export function handleDevelopmentLinks() {
    const inDevelopmentLinks = document.querySelectorAll('a[data-development="true"]');

    inDevelopmentLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            Swal.fire({
                title: '機能は開発中です',
                icon: 'info',
                text: '',
                confirmButtonText: '閉じる',
                confirmButtonColor: "#3085d6",
            });
        });
    });
}
