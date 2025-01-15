<!DOCTYPE html>
<html>
<head>
<style>
.quiz-container {
    max-width: 800px;
    margin: 2rem auto;
    padding: 2rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.question-card {
    display: none;
    animation: fadeIn 0.5s;
}

.question-card.active {
    display: block;
}

.question-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f0f0f0;
}

.question-number {
    font-size: 1.2rem;
    color: #318EA5;
    font-weight: bold;
}

.field-name {
    font-size: 0.9rem;
    color: #666;
    background: #f8f9fa;
    padding: 0.5rem 1rem;
    border-radius: 20px;
}

.question-content {
    margin-bottom: 2rem;
    font-size: 1.1rem;
    line-height: 1.6;
}

.question-image {
    max-width: 100%;
    margin: 1rem 0;
    border-radius: 8px;
}

.answers-container {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 2rem;
}

.answer-option {
    display: flex;
    align-items: center;
    padding: 1rem;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.answer-option:hover {
    border-color: #318EA5;
    background: #f8f9fa;
}

.answer-option.selected {
    border-color: #318EA5;
    background: #e8f4f8;
}

.answer-option input[type="radio"] {
    margin-right: 1rem;
    width: 20px;
    height: 20px;
    accent-color: #318EA5;
}

.navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 2rem;
    padding-top: 1rem;
    border-top: 2px solid #f0f0f0;
}

.nav-button {
    background: #318EA5;
    color: white;
    border: none;
    padding: 0.8rem 1.5rem;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    transition: background 0.3s ease;
}

.nav-button:disabled {
    background: #ccc;
    cursor: not-allowed;
}

.nav-button:hover:not(:disabled) {
    background: #267089;
}

.progress-container {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
    justify-content: center;
    margin: 1rem 0;
}

.progress-dot {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.progress-dot.active {
    background: #318EA5;
    color: white;
}

.progress-dot.answered {
    background: #28a745;
    color: white;
}

.submit-button {
    display: none;
    width: 100%;
    padding: 1rem;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background 0.3s ease;
    margin-top: 1rem;
}

.submit-button:hover {
    background: #218838;
}
.navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 2rem;
    padding-top: 1rem;
    border-top: 2px solid #f0f0f0;
}

.nav-button {
    background: #318EA5;
    color: white;
    border: none;
    padding: 0.8rem 1.5rem;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    transition: background 0.3s ease;
}

.nav-button:disabled {
    background: #ccc;
    cursor: not-allowed;
}

.nav-button:hover:not(:disabled) {
    background: #267089;
}

/* Thêm class mới cho container của các nút điều hướng */
.nav-buttons-group {
    display: flex;
    gap: 1rem;
}

.submit-button {
    width: 100%;
    max-width: 200px;
    padding: 1rem;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background 0.3s ease;
    margin-top: 2rem;
    display: block;
    margin-left: auto;
    margin-right: auto;
}

.submit-button:hover {
    background: #218838;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
let currentQuestion = 0;
const answers = {};

function initializeQuiz() {
    const questions = document.querySelectorAll('.question-card');
    const progressContainer = document.querySelector('.progress-container');
    
    // Create progress dots
    questions.forEach((_, index) => {
        const dot = document.createElement('div');
        dot.className = 'progress-dot';
        dot.textContent = index + 1;
        dot.onclick = () => goToQuestion(index);
        progressContainer.appendChild(dot);
    });
    
    showQuestion(0);
    updateNavButtons();
    updateProgressDots();
}

function showQuestion(index) {
    const questions = document.querySelectorAll('.question-card');
    questions.forEach(q => q.classList.remove('active'));
    questions[index].classList.add('active');
    currentQuestion = index;
    
    updateNavButtons();
    updateProgressDots();
}

function updateNavButtons() {
    const prevButton = document.querySelector('.prev-button');
    const nextButton = document.querySelector('.next-button');
    const submitButton = document.querySelector('.submit-button');
    const totalQuestions = document.querySelectorAll('.question-card').length;
    
    prevButton.disabled = currentQuestion === 0;
    nextButton.style.display = currentQuestion === totalQuestions - 1 ? 'none' : 'block';
    submitButton.style.display = currentQuestion === totalQuestions - 1 ? 'block' : 'none';
}

function updateProgressDots() {
    const dots = document.querySelectorAll('.progress-dot');
    dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentQuestion);
        dot.classList.toggle('answered', answers[index] !== undefined);
    });
}

function goToQuestion(index) {
    showQuestion(index);
}

function nextQuestion() {
    const totalQuestions = document.querySelectorAll('.question-card').length;
    if (currentQuestion < totalQuestions - 1) {
        showQuestion(currentQuestion + 1);
    }
}

function prevQuestion() {
    if (currentQuestion > 0) {
        showQuestion(currentQuestion - 1);
    }
}

