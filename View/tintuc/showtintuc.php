<?php
include_once(__DIR__ . '/../../Controller/cTinTuc.php');

if (isset($_GET['idTinTuc'])) {
    $idTinTuc = $_GET['idTinTuc'];
    $tintuc = new cTinTuc();
    $tinTucDetail = $tintuc->getTinTuc($idTinTuc);
    if ($tinTucDetail && $tinTucDetail->num_rows > 0) {
        $tinTuc = $tinTucDetail->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($tinTuc['tieuDe']); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #28a745;
            border-bottom: 2px solid #28a745;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-size: 2rem;
        }
        .meta-info {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }
        .content {
            margin-bottom: 2rem;
        }
        .content p {
            margin-bottom: 1rem;
            text-align: justify;
            word-wrap: break-word;
            overflow-wrap: break-word;
            hyphens: auto;
        }
        img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 1rem 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .back-link:hover {
            background-color: #0056b3;
        }
        @media (max-width: 600px) {
            .container {
                padding: 1rem;
                margin: 1rem;
            }
            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($tinTuc['tieuDe']); ?></h1>
        <div class="meta-info">
            <p>Danh mục: <?php echo htmlspecialchars($tinTuc['tenDanhMuc']); ?></p>
            <p>Ngày đăng: <?php echo date('d/m/Y', strtotime($tinTuc['ngayDang'])); ?></p>
        </div>
        <?php if ($tinTuc['hinhAnh'] == NULL) {
                            echo "<td style='text-align:center'><img src='/assets/uploads/images/user.png' alt='' height='100px' width='150px'></td>";
                          } else {
                            echo "<td style='text-align:center'><img src='admin/admin/assets/uploads/images/" . $tinTuc['hinhAnh'] . "' alt='' height='100px' width='300px' style='border-radius: 10px;'></td>";

                          }
                          ?>
        <div class="content">
            <?php
            $paragraphs = explode("\n", $tinTuc['noiDung']);
            foreach ($paragraphs as $paragraph) {
                echo '<p>' . htmlspecialchars($paragraph) . '</p>';
            }
            ?>
        </div>

        <!-- Nút đọc văn bản -->
        <button id="readArticleBtn" class="back-link" style="background-color: #28a745; margin-bottom: 20px;">Đọc bài viết</button>

        <a href="http://localhost/KLTN_PJ/index.php?tintuc" class="back-link">Trở về trang chủ</a>
    </div>

    <script>
 let isSpeaking = false;
let femaleVoice = null;
let vietnameseVoice = null;

const readButton = document.getElementById('readArticleBtn');
const content = `<?php
    $textContent = implode(' ', $paragraphs);
    echo htmlspecialchars($textContent);
?>`;

// Hàm lấy giọng nói từ hệ thống
function populateVoices() {
    const voices = window.speechSynthesis.getVoices();
    // Tìm giọng nữ cho ngôn ngữ tiếng Việt (vi-VN)
    vietnameseVoice = voices.find(voice => voice.lang === 'vi-VN');
    femaleVoice = voices.find(voice => voice.lang === 'vi-VN' && voice.name.toLowerCase().includes('female'));
    
    // Đảm bảo rằng nút đã được gắn sự kiện click
    readButton.removeEventListener('click', toggleSpeech);
    readButton.addEventListener('click', toggleSpeech);
}

function toggleSpeech() {
    if (isSpeaking) {
        window.speechSynthesis.cancel();
        readButton.textContent = 'Đọc bài viết';
        isSpeaking = false;
    } else {
        const speech = new SpeechSynthesisUtterance();
        speech.lang = 'vi-VN'; 
        speech.text = content;
        speech.pitch = 1; 
        speech.rate = 1; 
        speech.volume = 1; 

        // Chọn giọng nữ nếu tìm thấy, nếu không sử dụng giọng tiếng Việt có sẵn, hoặc giọng mặc định
        if (femaleVoice) {
            speech.voice = femaleVoice;
        } else if (vietnameseVoice) {
            speech.voice = vietnameseVoice;
        }

        speech.onend = function() {
            readButton.textContent = 'Đọc bài viết';
            isSpeaking = false;
        };

        window.speechSynthesis.speak(speech);
        readButton.textContent = 'Dừng đọc';
        isSpeaking = true;
    }
}

// Kiểm tra trình duyệt có hỗ trợ SpeechSynthesis không
if ('speechSynthesis' in window) {
    // Gọi populateVoices ngay lập tức để khởi tạo voices
    populateVoices();
    // Đăng ký sự kiện onvoiceschanged để cập nhật voices khi có sẵn
    window.speechSynthesis.onvoiceschanged = populateVoices;
} else {
    alert('Trình duyệt của bạn không hỗ trợ tính năng đọc văn bản.');
    readButton.style.display = 'none';
}
</script>

</body>
</html>
