<!-- trang tuvanchuyengia.php -->
<div class="container-fluid bg-primary mb-4">
   
</div>

<style>
    .chat-wrapper {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        height: 80vh;
        margin: 0 auto;
        max-width: 1200px;
        overflow: hidden;
    }

    .chat-sidebar {
        background: #f5f5f5;
        border-right: 1px solid #e5e5e5;
        height: 100%;
        padding: 20px;
    }

    .expert-profile {
        align-items: center;
        display: flex;
        flex-direction: column;
        padding: 20px 0;
        text-align: center;
    }

    .expert-avatar {
        border-radius: 50%;
        height: 120px;
        margin-bottom: 15px;
        object-fit: cover;
        width: 120px;
    }

    .expert-name {
        color: #1c1e21;
        font-size: 1.2rem;
        font-weight: 600;
        margin: 10px 0;
    }

    .chat-main {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .chat-header {
        align-items: center;
        background: #fff;
        border-bottom: 1px solid #e5e5e5;
        display: flex;
        padding: 15px 20px;
    }

    #chat-messages {
        flex: 1;
  padding: 1.5rem;
  overflow-y: auto;
  background: #f8f9fa;
  height: 600px; /* Đặt chiều cao cố định */
    }

    .message {
        align-items: flex-end;
        display: flex;
        margin-bottom: 10px;
        max-width: 85%;
    }

    .message-sent {
        flex-direction: row-reverse;
        margin-left: auto;
    }

    .message-content {
        border-radius: 20px;
        margin: 0 8px;
        max-width: 100%;
        padding: 8px 16px;
    }

    .message-sent .message-content {
        background: #0084ff;
        color: white;
    }

    .message-received .message-content {
        background: #f0f0f0;
        color: #1c1e21;
    }

    .message-image img {
        border-radius: 16px;
        max-height: 300px;
        max-width: 300px;
        object-fit: contain;
    }

    .message-time {
        color: #65676b;
        font-size: 0.75rem;
        margin: 4px 12px;
    }

    .chat-input-wrapper {
        background: #fff;
        border-top: 1px solid #e5e5e5;
        padding: 15px 20px;
    }

    .chat-input-container {
        align-items: center;
        background: #f0f2f5;
        border-radius: 24px;
        display: flex;
        padding: 8px 16px;
    }

    .upload-btn-wrapper {
        margin-right: 10px;
    }

    .upload-btn-wrapper button {
        background: transparent;
        border: none;
        color: #65676b;
        cursor: pointer;
        padding: 8px;
    }

    .upload-btn-wrapper button:hover {
        background: #e4e6eb;
        border-radius: 50%;
    }

    #message-input {
        background: transparent;
        border: none;
        flex: 1;
        font-size: 0.95rem;
        outline: none;
        padding: 8px;
    }

    #send-message-btn {
        background: transparent;
        border: none;
        color: #0084ff;
        cursor: pointer;
        font-size: 1.2rem;
        padding: 8px;
    }

    #send-message-btn:hover {
        background: #e4e6eb;
        border-radius: 50%;
    }

    @media (max-width: 768px) {
        .chat-wrapper {
            height: 90vh;
        }

        .chat-sidebar {
            display: none;
        }

        .message-image img {
            max-width: 200px;
        }
    }
    .chat-messages {
  flex: 1;
  padding: 1.5rem;
  overflow-y: auto;
  background: #f8f9fa;
  height: 600px; /* Đặt chiều cao cố định */
}
</style>
<?php
    $idChuyenVien = $_GET['idChuyenVien'];
?>
<div class="container-fluid px-4">
    <div class="chat-wrapper">
        <div class="row h-100 g-0">
            <!-- Sidebar -->
            <div class="col-md-3 chat-sidebar">
                <div class="expert-profile">
                    <?php
                    include_once("Model/mTuVanChuyenGia.php");
                    $mTuVan = new mTuVanChuyenGia();
                    $listcv = $mTuVan->select_ChuyenGia($idChuyenVien);
                    foreach ($listcv as $cv) {
                        echo '<img src="admin/admin/assets/uploads/images/'. $cv["hinhAnh"] . '" alt="Chuyên gia" class="expert-avatar">';
                        echo '<h5 class="expert-name">' . $cv['hoTen'] . '</h5>';
                    }
                    ?>
                </div>
            </div>

            <!-- Main Chat Area -->
            <div class="col-md-9">
                <div class="chat-main">
                    <div class="chat-header">
                        <h5 class="mb-0">Chat với chuyên gia</h5>
                    </div>
                    
                    <div id="chat-messages" class="chat-messages"></div>

                    <div class="chat-input-wrapper">
                        <div class="chat-input-container">
                            <div class="upload-btn-wrapper">
                                
                             
                            </div>
                            
                            <input type="text" id="message-input" placeholder="Aa">
                            
                            <button id="send-message-btn">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
$(document).ready(function() {
    const sender_id = <?php echo $_SESSION['idPhuHuynh']; ?>;
    const receiver_id = <?php echo $idChuyenVien; ?>;

    // Pusher setup
    const pusher = new Pusher('03dc77ca859c49e35e41', {
        cluster: 'ap1'
    });

    const channel = pusher.subscribe('chat-channel');
    
    channel.bind('new-message', function(data) {
        if ((data.sender_id == sender_id && data.receiver_id == receiver_id) ||
            (data.sender_id == receiver_id && data.receiver_id == sender_id)) {
            appendMessage(data);
            scrollToBottom();
        }
    });

    function appendMessage(data) {
        const messageClass = data.sender_id == sender_id ? 'message-sent' : 'message-received';
        const messageHtml = `
            <div class="message ${messageClass}">
                <div class="message-content">
                    <div class="message-text">${data.message}</div>
                </div>
                <div class="message-time">${formatMessageTime(data.created_at)}</div>
            </div>
        `;
        $('#chat-messages').append(messageHtml);
    }

    function scrollToBottom() {
    const chatMessages = $('#chat-messages');
    chatMessages.scrollTop(chatMessages[0].scrollHeight);
}

    function sendMessage(message) {
        if (!message.trim()) return;

        $.ajax({
            url: 'View/ajax.php',
            type: 'POST',
            data: {
                action: 'send_message',
                sender_id: sender_id,
                receiver_id: receiver_id,
                message: message
            },
            success: function(response) {
                if (response.success) {
                    $('#message-input').val('');
                }
            }
        });
    }

    // Event handlers
    $('#send-message-btn').click(function() {
        const message = $('#message-input').val().trim();
        sendMessage(message);
    });

    $('#message-input').keypress(function(e) {
        if (e.which == 13) {
            const message = $(this).val().trim();
            sendMessage(message);
        }
    });

    // Load initial messages
    $.get('View/ajax.php', {
        action: 'get_messages',
        sender_id: sender_id,
        receiver_id: receiver_id
    }, function(response) {
        if (response.success && response.messages) {
            response.messages.forEach(message => {
                appendMessage(message);
            });
            scrollToBottom();
        }
    });

    function formatMessageTime(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const isToday = date.toDateString() === now.toDateString();

        if (isToday) {
            return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        } else {
            return `${date.toLocaleDateString([], { month: 'short', day: 'numeric' })} ${date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}`;
        }
    }
});
</script>