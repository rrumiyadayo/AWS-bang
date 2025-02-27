import Swal from "sweetalert2";

export function handleSuccessMessage() {
    const successMessage = document
        .querySelector('meta[name="success"]')
        .getAttribute("content");
    if (successMessage) {
        Swal.fire({
            title: "成功!",
            text: successMessage,
            icon: "success",
            confirmButtonText: "閉じる ",
            confirmButtonColor: "#3085d6",
        });
    }
}
