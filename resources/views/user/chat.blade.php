<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-100">

    <!-- Floating Button -->
    <button id="openChat" class="fixed bottom-6 right-6 bg-blue-500 text-white p-4 rounded-full shadow-lg">
        💬
    </button>

    <!-- Chat Box -->
    <div id="chatBox" class="fixed bottom-16 right-6 w-80 bg-white rounded-lg shadow-md hidden" style="z-index: 100">
        <div class="p-4 bg-blue-500 text-white text-center rounded-t-lg relative">
            <h2 class="text-lg font-semibold">Live Chat</h2>
            <button id="closeChat" class="absolute top-2 right-3 text-white text-xl">&times;</button>
        </div>

        <!-- Kotak Pesan -->
        <div id="chatMessages" class="p-4 h-64 overflow-y-auto flex flex-col space-y-2"></div>

        <!-- Form Kirim Pesan -->
        <div class="p-4 border-t flex">
            <input id="messageInput" type="text" placeholder="Ketik pesan..." class="w-full p-2 border rounded-lg">
            <button id="sendMessage" class="ml-2 bg-blue-500 text-white p-2 rounded-lg">Kirim</button>
        </div>
    </div>

    <script>
        let senderId = {{ auth()->id() }}; // ID User yang sedang login
        let chatBox = document.querySelector("#chatBox");
        let chatMessages = document.querySelector("#chatMessages");
        let openChat = document.querySelector("#openChat");
        let closeChat = document.querySelector("#closeChat");

        // Buka & Tutup Chat Box
        openChat.addEventListener("click", function() {
            chatBox.classList.toggle("hidden");
            loadMessages();
        });

        closeChat.addEventListener("click", function() {
            chatBox.classList.add("hidden");
        });

        // Fungsi untuk memuat pesan
        function loadMessages() {
            fetch(`/user/messages`)
                .then(response => response.json())
                .then(data => {
                    chatMessages.innerHTML = ""; // Bersihkan chat lama
                    data.messages.forEach(msg => {
                        let messageElement = document.createElement("div");
                        messageElement.classList.add("p-2", "rounded-lg", "mb-2", "w-max", "max-w-xs");

                        if (msg.sender_id == senderId) {
                            messageElement.classList.add("bg-blue-500", "text-white", "self-end");
                        } else {
                            messageElement.classList.add("bg-gray-200", "self-start");
                        }

                        messageElement.innerHTML = `<p>${msg.message}</p>`;
                        chatMessages.appendChild(messageElement);
                    });

                    chatMessages.scrollTop = chatMessages.scrollHeight;
                })
                .catch(error => console.error("Error fetching messages:", error));
        }

        // Fungsi untuk mengirim pesan dari User ke Admin
        document.querySelector("#sendMessage").addEventListener("click", function() {
            let messageInput = document.querySelector("#messageInput");

            fetch('/user/send-message', {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        message: messageInput.value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    messageInput.value = "";
                    loadMessages();
                })
                .catch(error => console.error("Error sending message:", error));
        });

        // Update chat setiap 5 detik agar real-time
        setInterval(loadMessages, 5000);
    </script>

</body>

</html>
