<?php
include_once(__DIR__ . '/../model/mTuVanKH.php');
$tuvan = new mTuVanKH();
$idPhuHuynh = $_GET['idPhuHuynh']; // Lấy idPhuHuynh từ URL hoặc session
$phuHuynh = $tuvan->select_PhuHuynh($idPhuHuynh);
?>
<style>
.container-feedback {
  max-width: 1200px;
  margin: 2rem auto;
  padding: 0 1rem;
  margin-right: 15px;
}

/* Sidebar styles */
.feedback-section {
  background: #fff;
  border-radius: 12px;
  padding: 1.5rem;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}



.teacher-section {
  background: #f8f9fa;
  padding: 1rem;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.teacher-section:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.teacher-info h5 {
  margin: 0 0 0 1rem;
  color: #2c3e50;
  font-size: 1rem;
  font-weight: 500;
}

/* Chat container styles */
.chat-container {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  height: 600px;
  display: flex;
  flex-direction: column;
}

.chat-messages {
  flex: 1;
  padding: 1.5rem;
  overflow-y: auto;
  background: #f8f9fa;
}

/* Message styles */
.message {
  margin-bottom: 1rem;
  display: flex;
  align-items: flex-start;
  animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.message-received {
  justify-content: flex-start;
}

.message-sent {
  justify-content: flex-end;
}

.message-image {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  overflow: hidden;
  margin-right: 12px;
}

.message-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.message-text {
  padding: 12px 16px;
  border-radius: 18px;
  max-width: 70%;
  word-wrap: break-word;
  position: relative;
}

.message-sent .message-text {
  background: #0084ff;
  color: white;
  margin-left: 12px;
}

.message-received .message-text {
  background: #f0f2f5;
  color: #1c1e21;
  margin-right: 12px;
}

.message-text img {
  max-width: 100%;
  border-radius: 12px;
  margin-top: 8px;
}

.message-time {
  font-size: 0.75rem;
  color: #65676b;
  margin-top: 4px;
  padding: 0 8px;
}

/* Input area styles */
.input-group {
  padding: 1rem;
  
  border-top: 1px solid #e4e6eb;
  border-radius: 0 0 12px 12px;
}

.upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
}

.upload-btn-wrapper button {
  border: 1px solid #ced4da;
  padding: 8px 12px;
  border-radius: 8px;
  color: #495057;
}

.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
  cursor: pointer;
}

.form-control {
  border-radius: 20px;
  padding: 0.75rem 1rem;
  margin: 0 0.5rem;
  border: 1px solid #ced4da;
}

.btn-primary {
  background: #0084ff;
  border: none;
  border-radius: 20px;
  padding: 0.75rem 1.5rem;
  font-weight: 500;
  transition: all 0.3s ease;
}

.btn-primary:hover {
  background: #0073e6;
  transform: translateY(-1px);
}

/* Scrollbar styles */
.chat-messages::-webkit-scrollbar {
  width: 6px;
}

.chat-messages::-webkit-scrollbar-track {
  background: #f1f1f1;
}

.chat-messages::-webkit-scrollbar-thumb {
  background: #c1c1c1;
  border-radius: 3px;
}

.chat-messages::-webkit-scrollbar-thumb:hover {
  background: #a8a8a8;
}
.feedback-section {
    background: #fff;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    max-width:250px; /* Limit maximum width */
    margin: 0 auto;
}

.parent-info {
    text-align: center;
    padding: 15px;
}

.parent-image {
    width: 150px;  /* Smaller container size */
    height: 100px;
    margin: 0 auto 0.5rem;
    border-radius: 10px;  /* Make it circular */
    overflow: hidden;
    border: 2px solid #ced4da;
}

.parent-name {
    font-size: 1.25rem;
    font-weight: bold;
    color: #2c3e50;
    margin-top: 10px;
}

.parent-image img {
    width: 100%;  /* Make image responsive */
    height: auto;
}


</style>

