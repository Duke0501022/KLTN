-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 27, 2024 lúc 12:05 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `kinderdb1`
--

DELIMITER $$
--
-- Các hàm
--
CREATE DEFINER=`root`@`localhost` FUNCTION `convert_vi_to_en` (`input` VARCHAR(255)) RETURNS VARCHAR(255) CHARSET utf8mb4 COLLATE utf8mb4_general_ci  BEGIN
    DECLARE output VARCHAR(255);
    SET output = input;
    SET output = LOWER(output);
    SET output = REPLACE(output, 'á', 'a');
    SET output = REPLACE(output, 'à', 'a');
    SET output = REPLACE(output, 'ạ', 'a');
    SET output = REPLACE(output, 'ả', 'a');
    SET output = REPLACE(output, 'ã', 'a');
    SET output = REPLACE(output, 'â', 'a');
    SET output = REPLACE(output, 'ấ', 'a');
    SET output = REPLACE(output, 'ầ', 'a');
    SET output = REPLACE(output, 'ậ', 'a');
    SET output = REPLACE(output, 'ẩ', 'a');
    SET output = REPLACE(output, 'ẫ', 'a');
    SET output = REPLACE(output, 'ă', 'a');
    SET output = REPLACE(output, 'ắ', 'a');
    SET output = REPLACE(output, 'ằ', 'a');
    SET output = REPLACE(output, 'ặ', 'a');
    SET output = REPLACE(output, 'ẳ', 'a');
    SET output = REPLACE(output, 'ẵ', 'a');
    SET output = REPLACE(output, 'é', 'e');
    SET output = REPLACE(output, 'è', 'e');
    SET output = REPLACE(output, 'ẹ', 'e');
    SET output = REPLACE(output, 'ẻ', 'e');
    SET output = REPLACE(output, 'ẽ', 'e');
    SET output = REPLACE(output, 'ê', 'e');
    SET output = REPLACE(output, 'ế', 'e');
    SET output = REPLACE(output, 'ề', 'e');
    SET output = REPLACE(output, 'ệ', 'e');
    SET output = REPLACE(output, 'ể', 'e');
    SET output = REPLACE(output, 'ễ', 'e');
    SET output = REPLACE(output, 'í', 'i');
    SET output = REPLACE(output, 'ì', 'i');
    SET output = REPLACE(output, 'ị', 'i');
    SET output = REPLACE(output, 'ỉ', 'i');
    SET output = REPLACE(output, 'ĩ', 'i');
    SET output = REPLACE(output, 'ó', 'o');
    SET output = REPLACE(output, 'ò', 'o');
    SET output = REPLACE(output, 'ọ', 'o');
    SET output = REPLACE(output, 'ỏ', 'o');
    SET output = REPLACE(output, 'õ', 'o');
    SET output = REPLACE(output, 'ô', 'o');
    SET output = REPLACE(output, 'ố', 'o');
    SET output = REPLACE(output, 'ồ', 'o');
    SET output = REPLACE(output, 'ộ', 'o');
    SET output = REPLACE(output, 'ổ', 'o');
    SET output = REPLACE(output, 'ỗ', 'o');
    SET output = REPLACE(output, 'ơ', 'o');
    SET output = REPLACE(output, 'ớ', 'o');
    SET output = REPLACE(output, 'ờ', 'o');
    SET output = REPLACE(output, 'ợ', 'o');
    SET output = REPLACE(output, 'ở', 'o');
    SET output = REPLACE(output, 'ỡ', 'o');
    SET output = REPLACE(output, 'ú', 'u');
    SET output = REPLACE(output, 'ù', 'u');
    SET output = REPLACE(output, 'ụ', 'u');
    SET output = REPLACE(output, 'ủ', 'u');
    SET output = REPLACE(output, 'ũ', 'u');
    SET output = REPLACE(output, 'ư', 'u');
    SET output = REPLACE(output, 'ứ', 'u');
    SET output = REPLACE(output, 'ừ', 'u');
    SET output = REPLACE(output, 'ự', 'u');
    SET output = REPLACE(output, 'ử', 'u');
    SET output = REPLACE(output, 'ữ', 'u');
    SET output = REPLACE(output, 'ý', 'y');
    SET output = REPLACE(output, 'ỳ', 'y');
    SET output = REPLACE(output, 'ỵ', 'y');
    SET output = REPLACE(output, 'ỷ', 'y');
    SET output = REPLACE(output, 'ỹ', 'y');
    SET output = REPLACE(output, 'đ', 'd');
    RETURN output;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `hoTen` varchar(50) NOT NULL,
  `hinhAnh` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gioiTinh` tinyint(5) NOT NULL DEFAULT 0 COMMENT '0:Nam 1 Nu',
  `soDienThoai` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`idAdmin`, `hoTen`, `hinhAnh`, `username`, `email`, `gioiTinh`, `soDienThoai`) VALUES
(2, 'Đức', 'images (2).jpg', 'admin', 'duc20025111@gmail.com', 0, 978411347),
(3, 'Hậu', '123', 'admin1', '', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cauhoi`
--

