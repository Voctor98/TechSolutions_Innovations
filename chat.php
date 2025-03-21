<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Chat en Vivo - TechSolutions Innovations</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Open Sans', sans-serif;
        }
        #chat-container {
            max-width: 600px;
            margin: 50px auto;
            background: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        #messages {
            border-bottom: 1px solid #ddd;
            padding: 20px;
            height: 400px;
            overflow-y: auto;
            background-color: #f9f9f9;
        }
        #message-input, #username {
            width: calc(100% - 40px);
            padding: 10px;
            margin: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        #send-button, #back-button {
            width: calc(50% - 20px);
            padding: 10px;
            margin: 10px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        #send-button {
            background-color: #28a745;
            color: white;
        }
        #send-button:hover {
            background-color: #218838;
        }
        #back-button {
            background-color: #007bff;
            color: white;
        }
        #back-button:hover {
            background-color: #0069d9;
        }
        .message {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .message img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .message-content {
            background: #fff;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            width: 100%;
        }
        .message-content p {
            margin: 0;
        }
        .message-content small {
            display: block;
            margin-top: 5px;
            color: #999;
        }
    </style>
</head>
<body>
    <div id="chat-container" class="container">
        <h2 class="text-center py-3">Chat en Vivo</h2>
        <div id="messages" class="mb-3"></div>
        <input type="text" id="username" class="form-control" placeholder="Nombre de usuario" required>
        <textarea id="message-input" class="form-control" placeholder="Escribe tu mensaje..." required></textarea>
        <div class="d-flex justify-content-between">
            <button id="send-button" class="btn">Enviar</button>
            <button id="back-button" class="btn">Volver</button>
        </div>
    </div>
    
    <script>
        function fetchMessages() {
            fetch('get_messages.php')
                .then(response => response.json())
                .then(data => {
                    const messagesDiv = document.getElementById('messages');
                    messagesDiv.innerHTML = '';
                    data.forEach(message => {
                        const messageElement = document.createElement('div');
                        messageElement.className = 'message';
                        messageElement.innerHTML = `
                            <img src="https://via.placeholder.com/40" alt="Avatar">
                            <div class="message-content">
                                <p><strong>${message.username}</strong>: ${message.message}</p>
                                <small>${new Date(message.timestamp).toLocaleTimeString()}</small>
                            </div>`;
                        messagesDiv.appendChild(messageElement);
                    });
                    messagesDiv.scrollTop = messagesDiv.scrollHeight;
                }).catch(error => {
                    console.error('Error fetching messages:', error);
                });
        }

        document.getElementById('send-button').addEventListener('click', () => {
            const username = document.getElementById('username').value;
            const message = document.getElementById('message-input').value;

            if (username && message) {
                fetch('send_message.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `username=${encodeURIComponent(username)}&message=${encodeURIComponent(message)}`
                }).then(() => {
                    document.getElementById('message-input').value = '';
                    fetchMessages();
                }).catch(error => {
                    console.error('Error sending message:', error);
                });
            }
        });

        document.getElementById('back-button').addEventListener('click', () => {
            window.history.back();
        });

        setInterval(fetchMessages, 5000); // Actualiza los mensajes cada 5 segundos
        fetchMessages();
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrap.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
