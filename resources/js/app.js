import "./bootstrap";
import { toggleEditForm } from "./modules/edit-form";
import { setupSweetAlert } from "./modules/sweetalert-setup";
import { handleDeleteTodo } from "./modules/delete-todo";
import { handleSuccessMessage } from "./modules/success-message";
import { handleDevelopmentLinks } from "./modules/development-links";
import { setupAiAssistant } from "./modules/ai-assistant";

window.toggleEditForm = toggleEditForm;

document.addEventListener("DOMContentLoaded", function () {
    handleDeleteTodo();
    handleSuccessMessage();
    setupSweetAlert();
    handleDevelopmentLinks();
    setupAiAssistant();
});
