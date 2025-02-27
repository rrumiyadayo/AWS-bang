export function toggleEditForm(todoId) {
    const taskText = document.getElementById(`task-text-${todoId}`);
    const editForm = document.getElementById(`edit-form-${todoId}`);
    const editButton = document.getElementById(`edit-button-${todoId}`);
    const deleteButton = document.getElementById(`delete-button-${todoId}`);

    taskText.classList.toggle("hidden");
    editForm.classList.toggle("hidden");
    editButton.classList.toggle("hidden");
    deleteButton.classList.toggle("hidden");
};