<?php
    $idPhuHuynh = $_GET['idPhuHuynh'];

    // Kết nối cơ sở dữ liệu và truy vấn thông tin phụ huynh
    $conn = new mysqli("localhost", "root", "", "coidata");
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    $sql = "SELECT hoTenPH, hinhAnh FROM phuhuynh WHERE idPhuHuynh = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idPhuHuynh);
    $stmt->execute();
    $result = $stmt->get_result();
    $phuHuynh = $result->fetch_assoc();

    $stmt->close();
    $conn->close();
?>
<div class="container-fluid container-feedback">
  <div class="row">
    <!-- Sidebar with consultant info -->
    <div class="col-md-4">
      <div class="feedback-section">
        <div class="parent-info">
          <div class="parent-image">
          <?php if ($phuHuynh['hinhAnh'] == NULL): ?>
    <img src="/assets/uploads/images/user.png" alt="Hình ảnh phụ huynh" class="thumbnail" style="height:100px; width:150px;">
<?php else: ?>
    <img src="admin/assets/uploads/images/<?php echo $phuHuynh['hinhAnh']; ?>" alt="Hình ảnh phụ huynh" class="thumbnail" style="height:100px; width:150px;">
<?php endif; ?>
          </div>
          <h5 class="parent-name"><?php echo $phuHuynh['hoTenPH']; ?></h5>
        </div>
      </div>
    </div>

    <!-- Chat area -->
    <div class="col-md-8">
      <div class="chat-container">
        <div id="chat-messages" class="chat-messages"></div>
        <div class="input-group">
          <div class="upload-btn-wrapper">
           
          </div>
          <input type="text" class="form-control" id="message-input" placeholder="Nhập tin nhắn...">
          <button class="btn btn-primary" id="send-message-btn">
            <i class="fas fa-paper-plane mr-1"></i> Gửi
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
$(document).ready(function() {
    // Pusher configuration
    Pusher.logToConsole = true;

    var pusher = new Pusher('03dc77ca859c49e35e41', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('chat-channel');
    channel.bind('new-message', function(data) {
        const messageClass = data.sender_id == sender_id ? 'message-sent' : 'message-received';
        const messageHtml = `
            <div class="message ${messageClass}">
                ${data.message ? `<div class="message-text">${data.message}</div>` : ''}
                <div class="message-time">${formatMessageTime(data.created_at)}</div>
            </div>
        `;
        $('#chat-messages').append(messageHtml);
        scrollToBottom();
    });

    const sender_id = <?php echo $_SESSION['idChuyenVien']; ?>;
    const receiver_id = <?php echo $idPhuHuynh; ?>;

    function loadExistingMessages() {
        $.get('view/ajax_admin.php', {
            action: 'get_messages',
            sender_id: sender_id,
            receiver_id: receiver_id
        }, function(response) {
            if (response.success) {
                $('#chat-messages').html(response.messages.map(message => {
                    const messageClass = message.sender_id == sender_id ? 'message-sent' : 'message-received';
                    return `
                        <div class="message ${messageClass}">
                            ${message.message ? `<div class="message-text">${message.message}</div>` : ''}
                            <div class="message-time">${formatMessageTime(message.created_at)}</div>
                        </div>
                    `;
                }).join(''));
                scrollToBottom();
            }
        });
    }

    function scrollToBottom() {
        const chatMessages = $('#chat-messages');
        chatMessages.scrollTop(chatMessages[0].scrollHeight);
    }

    function sendMessage(message) {
        const formData = new FormData();
        formData.append('action', 'send_message');
        formData.append('sender_id', sender_id);
        formData.append('receiver_id', receiver_id);
        formData.append('message', message);

        $.ajax({
            url: 'view/ajax_admin.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    $('#message-input').val('');
                    // Remove the local append - let Pusher handle it
                }
            },
            error: function(xhr, status, error) {
                console.error('Ajax error:', error);
            }
        });
    }

    // Handle send button click
    $('#send-message-btn').click(function() {
        const message = $('#message-input').val().trim();
        console.log('Send button clicked, message:', message); // Debugging line
        if (message) {
            sendMessage(message);
        }
    });

    // Load existing messages on page load
    loadExistingMessages();

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