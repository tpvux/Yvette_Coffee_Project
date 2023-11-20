-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th4 20, 2023 lúc 09:26 AM
-- Phiên bản máy phục vụ: 5.7.36
-- Phiên bản PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `yvette_coffee_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ban`
--

DROP TABLE IF EXISTS `ban`;
CREATE TABLE IF NOT EXISTS `ban` (
  `MaBan` int(3) NOT NULL AUTO_INCREMENT,
  `KhuVuc` varchar(1) COLLATE utf8_vietnamese_ci NOT NULL,
  PRIMARY KEY (`MaBan`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `ban`
--

INSERT INTO `ban` (`MaBan`, `KhuVuc`) VALUES
(1, 'A'),
(2, 'A'),
(3, 'A'),
(4, 'A'),
(5, 'A'),
(6, 'A'),
(7, 'A'),
(8, 'A'),
(9, 'A'),
(10, 'A'),
(11, 'A'),
(12, 'A'),
(13, 'A'),
(14, 'A'),
(15, 'A'),
(16, 'A'),
(17, 'A'),
(18, 'A'),
(19, 'A'),
(20, 'A'),
(21, 'B'),
(22, 'B'),
(23, 'B'),
(24, 'B'),
(25, 'B'),
(26, 'B'),
(27, 'B'),
(28, 'B'),
(29, 'B'),
(30, 'B'),
(31, 'B'),
(32, 'B'),
(33, 'B'),
(34, 'B'),
(35, 'B'),
(36, 'B'),
(37, 'B'),
(38, 'B'),
(39, 'B'),
(40, 'B'),
(41, 'C'),
(42, 'C'),
(43, 'C'),
(44, 'C'),
(45, 'C'),
(46, 'C'),
(47, 'C'),
(48, 'C'),
(49, 'C'),
(50, 'C'),
(51, 'C'),
(52, 'C'),
(53, 'C'),
(54, 'C'),
(55, 'C'),
(56, 'C'),
(57, 'C'),
(58, 'C'),
(59, 'C'),
(60, 'C'),
(113, 'C');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ca_lam_viec`
--

DROP TABLE IF EXISTS `ca_lam_viec`;
CREATE TABLE IF NOT EXISTS `ca_lam_viec` (
  `MaNV` int(10) NOT NULL,
  `Ca` tinyint(1) NOT NULL,
  `Ngay` tinyint(1) NOT NULL,
  PRIMARY KEY (`MaNV`,`Ca`,`Ngay`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_muc`
--

DROP TABLE IF EXISTS `danh_muc`;
CREATE TABLE IF NOT EXISTS `danh_muc` (
  `MaDanhMuc` int(5) NOT NULL AUTO_INCREMENT,
  `TenDanhMuc` varchar(200) NOT NULL,
  PRIMARY KEY (`MaDanhMuc`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `danh_muc`
--

INSERT INTO `danh_muc` (`MaDanhMuc`, `TenDanhMuc`) VALUES
(1, 'Đá Xay'),
(2, 'Sữa chua\r\n'),
(3, 'Kem Viên\r\n'),
(4, 'Nước ép trái cây\r\n'),
(5, 'Topping\r\n'),
(6, 'Cà Phê Ý\r\n'),
(7, 'Cà Phê Việt Nam\r\n'),
(8, 'Trà trái cây\r\n'),
(9, 'Trà nóng\r\n'),
(10, 'Sinh tố trái cây\r\n'),
(11, 'Giải nhiệt\r\n'),
(12, 'Nước giải khát\r\n');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `do_uong`
--

DROP TABLE IF EXISTS `do_uong`;
CREATE TABLE IF NOT EXISTS `do_uong` (
  `MaDoUong` int(3) NOT NULL AUTO_INCREMENT,
  `TenDoUong` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `DonGia` int(8) NOT NULL,
  `MaDanhMuc` int(5) NOT NULL,
  `image` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaDoUong`),
  KEY `MaDanhMuc` (`MaDanhMuc`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `do_uong`
--

INSERT INTO `do_uong` (`MaDoUong`, `TenDoUong`, `DonGia`, `MaDanhMuc`, `image`) VALUES
(1, 'Matcha', 45000, 1, 'daxay3.jpg'),
(2, 'Chocolate', 45000, 1, 'daxay2.jpg'),
(3, 'Cà phê dừa', 45000, 1, 'coffee2.jpg'),
(4, 'Oreo', 45000, 1, 'daxay1.jpg'),
(5, 'Chocolate trắng hạnh nhân', 50000, 1, 'daxay4.jpg'),
(6, 'Sữa chua thanh đào', 35000, 1, 'suachua2.jpg'),
(7, 'Sữa chua dâu tây', 39000, 2, 'suachua1.jpg'),
(8, 'Sữa chua việt quất', 35000, 2, 'suachua1.jpg'),
(9, 'Sữa chua đá', 30000, 2, 'suachua1.jpg'),
(10, 'Cầu vòng', 30000, 3, 'suachua1.jpg'),
(11, 'Trái cây', 30000, 3, 'suachua1.jpg'),
(12, 'Mít', 30000, 3, 'suachua1.jpg'),
(13, 'Vani', 30000, 3, 'suachua1.jpg'),
(14, 'Socola', 30000, 3, 'suachua1.jpg'),
(15, 'Dừa', 30000, 3, 'suachua1.jpg'),
(16, 'Dâu', 30000, 3, 'suachua1.jpg'),
(17, 'Khoai môn', 30000, 3, 'suachua1.jpg'),
(18, 'Nước ép thơm cà rốt mật ong', 40000, 4, 'suachua1.jpg'),
(19, 'Nước ép cam cà rốt mật ong', 40000, 4, 'suachua1.jpg'),
(20, 'Nước ép táo xanh cần tây mật ong', 45000, 1, 'nuocep1.jpg'),
(21, 'Nước ép cam', 35000, 4, 'suachua1.jpg'),
(22, 'Nước ép thơm', 35000, 4, 'suachua1.jpg'),
(23, 'Nước ép ổi', 35000, 4, 'suachua1.jpg'),
(24, 'Nước ép dưa hấu', 35000, 4, 'suachua1.jpg'),
(25, 'Dừa trái', 35000, 4, 'suachua1.jpg'),
(26, 'Trân châu trắng', 10000, 5, 'suachua1.jpg'),
(27, 'Thạch cà phê', 10000, 5, 'suachua1.jpg'),
(28, 'Đào miếng', 10000, 5, 'suachua1.jpg'),
(29, 'Trái vải', 10000, 5, 'suachua1.jpg'),
(30, 'Hạt sen', 15000, 5, 'suachua1.jpg'),
(31, 'Espresso Hot', 30000, 6, 'suachua1.jpg'),
(32, 'Espresso Iced', 35000, 6, 'suachua1.jpg'),
(33, 'Americano Hot', 35000, 6, 'suachua1.jpg'),
(34, 'Americano Iced', 35000, 6, 'suachua1.jpg'),
(35, 'Latte Hot', 39000, 6, 'suachua1.jpg'),
(36, 'Latte Iced', 39000, 6, 'suachua1.jpg'),
(37, 'Cappuccino Hot', 39000, 6, 'suachua1.jpg'),
(38, 'Cappuccino Iced', 39000, 6, 'suachua1.jpg'),
(39, 'Cà phê đen đá', 22000, 7, 'suachua1.jpg'),
(40, 'Cà phê đen nóng', 22000, 7, 'suachua1.jpg'),
(41, 'Cà phê đen Phin đá', 25000, 7, 'suachua1.jpg'),
(42, 'Cà phê đen Phin nóng', 25000, 7, 'suachua1.jpg'),
(43, 'Cà phê sữa đá', 25000, 7, 'suachua1.jpg'),
(44, 'Cà phê sữa nóng', 25000, 1, 'coffee3.jpg'),
(45, 'Cà phê sữa Phin đá', 29000, 7, 'suachua1.jpg'),
(46, 'Cà phê sữa Phin nóng', 29000, 7, 'suachua1.jpg'),
(47, 'Bạc xỉu đá', 29000, 7, 'suachua1.jpg'),
(48, 'Bạc xỉu nóng', 35000, 7, 'suachua1.jpg'),
(49, 'Ca cao sữa đá', 30000, 7, 'suachua1.jpg'),
(50, 'Ca cao sữa nóng', 30000, 7, 'suachua1.jpg'),
(51, 'Trà vải hoa hồng', 35000, 8, 'suachua1.jpg'),
(52, 'Trà vải hoa đậu biếc', 35000, 8, 'suachua1.jpg'),
(53, 'Trà đào cam sả', 35000, 8, 'suachua1.jpg'),
(54, 'Trà lài hạt sen macchiato', 40000, 8, 'suachua1.jpg'),
(55, 'Trà lài đác thơm', 40000, 8, 'suachua1.jpg'),
(56, 'Trà sữa YVETTE', 35000, 8, 'suachua1.jpg'),
(57, 'Trà ấm nóng', 30000, 9, 'suachua1.jpg'),
(58, 'Trà gừng mật ong', 30000, 9, 'suachua1.jpg'),
(59, 'Trà hoa cúc mật ong', 30000, 9, 'suachua1.jpg'),
(60, 'Trà lipton chanh', 25000, 9, 'suachua1.jpg'),
(61, 'Sinh tố bơ', 45000, 10, 'suachua1.jpg'),
(62, 'Sinh tố mãng cầu', 40000, 10, 'suachua1.jpg'),
(63, 'Sinh tố dâu', 45000, 10, 'suachua1.jpg'),
(64, 'Sinh tố chuối hạnh nhân', 40000, 10, 'suachua1.jpg'),
(65, 'Trà hoa cúc lạnh mật ong', 39000, 11, 'suachua1.jpg'),
(66, 'Trà lipton chanh đá', 35000, 11, 'suachua1.jpg'),
(67, 'Soda chanh', 35000, 11, 'suachua1.jpg'),
(68, 'Nước suối Aquafina', 20000, 12, 'suachua1.jpg'),
(69, 'Coca-cola', 25000, 12, 'suachua1.jpg'),
(70, 'Pepsi', 25000, 12, 'suachua1.jpg'),
(71, '7up', 25000, 12, 'suachua1.jpg'),
(72, 'Warrior', 25000, 12, 'suachua1.jpg'),
(73, 'Sting', 25000, 12, 'sting.jpg'),
(74, 'Bò húc', 40000, 12, 'nuocep2.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoa_don_thanh_toan`
--

DROP TABLE IF EXISTS `hoa_don_thanh_toan`;
CREATE TABLE IF NOT EXISTS `hoa_don_thanh_toan` (
  `MaOrder` int(10) NOT NULL,
  `TongTien` int(9) NOT NULL,
  `TienNhan` int(6) NOT NULL DEFAULT '0',
  `ThoiGianThanhToan` datetime DEFAULT NULL,
  PRIMARY KEY (`MaOrder`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `hoa_don_thanh_toan`
--

INSERT INTO `hoa_don_thanh_toan` (`MaOrder`, `TongTien`, `TienNhan`, `ThoiGianThanhToan`) VALUES
(1, 29000, 0, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguyen_lieu`
--

DROP TABLE IF EXISTS `nguyen_lieu`;
CREATE TABLE IF NOT EXISTS `nguyen_lieu` (
  `MaNL` int(4) NOT NULL AUTO_INCREMENT,
  `TenNL` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `DonVi` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `SoLuongNL` int(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`MaNL`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `nguyen_lieu`
--

INSERT INTO `nguyen_lieu` (`MaNL`, `TenNL`, `DonVi`, `SoLuongNL`) VALUES
(1, 'Bột trà xanh Matcha Uji Yanoen', 'Bịch', 2),
(2, 'Bột mix Onemix Vanilla', 'Bịch', 5),
(3, 'Bột Socola Puratos', 'Bịch', 0),
(4, 'Bột Cacao Basic Figo', 'Bịch', 0),
(5, 'Mật Ong Eurodeli', 'Chai', 0),
(6, 'Xốt Caramel Golden Farm', 'Chai', 0),
(7, 'Bánh Oreo', 'Hộp', 0),
(8, 'Kem ký các vị Vinamilk', 'Hộp', 0),
(9, 'Bơ', 'Kg', 0),
(10, 'Cà rốt', 'Kg', 0),
(11, 'Cam', 'Kg', 0),
(12, 'Cần tây', 'Kg', 0),
(13, 'Chanh tươi', 'Kg', 0),
(14, 'Chuối', 'Kg', 0),
(15, 'Dâu', 'Kg', 0),
(16, 'Dưa hấu', 'Kg', 0),
(17, 'Đào', 'Kg', 0),
(18, 'Đường', 'Kg', 0),
(19, 'Hạt Cafe Arabica', 'Kg', 0),
(20, 'Mãng cầu', 'Kg', 0),
(21, 'Ổi', 'Kg', 0),
(22, 'Táo xanh', 'Kg', 0),
(23, 'Thơm', 'Kg', 0),
(24, 'Dừa trái', 'Quả', 0),
(25, 'Hạt đác', 'Thùng', 0),
(26, 'Mứt hoa quả các loại', 'Thùng', 0),
(27, 'Siro hoa quả', 'Thùng', 0),
(28, 'Soda', 'Thùng', 0),
(29, 'Sữa chua có đường Vinamilk', 'Thùng', 0),
(30, 'Sữa chua không đường Vinamilk', 'Thùng', 0),
(31, 'Sữa đặc ngôi sao Phương Nam', 'Thùng', 0),
(32, 'Sữa tươi tiệt trùng TH True Milk Organic', 'Thùng', 0),
(33, 'Trà Atiso', 'Thùng', 0),
(34, 'Trà Lipton', 'Thùng', 0),
(35, 'Vải ngâm', 'Thùng', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhan_vien`
--

DROP TABLE IF EXISTS `nhan_vien`;
CREATE TABLE IF NOT EXISTS `nhan_vien` (
  `MaNV` int(10) NOT NULL AUTO_INCREMENT,
  `TenNV` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `SDT` varchar(10) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `ChucVu` varchar(30) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `MaQL` int(10) DEFAULT NULL,
  PRIMARY KEY (`MaNV`)
) ENGINE=InnoDB AUTO_INCREMENT=2023000009 DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `nhan_vien`
--

INSERT INTO `nhan_vien` (`MaNV`, `TenNV`, `NgaySinh`, `SDT`, `ChucVu`, `MaQL`) VALUES
(2023000001, 'Lê Anh Vũ', '2002-03-14', '0123456789', 'Chủ quán', NULL),
(2023000002, 'Trần Phong Vũ', '2002-04-01', '0324231241', 'Quản lý', NULL),
(2023000003, 'Lê Thị Anh', '2003-02-25', '0153146289', 'Nhân viên', 2023000002),
(2023000004, 'Phan Tấn Trung', '2000-05-17', '0139746289', 'Nhân viên', 2023000002),
(2023000005, 'Nguyễn Quốc Đạt', '2002-08-22', '0538746289', 'Nhân viên', 2023000002),
(2023000006, 'Nguyễn Hà Thi', '2004-04-19', '0904746289', 'Nhân viên', 2023000002),
(2023000007, 'Trần Văn Cường', '2001-09-10', '0609746289', 'Nhân viên', 2023000002),
(2023000008, 'Trần Văn B', '2000-03-31', '1234567890', 'Nhân viên', 2023000002);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhap_xuat_nl`
--

DROP TABLE IF EXISTS `nhap_xuat_nl`;
CREATE TABLE IF NOT EXISTS `nhap_xuat_nl` (
  `MaNguoiNX` int(10) NOT NULL,
  `TenNguoiNX` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `NghiepVu` tinyint(1) NOT NULL COMMENT '0:nhập; 1:xuất',
  `MaNL` int(4) NOT NULL,
  `TenNL` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `SoLuongNX` int(6) NOT NULL DEFAULT '0',
  `ThoiGianNX` datetime NOT NULL,
  PRIMARY KEY (`MaNguoiNX`,`ThoiGianNX`,`MaNL`) USING BTREE,
  KEY `MaNL` (`MaNL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `nhap_xuat_nl`
--

INSERT INTO `nhap_xuat_nl` (`MaNguoiNX`, `TenNguoiNX`, `NghiepVu`, `MaNL`, `TenNL`, `SoLuongNX`, `ThoiGianNX`) VALUES
(2023000001, 'Lê Anh Vũ', 2, 36, 'bột ngọt', 0, '2023-04-19 15:39:48'),
(2023000001, 'Lê Anh Vũ', 3, 36, 'bột ngọt', 0, '2023-04-19 15:40:11'),
(2023000002, 'Trần Phong Vũ', 0, 1, 'Bột trà xanh Matcha Uji Yanoen', 4, '2023-04-19 15:21:40'),
(2023000002, 'Trần Phong Vũ', 1, 1, 'Bột trà xanh Matcha Uji Yanoen', 2, '2023-04-19 15:21:55'),
(2023000002, 'Trần Phong Vũ', 0, 2, 'Bột mix Onemix Vanilla', 5, '2023-04-19 15:23:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `MaOrder` int(10) NOT NULL,
  `MaNV` int(10) NOT NULL,
  `MaBan` int(3) NOT NULL,
  `MaDoUong` int(3) NOT NULL,
  `SoLuong` int(3) NOT NULL,
  `SoTien` int(9) NOT NULL,
  PRIMARY KEY (`MaOrder`,`MaNV`,`MaBan`,`MaDoUong`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`MaOrder`, `MaNV`, `MaBan`, `MaDoUong`, `SoLuong`, `SoTien`) VALUES
(1, 2023000003, 1, 45, 1, 29000),
(1, 2023000003, 1, 46, 1, 29000),
(1, 2023000003, 1, 47, 1, 29000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tai_khoan`
--

DROP TABLE IF EXISTS `tai_khoan`;
CREATE TABLE IF NOT EXISTS `tai_khoan` (
  `TenDangNhap` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `MaNV` int(10) NOT NULL,
  `MatKhau` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `TrangThai` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:không hoạt động; 1:đang hoạt động',
  PRIMARY KEY (`TenDangNhap`),
  KEY `MaNV` (`MaNV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tai_khoan`
--

INSERT INTO `tai_khoan` (`TenDangNhap`, `MaNV`, `MatKhau`, `TrangThai`) VALUES
('2023000001', 2023000001, '14e1b600b1fd579f47433b88e8d85291', 1),
('2023000002', 2023000002, '14e1b600b1fd579f47433b88e8d85291', 1),
('2023000003', 2023000003, '14e1b600b1fd579f47433b88e8d85291', 1),
('2023000004', 2023000004, '14e1b600b1fd579f47433b88e8d85291', 1),
('2023000005', 2023000005, '14e1b600b1fd579f47433b88e8d85291', 1),
('2023000006', 2023000006, '14e1b600b1fd579f47433b88e8d85291', 1),
('2023000007', 2023000007, '14e1b600b1fd579f47433b88e8d85291', 1),
('2023000008', 2023000008, '14e1b600b1fd579f47433b88e8d85291', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