CREATE TABLE `cauhoi` (
  `idcauHoi` int(5) NOT NULL,
  `cauHoi` varchar(1000) NOT NULL,
  `cau1` varchar(20) NOT NULL,
  `cau2` varchar(20) NOT NULL,
  `cau3` varchar(20) NOT NULL,
  `idUnit` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cauhoi`
--

INSERT INTO `cauhoi` (`idcauHoi`, `cauHoi`, `cau1`, `cau2`, `cau3`, `idUnit`) VALUES
(18, 'Không ra hiệu hoặc gợi ý bằng cử chỉ điệu bộ, khi bạn nói những yêu cầu sau, con của bạn có thực hiện được ít nhất 3 trong số các yêu cầu đó không? <br>\n“Đặt đồ chơi lên bàn”<br>\n“Đóng cửa lại”<br>\n“Đưa cho mẹ cái khăn”<br>\n“Lấy áo khoác cho mẹ”<br>\n“Nắm tay mẹ”<br>\n﻿“Lấy quyển sách cho mẹ”', 'Có', 'Thỉnh thoảng', 'Chưa', 1),
(19, 'Khi bạn chỉ vào hình quả bóng (hoặc con mèo, cái ly/cốc , mũ/nón) và hỏi con của bạn: “Đây là cái gì?”, bé có gọi tên chính xác ít nhất một hình không?', 'Có', 'Thỉnh thoảng', 'Chưa', 1),
(20, 'Khi yêu cầu con của bạn chỉ vào: mũi, mắt, tóc, tai, miệng, chân, tay, răng, tóc, bụng… bé có chỉ đúng ít nhất 7 bộ phận của cơ thể không? (Bé có thể chỉ vào bộ phận trên cơ thể của bé, của bạn hoặc của búp bê. Đánh dấu “thỉnh thoảng” nếu bé chỉ được ít nhất 3 bộ phận của cơ thể.)', 'Có', 'Thỉnh thoảng', 'Chưa', 1),
(21, 'Con của bạn có sử dụng đúng ít nhất hai trong số các từ/cụm từ như: “con”, “của con”, “mẹ”, “cô” không?', 'Có', 'Thỉnh thoảng', 'Chưa', 1),
(22, 'Không ra hiệu hoặc dùng cử chỉ điệu bộ, bạn hãy yêu cầu con: “Con đặt sách trên bàn” và “Con đặt giày dưới ghế”. Con của bạn có thực hiện đúng cả 2 mệnh lệnh này không?', 'Có', 'Thỉnh thoảng', 'Chưa', 1),
(23, 'Con của bạn có thể tự bước lên hoặc xuống ít nhất hai bậc cầu thang không? Bé có thể vịn vào tường hoặc tay vịn cầu thang. (Bạn có thể quan sát bé ở cửa hàng, sân chơi, hoặc ở nhà.)', 'Có', 'Thỉnh thoảng', 'Chưa', 1),
(24, 'Con của bạn có thể chạy khá vững và tự dừng lại mà không cần va chạm vào vật hoặc không bị té ngã không?', 'Có', 'Thỉnh thoảng', 'Chưa', 1),
(25, 'Con của bạn có thể nhảy với hai chân rời khỏi mặt đất cùng một lúc được không?', 'Có', 'Thỉnh thoảng', 'Chưa', 1),
(26, 'Con của bạn có đá được quả bóng bằng cách vung chân về phía trước mà không cần phải vịn vào bất cứ điểm tựa nào không?', 'Có', 'Thỉnh thoảng', 'Chưa', 1),
(27, 'Con của bạn có thực hiện thao tác vặn xoay khi cố gắng mở nắm cửa, vặn mở nút chai, xoay con vụ hoặc lên dây cót đồ chơi không?', 'Có', 'Thỉnh thoảng', 'Chưa', 1),
(28, 'Con của bạn có biết bật và tắt công tắc không?', 'Có', 'Thỉnh thoảng', 'Chưa', 1),
(29, 'Con của bạn có tự xếp 7 khối gỗ hoặc đồ chơi nhỏ chồng lên nhau không? (Bạn có thể dùng đồ chơi hoặc đồ vật kích cỡ khoảng 1 inch/2.5 cm.)', 'Có', 'Thỉnh thoảng', 'Chưa', 1),
(30, 'Con của bạn có biết chơi giả bộ không? Ví dụ: bé để cái ly lên tai giả vờ là điện thoại, bé đặt một chiếc hộp lên đầu giả vờ là chiếc mũ/nón, bé dùng khối gỗ hoặc đồ chơi nhỏ làm thức ăn.', 'Có', 'Thỉnh thoảng', 'Chưa', 1),
(31, 'Con của bạn có biết đặt đồ đạc đúng vị trí không? Ví dụ, đồ chơi ở trên kệ, chăn/mền ở trên giường và chén đĩa thì đặt ở nhà bếp?', 'Có', 'Thỉnh thoảng', 'Chưa', 1),
(32, 'Khi đang cùng bé nhìn vào gương, bạn hỏi “(Dùng tên bé) đâu rồi?” Bé có chỉ vào hình ảnh của mình trong gương không?', 'Có', 'Thỉnh thoảng', 'Chưa', 1),
(33, 'Nếu con của bạn muốn lấy một vật ở trên cao mà không với tới được, bé có tìm ghế hoặc hộp để đứng lên không (ví dụ lấy đồ chơi trên kệ\r\n\r\nhoặc “giúp” mẹ làm bếp)?', 'Có', 'Thỉnh thoảng', 'Chưa', 1),
(34, 'Nếu bạn thực hiện các động tác sau, con của bạn có bắt chước làm theo được ít nhất một động tác không? <br>\r\nHá và ngậm miệng<br>\r\nNháy mắt<br>\r\nKéo tai<br>\r\nVỗ nhẹ lên má', 'Có', 'Thỉnh thoảng', 'Chưa', 1),
(35, 'Con của bạn có biết ăn bằng thìa (muỗng) không?', 'Có', 'Thỉnh thoảng', 'Chưa', 1),
(36, 'Khi chơi với thú nhồi bông hoặc búp bê, con của bạn có giả bộ ru em ngủ, cho em ăn, thay tã cho em, đặt em vào giường, và làm các hành động tương tự vậy hay không?', 'Có', 'Thỉnh thoảng', 'Chưa', 1),
(37, 'Con của bạn có thường dùng từ “con”, “cháu” để xưng hô hơn là dùng tên của bé “không? Ví dụ, bé nói: “Con làm cái này” thường xuyên hơn là nói “Bi làm cái này”.', 'Có', 'Thỉnh thoảng', 'Chưa', 1),
(38, 'Nếu bạn chỉ vào một điểm trong phòng, trẻ có nhìn theo không? (VÍ DỤ, nếu bạn chỉ vào đồ chơi hay con vật, trẻ có nhìn vào đồ chơi đó hay con vật đó không?)', 'Có', 'Thỉnh thoảng', 'Không', 2),
(39, 'Bạn có bao giờ tự hỏi liệu trẻ có bị điếc không?', 'Có', 'Thỉnh thoảng', 'Không', 2),
(40, 'Trẻ có chơi trò chơi tưởng tượng hoặc giả vờ không? (VÍ DỤ, giả vờ uống nước từ một cái cốc rỗng, giả vờ nói chuyện điện thoại, hay giả vờ cho búp bê hoặc thú giả ăn?)', 'Có', 'Thỉnh thoảng', 'Không', 2),
(41, 'Trẻ có thích leo trèo lên đồ vật không? (VÍ DỤ, trèo lên đồ đạc trong nhà, đồ chơi ngoài trời, hoặc leo cầu thang)', 'Có', 'Thỉnh thoảng', 'Không', 2),
(42, 'Bé có làm các chuyển động ngón tay một cách bất thường đến sát mắt của bé không? (VÍ DỤ, bé có lắc/ ngọ nguậy ngón tay qua lại sát mắt của bé)', 'Có', 'Thỉnh thoảng', 'Không', 2),
(43, 'Bé có dùng ngón tay trỏ của bé để yêu cầu việc gì đó, hoặc để muốn được giúp đỡ không? (VÍ DỤ, chỉ vào bim bim hoặc đồ chơi ngoài tầm với)', 'Có', 'Thỉnh thoảng', 'Không', 2),
(44, 'Trẻ có dùng một ngón tay để chỉ cho bạn thứ gì đó thú vị? (VÍ DỤ, chỉ vào máy bay trên bầu trời hoặc 1 cái xe tải lớn trên đường)', 'Có', 'Thỉnh thoảng', 'Không', 2),
(45, 'Trẻ có thích chơi với những đứa trẻ khác không? (VÍ DỤ, trẻ có quan sát những đứa trẻ khác, cười, hoặc tới chơi với chúng không)', 'Có', 'Thỉnh thoảng', 'Không', 2),
(46, 'Trẻ có khoe bạn những đồ vật bằng cách mang hay ôm chúng đến cho bạn xem- không phải để được bạn giúp đỡ, chỉ để chia sẻ với bạn không? (VÍ DỤ, khoe với bạn 1 bông hoa, thú giả, hoặc 1 cái xe tải đồ chơi)', 'Có', 'Thỉnh thoảng', 'Không', 2),
(47, 'Bé có đáp lại khi được gọi tên không? (VÍ DỤ, bé có ngước tìm người gọi, nói chuyện, hay bập bẹ, hoặc ngừng việc bé đang làm khi bạn gọi tên của bé?)', 'Có', 'Thỉnh thoảng', 'Không', 2),
(48, 'Khi bạn cười với bé, bé có cười lại với bạn không?', 'Có', 'Thỉnh thoảng', 'Không', 2),
(49, 'Trẻ có cảm thấy khó chịu bởi những tiếng ồn xung quanh? (VÍ DỤ, trẻ có hét lên hay khóc khi nghe tiếng ồn của máy hút bụi, hoặc nhạc to?)', 'Có', 'Thỉnh thoảng', 'Không', 2),
(50, 'Bé đã biết đi chưa?', 'Có', 'Thỉnh thoảng', 'Không', 2),
(51, 'Trẻ có bắt chước những điều bạn làm không? (VÍ DỤ, vẫy tay bye bye, vỗ tay, hoặc tạo ra những âm thanh vui vẻ khi bạn làm)', 'Có', 'Thỉnh thoảng', 'Không', 2),
(52, 'Nếu bạn quay đầu để nhìn gì đó, trẻ có nhìn xung quanh để xem bạn đang nhìn cái gì không?', 'Có', 'Thỉnh thoảng', 'Không', 2),
(53, 'Trẻ có cố gắng gây sự chú ý để bạn phải nhìn vào bé không? (VÍ DỤ, trẻ có nhìn bạn để được bạn khen ngợi, hoặc nói “nhìn” hoặc “nhìn con”?)', 'Có', 'Thỉnh thoảng', 'Không', 2),
(54, 'Trẻ có hiểu bạn nói gì khi bạn yêu cầu con làm không? (VÍ DỤ, Nếu bạn không chỉ tay, trẻ có hiểu “để sách lên ghế” hoặc “đưa mẹ/bố cái chăn”không?)', 'Có', 'Thỉnh thoảng', 'Không', 2),
(55, 'Nếu có điều gì mới lạ, trẻ có nhìn bạn để xem bạn cảm thấy thế nào về việc xảy ra không? (VÍ DỤ, nếu trẻ nghe thấy 1 âm thanh thú vị, hoặc nhìn thấy đồ chơi mới, trẻ có nhìn bạn không?)', 'Có', 'Thỉnh thoảng', 'Không', 2),
(56, 'Trẻ có thích những hoạt động mang tính chất chuyển động không? (VÍ DỤ, được lắc lư hoặc nâng lên hạ xuống trên đầu gối của bạn không?)', 'Có', 'Thỉnh thoảng', 'Không', 2),
(57, 'Bé có nhìn vào mắt bạn khi bạn đang nói chuyện, chơi hoặc mặc quần áo cho bé không?', 'Có', 'Thỉnh thoảng', 'Không', 2),
(58, 'Thân bị đau nhức', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 3),
(59, 'Ở một mình nhiều hơn', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 3),
(60, 'Dễ mệt mỏi, ít sức lực', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 3),
(61, 'Cựa quậy, không thể ngồi yên', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 3),
(62, 'Có rắc rối với giáo viên', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 3),
(63, 'Không thích đi học', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 3),
(64, 'Hoạt động như bị động cơ điều khiển', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 3),
(65, 'Mơ mộng quá nhiều', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 3),
(66, 'Dễ bị phân tâm', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 3),
(67, 'Sợ những hoàn cảnh mới', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 3),
(68, 'Cảm thấy buồn, không vui', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 3),
(69, 'Dễ bị bực bội, dễ tức giận', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 3),
(70, 'Khó tập trung', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 3),
(71, 'Ít thích bạn bè', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 3),
(72, 'Đánh nhau với trẻ khác', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 3),
(73, 'Nghỉ học', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 3),
(74, 'Giảm sút điểm trong lớp', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 3),
(75, 'Đi khám nhưng bác sĩ không tìm ra bệnh', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 3),
(76, 'Khó ngủ', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 3),
(77, 'Muốn ở với ba mẹ nhiều hơn trước', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 3),
(78, 'Thân bị đau nhức', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 4),
(79, 'Ở một mình nhiều hơn', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 4),
(80, 'Dễ mệt mỏi, ít sức lực', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 4),
(81, 'Cựa quậy, không thể ngồi yên', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 4),
(82, 'Mơ mộng quá nhiều', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 4),
(83, 'Dễ bị phân tâm', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 4),
(84, 'Sợ những hoàn cảnh mới', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 4),
(85, 'Dễ bị bực bội, dễ tức giận', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 4),
(86, 'Từ chối chia sẻ', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 4),
(87, 'Lấy đồ của người khác', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 4),
(88, 'Đổ lỗi của mình cho người khác', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 4),
(89, 'Chọc ghẹo người khác', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 4),
(90, 'Không hiểu cảm xúc của người khác', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 4),
(91, 'Không biểu lộ cảm xúc', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 4),
(92, 'Không tuân theo luật lệ', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 4),
(93, 'Hành động trẻ con hơn những trẻ cùng tuổi khác', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 4),
(94, 'Có vẻ kém vui', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 4),
(95, 'Làm những việc nguy hiểm không cần thiết', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 4),
(96, 'Cảm thấy mình tệ hại', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 4),
(97, 'Khó ngủ', 'Không bao giờ', 'Thỉnh thoảng', 'Thường xuyên', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chatbot`
--

CREATE TABLE `chatbot` (
  `idChatBot` int(11) NOT NULL,
  `query` varchar(300) NOT NULL,
  `answer` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chatbot`
--

INSERT INTO `chatbot` (`idChatBot`, `query`, `answer`) VALUES
(7, 'Xin chào!', 'Tôi có thể giúp gì cho bạn?'),
(8, 'Hi!', 'Chào bạn tôi có thể giúp gì cho bạn?'),
(9, 'Những dấu hiệu nhận biết trẻ tự kỷ?', 'Thường thì các trẻ tự kỷ sẽ có những dấu hiệu như: Tương tác xã hội và giao tiếp xã hội kém, các hành vi lặp đi lặp lại, rập khuôn, sở thích hạn hẹp. Có hành vi tự gây tương tích cho bản thân, không ý thức được nguy hiểm, chống đối, làm tổn thương người khác, không kiểm soát được cảm xúc của mình.'),
(10, 'Tương tác xã hội và giao tiếp kém là như thế nào? ', '- Trẻ thích hoạt động một mình, ít tương tác, tiếp xúc với người khác <br>			 - Sử dụng tay người khác để lấy, chỉ đồ vật <br>			 \r\n- Kém chú ý chung <br>		\r\n- Không biết chia sẻ sở thích, cảm xúc.<br> \r\n- Ít giao tiếp mắt <br>\r\n- Không/ ít chơi các trò chơi xã hội (ú òa / chi chi chành chành, giả bộ, nhóm)<br>			 - Không hiểu các cử chỉ điệu bộ, nét mặt, cảm xúc. <br>			 \r\n- Không có khả năng kết bạn, duy trì quan hệ xã hội<br> - Không biết khởi đầu giao tiếp hoặc duy trì giao tiếp			'),
(11, 'Những hành vi có vấn đề mà trẻ tự kỷ thường gặp phải ', '- Tự gây thương tích cho bản thân mình: đập đầu, cắn tay, cào các vết thương . <br> - Không ý thức được nguy hiểm: leo trèo, chạy nơi công cộng, ăn những thứ đồ ăn không ăn được...  <br>	- Chống đối, làm tổn thương người khác: la hét, khóc, cào cấu, đấm, đẩy..	 <br> - Hiếu động, kém chú ý, tự ý rời khỏi chỗ ngồi, chạy lăng xăng... <br>	- Hành vi lặp đi lặp lại: lắc lư thân mình, vẫy tay, xoay tròn tại chỗ...'),
(12, 'Cha mẹ phải làm gì khi biết con mình bị tự kỷ ? ', '- Đưa con đến các bệnh viện hoặc phòng khám để khám và chẩn đoán.	 <br>- Trẻ gặp khó khăn trong việc giao tiếp bằng ngôn ngữ và ánh mắt. Vì thế cha mẹ có thể quan sát các cử chỉ, điệu bộ và hành vi đế nhận biết trạng thái và cảm xúc của trẻ.  '),
(13, 'Làm sao để chẩn đoán trẻ tự kỷ?', 'Chẩn đoán trẻ tự kỷ cần sự đánh giá của các chuyên gia y tế, như bác sĩ nhi khoa, nhà tâm lý học hoặc chuyên gia về tự kỷ. Quá trình chẩn đoán bao gồm quan sát hành vi, thảo luận với phụ huynh và có thể sử dụng các bài kiểm tra phát triển.'),
(14, 'Nguyên nhân nào gây ra tự kỷ?', 'Hiện tại, nguyên nhân chính xác của tự kỷ vẫn chưa được biết rõ. Tuy nhiên, người ta cho rằng có nhiều yếu tố kết hợp, bao gồm di truyền và môi trường, có thể góp phần gây ra tự kỷ.'),
(15, 'Có thể chữa khỏi tự kỷ không ?', 'Tự kỷ không thể chữa khỏi hoàn toàn, nhưng can thiệp sớm và các phương pháp trị liệu thích hợp có thể giúp trẻ cải thiện kỹ năng giao tiếp, tương tác xã hội và giảm các hành vi lặp đi lặp lại.'),
(16, 'Các phương pháp trị liệu nào hiệu quả cho trẻ tự kỷ?', 'Các phương pháp trị liệu phổ biến cho trẻ tự kỷ bao gồm trị liệu hành vi, trị liệu ngôn ngữ, trị liệu nghề nghiệp và can thiệp sớm. Mỗi trẻ có thể phản ứng khác nhau, vì vậy kế hoạch trị liệu cần được cá nhân hóa.'),
(17, 'Tôi có thể giúp con mình như thế nào?', 'Phụ huynh có thể giúp con bằng cách tìm hiểu về tự kỷ, tham gia vào các hoạt động trị liệu, tạo môi trường hỗ trợ tại nhà và kiên nhẫn. Hãy tìm kiếm sự hỗ trợ từ các chuyên gia và nhóm hỗ trợ phụ huynh.'),
(18, 'Trẻ tự kỷ có thể đi học bình thường không?', 'Trẻ tự kỷ có thể đi học, nhưng có thể cần có sự hỗ trợ đặc biệt. Một số trẻ học trong các lớp học hòa nhập, trong khi những trẻ khác có thể học tại các trường chuyên biệt dành cho trẻ tự kỷ.'),
(19, 'Làm sao để cải thiện kỹ năng giao tiếp cho trẻ tự kỷ?', 'Để cải thiện kỹ năng giao tiếp, có thể sử dụng các phương pháp trị liệu ngôn ngữ, hỗ trợ hình ảnh, và tạo cơ hội cho trẻ thực hành giao tiếp trong các tình huống thực tế.'),
(20, 'Trẻ tự kỷ có thể phát triển bình thường như trẻ khác không?', 'Trẻ tự kỷ có thể phát triển và đạt được nhiều kỹ năng, nhưng tiến độ phát triển có thể khác nhau. Với sự hỗ trợ và can thiệp phù hợp, nhiều trẻ tự kỷ có thể sống độc lập và thành công trong cuộc sống.'),
(21, 'Trẻ tự kỷ có thể có những khả năng đặc biệt không?', 'Đúng, một số trẻ tự kỷ có thể có những khả năng đặc biệt hoặc kỹ năng vượt trội trong một số lĩnh vực như toán học, âm nhạc, nghệ thuật hoặc trí nhớ.'),
(22, 'Chế độ ăn có ảnh hưởng đến trẻ tự kỷ không?', 'Một số nghiên cứu cho thấy rằng chế độ ăn có thể ảnh hưởng đến hành vi và sức khỏe của trẻ tự kỷ. Một số trẻ có thể nhạy cảm với gluten hoặc casein, do đó, chế độ ăn không chứa gluten và casein đôi khi được khuyến khích. Tuy nhiên, điều này cần được thảo luận với chuyên gia dinh dưỡng và bác sĩ trước khi áp dụng.'),
(23, 'Thực phẩm nào nên tránh cho trẻ tự kỷ?', 'Các thực phẩm có chứa gluten (từ lúa mì, lúa mạch) và casein (từ sữa) đôi khi được tránh vì có thể gây phản ứng không tốt ở một số trẻ. Ngoài ra, hạn chế đồ ăn có chất bảo quản, phẩm màu và đường có thể giúp giảm các triệu chứng hành vi.'),
(24, 'Các chất dinh dưỡng nào quan trọng cho trẻ tự kỷ?', 'Các chất dinh dưỡng quan trọng bao gồm omega-3, vitamin D, vitamin B6, magnesium và probiotics. Các chất này có thể hỗ trợ phát triển não bộ và cải thiện hành vi. Tuy nhiên, cần tham khảo ý kiến chuyên gia trước khi bổ sung dinh dưỡng.'),
(25, 'Có thực phẩm bổ sung nào tốt cho trẻ tự kỷ không?', 'Một số phụ huynh báo cáo rằng việc bổ sung omega-3, probiotics, và một số vitamin và khoáng chất có thể giúp cải thiện các triệu chứng tự kỷ. Tuy nhiên, việc sử dụng thực phẩm bổ sung nên được thực hiện dưới sự giám sát của bác sĩ hoặc chuyên gia dinh dưỡng.'),
(26, 'Can thiệp sớm là gì?', 'Can thiệp sớm là các biện pháp và chương trình được thực hiện ngay khi phát hiện các dấu hiệu tự kỷ, thường là trước khi trẻ 3 tuổi. Can thiệp sớm giúp cải thiện kỹ năng giao tiếp, xã hội và hành vi của trẻ.'),
(27, 'Tại sao can thiệp sớm quan trọng cho trẻ tự kỷ?', 'Can thiệp sớm rất quan trọng vì não bộ trẻ nhỏ rất linh hoạt và có khả năng học hỏi cao. Các can thiệp sớm giúp tận dụng giai đoạn phát triển quan trọng này để cải thiện kỹ năng và giảm thiểu các triệu chứng tự kỷ.'),
(28, 'Có những loại can thiệp sớm nào cho trẻ tự kỷ?', 'Các loại can thiệp sớm phổ biến bao gồm trị liệu hành vi ứng dụng (ABA), trị liệu ngôn ngữ, trị liệu nghề nghiệp, và các chương trình giáo dục đặc biệt. Mỗi trẻ sẽ phù hợp với các phương pháp khác nhau, nên cần có kế hoạch can thiệp cá nhân hóa.'),
(29, 'Làm sao để bắt đầu can thiệp sớm cho con?', 'Chương trình can thiệp sớm có thể bao gồm các hoạt động như chơi trị liệu, bài tập kỹ năng xã hội, các buổi học phát triển ngôn ngữ, và các bài tập tăng cường vận động. Mục tiêu là giúp trẻ phát triển toàn diện các kỹ năng cần thiết cho cuộc sống.'),
(30, 'Cha mẹ có thể làm gì tại nhà để hỗ trợ can thiệp sớm?', 'Cha mẹ có thể tham gia các buổi trị liệu, học cách áp dụng các chiến lược can thiệp tại nhà, tạo môi trường an toàn và hỗ trợ, và thúc đẩy kỹ năng xã hội thông qua chơi và tương tác hàng ngày.'),
(31, 'Làm thế nào để khuyến khích trẻ tự kỷ giao tiếp hiệu quả?', 'Để khuyến khích trẻ tự kỷ giao tiếp hiệu quả, phụ huynh có thể sử dụng các phương pháp như mô hình hóa giao tiếp, sử dụng hình ảnh hoặc biểu đồ để trợ giúp trẻ hiểu và diễn đạt ý của mình.'),
(32, 'Phải làm sao nếu trẻ không thể nói?', 'Nếu trẻ không thể nói, phụ huynh có thể khuyến khích trẻ sử dụng các hình thức giao tiếp thay thế như biểu đồ, hình ảnh, biểu tượng hoặc các thiết bị hỗ trợ giao tiếp như máy tính hoặc thiết bị thông minh.'),
(33, 'Có những phương pháp nào để giúp trẻ tự kỷ phát triển kỹ năng giao tiếp không nói?', 'Các phương pháp như trị liệu ngôn ngữ, trị liệu giao tiếp hỗ trợ, và sử dụng các công cụ hỗ trợ giao tiếp như AAC (Augmentative and Alternative Communication) có thể giúp trẻ tự kỷ phát triển kỹ năng giao tiếp không nói.'),
(34, 'Làm thế nào để giúp trẻ tự kỷ hòa nhập và tương tác với bạn bè?', 'Để giúp trẻ tự kỷ hòa nhập và tương tác với bạn bè, phụ huynh có thể tạo cơ hội cho trẻ tham gia vào các hoạt động nhóm, dạy kỹ năng xã hội thông qua trò chơi và hoạt động, và tạo môi trường ủng hộ cho sự tương tác.'),
(35, 'Có cách nào để giảm bớt cảm giác căng thẳng và lo lắng trong các tình huống xã hội không thoải mái?', 'Để giảm bớt cảm giác căng thẳng và lo lắng trong các tình huống xã hội không thoải mái, phụ huynh có thể áp dụng kỹ thuật thở sâu, dùng các từ ngữ tích cực và khích lệ trẻ, và tạo ra các kế hoạch trước cho các tình huống xã hội.'),
(36, 'Làm sao để quản lý các hành vi lặp đi lặp lại như vỗ tay hoặc xoay vật?', 'Để quản lý các hành vi lặp đi lặp lại, phụ huynh có thể cung cấp các hoạt động thay thế, thiết lập lịch trình rõ ràng, sử dụng hệ thống tiền thưởng và khuyến khích các hoạt động khác.'),
(37, 'Có cách nào để giúp trẻ tự kỷ tự quản lý cảm xúc của mình không?', 'Để giúp trẻ tự kỷ tự quản lý cảm xúc, phụ huynh có thể dạy cho trẻ các kỹ năng tự chăm sóc như hít thở sâu, sử dụng từ ngữ để diễn đạt cảm xúc, và cung cấp các kỹ thuật thư giãn như yoga hoặc thiền.'),
(38, 'ABA là gì và làm thế nào nó có thể giúp trẻ tự kỷ?', 'ABA (Applied Behavior Analysis) là một phương pháp trị liệu dựa trên khoa học, tập trung vào việc thay đổi hành vi bằng cách sử dụng kỹ thuật học hành vi. ABA có thể giúp trẻ tự kỷ phát triển các kỹ năng mới và giảm các hành vi không mong muốn.'),
(39, 'Trị liệu ngôn ngữ như thế nào có thể được tích hợp vào cuộc sống hàng ngày của trẻ?', 'Trị liệu ngôn ngữ có thể được tích hợp vào cuộc sống hàng ngày của trẻ bằng cách sử dụng các hoạt động và trò chơi kỹ thuật ngôn ngữ, tạo cơ hội cho trẻ thực hành các kỹ năng ngôn ngữ trong các tình huống thực tế, và sử dụng ngôn ngữ hỗ trợ như biểu đồ hoặc bảng từ vựng.'),
(40, 'Gia đình nên làm gì để hỗ trợ quá trình can thiệp sớm của trẻ?', 'Gia đình có thể hỗ trợ quá trình can thiệp sớm của trẻ bằng cách tham gia vào các buổi trị liệu, áp dụng các kỹ thuật hỗ trợ tại nhà, và tìm kiếm sự hỗ trợ từ các nhóm cộng đồng và tổ chức.'),
(41, 'Làm thế nào để tạo một môi trường gia đình hỗ trợ và đồng hành với trẻ tự kỷ hàng ngày?', 'Để tạo một môi trường gia đình hỗ trợ, phụ huynh có thể thiết lập các quy tắc rõ ràng và công bằng, cung cấp sự ủng hộ và khuyến khích, và tạo ra các kế hoạch và thói quen hằng ngày để giúp trẻ tự kỷ cảm thấy an toàn và tự tin.'),
(42, 'Nên tiếp cận can thiệp sớm từ đâu và làm thế nào để bắt đầu?', 'Phụ huynh nên tiếp cận can thiệp sớm bằng cách tìm kiếm sự đánh giá từ các chuyên gia y tế và giáo dục, và thảo luận với các chuyên gia để lập kế hoạch can thiệp phù hợp với nhu cầu cụ thể của trẻ.'),
(43, 'Cách tạo và duy trì một mối liên kết tích cực với các chuyên gia can thiệp và cộng đồng hỗ trợ?', 'Để tạo và duy trì mối liên kết tích cực với các chuyên gia can thiệp và cộng đồng hỗ trợ, phụ huynh có thể tham gia vào các buổi hội thảo, nhóm hỗ trợ phụ huynh, và tìm kiếm sự tư vấn và hỗ trợ từ các chuyên gia.'),
(44, 'Làm thế nào để theo dõi tiến độ của trẻ trong quá trình can thiệp sớm?', 'Để theo dõi tiến độ của trẻ, phụ huynh có thể sử dụng các bảng điểm, ghi chép hàng ngày, và thảo luận thường xuyên với các chuyên gia can thiệp để đánh giá và điều chỉnh kế hoạch can thiệp.'),
(45, 'Khi nào cần phải điều chỉnh kế hoạch can thiệp và làm thế nào để làm điều này?', 'Phụ huynh cần điều chỉnh kế hoạch can thiệp khi trẻ có các nhu cầu mới hoặc khi có sự thay đổi trong môi trường hoặc tình hình gia đình. Điều này có thể được thực hiện thông qua việc thảo luận với các chuyên gia can thiệp và theo dõi tiến trình của trẻ.'),
(46, 'Độ tuổi từ mấy tháng tuổi đến dưới 2 tuổi thường có những biểu hiện gì ?  ', 'Thường thì trẻ sẽ không tương tác với đồ vật, đồ chơi, không nhìn mặt, mắt, gọi tên hay có âm thanh cũng sẽ không phản ứng'),
(47, 'Từ 3 tuổi trở lên có những biểu hiện nào? ', 'Hành vi rập khuôn về mọi mặt, giao tiếp mắt kém, ngôn ngữ ít phát triển'),
(48, 'Trẻ tự kỷ là gì?', 'Trẻ tự kỷ là trẻ có những rối loạn trong phát triển thần kinh, ảnh hưởng đến khả năng giao tiếp, tương tác xã hội và hành vi. Tự kỷ là một phổ, có nghĩa là mức độ ảnh hưởng và các triệu chứng có thể rất khác nhau giữa các trẻ.'),
(49, 'Phổ tự kỷ là gì?', 'Phổ tự kỷ (Autism Spectrum Disorder - ASD) là một loạt các rối loạn phát triển thần kinh ảnh hưởng đến cách một người giao tiếp và tương tác với người khác. Mức độ ảnh hưởng của tự kỷ có thể từ nhẹ đến nặng, và các triệu chứng có thể rất đa dạng.'),
(50, 'Trẻ tự kỷ có thể có những khả năng đặc biệt không?', 'Đúng, một số trẻ tự kỷ có thể có những khả năng đặc biệt hoặc kỹ năng vượt trội trong một số lĩnh vực như toán học, âm nhạc, nghệ thuật hoặc trí nhớ.'),
(51, 'Trẻ tự kỷ có thể phát triển các kỹ năng xã hội như thế nào?', 'Các kỹ năng xã hội có thể được phát triển thông qua các chương trình can thiệp xã hội, trị liệu nhóm, và các hoạt động xã hội hóa có sự giám sát của người lớn.'),
(52, 'Làm thế nào để tạo một môi trường học thuật thuận lợi cho trẻ tự kỷ?', 'Để tạo một môi trường học thuật thuận lợi, cần phải tận dụng các phương pháp giảng dạy phù hợp với nhu cầu của trẻ, cung cấp cơ hội học tương tác và thực hành, và sử dụng các công cụ học tập hỗ trợ như bảng từ vựng hình ảnh hoặc ứng dụng giáo dục.'),
(53, 'Làm thế nào để giúp trẻ tự kỷ phát triển kỹ năng tự chăm sóc và tự phục vụ?', 'Để giúp trẻ tự kỷ phát triển kỹ năng tự chăm sóc và tự phục vụ, phụ huynh có thể sử dụng mô hình hóa, hướng dẫn bước một, và cung cấp phản hồi tích cực khi trẻ thực hiện các hoạt động tự chăm sóc.'),
(54, 'Làm thế nào để chọn trường phù hợp cho trẻ tự kỷ?', 'Để chọn trường phù hợp cho trẻ tự kỷ, phụ huynh nên tìm hiểu về các chương trình giáo dục đặc biệt của trường, hỏi về các phương pháp giảng dạy và hỗ trợ, và tham gia các buổi tham quan trường để xem xét môi trường học tập.'),
(55, 'Làm sao để giúp con tôi tự kỷ phát triển kỹ năng sống hàng ngày?', 'Mỗi ngày, bạn có thể biến những hoạt động hàng ngày thành cơ hội học tập. Ví dụ, bạn có thể dạy con cách tự đánh răng bằng cách làm mẫu và sau đó khuyến khích con làm theo. Hãy kiên nhẫn và khen ngợi con mỗi khi con hoàn thành một nhiệm vụ.'),
(56, 'Con tôi thường không tập trung vào một việc gì quá lâu. Tôi nên làm gì?', 'Bạn có thể chia nhỏ các hoạt động thành từng bước nhỏ và dễ quản lý hơn. Hãy sử dụng hình ảnh hoặc biểu đồ để giúp con theo dõi các bước cần thực hiện. Ngoài ra, hãy tạo môi trường ít xao nhãng nhất có thể để con dễ tập trung hơn.'),
(57, 'Con tôi có vẻ lo lắng khi gặp người lạ. Tôi nên làm gì?', 'Bạn có thể giúp con cảm thấy thoải mái hơn bằng cách chuẩn bị trước cho con về những gì sẽ diễn ra. Dùng sách hình ảnh hoặc câu chuyện để mô tả tình huống và người con sẽ gặp. Hãy ở bên cạnh con trong suốt thời gian đầu để con cảm thấy an toàn.'),
(58, 'Làm sao để con tôi kết bạn?', 'Hãy bắt đầu bằng cách tạo ra các tình huống giao tiếp xã hội dễ dàng và không áp lực. Ví dụ, mời một bạn cùng lớp đến chơi nhà hoặc tham gia vào các nhóm chơi có sự giám sát của người lớn. Hãy dạy con các kỹ năng xã hội cơ bản như chào hỏi, chia sẻ và lắng nghe.'),
(59, 'Con tôi thường có những cơn giận dữ. Tôi nên làm sao?', 'Khi con bắt đầu giận dữ, hãy giữ bình tĩnh và tạo ra một không gian an toàn cho con. Bạn có thể dạy con cách sử dụng các kỹ thuật thở sâu hoặc nhờ con mô tả cảm giác của mình bằng từ ngữ hoặc hình ảnh. Sau khi con đã bình tĩnh, hãy thảo luận về cảm xúc của con và cùng tìm ra các giải pháp.'),
(60, 'Làm sao để biết bài học can thiệp sớm nào phù hợp với con tôi?', 'Bạn nên làm việc cùng với các chuyên gia để đánh giá nhu cầu và khả năng của con. Thử nghiệm với nhiều phương pháp khác nhau và theo dõi sự tiến bộ của con có thể giúp bạn tìm ra bài học can thiệp phù hợp nhất.'),
(61, 'Trò chơi nào giúp phát triển trí tuệ cảm xúc (EQ) cho trẻ tự kỷ?', 'Một số trò chơi như \"Đoán cảm xúc\" nơi trẻ đoán cảm xúc từ hình ảnh hoặc khuôn mặt, \"Câu chuyện cảm xúc\" nơi trẻ kể lại câu chuyện và mô tả cảm xúc của nhân vật, và \"Trò chơi chia sẻ\" giúp trẻ học cách chia sẻ và hợp tác có thể rất hiệu quả.'),
(62, 'Làm sao để chơi các trò chơi này với con?', 'Bạn có thể bắt đầu bằng cách chơi cùng con, mô tả và giải thích từng cảm xúc hoặc tình huống. Hãy khuyến khích con tham gia và bày tỏ cảm xúc của mình, và khen ngợi con khi con thể hiện hiểu biết về các cảm xúc đó.'),
(63, 'Trò chơi nào giúp phát triển trí tuệ (IQ) cho trẻ tự kỷ?', 'Trò chơi như xếp hình, giải đố, trò chơi ghép chữ, và các ứng dụng giáo dục trực tuyến có thể giúp phát triển kỹ năng tư duy logic, giải quyết vấn đề và ngôn ngữ. Trò chơi xây dựng như LEGO cũng giúp phát triển khả năng sáng tạo và kỹ năng không gian.'),
(64, 'ó cách nào kết hợp trò chơi và học tập không?', 'Bạn có thể kết hợp trò chơi vào việc học bằng cách sử dụng các trò chơi giáo dục tương tác, như sử dụng bảng chữ cái để học từ vựng, hoặc các trò chơi số học để phát triển kỹ năng toán. Các ứng dụng học tập trực tuyến thường có các trò chơi giáo dục vui nhộn và tương tác.'),
(65, 'Làm sao để giữ cho con hứng thú với các trò chơi học tập?', 'Để giữ cho con hứng thú, hãy thay đổi các trò chơi thường xuyên, tạo ra các thử thách mới và thú vị, và khen ngợi khi con hoàn thành các mục tiêu nhỏ. Bạn cũng có thể tạo ra một hệ thống phần thưởng nhỏ để khuyến khích con tiếp tục học tập thông qua trò chơi.'),
(66, 'Phụ huynh có vai trò gì trong các bài học can thiệp sớm?', 'Phụ huynh đóng vai trò quan trọng trong các bài học can thiệp sớm bằng cách tạo ra một môi trường học tập hỗ trợ, tham gia vào các hoạt động và bài tập cùng con, và cung cấp sự khuyến khích và phản hồi tích cực. Họ cũng có thể hợp tác chặt chẽ với các chuyên gia để đảm bảo các phương pháp can thiệp được thực hiện nhất quán.'),
(67, 'Làm sao để biết con mình có tiến bộ trong các bài học can thiệp sớm?', 'Bạn có thể theo dõi tiến độ của con bằng cách ghi lại các mốc quan trọng và các kỹ năng mới mà con đạt được. Thường xuyên thảo luận với các chuyên gia can thiệp để đánh giá sự tiến bộ và điều chỉnh kế hoạch nếu cần.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuyenvien`
--

CREATE TABLE `chuyenvien` (
  `idChuyenVien` int(11) NOT NULL,
  `hoTen` varchar(50) NOT NULL,
  `soDienThoai` bigint(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hinhAnh` varchar(100) NOT NULL,
  `moTa` varchar(500) NOT NULL,
  `ngaySinh` date DEFAULT NULL,
  `gioiTinh` tinyint(11) NOT NULL COMMENT '0 Nam , 1 Nữ',
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chuyenvien`
--

INSERT INTO `chuyenvien` (`idChuyenVien`, `hoTen`, `soDienThoai`, `email`, `hinhAnh`, `moTa`, `ngaySinh`, `gioiTinh`, `username`) VALUES
(1, 'Lê Thị Hòa', 914569871, 'haha@gmail.com', '100-Bui Thi Kim Lan-70100734.000052.jpg', 'Tôi đã hoạt động trong lĩnh vực tự kỷ này trong suốt 8 năm qua và đã có cơ hội làm việc với nhiều học sinh có nhu cầu đặc biệt khác nhau...', '2004-06-18', 0, 'chuyenvien01'),
(2, 'Phan Thị Ngọc Dung', 1234567890, 'chuyenvien02@gmail.com', '53-Phan Thi Ngoc Dung-79000734.000115.jpg', 'Đam mê của tôi là đảm bảo rằng mỗi học sinh đều có một môi trường học tập an toàn và khuyến khích, giúp họ phát triển toàn diện cả về kiến thức và kỹ năng sống...', '2015-05-20', 1, 'chuyenvien02'),
(3, 'Trương Thị Huệ', 1234567891, 'chuyenvien03@gmail.com', '101-Vi Thuy Anh Chuong-70100734.000049.jpg', 'Tôi luôn tự đặt mình vào vị trí của học sinh, giúp họ cảm thấy tự tin và đồng thời khuyến khích họ khám phá tiềm năng trong bản thân...', '1994-06-21', 0, 'chuyenvien03'),
(4, 'Trần Văn Tuấn', 1234567892, 'chuyenvien04@gmail.com', '17-Nguyen Quoc Huy-79000734.000173.jpg', 'Tôi luôn tin rằng mỗi học sinh đều có tiềm năng đáng kinh ngạc và tôi cam kết hỗ trợ họ trên con đường thành công...', '2005-06-17', 0, 'chuyenvien04'),
(5, 'Phạm Văn Nam', 1234567894, 'chuyenvien05@gmail.com', '40. Nguyen Linh Bang-79000734.000089.jpg', 'Tôi tin rằng mỗi học sinh đều có thể học tốt nếu được đồng hành và hỗ trợ chính xác, và tôi cam kết làm việc chăm chỉ để đảm bảo sự phát triển toàn diện cho mỗi em...', '1998-08-17', 0, 'chuyenvien05'),
(6, 'Nguyễn Thị Ánh Thư', 1234567895, 'chuyenvien06@gmail.com', '23-Nguyen Vu Mai Trang79000734.000168.jpg', 'Niềm đam mê của tôi là giúp các em khám phá thế giới xung quanh thông qua phương tiện khác nhau, bổ sung kiến thức và kỹ năng của mình...', '1985-06-17', 0, 'chuyenvien06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuctintuc`
--

CREATE TABLE `danhmuctintuc` (
  `idDanhMuc` tinyint(4) NOT NULL,
  `tenDanhMuc` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuctintuc`
--

INSERT INTO `danhmuctintuc` (`idDanhMuc`, `tenDanhMuc`) VALUES
(1, 'Bệnh trẻ em'),
(2, 'Đời sống'),
(3, 'Góc nhìn'),
(4, 'Góc chuyên gia');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ketqua`
--

CREATE TABLE `ketqua` (
  `idKetQua` int(11) NOT NULL,
  `noiDungKetQua` varchar(200) NOT NULL,
  `idPhuHuynh` int(11) NOT NULL,
  `idUnit` int(5) NOT NULL,
  `diemSo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ketqua`
--

INSERT INTO `ketqua` (`idKetQua`, `noiDungKetQua`, `idPhuHuynh`, `idUnit`, `diemSo`) VALUES
(76, 'Không đạt', 19, 1, 6),
(77, 'Không đạt', 19, 1, 6),
(78, 'Không đạt', 19, 2, 3),
(79, 'Khá', 20, 1, 69),
(80, 'Khá', 20, 1, 60),
(81, 'Con có dấu hiệu phát triển chậm hơn so với sự phát triển của trẻ bình thường, hãy lưu ý những điểm con chưa đạt và hỗ trợ con.', 20, 1, 68);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lienhe`
--

CREATE TABLE `lienhe` (
  `idTieuDe` tinyint(11) NOT NULL,
  `tieuDe` varchar(100) NOT NULL,
  `noiDung` varchar(500) NOT NULL,
  `thoiGian` date DEFAULT NULL,
  `hoTen` varchar(225) NOT NULL,
  `soDienThoai` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lienhe`
--

INSERT INTO `lienhe` (`idTieuDe`, `tieuDe`, `noiDung`, `thoiGian`, `hoTen`, `soDienThoai`, `email`) VALUES
(4, 'BA tuyển dụng', 'Hậu đẹp troai', '2024-05-17', 'Hậu cute phô mai que', '0948620100', 'xuanhauk16@gmail.com'),
(5, 'BA tuyển dụng', '1', '2024-05-17', 'Hậu cute phô mai que', '0948620100', 'xuanhauk16@gmail.com'),
(6, 'BA tuyển dụng', '1', '2024-05-17', 'Hậu cute phô mai que', '0948620100', 'xuanhauk16@gmail.com'),
(7, 'BA tuyển dụng', '1', '2024-05-17', 'Hậu cute phô mai que', '0948620100', 'xuanhauk16@gmail.com'),
(8, 'BA tuyển dụng', '1', '2024-05-17', 'Hậu cute phô mai que', '0948620100', 'xuanhauk16@gmail.com'),
(9, 'BA tuyển dụng', '1', '2024-05-17', 'Hậu cute phô mai que', '0948620100', 'xuanhauk16@gmail.com'),
(10, 'BA tuyển dụng', '1', '2024-05-17', 'Hậu cute phô mai que', '0948620100', 'xuanhauk16@gmail.com'),
(11, 'BA tuyển dụng', '1', '2024-05-17', 'Hậu cute phô mai que', '', 'xuanhauk16@gmail.com'),
(12, 'BA tuyển dụng', '1', '2024-05-17', 'Hậu cute phô mai que', '', 'xuanhauk16@gmail.com'),
(13, 'BA tuyển dụng33', '3333', '2024-05-17', 'Hậu cute phô mai que', '', 'xuanhauk16@gmail.com'),
(14, 'Tuyển dụng Mei vào làm vợ sếp Hậu', 'Xin chào tôi là Mei đây!', '2024-05-17', '', '0948620100', 'xuanhauk16@gmail.com'),
(15, 'Tuyển dụng Mei vào làm vợ sếp Hậu', 'h', '2024-05-17', '', '0948620100', 'xuanhauk16@gmail.com'),
(16, 'Tuyển dụng Mei vào làm vợ sếp Hậu', 'h', '2024-05-17', '', '0948620100', 'xuanhauk16@gmail.com'),
(17, 'Tuyển dụng Mei vào làm vợ sếp Hậu', 'j', '2024-05-17', '', '0948620100', 'xuanhauk16@gmail.com'),
(18, 'Tuyển dụng Mei vào làm vợ sếp Hậu', 'Ahihi', '2024-05-17', 'Hậu cute phô mai que', '0948620100', 'xuanhauk16@gmail.com'),
(19, 'Intern_Tuyển dụng', '5', '2024-05-24', 'Xuân Hậu', '0948620100', 'xuanhau9a2@gmail.com'),
(20, 'Tuyển dụng Mei vào làm vợ sếp Hậu', 'alo', '2024-05-25', 'Hậu cute phô mai que', '0948620100', 'xuanhauk16@gmail.com'),
(21, 'Test contact 1', 'Xin chào tôi đang kiểm tra contact.', '2024-05-27', 'Xuân Hậu', '0948620100', 'xhau@gmail.com'),
(22, 'Test contact 2', 'Hello ', '2024-05-27', 'Xuân Hậu', '0948620100', 'xuanhau9a2@gmail.com'),
(23, 'Test contact 3', 'hellllo', '2024-05-27', 'Hậu cute phô mai que', '0948620100', 'xuanhau9a2@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `message`
--

CREATE TABLE `message` (
  `idMessage` int(11) NOT NULL,
  `noiDung` text NOT NULL,
  `added_on` datetime NOT NULL,
  `type` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `message`
--

INSERT INTO `message` (`idMessage`, `noiDung`, `added_on`, `type`, `username`) VALUES
(291, 'hi', '2024-05-25 14:55:47', 'user', 'admin1'),
(292, 'Chào bạn tôi có thể giúp gì cho bạn?', '2024-05-25 14:55:47', 'bot', 'admin1'),
(293, 'tre tu ky la gi', '2024-05-25 14:55:52', 'user', 'admin1'),
(294, 'Xin lỗi! Tôi không hiểu bạn đang nói gì, vui lòng nhập lại. Cảm ơn.', '2024-05-25 14:55:52', 'bot', 'admin1'),
(295, 'xin chao', '2024-05-25 14:56:01', 'user', 'admin1'),
(296, 'Tôi có thể giúp gì cho bạn?', '2024-05-25 14:56:01', 'bot', 'admin1'),
(297, 'nhung dau hieu nhan biet tre tu ky', '2024-05-25 14:56:11', 'user', 'admin1'),
(298, 'Xin lỗi! Tôi không hiểu bạn đang nói gì, vui lòng nhập lại. Cảm ơn.', '2024-05-25 14:56:11', 'bot', 'admin1'),
(299, 'nhung dau hieu de nhan nao nhan biet tre tu ky?', '2024-05-25 14:56:21', 'user', 'admin1'),
(300, 'Thường thì các trẻ tự kỷ sẽ có những dấu hiệu như: Tương tác xã hội và giao tiếp xã hội kém, các hành vi lặp đi lặp lại, rập khuôn, sở thích hạn hẹp. Có hành vi tự gây tương tích cho bản thân, không ý thức được nguy hiểm, chống đối, làm tổn thương người khác, không kiểm soát được cảm xúc của mình.', '2024-05-25 14:56:21', 'bot', 'admin1'),
(301, 'tuong tac xa hoi va giao tiep kem la nhu the nao?', '2024-05-25 14:56:37', 'user', 'admin1'),
(302, '- Trẻ thích hoạt động một mình, ít tương tác, tiếp xúc với người khác <br>			 - Sử dụng tay người khác để lấy, chỉ đồ vật <br>			 \r\n- Kém chú ý chung <br>		\r\n- Không biết chia sẻ sở thích, cảm xúc.<br> \r\n- Ít giao tiếp mắt <br>\r\n- Không/ ít chơi các trò chơi xã hội (ú òa / chi chi chành chành, giả bộ, nhóm)<br>			 - Không hiểu các cử chỉ điệu bộ, nét mặt, cảm xúc. <br>			 \r\n- Không có khả năng kết bạn, duy trì quan hệ xã hội<br> - Không biết khởi đầu giao tiếp hoặc duy trì giao tiếp			', '2024-05-25 14:56:37', 'bot', 'admin1'),
(303, 'tuong tac xa hoi', '2024-05-25 14:57:18', 'user', 'admin1'),
(304, '- Trẻ thích hoạt động một mình, ít tương tác, tiếp xúc với người khác <br>			 - Sử dụng tay người khác để lấy, chỉ đồ vật <br>			 \r\n- Kém chú ý chung <br>		\r\n- Không biết chia sẻ sở thích, cảm xúc.<br> \r\n- Ít giao tiếp mắt <br>\r\n- Không/ ít chơi các trò chơi xã hội (ú òa / chi chi chành chành, giả bộ, nhóm)<br>			 - Không hiểu các cử chỉ điệu bộ, nét mặt, cảm xúc. <br>			 \r\n- Không có khả năng kết bạn, duy trì quan hệ xã hội<br> - Không biết khởi đầu giao tiếp hoặc duy trì giao tiếp			', '2024-05-25 14:57:18', 'bot', 'admin1'),
(305, 'nhan biet tre tu ky', '2024-05-25 14:57:31', 'user', 'admin1'),
(306, 'Thường thì các trẻ tự kỷ sẽ có những dấu hiệu như: Tương tác xã hội và giao tiếp xã hội kém, các hành vi lặp đi lặp lại, rập khuôn, sở thích hạn hẹp. Có hành vi tự gây tương tích cho bản thân, không ý thức được nguy hiểm, chống đối, làm tổn thương người khác, không kiểm soát được cảm xúc của mình.', '2024-05-25 14:57:31', 'bot', 'admin1'),
(307, 'dau hieu nhan biet', '2024-05-25 14:57:37', 'user', 'admin1'),
(308, 'Xin lỗi! Tôi không hiểu bạn đang nói gì, vui lòng nhập lại. Cảm ơn.', '2024-05-25 14:57:37', 'bot', 'admin1'),
(309, 'dau hieu nhan biet tre tu ky', '2024-05-25 14:57:43', 'user', 'admin1'),
(310, 'Xin lỗi! Tôi không hiểu bạn đang nói gì, vui lòng nhập lại. Cảm ơn.', '2024-05-25 14:57:43', 'bot', 'admin1'),
(311, 'che do an co anh huong den tre tu ky khong?', '2024-05-25 15:15:52', 'user', 'admin1'),
(312, 'Một số nghiên cứu cho thấy rằng chế độ ăn có thể ảnh hưởng đến hành vi và sức khỏe của trẻ tự kỷ. Một số trẻ có thể nhạy cảm với gluten hoặc casein, do đó, chế độ ăn không chứa gluten và casein đôi khi được khuyến khích. Tuy nhiên, điều này cần được thảo luận với chuyên gia dinh dưỡng và bác sĩ trước khi áp dụng.', '2024-05-25 15:15:52', 'bot', 'admin1'),
(313, 'hi', '2024-05-25 15:38:42', 'user', '20040441'),
(314, 'Chào bạn tôi có thể giúp gì cho bạn?', '2024-05-25 15:38:42', 'bot', '20040441'),
(315, 'tre tu ky la gi', '2024-05-25 15:38:47', 'user', '20040441'),
(316, 'Xin lỗi! Tôi không hiểu bạn đang nói gì, vui lòng nhập lại. Cảm ơn.', '2024-05-25 15:38:47', 'bot', '20040441'),
(317, 'dau hieu nhan biet tre tu ky', '2024-05-25 15:39:12', 'user', '20040441'),
(318, 'Thường thì các trẻ tự kỷ sẽ có những dấu hiệu như: Tương tác xã hội và giao tiếp xã hội kém, các hành vi lặp đi lặp lại, rập khuôn, sở thích hạn hẹp. Có hành vi tự gây tương tích cho bản thân, không ý thức được nguy hiểm, chống đối, làm tổn thương người khác, không kiểm soát được cảm xúc của mình.', '2024-05-25 15:39:12', 'bot', '20040441'),
(319, 'nguyen nhan', '2024-05-25 15:39:21', 'user', '20040441'),
(320, 'Hiện tại, nguyên nhân chính xác của tự kỷ vẫn chưa được biết rõ. Tuy nhiên, người ta cho rằng có nhiều yếu tố kết hợp, bao gồm di truyền và môi trường, có thể góp phần gây ra tự kỷ.', '2024-05-25 15:39:21', 'bot', '20040441'),
(321, 'co the chua khoi tu ky khong', '2024-05-25 15:39:33', 'user', '20040441'),
(322, 'Tự kỷ không thể chữa khỏi hoàn toàn, nhưng can thiệp sớm và các phương pháp trị liệu thích hợp có thể giúp trẻ cải thiện kỹ năng giao tiếp, tương tác xã hội và giảm các hành vi lặp đi lặp lại.', '2024-05-25 15:39:33', 'bot', '20040441'),
(323, 'co nhung phuong phap nao', '2024-05-25 15:39:43', 'user', '20040441'),
(324, 'Các phương pháp như trị liệu ngôn ngữ, trị liệu giao tiếp hỗ trợ, và sử dụng các công cụ hỗ trợ giao tiếp như AAC (Augmentative and Alternative Communication) có thể giúp trẻ tự kỷ phát triển kỹ năng giao tiếp không nói.', '2024-05-25 15:39:43', 'bot', '20040441'),
(325, 'toi co the giup con minh nhu the nao', '2024-05-25 15:40:03', 'user', '20040441'),
(326, 'Phụ huynh có thể giúp con bằng cách tìm hiểu về tự kỷ, tham gia vào các hoạt động trị liệu, tạo môi trường hỗ trợ tại nhà và kiên nhẫn. Hãy tìm kiếm sự hỗ trợ từ các chuyên gia và nhóm hỗ trợ phụ huynh.', '2024-05-25 15:40:03', 'bot', '20040441'),
(327, 'xin chao', '2024-05-26 20:34:27', 'user', '123456'),
(328, 'Tôi có thể giúp gì cho bạn?', '2024-05-26 20:34:27', 'bot', '123456'),
(329, 'tre tu ky la gi', '2024-05-26 20:34:32', 'user', '123456'),
(330, 'Trẻ tự kỷ là trẻ có những rối loạn trong phát triển thần kinh, ảnh hưởng đến khả năng giao tiếp, tương tác xã hội và hành vi. Tự kỷ là một phổ, có nghĩa là mức độ ảnh hưởng và các triệu chứng có thể rất khác nhau giữa các trẻ.', '2024-05-26 20:34:32', 'bot', '123456'),
(331, 'xin chao', '2024-05-27 08:31:05', 'user', '123456'),
(332, 'Tôi có thể giúp gì cho bạn?', '2024-05-27 08:31:05', 'bot', '123456'),
(333, 'lam the nao de khuyen khich tre tu ky giao tiep hieu qua?', '2024-05-27 11:13:55', 'user', '123456'),
(334, 'Để khuyến khích trẻ tự kỷ giao tiếp hiệu quả, phụ huynh có thể sử dụng các phương pháp như mô hình hóa giao tiếp, sử dụng hình ảnh hoặc biểu đồ để trợ giúp trẻ hiểu và diễn đạt ý của mình.', '2024-05-27 11:13:55', 'bot', '123456'),
(335, 'lam the nao de tao mot moi truong hoc thuat thuan loi cho tre tu ky?', '2024-05-27 11:14:04', 'user', '123456'),
(336, 'Xin lỗi! Tôi không hiểu bạn đang nói gì, vui lòng nhập lại. Cảm ơn.', '2024-05-27 11:14:04', 'bot', '123456'),
(337, 'can thiep som la gi', '2024-05-27 11:20:11', 'user', '123456'),
(338, 'Can thiệp sớm là các biện pháp và chương trình được thực hiện ngay khi phát hiện các dấu hiệu tự kỷ, thường là trước khi trẻ 3 tuổi. Can thiệp sớm giúp cải thiện kỹ năng giao tiếp, xã hội và hành vi của trẻ.', '2024-05-27 11:20:11', 'bot', '123456'),
(339, 'cac bien phap can thiep som', '2024-05-27 11:20:21', 'user', '123456'),
(340, 'Xin lỗi! Tôi không hiểu bạn đang nói gì, vui lòng nhập lại. Cảm ơn.', '2024-05-27 11:20:21', 'bot', '123456'),
(341, 'lam sao biet con minh tien bo trong can thiep som', '2024-05-27 11:20:44', 'user', '123456'),
(342, 'Xin lỗi! Tôi không hiểu bạn đang nói gì, vui lòng nhập lại. Cảm ơn.', '2024-05-27 11:20:44', 'bot', '123456'),
(343, 'lam sao de biet con minh tien bo trong cac bai hoc can thiep som', '2024-05-27 11:21:04', 'user', '123456'),
(344, 'Xin lỗi! Tôi không hiểu bạn đang nói gì, vui lòng nhập lại. Cảm ơn.', '2024-05-27 11:21:04', 'bot', '123456'),
(345, 'lam sao de biet con minh co tien bo trong cac bai hoc can thiep som?', '2024-05-27 11:21:11', 'user', '123456'),
(346, 'Bạn có thể theo dõi tiến độ của con bằng cách ghi lại các mốc quan trọng và các kỹ năng mới mà con đạt được. Thường xuyên thảo luận với các chuyên gia can thiệp để đánh giá sự tiến bộ và điều chỉnh kế hoạch nếu cần.', '2024-05-27 11:21:11', 'bot', '123456'),
(347, 'pho tu ky', '2024-05-27 11:21:37', 'user', '123456'),
(348, 'Phổ tự kỷ (Autism Spectrum Disorder - ASD) là một loạt các rối loạn phát triển thần kinh ảnh hưởng đến cách một người giao tiếp và tương tác với người khác. Mức độ ảnh hưởng của tự kỷ có thể từ nhẹ đến nặng, và các triệu chứng có thể rất đa dạng.', '2024-05-27 11:21:37', 'bot', '123456'),
(349, 'roi loan pho tu ky', '2024-05-27 11:21:43', 'user', '123456'),
(350, 'Xin lỗi! Tôi không hiểu bạn đang nói gì, vui lòng nhập lại. Cảm ơn.', '2024-05-27 11:21:43', 'bot', '123456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `is_read`, `timestamp`) VALUES
(39, 1, 16, 'hi', 0, '2024-05-26 16:32:42'),
(40, 16, 1, 'hi', 0, '2024-05-26 16:32:50'),
(41, 1, 16, 'hi', 0, '2024-05-26 16:33:41'),
(42, 20, 1, 'xin chào cô', 0, '2024-05-26 18:34:44'),
(43, 1, 20, 'Dạ chào phụ huynh', 0, '2024-05-26 18:35:30'),
(44, 1, 20, 'không biết phụ huynh cần tư vấn giúp đỡ gì ạ', 0, '2024-05-26 18:35:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phanhoi`
--

CREATE TABLE `phanhoi` (
  `idPhanHoi` int(11) NOT NULL,
  `idChuyenVien` int(10) NOT NULL,
  `idPhuHuynh` int(11) NOT NULL,
  `hoTen` varchar(255) NOT NULL,
  `soDienThoai` varchar(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `chatLuong` varchar(2) NOT NULL,
  `noiDungPhanHoi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phanhoi`
--

INSERT INTO `phanhoi` (`idPhanHoi`, `idChuyenVien`, `idPhuHuynh`, `hoTen`, `soDienThoai`, `email`, `chatLuong`, `noiDungPhanHoi`) VALUES
(1, 1, 16, 'Nguyễn Thị Ánh', '0123456', 'ahn@gmail.com', '1', 'asd'),
(2, 1, 17, 'Nguyễn Thị Ánh', '0123456', 'anhn56423@gmail.com', '5', 'qqqqqqq'),
(3, 1, 19, 'Xuân Hậu', '0948620100', 'xuanhauk16@gmail.com', '4', 'đasdasd'),
(4, 1, 19, 'Xuân Hậu', '0948620100', 'xuanhauk16@gmail.com', '3', 'l');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phuhuynh`
--

CREATE TABLE `phuhuynh` (
  `idPhuHuynh` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hinhAnh` varchar(100) DEFAULT NULL,
  `hoTen` varchar(50) NOT NULL,
  `soDienThoai` bigint(20) NOT NULL,
  `gioiTinh` tinyint(4) NOT NULL COMMENT '0: Nam 1:Nữ',
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phuhuynh`
--

INSERT INTO `phuhuynh` (`idPhuHuynh`, `email`, `hinhAnh`, `hoTen`, `soDienThoai`, `gioiTinh`, `username`) VALUES
(16, 'duc200251@gmail.com', 'images (1).jpg', 'Luong Anh Duc', 978411347, 0, 'khachhang1'),
(17, 'xuanhauk16@gmail.com', 'z5477893738553_47621c554658bac4205893f2f4a34929.jpg', 'XuanHau', 948620100, 0, '12345678'),
(20, 'xuanhauk16@gmail.com', 'kento-4235-1.jpg', 'Xuân Hậu', 948620100, 0, '123456'),
(21, '20040441.hau@student.iuh.edu.vn', 'viktor-axelsen-olympic-2020-hcv-2.jpg', 'Hậu cute phô mai que', 948620100, 0, 'XuanHau');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quantrivien`
--

CREATE TABLE `quantrivien` (
  `idQTV` int(11) NOT NULL,
  `hoTen` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hinhAnh` varchar(100) NOT NULL,
  `soDienThoai` bigint(20) NOT NULL,
  `gioiTinh` tinyint(11) NOT NULL COMMENT '0 Nam, 1 Nữ',
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `quantrivien`
--

INSERT INTO `quantrivien` (`idQTV`, `hoTen`, `email`, `hinhAnh`, `soDienThoai`, `gioiTinh`, `username`) VALUES
(1, 'QTV A', 'haha@gmail.com', 'images (2).jpg', 12345678, 0, 'quantrivien1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `idRole` int(11) NOT NULL,
  `tenRole` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`idRole`, `tenRole`) VALUES
(1, 'admin'),
(2, 'phuhuynh'),
(3, 'chuyenvien'),
(4, 'quantrivien');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan1`
--

CREATE TABLE `taikhoan1` (
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan1`
--

INSERT INTO `taikhoan1` (`username`, `password`, `Role`) VALUES
('123456', 'c4ca4238a0b923820dcc509a6f75849b', 2),
('12345678', 'c4ca4238a0b923820dcc509a6f75849b', 2),
('123aaa', '202cb962ac59075b964b07152d234b70', 2),
('123abc', '202cb962ac59075b964b07152d234b70', 2),
('123adc', '202cb962ac59075b964b07152d234b70', 2),
('20013391', 'c4ca4238a0b923820dcc509a6f75849b', 2),
('admin', 'e10adc3949ba59abbe56e057f20f883e', 1),
('admin1', 'c4ca4238a0b923820dcc509a6f75849b', 1),
('chuyenvien01', 'c4ca4238a0b923820dcc509a6f75849b', 3),
('chuyenvien02', 'c4ca4238a0b923820dcc509a6f75849b', 3),
('chuyenvien03', 'c4ca4238a0b923820dcc509a6f75849b', 3),
('chuyenvien04', 'c4ca4238a0b923820dcc509a6f75849b', 3),
('chuyenvien05', 'c4ca4238a0b923820dcc509a6f75849b', 3),
('chuyenvien06', 'c4ca4238a0b923820dcc509a6f75849b', 3),
('duc200212', '202cb962ac59075b964b07152d234b70', 2),
('khachhang1', 'c4ca4238a0b923820dcc509a6f75849b', 2),
('quantrivien1', '1', 4),
('XuanHau', 'c4ca4238a0b923820dcc509a6f75849b', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintuc`
--

CREATE TABLE `tintuc` (
  `idTinTuc` tinyint(10) NOT NULL,
  `tieuDe` varchar(300) NOT NULL,
  `noiDung` varchar(10000) NOT NULL,
  `hinhAnh` varchar(100) NOT NULL,
  `idDanhMuc` tinyint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tintuc`
--

INSERT INTO `tintuc` (`idTinTuc`, `tieuDe`, `noiDung`, `hinhAnh`, `idDanhMuc`) VALUES
(1, 'Nghề chăm sóc trẻ đặc biệt.', 'HÀ NỘI - Tiếng khóc giữa đêm của học sinh mới chuyển đến khiến chị Trần Thị Thanh Thủy vội sang kiểm tra, vỗ nhẹ vào lưng cậu bé theo bài hát ru, đêm 8/12.Đêm nào chị cũng dậy 4-5 cữ như vậy với đủ lý do như cho trẻ đi vệ sinh, sau đắp chăn, vỗ về nếu có học sinh khóc nhớ nhà hoặc lên cơ động kinh. ', '60e2cd761374cb2a9265-6897-1671690684.jpg', 2),
(2, 'Những biểu hiện dễ nhầm lẫn trẻ mắc tự kỷ', 'Trẻ chậm nói, chậm phát triển do bị ngộ độc chì hay biết đọc sớm... sẽ có những biểu hiện mà nhiều cha mẹ dễ nhầm lẫn với chứng tự kỷ.\r\n\r\nRối loạn tâm lý\r\n\r\nNhững rối loạn tâm lý như rối loạn nhân cách tránh né, rối loạn phản ứng, giao tiếp xã hội... có thể gây ra hành vi ám ảnh, vấn đề về lời nói và giao tiếp giống như tự kỷ.\r\n\r\nNgộ độc chì\r\n\r\nChì đặc biệt nguy hiểm đối với trẻ sơ sinh và trẻ dưới năm tuổi, do làm tổn thương não trước khi trẻ có cơ hội phát triển đầy đủ, dẫn đến bị suy giảm hệ thần kinh, nhận thức, thể chất suốt đời. Nếu một đứa trẻ bị nhiễm độc chì do ăn phải các mảnh vụn sơn hoặc uống nước có chứa hạt chì, chúng có thể bị chậm phát triển và gặp khó khăn trong học tập. Biểu hiện có thể giống tự kỷ.\r\n\r\nNhạy cảm với âm thanh, ánh sáng\r\n\r\nMột số trẻ rất nhạy cảm với ánh sáng, âm thanh hoặc xúc giác. Việc nghe thấy tiếng ồn lớn có thể khiến chúng khó chịu hoặc ngừng giao tiếp. Một đứa trẻ mắc chứng tự kỷ cũng có thể những biểu hiện này kết hợp với triệu chứng khác như chậm nói.\r\n\r\nTrẻ rối loạn tâm lý, quá thông minh có thể dễ bị nhầm lẫn với chứng tự kỷ. Ảnh: Freepik\r\nTrẻ rối loạn tâm lý, quá thông minh có thể dễ bị nhầm lẫn với chứng tự kỷ. Ảnh: Freepik\r\n\r\nChậm nói, vấn đề về thính giác hoặc các tình trạng chậm phát triển khác\r\n\r\nChậm phát triển là khi trẻ không làm được những điều mà bạn bè có thể thực hiện. Điều này có thể bao gồm: khả năng ngôn ngữ, lời nói, thính giác, vấn đề về tương tác xã hội và suy giảm kỹ năng tư duy.\r\n\r\nChậm nói thường xảy ra khi có vấn đề trong các vùng não, nơi kiểm soát cơ chịu trách nhiệm nói. Do đó, trẻ có thể gặp khó khăn trong việc tạo ra âm thanh vì chúng không thể phối hợp cử động của môi, lưỡi và hàm. Hở hàm ếch, nhiễm trùng tai, viêm tai giữa là những lý do giải thích cho hiện tượng trẻ bị chậm nói.\r\n\r\nTrẻ tự kỷ thường chậm phát triển. Tuy nhiên, tình trạng này cũng có thể do các nguyên nhân khác như nhiễm độc chì, hội chứng Down hoặc nhiều nguyên nhân tiềm ẩn khác.\r\n\r\nBiết đọc sớm hay trí thông minh cao\r\n\r\nTrẻ có thể đọc từ khi còn nhỏ hoặc có dấu hiệu khác của trí thông minh cao đôi khi được chẩn đoán mắc chứng tự kỷ.\r\n\r\nTự kỷ là chứng rối loạn về sự phát triển hành vi, có thể ảnh hưởng đến các kỹ năng cơ bản của trẻ. Nhiều nghiên cứu cho thấy bé mắc tự kỷ cũng bị giảm hứng thú đối với môi trường bên ngoài.\r\n\r\nĐể chẩn đoán chứng tự kỷ, bác sĩ sẽ kiểm tra sự phát triển và hành vi của trẻ. Bác sĩ có thể đặt câu hỏi cho phụ huynh, bản thân trẻ ghi lại toàn bộ tiền sử sức khỏe, kết hợp quan sát hành vi của trẻ.\r\n\r\nViệc điều trị chứng tự kỷ nhẹ phụ thuộc vào độ tuổi của trẻ. Phụ huynh có thể cải thiện các triệu chứng tự kỷ cho con bằng những liệu pháp sau: can thiệp nhận thức để dạy các bé hiểu và thay đổi suy nghĩ và hành vi; tập cho bé thói quen vận động để tăng cường thể chất và kỹ năng vận động; xây dựng chế độ ăn đầy đủ các chất dinh dưỡng, đặc biệt là các loại vitamin và các nguyên tố vi lượng tốt cho sự phát triển não bộ.', 'portrait-asian-little-boy-sitt-7273-3176-1680429340.jpg', 1),
(4, 'Chế độ dinh dưỡng cho trẻ tự kỷ: Nên và không nên ăn gì?', 'Điều chỉnh chế độ dinh dưỡng cho trẻ tự kỷ là điều vô cùng quan trọng bên cạnh các phương pháp can thiệp, trị liệu.  Hội chứng tự kỷ đang trở thành vấn đề đáng lo ngại của nhiều bậc phụ huynh trong nước nói riêng và trên toàn thế giới nói chung. Chính vì chưa xác định được nguyên nhân cụ thể và cách chữa trị tận gốc hội chứng này, cha mẹ nên cố gắng can thiệp bằng các phương pháp tâm lý và đưa ra chế độ dinh dưỡng cho trẻ tự kỷ phù hợp nhất.   Trẻ tự kỷ cũng cần một chế độ ăn uống đầy đủ chất dinh dưỡng theo từng độ tuổi không khác gì so với trẻ bình thường. Tuy nhiên, đối với trẻ tự kỷ các mẹ cần lưu ý một số điều dưới đây, nhằm tránh những tác động không tốt từ những thực phẩm gây ảnh hưởng xấu đến hệ thần kinh cũng như sự phát triển thể lực của trẻ.   Trẻ tự kỷ không nên ăn gì?   - Bột mỳ, bột ngũ cốc, đường, chất kích thích. Theo các nhà nghiên cứu cũng như sự trải nghiệm của đại đa số phụ huynh có con bị tự kỷ: những chất như gluten, carbonhydrate, casein có nhiều trong ngũ cốc, bột mỳ, đường là những thành phần dễ làm trẻ tự kỷ bị kích thích. Khi sử dụng những thực phẩm này, ở đại đa số hệ thần kinh ở trẻ tự kỷ đều bị kích thích khiến trẻ có biểu hiện tăng động, cười hoặc cáu liên tục mà không rõ nguyên nhân. Vì vậy các mẹ nên hạn chế tối đa hoặc dùng với số lượng ít những sản phẩm có thành phần từ bột mỳ, lúa mạch, đường, cà phê...  - Về nước uống: Không nên uống các loại sữa tươi, đặc biệt là các loại có đường, các loại nước ngọt, nước có ga, các loại nước có chất kích thích như cà phê vì trong đó rất nhiều đường và phẩm màu ảnh hưởng đến bộ não của trẻ. Thay vào đó có thể dùng sữa đậu nành, sữa dừa, sữa gạo, sữa khoai tây, nước ép hoa quả.  - Hoa quả: Hạn chế cho trẻ ăn các loại quả có múi như: cam, chanh, bưởi… bởi trong những loại quả này có chứa hàm lượng các chất lên men, gây tích tụ nấm khiến trẻ mất ngủ, không kiểm soát được hành vi.   - Thuốc: Hạn chế việc cho trẻ uống thuốc ngủ để hệ thần kinh của trẻ không bị kích thích. Thay vì cho trẻ uống thuốc ngủ, hãy bổ sung cho trẻ những thực phẩm như: chuối, trứng, cá, các bộ phận từ cây sen và có kế hoạch cho trẻ vận động.   Trẻ tự kỷ nên ăn gì?   - Rất nhiều trẻ tự kỷ gặp vấn đề về hệ tiêu hóa như tiêu chảy, táo bón…Vì vậy, hãy bổ sung các thức ăn giàu omega 3, probiotics có trong sữa chua, các sản phẩm từ sữa và các sản phẩm từ đậu nành. Tuy nhiên, nên tìm các loại không đường hoặc ít đường.   - Nên thêm nhiều hành tây, tỏi vào trong khẩu phần ăn của trẻ vì hành tây kích thích hệ miễn dịch ở trẻ, tỏi có khả năng chống nấm, những ký sinh gây hại và virus. Dầu oliu, axit oleic sẽ giúp hệ thống miễn dịch của trẻ hiệu quả. Ngoài ra, nghệ vàng, bí đỏ cũng là một loại thực phẩm rất tốt cho những người có hội chứng tự kỷ vì trong nghệ và bí đỏ có chất chống viêm, kháng khuẩn, chống nấm và làm tăng cường hệ thống miễn dịch, chống lại các vi khuẩn gây bệnh.   - Tăng cường các loại quả mọng tươi có chứa nitrilosides, vitamin A như: táo, xoài, dưa đỏ, mơ, khoai lang, bí đỏ, ngọn bí và rau xanh các loại.   Lưu ý:   Cần chú ý cân bằng về dinh dưỡng cho trẻ nhưng không nên ép trẻ ăn những đồ mà trẻ không thích vì trẻ rất dễ bị kích thích, nổi cáu khi phải ăn những đồ đó, đôi khi gây cho trẻ tâm lý sợ ăn. Nếu phụ huynh muốn tập cho trẻ ăn món mới thì nên trộn thức ăn đó với thức ăn trẻ đang thích rồi tăng lên từ từ. Nếu trẻ không muốn dùng muỗng thì nên đưa cho trẻ cái muỗng không trước hai lần. Trẻ nghĩ muỗng trống nên không chống lại chuyện đút muỗng vào miệng. Đến lần thứ ba mới đưa một ít thức ăn vào muỗng. Tương tự, cha mẹ muốn đưa loại thức ăn mới thì nên để sẵn thức ăn đó trên bàn, cho trẻ đụng vào, ngửi, liếm, cắn một miếng và cho trẻ nuốt. Có thể mất một ngày hoặc một tuần để trẻ quen với sự thay đổi này.  Bên cạnh đó, không nên ép trẻ ăn đúng giờ theo người bình thường vì ở trẻ tự kỷ việc phải ăn uống đúng giờ là điều rất khó khăn, đặc biệt là với những trẻ từ 2 -3 tuổi. ', '20210802_094042_709201_tre-tu-ky-bieng-an.max-800x800.jpg', 1),
(5, 'Con tôi tự kỷ', 'Vào một sáng mùa thu năm 2019, con trai tôi đi mẫu giáo.Hôm ấy, tôi và vợ cất công quay video để kỷ niệm ngày con chập chững đến trường. Khi video còn chưa dựng xong, vợ tôi nhận được điện thoại của cô giáo, nhắn: ', 'portfolio-6.jpg', 3),
(6, 'Nhận biết dấu hiệu tự kỷ sớm ở trẻ dưới 2 tuổi.', 'Quan sát hành vi và sự phát triển của con, cha mẹ có thể nhận thấy các dấu hiệu sớm của bệnh tự kỷ trước khi trẻ lên 3 tuổi.Chứng rối loạn phổ tự kỷ (ASD), thường gọi là tự kỷ, là một rối loạn não làm hạn chế khả năng giao tiếp và tương tác của một người với người khác. Thống kê cho thấy, cứ 59 trẻ thì có một bé mắc tự kỷ và số bé trai mắc phải gần gấp 4 lần so với bé gái.Giai đoạn trước năm 3 tuổi, một số trẻ phát triển bình thường đến giai đoạn 18-24 tháng tuổi thì ngừng hoặc mất kỹ năng. Các dấu hiệu tự kỷ phổ biến ở trẻ có thể bao gồm: lặp đi lặp lại một chuyển động, tránh giao tiếp bằng mắt hoặc đụng chạm cơ thể, chậm trễ trong việc học nói, lặp lại từ hoặc cụm từ... Tuy nhiên, điều quan trọng cha mẹ cần lưu ý là một số trẻ em không mắc tự kỷ cũng có những biểu hiện này. Vì vậy, cần quan tâm đến một số dấu hiệu trong 2 năm đầu đời ở trẻ:Năm một tuổi: Trẻ nhỏ thường rất hòa đồng vì vậy có thể phát hiện sớm các dấu hiệu của bệnh tự kỷ trong cách trẻ tương tác với mọi người. Ở độ tuổi này, trẻ mắc tự kỷ có thể: không hướng về phía mẹ khi được gọi, không trả lời khi được gọi tên, không nhìn vào mắt mọi người, không bập bẹ tập nói. Ngoài ra, bé cũng không cười hoặc phản ứng, tương tác xã hội trong giao tiếp với người khácNăm hai tuổi: Các dấu hiệu của bệnh tự kỷ dễ nhận thấy hơn trong năm thứ hai của trẻ. Trong khi những bé khác đang bập bẹ phát ra những từ đầu tiên và chỉ vào những thứ chúng muốn, trẻ mắc chứng tự kỷ vẫn tách biệt. Các dấu hiệu của bệnh tự kỷ năm 2 tuổi bao gồm: không phát âm được từ đơn khi được 16 tháng tuổi, không chơi các trò chơi mô phỏng trước 18 tháng. Trẻ ở giai đoạn 24 tháng tuổi cũng không phát âm được cụm từ, mất kỹ năng ngôn ngữ, không quan tâm khi người lớn chỉ vào các đồ vật, chẳng hạn như một chiếc ô tô đang đi qua...Những em bé không mắc chứng tự kỷ cũng có thể có những hành vi này nên phụ huynh cần đưa con đi khám sớm nếu có bất kỳ mối lo ngại nào.Trẻ tự kỷ ít có giao tiếp xã hội hoặc tương tác với người khác. Ảnh: Freepik.Trẻ tự kỷ ít có giao tiếp xã hội hoặc tương tác với người khác. Ảnh: Freepik.Tự kỷ ảnh hưởng đến các phần não kiểm soát cảm xúc, giao tiếp và cử động cơ thể. Đến những năm chập chững biết đi, một số trẻ mắc chứng tự kỷ có đầu và não to bất thường. Điều này có thể là do các vấn đề về phát triển não bộ. Các gen bất thường di truyền trong một gia đình có liên quan đến các chức năng kém ở một số bộ phận của não.Khi nào cần sàng lọc sớm bệnh tự kỷ?Nhiều trẻ không được chẩn đoán mắc chứng rối loạn tự kỷ cho đến khi đi học mẫu giáo và có thể không nhận được sự can thiệp cần thiết trong những năm đầu đời. Nhiều chuyên gia khuyến nghị bố mẹ nên sàng lọc tự kỷ ở tất cả trẻ em lúc 9 tháng tuổi để phát hiện sớm. Đặc biệt, cần kiểm tra tự kỷ ở hai giai đoạn: 18 tháng tuổi và 24 tháng tuổi. Ở trẻ có hành vi đáng lo ngại hoặc tiền sử gia đình mắc chứng tự kỷ cũng nên sàng lọc sớm.Chế độ ăn cho trẻ tự kỷCác vấn đề về tiêu hóa thường gặp ở trẻ tự kỷ và khoảng 30% các bé đó có thể ăn những thứ không phải thực phẩm như đất hoặc giấy. Một số cha mẹ đã thử chế độ ăn của con không có gluten (thường tìm thấy trong lúa mì) và casein (một loại protein từ các loại sữa). Một số lại duy trì những thay đổi về chế độ ăn uống khác bao gồm bổ sung B6 và magiê.Tuy nhiên, cho đến nay vẫn chưa có đủ bằng chứng cho thấy bất kỳ chế độ ăn uống riêng biệt nào có hiệu quả với trẻ tự kỷ. Cha mẹ có con tự kỷ nên bổ sung chế độ dinh dưỡng tốt cho con dưới sự giám sát của bác sĩ hoặc chuyên gia dinh dưỡng.Các chuyên gia vẫn chưa tìm ra nguyên nhân chính xác của bệnh tự kỷ nhưng vì bệnh có tính di truyền nên gen có thể là một nguyên nhân chính. Nghiên cứu đang được tiến hành để xem liệu hóa chất trong môi trường hay nhiễm trùng trước khi sinh có phải là nguyên nhân gây tự kỷ hay không.Tự kỷ cũng phổ biến hơn ở những người mắc các chứng rối loạn di truyền khác như hội chứng Fragile X (là một bất thường di truyền trong nhiễm sắc thể X dẫn tới khuyết tật về trí tuệ và rối loạn hành vi). Phụ nữ mang thai sử dụng axit valproic hoặc thalidomide làm tăng nguy cơ mắc tự kỷ ở trẻ khi sinh ra.', 'tre-tu-ky-9035-1681097495.jpg', 1),
(7, '4 cách giúp trẻ tự kỷ tận hưởng chuyến du lịch', 'Để con mắc chứng tự kỷ có những trải nghiệm thú vị trong các chuyến du lịch hè, cha mẹ cần cân nhắc một số yếu tố trước khi cùng con tham gia.Kỳ nghỉ hè với những chuyến du lịch có thể là khoảng thời gian yêu thích đối với trẻ em. Tuy nhiên, những đám đông, khu vui chơi với tiếng ồn lớn hoặc sáng rực rỡ có thể gây choáng ngợp cho trẻ tự kỷ. Bên cạnh đó, những đánh giá, ánh nhìn của người khác về cách cư xử của trẻ mắc chứng tự kỷ cũng ảnh hưởng ít nhiều đến tâm trạng của con.Cha mẹ có con tự kỷ không nhất thiết phải để con ở trong nhà suốt cả ngày, tránh giao tiếp với thế giới bên ngoài. Tùy thuộc vào tình trạng của con, sở thích và hoàn cảnh, gia đình vẫn có thể cho con ra ngoài vui chơi. Dưới đây là một số gợi ý.Tránh đám đôngĐám đông có thể gây ra sự choáng ngợp với những trẻ tự kỷ có chứng nhạy cảm về giác quan. Khi đó, nhiều khả năng chúng sẽ trở nên ủ rũ, cư xử không đúng mực hoặc đơn giản là thu hẹp mình lại.Cho trẻ tự kỷ đi du lịch tránh những nơi náo nhiệt, đông đúc có thể là một giải pháp hữu ích. Cha mẹ có cân nhắc để con ', 'tintuc2.jpg', 1),
(8, 'Tham khảo một số phương pháp can thiệp cho trẻ tự kỷ', 'Trên thực tế, tại Việt Nam cũng như các nước tiên tiến, có rất nhiều các phương pháp điều trị tự kỷ được cho là có hiệu quả. Tuy nhiên vì có quá nhiều phương pháp nên phụ huynh khá bối rối trong việc nên lựa chọn phương pháp nào để điều trị cho con mình. Bên cạnh đó, khi bạn nhờ tới sự tư vấn các các bác sĩ và những bậc phụ huynh có con tự kỷ, bạn sẽ nhận được những lời khuyên khác nhau. Điều đó sẽ càng làm cho bạn cảm thấy băn khoăn hơn.Lựa chọn phương pháp can thiệp tự kỷ cho trẻ là câu hỏi của rất nhiều phụ huynh, bởi mỗi trẻ tự kỷ khác nhau sẽ cần có hướng can thiệp khác nhau.I Phương pháp ABA: ( Applied Behaviour Analysis- Ứng dụng phân tích hành vi).ABA là biện pháp được quan tâm nhiều nhất trong trị liệu trẻ tự kỷ, được đánh giá là một trong những biện pháp hữu hiệu nhất hiện nay. Đây là một biện pháp tiếp cận khoa học nhằm hiểu rõ hành vi của trẻ. Các nguyên tắc trị liệu được ứng dụng cho những hành vi quan trọng mang tính xã hội. Biện pháp này được sáng tạo ra dựa trên các lý thuyết khoa học về hành vi. Đối với mỗi trẻ, ngay khi bắt đầu chương trình can thiệp, trẻ sẽ được đánh giá ban đầu để kiểm tra xem kỹ năng nào trẻ đã có, kỹ năng nào chưa có. Sau đó lựa chọn các bài tập, các tài liệu phù hợp với đánh giá ban đầu. Nội dung rèn luyện chung cũng như của từng buổi sẽ liệt kê từng kỹ năng trong mọi lĩnh vực (giao tiếp, xã hội, kiến thức, tự chăm sóc, vận động, chơi..) các kỹ năng này thường được chia nhỏ thành các kỹ năng thành phần và được sắp xếp theo trình tự phát triển, từ đơn giản đến phức tạp.Ưu điểm– ABA rất hiệu quả để dạy TTK những kỹ năng mới, những hành vi mới.– Có thể áp dụng ở mọi tình huống, mọi nơi.– Cách dạy rõ ràng, dễ dạy.– Chia bài tập thành nhiều phần đơn giản.– Hữu hiệu trong chuyển hoá hành vi tiêu cực.Khuyết điểm:– Cần nhiều thì giờ.– Ảnh hưởng đến thời gian của trẻ với gia đình.–  Không giúp được cho TTK đáp ứng với hoàn cảnh mới. II. Biện pháp TEACCH ( Division of Treatment and Education of Autistic and Children with Communication Handicaps )Chương trình này đã được thực hiện trong cả một tiểu bang của Mỹ, bắt đầu ở trường Đại học Y, Đại học North Califolia.  Biện pháp này là định hướng điều trị và giáo dục TTK và trẻ khuyết tật về giao tiếp. Các kỹ năng học của trẻ được đánh giá bằng PEP: những biểu hiện tâm lý giáo dục.Teacch khác với tiêu chuẩn phát triển “ bình thường” bắt đầu ở mức độ của trẻ và giúp trẻ phát triển đến mức cao nhất có thể.Những bài học cụ thể của chương trình TEACCHBắt chước (Imitation).Nhận thức (Perception).Vận động thô (Gross motor).Vận động tinh (Fine Motor).Phối hợp mắt và tay (Eye-hand intergration).Kỹ năng hiểu biết (Cognitive performance).Kỹ năng ngôn ngữ (Verbal performance).Kỹ năng tự lập (Self-help).Kỹ năng bắt chước xã hội (Social performance).Ưu điểm:– Có cả một chương trình đáp ứng nhu cầu của trẻ.– Giúp TTK hiểu được các yêu cầu và cách thức đáp ứng.– Tập trung vào những kỹ năng đã có của trẻ chứ không chỉ nhìn vào những khuyết điểm.Khuyết điểm– Rất gò bó, tập trung vào những đồ dùng giảng dạy nh­ bảng, soạn chương trình.– Cần nhiều nhân lực để thực hiện III.Biện pháp PECS (picture exchane communication system – hệ thống giao tiếp trao đổi hình).     Biện pháp này được nhà tâm lý nhi, Andrew Bondy và nhà âm ngữ trị liệu-  Lori Frost đề ra trong chương trình tự kỷ Delaware.  Biện pháp này dựa trên biện pháp ABA để đổi hình ảnh theo những gì mà trẻ muốn. Khoảng 50% trẻ tự kỷ không nói nhưng bạn vẫn dạy quy tắc là con phải tỏ ý cho trẻ không biết nói, đó là cấu hình theo phương pháp PECS. Cách dạy PECS là từ những hình riêng lẻ trẻ sẽ xếp đặt thành câu nhiều chữ, đầu tiên trẻ phải đưa bình nước cho cha mẹ để được uống nước, hay chỉ vào ly nước dán trên cửa tủ lạnh, từ đó mở rộng dần những ý khác. Có e ngại là cách dạy này ảnh hưởng đến việc học nói của trẻ nhưng thực tế thấy nó không cản trở việc học nói sau này cho trẻ nói chậm, cha mẹ không nên lo ngại là nếu dùng hình thì trẻ sẽ không biết nói về sau mà ngược lại có ghi nhận là PECS giúp cải thiện khả năng nói của trẻ. Có trẻ dùng PECS vài tháng rồi tập nói được, nhưng ta không biết đó là phát triển tự nhiên tới lúc thì em nói không cần có PECS hay nhờ PECS mà em tập nói. Khi cha mẹ và trường sử dụng nhiều biện pháp cùng thì kết quả khó biết là do riêng biện pháp nào hay do nhiều cách hợp lại, mà cũng có khi nó sẽ tới khi em phát triển đúng mức.Ưu điểm:– Rõ ràng, có chủ ý, trẻ chủ động tham gia– Phát triển giao tiếp chức năng nhanh– Có thể mở rộng trình độ giao tiếp– Phát triển được lời nóiKhuyết điểm:– Cần nhiều thời gian chuẩn bị tài liệu và hình ảnh– Chỉ tập trung vào khả năng giao tiếp, bỏ qua các lĩnh vực xã hội, vận động IV.Biện pháp DIR( Floor Time-cùng chơi với trẻ )Biện pháp này được hai bác sĩ tâm thần nhi, Stanley Greenspan và Serena Weider đề ra. Chương trình gồm ba yếu tố:-Dựa trên sự phát triển cảm xúc.-Sự khác biệt cá nhân,-Dựa trên mối quan hệ.1. Dựa trên sự phát triển cảm xúcCó 6 giai đoạn phát triển cảm xúc trẻ cần phát triển để có nền học hỏi, đó là:+ Tự điều chỉnh và quan tâm đến thế giới bên ngoài.+ Sự gần gũi.+ Giao tiếp hai chiều.+ Giao tiếp phức tạp.+ Giao tiếp phức tạp.+ Cảm xúc.+ Suy nghĩ với cảm xúc.2. Khác biệt cá nhânXử lý thính giác, giao tiếp không lời hay bằng cử chỉ, khả năng hiểu và sử dụng ngôn ngữ, xử lý thị giác – không gian, đặt kế hoạch vận động và làm theo chuỗi, phản ứng cảm giác và tự quản lý.3. Dựa trên mối quan hệ+ Nhằm phát triển cảm xúc thay vì phát triển trí tuệ.+ 6 giai đoạn phát triển cảm xúc để trẻ đạt được những kỹ năng cơ bản cho việc học hỏi sau này.Chương trình DIR thường gồm ba phần:+ Phụ huynh chơi với trẻ 3- 5 tiếng trong những buổi 20 -30 phút trong ngày.+ Nhà âm ngữ trị liệu, hoạt động trị liệu, vật lý trị liệu, giáo viên, tâm lý và các lĩnh vực khác cùng làm việc với trẻ.+ Phô huynh nhận xét về cách đáp ứng và cách tương tác dựa trên các giai đoạn phát triển cảm xúc.Ưu điểm:– Nhằm phát triển cảm xúc thay vì phát triển trí tuệ– Khuyến khích trẻ chủ động tương tác– Phụ huynh đóng vai trò chính trong việc trị liệuKhuyết điểm:– Không dạy cách học, cách phát triển trí tuệ nh­ những trẻ khác– Hơi khó tương tác ban đầu với trẻ. V.Hoà nhập cảm giác ( SI –Sensory Intergration)Trẻ tự kỷ có thể có những phản ứng không đủ hoặc là quá nhạy cảm, hoặc thiếu khả năng hoà hợp các giác quan. Biện pháp này tập trung vào giúp trẻ bớt nhạy cảm, giúp tổ chức lại thông tin cảm giác và thường do những người hoạt động trị liệu, vật lý trị liệu hoặc âm ngữ trị liệu điều trị. Điều quan trọng là nhà trị liệu phải quan sát và hiểu các nhạy cảm của trẻ. Trị liệu hoà hợp thính giác giảm sự quá nhạy cảm với âm thanh bằng cách nghe nhiều loại âm thanh cao thấp. Hoặc kích thích trẻ bằng áp lực mạnh để trẻ chịu đựng người khác hoặc là sự vật đụng chạm đến mình.1.Biện pháp tâm lý- giáo dụca.Trị liệu phân tâmBiện pháp này chủ yếu là chơi và nói chuyện, nhằm giúp trẻ và gia đình giải tỏa những căng thẳng dồn nén trong quá khứ, hệ thống lại cấu trúc nhân cách của trẻ. Trong trị liệu phân tâm sẽ giúp cải thiện bầu không khí gia đình, giúp mọi người thấu hiểu thực tại và chấp nhận thực tại tốt hơn, mọi người sẽ vui vẻ hơn trong giao tiếp và chăm sóc trẻ. Điều này giúp trẻ tự kỷ cải thiện tình huống giao tiếp và hình thành sự tiếp xúc qua lại. Khuyến khích trẻ hợp tác trong mọi hoạt động sinh hoạt của gia đình, nhà trường và xã hội; từ đó, tình trạng tự kỷ của trẻ được cải thiện dần dần.Đây là hình thức trị liệu dựa theo phương pháp phân tâm của S.FreudƯu điểm:– Trẻ trở nên vui vẻ hơn, bớt hung tính– Có tình cảm sâu sắc và tin tưởng nhà trị liệu– Trẻ chủ động hơn, thoải mái bày tỏ bản thânKhuyết điểm:– Cần nhiều thời gian– Không dạy được nhiều kỹ năng cơ bản, không ngăn chặn được hành vi xấu.– Không dạy được ngôn ngữ và giao tiếp theo cách học thông thường.– Có nhiều tình huống nhà trị liệu không tự chủ được và không tiên lượng được kết quả trị liệu.b.Trị liệu tâm vận độngMột biện pháp kích thích trẻ hoạt hóa hành vi. Quan điểm chi phối của biện pháp là: Vận động (hoạt động) của cơ thể sẽ dẫn đến sự nhanh nhạy hệ thần kinh và tác động đến phát triển tâm lý, vận động về cơ thể càng tăng thì vận động về tâm lý tăng theo; phát triển vận động sẽ dần phát triển tâm lý. Đồng thời sự phát triển tâm lý sẽ kéo theo sự phát triển vận động. Biện pháp này giúp những trẻ em gặp các vấn đề khó khăn về tâm lý có khả năng phối hợp các chức năng tâm trí tản mạn, hướng trẻ đến những hoạt động tâm lý có ý nghĩa cho chính trẻ em đó và cho những người xung quanh. Khả năng hợp tác của trẻ được tăng lên khi áp dụng biện pháp.c. Trị liệu ngôn ngữ và chỉnh âmĐây là biện pháp can thiệp thường thấy nhất ở trẻ tự kỷ. Trẻ tự  kỷ có khó khăn về liên hệ. Điều này bị chi phối lớn bởi ngôn ngữ và lời nói. Theo các chuyên gia âm ngữ trị liệu, nếu trẻ tự kỷ biết nói sẽ ảnh hưởng rất tốt cho sự phát triển trong tương lai. Nên chỉnh âm là một phần đặc biệt quan trọng cho trị liệu. Trị liệu thường được áp dụng cho từng trẻ một, diễn ra từ mụ̣t đờ́n hai tuần một lần và đôi khi kéo dài nhiều năm. Mục tiêu và biện pháp được soạn dựa vào khả năng ngôn ngữ của trẻ.Ưu điểm:– Không cần nhiều người.– Không mất nhiều thời gian của nhà trị liệu.– Không phải soạn chương trình nhiều. Chỉ cần dựa vào biểu hiện đang có của trẻ để thiết kế bài dạy tiếp theo.– Nhà trị liệu đóng vai trò chính– Dễ tương tác ban đầu.Khuyết điểm:– Không làm dứt được các ', 'tải xuống.jpg', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `unit`
--

CREATE TABLE `unit` (
  `idUnit` int(5) NOT NULL,
  `tenUnit` varchar(50) NOT NULL,
  `moTaUnit` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `unit`
--

INSERT INTO `unit` (`idUnit`, `tenUnit`, `moTaUnit`) VALUES
(1, 'ASQ-3', 'Là công cụ sàng lọc giúp theo dõi phát triển cho trẻ từ 01 đến 66 tháng tuổi.'),
(2, 'M-CHAT-R', 'Là công cụ sàng lọc nguy cơ rối loạn phổ tự kỷ cho trẻ từ 16-30 tháng tuổi.'),
(3, 'PSC', 'Là công cụ sàng lọc những vấn đề về cảm xúc và hành vi cho trẻ từ 4 đến 16 tuổi.'),
(4, 'CSHQ', 'Là công cụ sàng lọc những vấn đề liên quan đến giấc ngủ cho trẻ từ 48 tháng tuổi đến 12 tuổi.'),
(5, 'BAMBI', 'Là công cụ sàng lọc những vấn đề hành vi liên quan đến ăn uống cho trẻ từ 2 tuổi đến dưới 11 tuổi.'),
(6, 'VADPRS', 'Là thang đo phỏng vấn người chăm sóc thuộc bộ công cụ sàng lọc nguy cơ rối loạn Tăng động - Giảm chú ý của Vanderbilt.');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`),
  ADD KEY `username` (`username`);

--
-- Chỉ mục cho bảng `cauhoi`
--
ALTER TABLE `cauhoi`
  ADD PRIMARY KEY (`idcauHoi`),
  ADD KEY `idUnit` (`idUnit`);

--
-- Chỉ mục cho bảng `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`idChatBot`);

--
-- Chỉ mục cho bảng `chuyenvien`
--
ALTER TABLE `chuyenvien`
  ADD PRIMARY KEY (`idChuyenVien`),
  ADD KEY `username` (`username`);

--
-- Chỉ mục cho bảng `danhmuctintuc`
--
ALTER TABLE `danhmuctintuc`
  ADD PRIMARY KEY (`idDanhMuc`);

--
-- Chỉ mục cho bảng `ketqua`
--
ALTER TABLE `ketqua`
  ADD PRIMARY KEY (`idKetQua`),
  ADD KEY `idPhuHuynh` (`idPhuHuynh`),
  ADD KEY `idcauHoi` (`idUnit`) USING BTREE;

--
-- Chỉ mục cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  ADD PRIMARY KEY (`idTieuDe`);

--
-- Chỉ mục cho bảng `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`idMessage`),
  ADD KEY `username` (`username`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `phanhoi`
--
ALTER TABLE `phanhoi`
  ADD PRIMARY KEY (`idPhanHoi`),
  ADD KEY `idChuyenVien` (`idChuyenVien`),
  ADD KEY `idPhuHuynh` (`idPhuHuynh`);

--
-- Chỉ mục cho bảng `phuhuynh`
--
ALTER TABLE `phuhuynh`
  ADD PRIMARY KEY (`idPhuHuynh`),
  ADD KEY `username` (`username`);

--
-- Chỉ mục cho bảng `quantrivien`
--
ALTER TABLE `quantrivien`
  ADD PRIMARY KEY (`idQTV`),
  ADD KEY `username` (`username`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idRole`);

--
-- Chỉ mục cho bảng `taikhoan1`
--
ALTER TABLE `taikhoan1`
  ADD PRIMARY KEY (`username`),
  ADD KEY `Role` (`Role`);

--
-- Chỉ mục cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`idTinTuc`);

--
-- Chỉ mục cho bảng `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`idUnit`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `cauhoi`
--
ALTER TABLE `cauhoi`
  MODIFY `idcauHoi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT cho bảng `chatbot`
--
ALTER TABLE `chatbot`
  MODIFY `idChatBot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT cho bảng `chuyenvien`
--
ALTER TABLE `chuyenvien`
  MODIFY `idChuyenVien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `danhmuctintuc`
--
ALTER TABLE `danhmuctintuc`
  MODIFY `idDanhMuc` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `ketqua`
--
ALTER TABLE `ketqua`
  MODIFY `idKetQua` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  MODIFY `idTieuDe` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `message`
--
ALTER TABLE `message`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=351;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `phanhoi`
--
ALTER TABLE `phanhoi`
  MODIFY `idPhanHoi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `phuhuynh`
--
ALTER TABLE `phuhuynh`
  MODIFY `idPhuHuynh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `quantrivien`
--
ALTER TABLE `quantrivien`
  MODIFY `idQTV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `role`
--
ALTER TABLE `role`
  MODIFY `idRole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `idTinTuc` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `unit`
--
ALTER TABLE `unit`
  MODIFY `idUnit` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`username`) REFERENCES `taikhoan1` (`username`);

--
-- Các ràng buộc cho bảng `cauhoi`
--
ALTER TABLE `cauhoi`
  ADD CONSTRAINT `cauhoi_ibfk_2` FOREIGN KEY (`idUnit`) REFERENCES `unit` (`idUnit`);

--
-- Các ràng buộc cho bảng `chuyenvien`
--
ALTER TABLE `chuyenvien`
  ADD CONSTRAINT `chuyenvien_ibfk_1` FOREIGN KEY (`username`) REFERENCES `taikhoan1` (`username`);

--
-- Các ràng buộc cho bảng `ketqua`
--
ALTER TABLE `ketqua`
  ADD CONSTRAINT `ketqua_ibfk_1` FOREIGN KEY (`idUnit`) REFERENCES `unit` (`idUnit`);

--
-- Các ràng buộc cho bảng `phuhuynh`
--
ALTER TABLE `phuhuynh`
  ADD CONSTRAINT `phuhuynh_ibfk_1` FOREIGN KEY (`username`) REFERENCES `taikhoan1` (`username`);

--
-- Các ràng buộc cho bảng `quantrivien`
--
ALTER TABLE `quantrivien`
  ADD CONSTRAINT `quantrivien_ibfk_1` FOREIGN KEY (`username`) REFERENCES `taikhoan1` (`username`);

--
-- Các ràng buộc cho bảng `taikhoan1`
--
ALTER TABLE `taikhoan1`
  ADD CONSTRAINT `taikhoan1_ibfk_1` FOREIGN KEY (`Role`) REFERENCES `role` (`idRole`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
