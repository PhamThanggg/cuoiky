-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Thời gian đã tạo: Th12 20, 2023 lúc 08:01 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `27_project_k71`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `btvn`
--

CREATE TABLE `btvn` (
  `id` int(11) NOT NULL,
  `id_khoa_hoc` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `img` varchar(200) NOT NULL,
  `content` varchar(300) NOT NULL,
  `createDate` varchar(60) NOT NULL,
  `expired` varchar(60) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `btvn`
--

INSERT INTO `btvn` (`id`, `id_khoa_hoc`, `name`, `img`, `content`, `createDate`, `expired`, `quantity`) VALUES
(5, 4, 'Bài tập tuần 1', '', 'Làm quen với php', '2023-12-20 12:41:06', '2023-12-23 12:41:06', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cau_hoi`
--

CREATE TABLE `cau_hoi` (
  `id_cau_hoi` int(11) NOT NULL,
  `ten_cau_hoi` varchar(400) DEFAULT NULL,
  `dap_an` varchar(1000) NOT NULL,
  `correct` varchar(1000) NOT NULL,
  `loai_cau_hoi` int(10) DEFAULT NULL,
  `anh_cau_hoi` varchar(200) DEFAULT NULL,
  `id_user_them` int(11) DEFAULT NULL,
  `id_khoa_hoc` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cau_hoi`
--

INSERT INTO `cau_hoi` (`id_cau_hoi`, `ten_cau_hoi`, `dap_an`, `correct`, `loai_cau_hoi`, `anh_cau_hoi`, `id_user_them`, `id_khoa_hoc`, `status`) VALUES
(70, 'Ngôn ngữ PHP ra đời vào năm nào?', '1994', '1991, 1992, 1993, 1994', 2, '', 1, 4, 1),
(71, 'PHP là viết tắt của ?', 'PHP: Hypertext Preprocessor', 'PHP: Hypertext Preprocessor, Personal Hypertext Preprocessor, Private Home Page, Personal Home Page', 2, '', 1, 4, 1),
(72, 'Lệnh nào dùng để xuất 1 mảng ra trang web?', 'print_r', 'echo, print, out, print_r', 2, '', 1, 4, 1),
(73, 'Type của biến $var1 = 5; $var2 = 3; $var3 = $var1/$var2 la?', 'float', 'float, integer, string, boolean', 2, '', 1, 4, 1),
(74, 'Ai là người đầu tiên phát minh ra php?', 'Rasmus Lerdorf', 'James Gosling, Tim Berners-Lee, Todd Fast, Rasmus Lerdorf', 2, '', 1, 4, 1),
(75, 'Type của biến $var3 = $var1%$var2 la?', 'integer', 'double, integer, string, boolean', 2, '', 1, 4, 1),
(76, 'Giá trị của tham số sau $var = 1 / 2 la?', '0.5', '0, 1, 0.5, 1/2', 2, '', 1, 4, 1),
(77, 'Tên biến nào sau đây là hợp lệ?', '$_hello ', '$3hello, $this, $_hello, Tất cả đều không hợp lệ', 2, '', 1, 4, 1),
(78, 'Kết quả của đoạn code dưới đây là?', '1', '5 === 5, Error, 1, False', 2, 'Picture1.png', 1, 4, 1),
(79, 'Nếu $a = 12 thì câu lệnh sau: ($a == 12) ? 5 : 1 có kết quả là?', '5', '12, 1, Error, 5', 2, '', 1, 4, 1),
(80, 'Trong PHP, hàm bắt đầu bởi __(2 dấu _) được gọi là hàm', 'Magic Function', 'Magic Function, Inbuilt Function, Default Function, User Defined Function', 2, '', 1, 4, 1),
(81, 'Kết quả của đoạn code dưới đây là? <?php echo chr(52);?>', '4', '1, 2, 3, 4', 2, '', 1, 4, 1),
(82, 'Trong PHP, hàm nào dùng để kiểm tra 1 đối tượng có phải là mảng hay không?', 'is_array() ', 'this_array(), is_array(), do_array(), in_array()', 2, '', 1, 4, 1),
(83, 'Trong PHP, hàm nào dùng để thêm phần tử vào cuối mảng?', 'array_push()', 'array_unshift(), into_array(), inend_array(), array_push()', 2, '', 1, 4, 1),
(84, 'Trong PHP, hàm nào dùng để truy xuất tới phần tử trước đó trong mảng?', 'prev()', 'last(), before(), prev(), previous()', 2, '', 1, 4, 1),
(85, 'Kết quả của đoạn code dưới đây là?', 'Array ( [0] => peach [1] => pear [2] => orange', 'Array ( [0] => peach ), Array ( [0] => apple [1] => mango [2] => peach ), Array ( [0] => apple [1] => mango ), Array ( [0] => peach [1] => pear [2] => orange', 2, 'Picture2.png', 1, 4, 1),
(86, 'Tính kế thừa trong OOP là?', 'Inheritance', 'Polymorphism, Inheritance, Encapsulation, Abstraction', 2, '', 1, 4, 1),
(87, 'Dòng nào để khởi tạo một đối tượng thuộc lớp có tên foo trong PHP ?', '$obj = new foo ();', '$obj = new $foo;, $obj = new foo;, $obj = new foo ();, obj = new foo ();', 2, '', 1, 4, 1),
(88, 'Trong PHP, từ khóa tầm vực nào ngăn không cho một phương thức bị ghi đè bởi lớp con?', 'Final', 'Abstract, Protected, Final, Static', 2, '', 1, 4, 1),
(89, 'Hàm nào sau đây được dùng để xác định loại của đối tượng object trong PHP?', 'is_a()', 'obj_type(), type(), is_a(), is_obj()', 2, '', 1, 4, 1),
(90, 'Xem đoạn mã lệnh sau đây. Sau khi thực hiện đoạn mã trên kết quả hiển thị sẽ là gì ?', 'a2 = e a1 = x a3 = z', 'a2 = e a1 = x a3 = z, a1 = e a2 = x a3 = z, 0 = e 1 =x 2 = z, Có lỗi xảy ra', 2, 'Picture3.png', 1, 4, 1),
(91, 'Từ khóa sau đây được hỗ trợ bởi PHP?', ', 1, 2, 3, , 5, ', 'friendly, final, public, static, priveta, Abstract, ', 3, '', 1, 4, 1),
(92, 'Phát biểu nào sau đây là đúng?', '0, , , 3, ', 'Lệnh include dùng để nhúng file php vào trang, Lệnh include dùng để chạy 1 file php rồi nhúng kết quả của file đó vào trang, Lệnh include chỉ có thể được dùng 1 lần trong trang, Lệnh include có thể nhúng file html php js css ', 3, '', 1, 4, 1),
(93, 'Điều nào là đúng về phương thức dựng (Constructors) trong PHP:', '0, 1, 2, 3, ', 'PHP 4 giới thiệu phương thức dựng, Phương thức dựng chấp nhận tham số truyền vào, Trong phương thức dựng có thể gọi đến các phương thức khác., Trong phương thức dựng có thể gọi đến các phương thức dựng khác, ', 3, '', 1, 4, 1),
(94, 'CHọn các hàm sử lý chuỗi đúng trong php', ', 1, 2, 3, , ', 'Str_len(), str_replace(), trim(), htmlspecialchars(), str_pos(), ', 3, '', 1, 4, 1),
(95, 'Xem đoạn mã lệnh sau đây. Sau khi thực hiện đoạn mã trên kết quả hiển thị sẽ là gì?', '40', '', 1, 'Picture4.png', 1, 4, 1),
(96, 'Kết quả của đoạn code dưới đây là?', '5', '', 1, 'Picture5.png', 1, 4, 1),
(97, 'Điền vào dấu ... đáp án đúng.', 'Session trong PHP là một cách để lưu trữ thông tin (trong các biến) để sử dụng trên nhiều trang và ..., sesstion không được lưu trữ trên máy người dùng', 'sesstion không được lưu trữ trên máy người dùng, sesstionđược lưu trữ trên máy người dùng, sesstion vừa lưu trữ trên máy người dùng và cả trên server', 4, '', 1, 4, 1),
(98, 'Ngôn ngữ PHP ra đời vào năm nào?', '1994', '1991, 1992, 1993, 1994', 2, '', 2, 4, 0),
(99, 'PHP là viết tắt của ?', 'PHP: Hypertext Preprocessor', 'PHP: Hypertext Preprocessor, Personal Hypertext Preprocessor, Private Home Page, Personal Home Page', 2, '', 2, 4, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dap_an`
--

CREATE TABLE `dap_an` (
  `id_dap_an` int(11) NOT NULL,
  `ten_dap_an` varchar(45) DEFAULT NULL,
  `flag` int(11) DEFAULT NULL,
  `id_cau_hoi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diem`
--

CREATE TABLE `diem` (
  `id_diem` int(11) NOT NULL,
  `diem` float NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_khoa_hoc` int(11) NOT NULL,
  `thoi_gian` varchar(30) NOT NULL,
  `thoi_gian_dau` varchar(60) NOT NULL,
  `thoi_gian_cuoi` varchar(60) NOT NULL,
  `id_quizz` int(11) NOT NULL,
  `thoi_gian_end` int(11) NOT NULL,
  `id_KT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `diem`
--

INSERT INTO `diem` (`id_diem`, `diem`, `id_user`, `id_khoa_hoc`, `thoi_gian`, `thoi_gian_dau`, `thoi_gian_cuoi`, `id_quizz`, `thoi_gian_end`, `id_KT`) VALUES
(67, 0, 2, 4, '2023-12-19 23:41:13', '2023-12-19 23:31:13', '2023-12-19 23:41:13', 0, 1703004073, 0),
(68, 0, 2, 4, '2023-12-19 23:46:36', '2023-12-19 23:41:20', '2023-12-19 23:51:20', 0, 1703004680, 0),
(69, 10, 1, 4, '2023-12-19 23:58:49', '2023-12-19 23:51:57', '2023-12-20 00:01:57', 0, 1703005317, 0),
(70, 50, 1, 4, '2023-12-20 00:03:30', '2023-12-19 23:58:51', '2023-12-20 00:08:51', 0, 1703005731, 0),
(71, 0, 1, 4, '2023-12-20 00:03:50', '2023-12-20 00:03:35', '2023-12-20 00:13:35', 0, 1703006015, 0),
(72, 0, 1, 4, '2023-12-20 00:05:31', '2023-12-20 00:04:43', '2023-12-20 00:24:43', 1, 1703006683, 14);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoa_hoc`
--

CREATE TABLE `khoa_hoc` (
  `id_khoa_hoc` int(11) NOT NULL,
  `ten_khoa_hoc` varchar(45) DEFAULT NULL,
  `anh_khoa_hoc` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khoa_hoc`
--

INSERT INTO `khoa_hoc` (`id_khoa_hoc`, `ten_khoa_hoc`, `anh_khoa_hoc`) VALUES
(4, 'PHP', 'php.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ky_thi`
--

CREATE TABLE `ky_thi` (
  `id_KT` int(11) NOT NULL,
  `tieu_de` varchar(200) NOT NULL,
  `noi_dung` varchar(300) NOT NULL,
  `so_luong_cau` int(11) NOT NULL,
  `so_lan` int(11) NOT NULL,
  `thoi_gian_mo` varchar(60) NOT NULL,
  `thoi_gian_dong` varchar(60) NOT NULL,
  `id_khoa_hoc` int(11) NOT NULL,
  `thoi_gian_lam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ky_thi`
--

INSERT INTO `ky_thi` (`id_KT`, `tieu_de`, `noi_dung`, `so_luong_cau`, `so_lan`, `thoi_gian_mo`, `thoi_gian_dong`, `id_khoa_hoc`, `thoi_gian_lam`) VALUES
(14, 'Thi GK1', 'Làm trong 20p', 20, 2, '2023-12-20 00:04:36', '2023-12-23 00:04:36', 4, 20),
(15, 'Thi cuối kỳ', 'Làm trong 30p', 15, 2, '2023-12-20 12:47:57', '2023-12-23 12:47:57', 4, 30);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lich_su_sai`
--

CREATE TABLE `lich_su_sai` (
  `id_cau_hoi` int(11) NOT NULL,
  `ten_cau_hoi` varchar(500) NOT NULL,
  `dap_an` varchar(1000) NOT NULL,
  `correct` varchar(1000) NOT NULL,
  `loai_cau_hoi` int(10) NOT NULL,
  `anh_cau_hoi` varchar(300) NOT NULL,
  `id_user_them` int(11) NOT NULL,
  `id_khoa_hoc` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lich_su_sai`
--

INSERT INTO `lich_su_sai` (`id_cau_hoi`, `ten_cau_hoi`, `dap_an`, `correct`, `loai_cau_hoi`, `anh_cau_hoi`, `id_user_them`, `id_khoa_hoc`, `status`) VALUES
(88, 'Trong PHP, từ khóa tầm vực nào ngăn không cho một phương thức bị ghi đè bởi lớp con?', '', 'Abstract, Protected, Final, Static', 2, '', 2, 4, 1),
(72, 'Lệnh nào dùng để xuất 1 mảng ra trang web?', '', 'echo, print, out, print_r', 2, '', 2, 4, 1),
(78, 'Kết quả của đoạn code dưới đây là?', '', '5 === 5, Error, 1, False', 2, 'Picture1.png', 2, 4, 1),
(70, 'Ngôn ngữ PHP ra đời vào năm nào?', '', '1991, 1992, 1993, 1994', 2, '', 2, 4, 1),
(85, 'Kết quả của đoạn code dưới đây là?', '', 'Array ( [0] => peach ), Array ( [0] => apple [1] => mango [2] => peach ), Array ( [0] => apple [1] => mango ), Array ( [0] => peach [1] => pear [2] => orange', 2, 'Picture2.png', 2, 4, 1),
(94, 'CHọn các hàm sử lý chuỗi đúng trong php', ', , , , , ', 'Str_len(), str_replace(), trim(), htmlspecialchars(), str_pos(), ', 3, '', 2, 4, 1),
(89, 'Hàm nào sau đây được dùng để xác định loại của đối tượng object trong PHP?', '', 'obj_type(), type(), is_a(), is_obj()', 2, '', 2, 4, 1),
(74, 'Ai là người đầu tiên phát minh ra php?', '', 'James Gosling, Tim Berners-Lee, Todd Fast, Rasmus Lerdorf', 2, '', 2, 4, 1),
(87, 'Dòng nào để khởi tạo một đối tượng thuộc lớp có tên foo trong PHP ?', '', '$obj = new $foo;, $obj = new foo;, $obj = new foo ();, obj = new foo ();', 2, '', 2, 4, 1),
(79, 'Nếu $a = 12 thì câu lệnh sau: ($a == 12) ? 5 : 1 có kết quả là?', '', '12, 1, Error, 5', 2, '', 2, 4, 1),
(73, 'Type của biến $var1 = 5; $var2 = 3; $var3 = $var1/$var2 la?', '', 'float, integer, string, boolean', 2, '', 2, 4, 1),
(74, 'Ai là người đầu tiên phát minh ra php?', '', 'James Gosling, Tim Berners-Lee, Todd Fast, Rasmus Lerdorf', 2, '', 2, 4, 1),
(83, 'Trong PHP, hàm nào dùng để thêm phần tử vào cuối mảng?', '', 'array_unshift(), into_array(), inend_array(), array_push()', 2, '', 2, 4, 1),
(75, 'Type của biến $var3 = $var1%$var2 la?', '', 'double, integer, string, boolean', 2, '', 2, 4, 1),
(94, 'CHọn các hàm sử lý chuỗi đúng trong php', ', , , , , ', 'Str_len(), str_replace(), trim(), htmlspecialchars(), str_pos(), ', 3, '', 2, 4, 1),
(89, 'Hàm nào sau đây được dùng để xác định loại của đối tượng object trong PHP?', '', 'obj_type(), type(), is_a(), is_obj()', 2, '', 2, 4, 1),
(92, 'Phát biểu nào sau đây là đúng?', '', 'Lệnh include dùng để nhúng file php vào trang, Lệnh include dùng để chạy 1 file php rồi nhúng kết quả của file đó vào trang, Lệnh include chỉ có thể được dùng 1 lần trong trang, Lệnh include có thể nhúng file html php js css ', 3, '', 2, 4, 1),
(76, 'Giá trị của tham số sau $var = 1 / 2 la?', '', '0, 1, 0.5, 1/2', 2, '', 2, 4, 1),
(82, 'Trong PHP, hàm nào dùng để kiểm tra 1 đối tượng có phải là mảng hay không?', '', 'this_array(), is_array(), do_array(), in_array()', 2, '', 2, 4, 1),
(78, 'Kết quả của đoạn code dưới đây là?', '', '5 === 5, Error, 1, False', 2, 'Picture1.png', 2, 4, 1),
(80, 'Trong PHP, hàm bắt đầu bởi __(2 dấu _) được gọi là hàm', '', 'Magic Function, Inbuilt Function, Default Function, User Defined Function', 2, '', 1, 4, 1),
(91, 'Từ khóa sau đây được hỗ trợ bởi PHP?', ', , , , , , ', 'friendly, final, public, static, priveta, Abstract, ', 3, '', 1, 4, 1),
(78, 'Kết quả của đoạn code dưới đây là?', '', '5 === 5, Error, 1, False', 2, 'Picture1.png', 1, 4, 1),
(82, 'Trong PHP, hàm nào dùng để kiểm tra 1 đối tượng có phải là mảng hay không?', '', 'this_array(), is_array(), do_array(), in_array()', 2, '', 1, 4, 1),
(85, 'Kết quả của đoạn code dưới đây là?', '', 'Array ( [0] => peach ), Array ( [0] => apple [1] => mango [2] => peach ), Array ( [0] => apple [1] => mango ), Array ( [0] => peach [1] => pear [2] => orange', 2, 'Picture2.png', 1, 4, 1),
(94, 'CHọn các hàm sử lý chuỗi đúng trong php', ', , , , , ', 'Str_len(), str_replace(), trim(), htmlspecialchars(), str_pos(), ', 3, '', 1, 4, 1),
(74, 'Ai là người đầu tiên phát minh ra php?', '', 'James Gosling, Tim Berners-Lee, Todd Fast, Rasmus Lerdorf', 2, '', 1, 4, 1),
(72, 'Lệnh nào dùng để xuất 1 mảng ra trang web?', '', 'echo, print, out, print_r', 2, '', 1, 4, 1),
(76, 'Giá trị của tham số sau $var = 1 / 2 la?', '', '0, 1, 0.5, 1/2', 2, '', 1, 4, 1),
(86, 'Tính kế thừa trong OOP là?', 'Abstraction', 'Polymorphism, Inheritance, Encapsulation, Abstraction', 2, '', 1, 4, 1),
(89, 'Hàm nào sau đây được dùng để xác định loại của đối tượng object trong PHP?', 'is_obj()', 'obj_type(), type(), is_a(), is_obj()', 2, '', 1, 4, 1),
(82, 'Trong PHP, hàm nào dùng để kiểm tra 1 đối tượng có phải là mảng hay không?', 'is_array()', 'this_array(), is_array(), do_array(), in_array()', 2, '', 1, 4, 1),
(81, 'Kết quả của đoạn code dưới đây là? <?php echo chr(52);?>', '3', '1, 2, 3, 4', 2, '', 1, 4, 1),
(77, 'Tên biến nào sau đây là hợp lệ?', '$_hello', '$3hello, $this, $_hello, Tất cả đều không hợp lệ', 2, '', 1, 4, 1),
(79, 'Nếu $a = 12 thì câu lệnh sau: ($a == 12) ? 5 : 1 có kết quả là?', '', '12, 1, Error, 5', 2, '', 1, 4, 1),
(96, 'Kết quả của đoạn code dưới đây là?', '', '', 1, 'Picture5.png', 1, 4, 1),
(97, 'Điền vào dấu ... đáp án đúng.', 'Session trong PHP là một cách để lưu trữ thông tin (trong các biến) để sử dụng trên nhiều trang và ..., sesstion vừa lưu trữ trên máy người dùng và cả trên server', 'sesstion không được lưu trữ trên máy người dùng, sesstionđược lưu trữ trên máy người dùng, sesstion vừa lưu trữ trên máy người dùng và cả trên server', 4, '', 1, 4, 1),
(84, 'Trong PHP, hàm nào dùng để truy xuất tới phần tử trước đó trong mảng?', '', 'last(), before(), prev(), previous()', 2, '', 1, 4, 1),
(85, 'Kết quả của đoạn code dưới đây là?', '', 'Array ( [0] => peach ), Array ( [0] => apple [1] => mango [2] => peach ), Array ( [0] => apple [1] => mango ), Array ( [0] => peach [1] => pear [2] => orange', 2, 'Picture2.png', 1, 4, 1),
(77, 'Tên biến nào sau đây là hợp lệ?', '', '$3hello, $this, $_hello, Tất cả đều không hợp lệ', 2, '', 1, 4, 1),
(81, 'Kết quả của đoạn code dưới đây là? <?php echo chr(52);?>', '', '1, 2, 3, 4', 2, '', 1, 4, 1),
(73, 'Type của biến $var1 = 5; $var2 = 3; $var3 = $var1/$var2 la?', '', 'float, integer, string, boolean', 2, '', 1, 4, 1),
(88, 'Trong PHP, từ khóa tầm vực nào ngăn không cho một phương thức bị ghi đè bởi lớp con?', '', 'Abstract, Protected, Final, Static', 2, '', 1, 4, 1),
(94, 'CHọn các hàm sử lý chuỗi đúng trong php', ', , , , , ', 'Str_len(), str_replace(), trim(), htmlspecialchars(), str_pos(), ', 3, '', 1, 4, 1),
(93, 'Điều nào là đúng về phương thức dựng (Constructors) trong PHP:', ', , , , ', 'PHP 4 giới thiệu phương thức dựng, Phương thức dựng chấp nhận tham số truyền vào, Trong phương thức dựng có thể gọi đến các phương thức khác., Trong phương thức dựng có thể gọi đến các phương thức dựng khác, ', 3, '', 1, 4, 1),
(89, 'Hàm nào sau đây được dùng để xác định loại của đối tượng object trong PHP?', '', 'obj_type(), type(), is_a(), is_obj()', 2, '', 1, 4, 1),
(81, 'Kết quả của đoạn code dưới đây là? <?php echo chr(52);?>', '', '1, 2, 3, 4', 2, '', 1, 4, 1),
(70, 'Ngôn ngữ PHP ra đời vào năm nào?', '', '1991, 1992, 1993, 1994', 2, '', 1, 4, 1),
(80, 'Trong PHP, hàm bắt đầu bởi __(2 dấu _) được gọi là hàm', '', 'Magic Function, Inbuilt Function, Default Function, User Defined Function', 2, '', 1, 4, 1),
(76, 'Giá trị của tham số sau $var = 1 / 2 la?', '', '0, 1, 0.5, 1/2', 2, '', 1, 4, 1),
(96, 'Kết quả của đoạn code dưới đây là?', '', '', 1, 'Picture5.png', 1, 4, 1),
(90, 'Xem đoạn mã lệnh sau đây. Sau khi thực hiện đoạn mã trên kết quả hiển thị sẽ là gì ?', '', 'a2 = e a1 = x a3 = z, a1 = e a2 = x a3 = z, 0 = e 1 =x 2 = z, Có lỗi xảy ra', 2, 'Picture3.png', 1, 4, 1),
(92, 'Phát biểu nào sau đây là đúng?', ', , , , ', 'Lệnh include dùng để nhúng file php vào trang, Lệnh include dùng để chạy 1 file php rồi nhúng kết quả của file đó vào trang, Lệnh include chỉ có thể được dùng 1 lần trong trang, Lệnh include có thể nhúng file html php js css ', 3, '', 1, 4, 1),
(79, 'Nếu $a = 12 thì câu lệnh sau: ($a == 12) ? 5 : 1 có kết quả là?', '', '12, 1, Error, 5', 2, '', 1, 4, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_cau_hoi`
--

CREATE TABLE `loai_cau_hoi` (
  `id_loai` int(11) NOT NULL,
  `loai_CH` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loai_cau_hoi`
--

INSERT INTO `loai_cau_hoi` (`id_loai`, `loai_CH`) VALUES
(1, 'Câu hỏi điền'),
(2, 'Câu hỏi chọn'),
(3, 'Câu hỏi chọn nhiều'),
(4, 'Câu hỏi select option');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `luyen_tap`
--

CREATE TABLE `luyen_tap` (
  `id_cau_hoi` int(11) NOT NULL DEFAULT 0,
  `ten_cau_hoi` varchar(500) DEFAULT NULL,
  `dap_an` varchar(1000) NOT NULL,
  `correct` varchar(1000) NOT NULL,
  `loai_cau_hoi` int(10) DEFAULT NULL,
  `anh_cau_hoi` varchar(300) DEFAULT NULL,
  `id_user_them` int(11) DEFAULT NULL,
  `id_khoa_hoc` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `id_KT` int(11) NOT NULL,
  `id_quizz` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `ho_ten` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `gmail` varchar(60) NOT NULL,
  `role` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id_user`, `user_name`, `ho_ten`, `password`, `level`, `gmail`, `role`) VALUES
(1, 'admin', 'admin', 'c4ca4238a0b923820dcc509a6f75849b', NULL, 'phamthanglg2020@gmail.com', 1),
(2, 'thangpham', 'Phạm Huy Thắng', 'c4ca4238a0b923820dcc509a6f75849b', NULL, 'stu715105218@hnue.edu.vn', 0),
(5, 'huythang', NULL, 'c4ca4238a0b923820dcc509a6f75849b', NULL, 'phamthanglg2022@gmail.com', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `btvn`
--
ALTER TABLE `btvn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lk_btvn_kh` (`id_khoa_hoc`);

--
-- Chỉ mục cho bảng `cau_hoi`
--
ALTER TABLE `cau_hoi`
  ADD PRIMARY KEY (`id_cau_hoi`),
  ADD KEY `lien_ket_user` (`id_user_them`),
  ADD KEY `lien_ket_kh` (`id_khoa_hoc`),
  ADD KEY `lk_ch_loaiCH` (`loai_cau_hoi`);

--
-- Chỉ mục cho bảng `dap_an`
--
ALTER TABLE `dap_an`
  ADD PRIMARY KEY (`id_dap_an`),
  ADD KEY `lien_ket_ch` (`id_cau_hoi`);

--
-- Chỉ mục cho bảng `diem`
--
ALTER TABLE `diem`
  ADD PRIMARY KEY (`id_diem`),
  ADD KEY `lk_diem_iduser` (`id_user`),
  ADD KEY `lk_diem_idkhoahoc` (`id_khoa_hoc`);

--
-- Chỉ mục cho bảng `khoa_hoc`
--
ALTER TABLE `khoa_hoc`
  ADD PRIMARY KEY (`id_khoa_hoc`);

--
-- Chỉ mục cho bảng `ky_thi`
--
ALTER TABLE `ky_thi`
  ADD PRIMARY KEY (`id_KT`),
  ADD KEY `lk_kt_idkhoahoc` (`id_khoa_hoc`);

--
-- Chỉ mục cho bảng `lich_su_sai`
--
ALTER TABLE `lich_su_sai`
  ADD KEY `lk_lss_idkhoahoc` (`id_khoa_hoc`),
  ADD KEY `lk_lss_iduser` (`id_user_them`),
  ADD KEY `lk_lss_loaiCH` (`loai_cau_hoi`);

--
-- Chỉ mục cho bảng `loai_cau_hoi`
--
ALTER TABLE `loai_cau_hoi`
  ADD PRIMARY KEY (`id_loai`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `btvn`
--
ALTER TABLE `btvn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `cau_hoi`
--
ALTER TABLE `cau_hoi`
  MODIFY `id_cau_hoi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT cho bảng `dap_an`
--
ALTER TABLE `dap_an`
  MODIFY `id_dap_an` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `diem`
--
ALTER TABLE `diem`
  MODIFY `id_diem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT cho bảng `khoa_hoc`
--
ALTER TABLE `khoa_hoc`
  MODIFY `id_khoa_hoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `ky_thi`
--
ALTER TABLE `ky_thi`
  MODIFY `id_KT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `loai_cau_hoi`
--
ALTER TABLE `loai_cau_hoi`
  MODIFY `id_loai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `btvn`
--
ALTER TABLE `btvn`
  ADD CONSTRAINT `lk_btvn_kh` FOREIGN KEY (`id_khoa_hoc`) REFERENCES `khoa_hoc` (`id_khoa_hoc`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `cau_hoi`
--
ALTER TABLE `cau_hoi`
  ADD CONSTRAINT `lien_ket_kh` FOREIGN KEY (`id_khoa_hoc`) REFERENCES `khoa_hoc` (`id_khoa_hoc`) ON DELETE CASCADE,
  ADD CONSTRAINT `lien_ket_user` FOREIGN KEY (`id_user_them`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `lk_ch_loaiCH` FOREIGN KEY (`loai_cau_hoi`) REFERENCES `loai_cau_hoi` (`id_loai`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `dap_an`
--
ALTER TABLE `dap_an`
  ADD CONSTRAINT `lien_ket_ch` FOREIGN KEY (`id_cau_hoi`) REFERENCES `cau_hoi` (`id_cau_hoi`);

--
-- Các ràng buộc cho bảng `diem`
--
ALTER TABLE `diem`
  ADD CONSTRAINT `lk_diem_idkhoahoc` FOREIGN KEY (`id_khoa_hoc`) REFERENCES `khoa_hoc` (`id_khoa_hoc`) ON DELETE CASCADE,
  ADD CONSTRAINT `lk_diem_iduser` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `ky_thi`
--
ALTER TABLE `ky_thi`
  ADD CONSTRAINT `lk_kt_idkhoahoc` FOREIGN KEY (`id_khoa_hoc`) REFERENCES `khoa_hoc` (`id_khoa_hoc`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `lich_su_sai`
--
ALTER TABLE `lich_su_sai`
  ADD CONSTRAINT `lk_lss_idkhoahoc` FOREIGN KEY (`id_khoa_hoc`) REFERENCES `khoa_hoc` (`id_khoa_hoc`) ON DELETE CASCADE,
  ADD CONSTRAINT `lk_lss_iduser` FOREIGN KEY (`id_user_them`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `lk_lss_loaiCH` FOREIGN KEY (`loai_cau_hoi`) REFERENCES `loai_cau_hoi` (`id_loai`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
