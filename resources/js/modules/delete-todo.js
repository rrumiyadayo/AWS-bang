import Swal from "sweetalert2";

export function handleDeleteTodo() {
    const deleteButtons = document.querySelectorAll(".delete-btn");

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            const todoName = button.dataset.name;

            Swal.fire({
                title: `「${todoName}」を削除しますか？`,
                text: "削除したら元に戻せません！",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "はい、削除します！",
                cancelButtonText: "キャンセル",
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = this.closest("form");
                    form.addEventListener("submit", () => {
                        sessionStorage.setItem("deleted", todoName);
                    });
                    form.submit();
                }
            });
        });
    });
}
