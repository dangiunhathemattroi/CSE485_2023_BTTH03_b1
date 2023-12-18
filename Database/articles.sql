
--
-- Cơ sở dữ liệu: `myArticle`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `articles`
--

CREATE TABLE `articles` (
  `id` int NOT NULL primary key auto_increment,
  `title` text NOT NULL,
  `content` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `articles`
--

INSERT INTO `articles` (`title`, `content`) VALUES
('PHP', 'hoc de qua mon PHP'),
('JAVA', 'hoc de qua mon JAVA');