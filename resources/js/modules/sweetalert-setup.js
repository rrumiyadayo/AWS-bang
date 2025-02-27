import Swal from "sweetalert2";

export function setupSweetAlert() {
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
