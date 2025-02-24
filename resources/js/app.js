import './bootstrap';
import Swal from 'sweetalert2';

window.toggleEditForm = function(todoId) {
    const taskText = document.getElementById(`task-text-${todoId}`);
    const editForm = document.getElementById(`edit-form-${todoId}`);
    const editButton = document.getElementById(`edit-button-${todoId}`);

    taskText.classList.toggle('hidden');
    editForm.classList.toggle('hidden');
    editButton.classList.toggle('hidden');
}

document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const todoName = button.dataset.name;

            Swal.fire({
                title: `「${todoName}」を削除しますか？`,
                text: "削除したら元に戻せません！",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'はい、削除します！',
                cancelButtonText: 'キャンセル',
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = this.closest('form');
                    form.addEventListener('submit', () => {
                        sessionStorage.setItem('deleted', todoName);
                    });
                    form.submit();
                }
            });
        });
    });

    const successMessage = document.querySelector('meta[name="success"]').getAttribute('content');
    if (successMessage) {
        Swal.fire({
            title: '成功!',
            text: successMessage,
            icon: 'success',
            confirmButtonText: '閉じる '
        });
    }
});