function selectAnswer(questionIndex, answer) {
    answers[questionIndex] = answer;
    updateProgressDots();
    
    // Automatically move to next question after selecting an answer
    const totalQuestions = document.querySelectorAll('.question-card').length;
    if (currentQuestion < totalQuestions - 1) {
        setTimeout(nextQuestion, 500);
    }
}

function handleSubmit() {
    const totalQuestions = document.querySelectorAll('.question-card').length;
    const answeredQuestions = Object.keys(answers).length;
    
    if (answeredQuestions < totalQuestions) {
        alert(`Vui lòng trả lời tất cả câu hỏi. Bạn đã trả lời ${answeredQuestions}/${totalQuestions} câu.`);
        return false;
    }
    
    return true;
}

window.onload = initializeQuiz;
</script>

<?php
include_once("Controller/cTracNghiem.php");
$wait = 1 ;
$showQuiz = true; // Biến để xác định có hiển thị bài trắc nghiệm hay không

// Xử lý yêu cầu và lấy danh sách câu hỏi từ cơ sở dữ liệu
if (isset($_GET['idUnit'])) {
    $idUnit = $_GET['idUnit'];
    $tracnghiem = new cTracNghiem();
    $allQuestions = $tracnghiem->select_questions_by_unit($idUnit,$wait); // Lấy tất cả câu hỏi theo Unit

    // Hiển thị danh sách câu hỏi và chức năng gửi kết quả
    if ($allQuestions && mysqli_num_rows($allQuestions) > 0) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $showQuiz = false; // Ẩn bài trắc nghiệm sau khi nộp bài

            $totalScoreByField = [];
            $questionCountByField = [];
            $totalScore = 0;
            $fieldNames = [];
            $evaluation = ""; // Khởi tạo biến $evaluation

            // Khởi tạo các biến lưu trữ điểm theo lĩnh vực
            while ($question = mysqli_fetch_assoc($allQuestions)) {
                $fieldID = $question['idLinhVuc'];
                $fieldName = $question['tenLinhVuc'];
                if (!isset($totalScoreByField[$fieldID])) {
                    $totalScoreByField[$fieldID] = 0;
                    $questionCountByField[$fieldID] = 0;
                    $fieldNames[$fieldID] = $fieldName;
                }
            }

            mysqli_data_seek($allQuestions, 0);

            // Xử lý kết quả của người dùng
            foreach ($_POST['answer'] as $key => $ans) {
                $score = 0;
                switch ($ans) {
                    case 'a':
                        $score += 10;
                        break;
                    case 'b':
                        $score += 5;
                        break;
                    case 'c':
                        $score += 0;
                        break;
                }

                $questionID = $_POST['idcauHoi'][$key];
                mysqli_data_seek($allQuestions, $key);
                $questionData = mysqli_fetch_assoc($allQuestions);

                $totalScoreByField[$questionData['idLinhVuc']] += $score;
                $totalScore += $score;
                $questionCountByField[$questionData['idLinhVuc']]++;
            }

            // Hiển thị kết quả
            echo "<div align='center'>";
            echo "<br><br>";
            echo "<h2 align='center'>KẾT QUẢ BÀI LÀM</h2>";
            foreach ($totalScoreByField as $fieldId => $score) {
                if ($questionCountByField[$fieldId] > 0) {
                    $averageScore = $score / $questionCountByField[$fieldId];
                } else {
                    $averageScore = 0;
                }

                // Đánh giá theo lĩnh vực
                switch ($fieldId) {
                    case 1:
                        $evaluation = $averageScore < 5 ? "Khả năng giao tiếp rất kém." : ($averageScore >= 5 && $averageScore < 10 ? "Khả năng giao tiếp còn hạn chế." : "Khả năng giao tiếp tốt.");
                        break;
                    case 2:
                        $evaluation = $averageScore < 5 ? "Khả năng vận động thô kém." : ($averageScore >= 5 && $averageScore < 10 ? "Khả năng vận động thô trung bình." : "Khả năng vận động thô tốt.");
                        break;
                    case 3:
                        $evaluation = $averageScore < 5 ? "Khả năng vận động tinh kém." : ($averageScore >= 5 && $averageScore < 10 ? "Khả năng vận động tinh trung bình." : "Khả năng vận động tinh tốt.");
                        break;
                    case 4:
                        $evaluation = $averageScore < 5 ? "Khả năng giải quyết vấn đề kém." : ($averageScore >= 5 && $averageScore < 10 ? "Khả năng giải quyết vấn về còn hạn chế." : "Khả năng giải quyết vấn đề tốt.");
                        break;
                    case 5:
                        $evaluation = $averageScore < 5 ? "Khả năng cá nhân xã hội rất kém." : ($averageScore >= 5 && $averageScore < 10 ? "Khả năng cá nhân xã hội còn hạn chế." : "Khả năng cá nhân xã hội tốt.");
                }

                echo "<div class='field-header'>Lĩnh vực: " . htmlspecialchars($fieldNames[$fieldId]) . " - Tổng điểm: $score/20</div>";
                echo "<div class='evaluation'>Đánh giá: $evaluation</div>";
            }

            // Tổng điểm và đánh giá tổng thể
            if ($totalScore >= 0 && $totalScore < 50) {
                $evaluation = "Đánh giá tổng thể: Yếu.";
            } elseif ($totalScore >= 50 && $totalScore < 70) {
                $evaluation = "Đánh giá tổng thể: Trung bình.";
            } else {
                $evaluation = "Đánh giá tổng thể: Khá.";
            }
            
            echo "<br>";
            echo "<h3 class='total-evaluation'>Tổng điểm toàn bài: $totalScore</h3>";
            echo "<h4 class='total-evaluation'>$evaluation</h4>";
            echo "</div>";
            
            // Lưu kết quả vào cơ sở dữ liệu
           
            $idPhuHuynh = $_SESSION['idPhuHuynh'];
            $ngayTao = date('Y-m-d H:i:s');
            $p = new cTracNghiem();
            $kq = $p->get_saveResult($evaluation, $ngayTao, $idPhuHuynh, $idUnit, $totalScore,  $fieldID, $totalScoreByField);
            if ($kq > 0) {
                echo "<script>alert('Kết quả bài trắc nghiệm đã được lưu vào lịch sử bài làm.')</script>";
            } else {
                echo "<script>alert('Đã xảy ra lỗi khi lưu kết quả bài trắc nghiệm.')</script>";
            }
        }
       
        // Hiển thị bài trắc nghiệm nếu chưa nộp bài
        if ($showQuiz) {
?>
            <div class="quiz-container">
                <form action="index.php?lambaitracnghiem=<?= htmlspecialchars($idUnit) ?>&idUnit=<?= htmlspecialchars($idUnit) ?>" 
                      method="post" onsubmit="return handleSubmit();">
                    <?php
                    $key = 0;
                    $currentFieldId = null;
                    
                    // Lưu kết quả vào mảng để có thể duyệt nhiều lần
                    $questions = [];
                    while ($row = mysqli_fetch_assoc($allQuestions)) {
                        $questions[] = $row;
                    }
                    
                    foreach ($questions as $question) {
                    ?>
                        <div class="question-card">
                            <div class="question-header">
                                <span class="question-number">Câu <?= ($key + 1) ?></span>
                                <span class="field-name"><?= htmlspecialchars($question['tenLinhVuc']) ?></span>
                            </div>
                            
                            <div class="question-content">
                                <?= htmlspecialchars($question['cauHoi']) ?>
                                <?php if (!empty($question['hinhAnh'])): ?>
                                    <img src="admin/admin/assets/uploads/images/<?= htmlspecialchars($question['hinhAnh']) ?>" 
                                         alt="Hình ảnh câu hỏi" 
                                         class="question-image">
                                <?php endif; ?>
                            </div>

                            <div class="answers-container">
                                <?php if (!empty($question['cau1'])): ?>
                                    <label class="answer-option">
                                        <input type="radio" 
                                               name="answer[<?= $key ?>]" 
                                               value="a"
                                               onclick="selectAnswer(<?= $key ?>, 'a')"> 
                                        <?= htmlspecialchars($question['cau1']) ?>
                                    </label>
                                <?php endif; ?>

                                <?php if (!empty($question['cau2'])): ?>
                                    <label class="answer-option">
                                        <input type="radio" 
                                               name="answer[<?= $key ?>]" 
                                               value="b"
                                               onclick="selectAnswer(<?= $key ?>, 'b')"> 
                                        <?= htmlspecialchars($question['cau2']) ?>
                                    </label>
                                <?php endif; ?>

                                <?php if (!empty($question['cau3'])): ?>
                                    <label class="answer-option">
                                        <input type="radio" 
                                               name="answer[<?= $key ?>]" 
                                               value="c"
                                               onclick="selectAnswer(<?= $key ?>, 'c')"> 
                                        <?= htmlspecialchars($question['cau3']) ?>
                                    </label>
                                <?php endif; ?>
                            </div>

                            <input type="hidden" name="idcauHoi[]" value="<?= htmlspecialchars($question['idcauHoi']) ?>">
                            <input type="hidden" name="idPhuHuynh" value="<?= htmlspecialchars($_SESSION['idPhuHuynh']) ?>">
                        </div>
                    <?php
                        $key++;
                    }
                    ?>

                    <div class="progress-container">
                        <!-- Progress dots will be added here by JavaScript -->
                    </div>
                  
                    <div class="navigation">
                    <div class="nav-buttons-group">
                        <button type="button" class="nav-button prev-button" onclick="prevQuestion()">Câu trước</button>
                        <button type="button" class="nav-button next-button" onclick="nextQuestion()">Câu tiếp</button>
                    </div>
                </div>
                <button type="submit" class="submit-button" name="nopbai">Nộp bài</button>
                </form>
            </div>
<?php
        }
    } else {
        echo "<p>Không thể lấy danh sách câu hỏi.</p>";
    }
} else {
    echo "<p>Lỗi: Không có Unit nào được cung cấp.</p>";
}
?>