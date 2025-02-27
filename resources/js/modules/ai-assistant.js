export function setupAiAssistant() {
    const aiAssistantButton = document.querySelector(".ai-assistant-button");
    const aiAssistantSidebar = document.getElementById("ai-assistant-sidebar");
    const closeAiAssistantButton =
        document.getElementById("close-ai-assistant");
    const aiAssistantInput = document.getElementById("ai-assistant-input");
    const aiAssistantSubmit = document.getElementById("ai-assistant-submit");
    const aiAssistantResponse = document.getElementById(
        "ai-assistant-response"
    );

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
}
