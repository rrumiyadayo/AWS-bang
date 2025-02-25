import "./bootstrap";
import Swal from "sweetalert2";

window.toggleEditForm = function (todoId) {
    const taskText = document.getElementById(`task-text-${todoId}`);
    const editForm = document.getElementById(`edit-form-${todoId}`);
    const editButton = document.getElementById(`edit-button-${todoId}`);
    const deleteButton = document.getElementById(`delete-button-${todoId}`);


    taskText.classList.toggle("hidden");
    editForm.classList.toggle("hidden");
    editButton.classList.toggle("hidden");
    deleteButton.classList.toggle("hidden");
};

function setupSweetAlert() {
    const modalTriggers = document.querySelectorAll("[data-modal-trigger]");

    modalTriggers.forEach((trigger) => {
        trigger.onclick = function () {
            const modalType = trigger.dataset.modalTrigger;
            let title = "";
            let html = "";

            if (modalType === "about") {
                title = "Todoリストアプリについて";
                html =
                    "<p>これはシンプルなTodoリストアプリケーションです。</p>";
            } else if (modalType === "contact") {
                title = "連絡先";
                html = `<p>チームメンバー:</p><br>
                        <ul class="list-disc pl-5">
                            <div>rrumiyadayo - <a href="https://github.com/rrumiyadayo"
                                    target="_blank" rel="noopener noreferrer"
                                    class="text-blue-500 hover:underline">GitHub</a>
                            </div>
                            <div>AzimSofi - <a href="https://github.com/AzimSofi"
                                    target="_blank" rel="noopener noreferrer"
                                    class="text-blue-500 hover:underline">GitHub</a>
                            </div>
                            <div>Arif-Sofi - <a href="https://github.com/Arif-Sofi"
                                    target="_blank" rel="noopener noreferrer"
                                    class="text-blue-500 hover:underline">GitHub</a>
                            </div>
                        </ul>`;
            }

            Swal.fire({
                title: title,
                html: html,
                confirmButtonText: "閉じる",
                confirmButtonColor: "#3085d6",
            });
        };
    });
}

document.addEventListener("DOMContentLoaded", function () {
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

    setupSweetAlert();

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
});
