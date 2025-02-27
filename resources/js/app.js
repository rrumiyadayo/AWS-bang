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
                const featureIcons = {
                    add: '➕',
                    complete: '✅',
                    edit: '✏️',
                    delete: '🗑️',
                    filter: '🔍',
                    darkMode: '🌙'
                };
                html = `
                        <p>これはシンプルなTodoリストアプリケーションです。</p>
                        <p class='mt-4 mb-2'>主な機能：</p>
                        <ul class='text-left pl-4'>
                            <li>${featureIcons.add} タスクの追加</li>
                            <li>${featureIcons.complete} タスクの完了</li>
                            <li>${featureIcons.edit} タスクの編集</li>
                            <li>${featureIcons.delete} タスクの削除</li>
                            <li>${featureIcons.filter} タスクのフィルタリング</li>
                            <li>${featureIcons.darkMode} ダークモード</li>
                        </ul>
                    `;
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

    const aiAssistantButton = document.querySelector(".ai-assistant-button");
    const aiAssistantSidebar = document.getElementById("ai-assistant-sidebar");
    const closeAiAssistantButton =
        document.getElementById("close-ai-assistant");
    const aiAssistantInput = document.getElementById("ai-assistant-input");
    const aiAssistantSubmit = document.getElementById("ai-assistant-submit");
    const aiAssistantResponse = document.getElementById(
        "ai-assistant-response"
    );

    aiAssistantButton.onclick = function () {
        consoleole.log("AI Assistant Button Clicked");
    }

    if (
        aiAssistantButton &&
        aiAssistantSidebar &&
        closeAiAssistantButton &&
        aiAssistantInput &&
        aiAssistantSubmit &&
        aiAssistantResponse
    ) {
        aiAssistantButton.addEventListener("click", () => {
            aiAssistantSidebar.style.transition = 'transform 0.3s ease-in-out';
            aiAssistantSidebar.classList.toggle("open");
        });

        closeAiAssistantButton.addEventListener("click", () => {
            aiAssistantSidebar.style.transition = 'transform 0.3s ease-in-out';
            aiAssistantSidebar.classList.toggle("open");
        });

        aiAssistantSubmit.addEventListener("click", async () => {
            const prompt = aiAssistantInput.value;

            const response = await fetch("/ai-response", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({
                    prompt: prompt,
                }),
            });

            if (!response.ok) {
                console.error("HTTP error!", response.status);
                aiAssistantResponse.innerHTML =
                    '<p class="text-red-500">Error fetching AI response.</p>';
                return;
            }

            try {
                const data = await response.json();
                if (
                    data.candidates &&
                    data.candidates[0] &&
                    data.candidates[0].content &&
                    data.candidates[0].content.parts &&
                    data.candidates[0].content.parts[0].text
                ) {
                    aiAssistantResponse.innerHTML =
                        data.candidates[0].content.parts[0].text;
                } else {
                    aiAssistantResponse.innerHTML =
                        '<p class="text-yellow-500">No valid AI response received.</p>';
                    console.warn("Invalid AI response format:", data);
                }
            } catch (error) {
                console.error("Error parsing JSON:", error);
                aiAssistantResponse.innerHTML =
                    '<p class="text-red-500">Error parsing AI response.</p>';
            }
        });
    } else {
        console.error(
            "AI Assistant elements not found."
        );
    }
});
