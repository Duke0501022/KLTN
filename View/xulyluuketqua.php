<?php
include_once("Controller/cTracNghiem.php");

$showQuiz = true; // Biến để xác định có hiển thị bài trắc nghiệm hay không

// Xử lý yêu cầu và lấy danh sách câu hỏi từ cơ sở dữ liệu
if (isset($_GET['idUnit'])) {
    $idUnit = $_GET['idUnit'];
    $tracnghiem = new cTracNghiem();
    $allQuestions = $tracnghiem->select_questions_by_unit($idUnit); // Lấy tất cả câu hỏi theo Unit

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
                        $score += 5;
                        break;
                    case 'b':
                        $score += 3;
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
            $username = $_SESSION['username'];
            $idPhuHuynh = $_SESSION['idPhuHuynh'];
            $ngayTao = date('Y-m-d H:i:s');
            $p = new cTracNghiem();
            $kq = $p->get_saveResult($evaluation, $ngayTao, $idPhuHuynh, $idUnit, $totalScore, $username, $fieldID);
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
                        <button type="button" class="nav-button prev-button" onclick="prevQuestion()">Câu trước</button>
                        <button type="button" class="nav-button next-button" onclick="nextQuestion()">Câu tiếp</button>
                        <button type="submit" class="submit-button" name="nopbai">Nộp bài</button>
                    </div>
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