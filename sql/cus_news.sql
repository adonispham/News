-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 16, 2022 lúc 01:18 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cus_news`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Tin nhanh', 'Tin nhanh - ngắn gọn trong ngày', NULL, NULL),
(2, 'Tin quốc tế', 'Tin quốc tế trong ngày', NULL, NULL),
(3, 'Tin thể thao', 'Tin thể thao trong ngày', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 2, 20, 'Bão to quá', '2022-02-13 10:55:43', '2022-02-13 10:55:43'),
(2, 2, 20, 'Mưa bão thế này thì chớt', '2022-02-13 10:58:39', '2022-02-13 10:58:39'),
(9, 2, 1, 'đẹp trai quá', '2022-02-14 07:58:01', '2022-02-14 07:58:01'),
(10, 1, 19, 'Có 3 thứ trên đời không nên tin: Top 1 là tin chuyển nhượng của MU', '2022-02-14 15:29:53', '2022-02-14 15:29:53'),
(12, 15, 20, 'Mưa bão chán quá', '2022-02-15 12:14:52', '2022-02-15 12:14:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `title`, `sort_description`, `content`, `image_url`, `created_at`, `updated_at`) VALUES
(1, 2, 'Thủ tướng đốc thúc hỗ trợ tiền thuê nhà cho người lao động', 'Để quyết liệt thực hiện Chương trình phục hồi kinh tế - xã hội, Thủ tướng yêu cầu nhiều nhiệm vụ phải làm ngay trong quý I, trong đó có hỗ trợ tiền thuê nhà cho người lao động.', '<p>Thủ tướng Phạm Minh Ch&iacute;nh vừa k&yacute; c&ocirc;ng điện đ&ocirc;n đốc triển khai quyết liệt, hiệu quả Chương tr&igrave;nh phục hồi v&agrave; ph&aacute;t triển kinh tế - x&atilde; hội; đẩy nhanh tiến độ giải ng&acirc;n vốn đầu tư c&ocirc;ng. &Ocirc;ng y&ecirc;u cầu c&aacute;c bộ trưởng, chủ tịch tỉnh, th&agrave;nh triển khai đồng bộ, hiệu quả Chương tr&igrave;nh ph&ograve;ng, chống dịch Covid-19 (2022-2023) theo phương ch&acirc;m th&iacute;ch ứng an to&agrave;n, linh hoạt, kiểm so&aacute;t hiệu quả dịch bệnh; bảo đảm sản xuất, kinh doanh an to&agrave;n, th&iacute;ch ứng tốt với c&aacute;c diễn biến t&igrave;nh h&igrave;nh dịch bệnh. Ngay trong qu&yacute; I, Thủ tướng y&ecirc;u cầu Bộ Kế hoạch v&agrave; Đầu tư tổng hợp danh mục nhiệm vụ, dự &aacute;n v&agrave; phương &aacute;n bố tr&iacute; vốn c&oacute; trọng t&acirc;m, trọng điểm trong 2 năm 2022-2023 của Chương tr&igrave;nh phục hồi v&agrave; ph&aacute;t triển kinh tế - x&atilde; hội, sau đ&oacute; b&aacute;o c&aacute;o Ch&iacute;nh phủ, Thủ tướng xem x&eacute;t, quyết định.</p>\r\n', 'uploads/1644681733-thutuong.jpeg', '2022-02-12 16:02:13', '2022-02-12 16:02:13'),
(19, 3, 'Shearer: \'Man Utd trở nên tầm thường\'', 'Trong bài viết trên báo Anh The Athletic, cựu tiền đạo Alan Shearer cho rằng Man Utd hiện chỉ là đội bóng tầm thường, với văn hoá đổ lỗi.', '<p>Tr&ecirc;n s&acirc;n, Man Utd lộn xộn v&agrave; rời rạc, ảo tưởng v&agrave; thường mất kiểm so&aacute;t. Cầu thủ chỉ lu&ocirc;n muốn đổ lỗi cho người kh&aacute;c, v&agrave; kh&ocirc;ng hiểu vai tr&ograve; của bản th&acirc;n tr&ecirc;n s&acirc;n. Man City chơi b&oacute;ng kiểu &aacute;p đặt, ưu ti&ecirc;n chuyền v&agrave; kiểm so&aacute;t b&oacute;ng. Liverpool chơi với đội h&igrave;nh d&acirc;ng cao, g&acirc;y &aacute;p lực để đoạt lại b&oacute;ng sớm từ tuyến tr&ecirc;n. Hai đội n&agrave;y đều hiệu quả như cỗ m&aacute;y. Khi một cầu thủ vắng mặt, người kh&aacute;c thay thế khiến cỗ m&aacute;y thay đổi kh&ocirc;ng đ&aacute;ng kể. Họ ở đẳng cấp kh&aacute;c hẳn.</p>\r\n\r\n<p>Man Utd th&igrave; sao? HLV&nbsp;<a href=\"https://vnexpress.net/the-thao/du-lieu-bong-da/doi-bong/southampton-41\">Southampton</a>&nbsp;Ralph Hasenhuttl nhận x&eacute;t sau trận ho&agrave; 1-1 ở Old Trafford: &quot;C&oacute; một thực tế l&agrave; mỗi khi mất b&oacute;ng, kh&ocirc;ng phải cầu thủ n&agrave;o của Man Utd cũng c&agrave;i số l&ugrave;i theo c&aacute;ch tốt nhất&quot;.</p>\r\n\r\n<p>Old Trafford giống như nh&agrave; h&aacute;t, nơi họ mơ mộng về sự cạnh tranh v&agrave; c&aacute;c danh hiệu thiếu thực tế. Man Utd đang đứng thứ năm Ngoại hạng Anh, vị tr&iacute; được nhiều đội b&oacute;ng mơ đến. Nhưng với Man Utd, vị tr&iacute; đ&oacute; chỉ l&agrave; miền đất hoang.</p>\r\n\r\n<p>Man Utd đ&atilde; th&agrave;nh một đội b&oacute;ng ồn &agrave;o, lộn xộn v&agrave; nhiều lỗ hổng. Những tin tức gần đ&acirc;y cho thấy c&aacute;c cầu thủ kh&ocirc;ng th&iacute;ch gi&aacute;o &aacute;n huấn luyện của&nbsp;<a href=\"https://vnexpress.net/chu-de/ralf-rangnick-3840\">Ralf Rangnick</a>. Họ muốn Mauricio Pochettino xuất hiện từ m&ugrave;a sau. Khi thắng, đội b&oacute;ng kh&ocirc;ng vui mừng. Ng&ocirc;n ngữ cơ thể của Cristiano Ronaldo ở từng trận đấu cho thấy th&oacute;i quen k&ecirc;u ca đ&atilde; đeo b&aacute;m Man Utd nhiều năm qua.</p>\r\n\r\n<p>R&otilde; r&agrave;ng c&aacute;c cầu thủ Man Utd phải nh&igrave;n lại bản th&acirc;n. Liệu họ c&oacute; đang l&agrave;m tốt như y&ecirc;u cầu kh&ocirc;ng? C&acirc;u trả lời l&agrave; kh&ocirc;ng. Nhưng t&ocirc;i cũng nhận thấy họ thiếu cự ly đội h&igrave;nh v&agrave; mục đ&iacute;ch chơi b&oacute;ng cụ thể. Đ&ocirc;i ch&acirc;n của họ lộ r&otilde; sự nặng nề. Họ c&oacute; c&aacute;i cớ khi đội b&oacute;ng lộn xộn từ thượng tầng đổ xuống.</p>\r\n\r\n<p>Sai một ly, đi một dặm. Cố HLV Bobby Robson từng n&oacute;i như thế nhiều lần. C&aacute;c HLV lu&ocirc;n muốn tạo ra một văn ho&aacute; kh&ocirc;ng đổ lỗi trong đội b&oacute;ng. Họ muốn tạo ra cho cầu thủ những điều kiện v&agrave; t&agrave;i nguy&ecirc;n tốt nhất, chỉ r&otilde; cho họ biết nhiệm vụ của từng người. Khi đ&oacute;, cầu thủ sẽ phải tự nhận tr&aacute;ch nhiệm, kh&ocirc;ng c&ograve;n c&aacute;ch n&agrave;o để đổ lỗi.</p>\r\n\r\n<p>Ch&uacute;ng ta kh&ocirc;ng nghe thấy sự ồn &agrave;o n&agrave;o tương tự từ Liverpool hay Man City, khi họ đang thắng li&ecirc;n tục. HLV cần chứng minh cho cầu thủ thấy phương ph&aacute;p của &ocirc;ng ta sẽ đem lại t&aacute;c dụng. Cầu thủ n&agrave;o muốn đ&aacute; ch&iacute;nh, phải thể hiện tốt nhất. Nếu bị gạt khỏi đội h&igrave;nh ch&iacute;nh, họ phải nỗ lực gấp đ&ocirc;i để trở lại. Phương ph&aacute;p n&agrave;y c&oacute; thể gọi l&agrave; &quot;thuật giả kim&quot;, nhưng Man Utd kh&ocirc;ng hề c&oacute; &yacute; niệm n&agrave;o như thế.</p>\r\n\r\n<p><img alt=\"Rangnick vỗ tay tri ân khán giả sau trận thắng Brentford hôm 19/1. Ảnh: Reuters\" src=\"https://i1-thethao.vnecdn.net/2022/02/14/rangnick-jpeg-1644813206-5043-1644813364.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=X7bjVbLi3FH_YeWyYB2YMA\" /></p>\r\n\r\n<p>Rangnick vỗ tay tri &acirc;n kh&aacute;n giả sau trận thắng Brentford h&ocirc;m 19/1. Ảnh:&nbsp;<em>Reuters</em></p>\r\n\r\n<p>T&ocirc;i ngạc nhi&ecirc;n khi nhận ra điều n&agrave;y. Man Utd c&oacute; thể coi l&agrave; đội b&oacute;ng lớn nhất thế giới, nhưng lại đang d&ugrave;ng HLV tạm quyền. &Ocirc;ng ta chỉ d&agrave;nh 2 trong 11 năm qua để huấn luyện cầu thủ. Họ đưa một Gi&aacute;m đốc Kỹ thuật về l&agrave;m HLV tạm quyền. Trợ l&yacute; của &ocirc;ng ta lại l&agrave; một người lần đầu l&agrave;m gi&aacute;m đốc kỹ thuật - Darren Fletcher. Trước đ&oacute;, Carrick cũng l&agrave;m HLV tạm thời. Trước đ&oacute; nữa, Ole Gunnar Solskjaer cũng bắt đầu c&ocirc;ng việc trong vai tr&ograve; HLV tạm quyền.</p>\r\n\r\n<p>Đ&acirc;y kh&ocirc;ng phải c&aacute;ch hoạt động của một tổ chức muốn gặt h&aacute;i th&agrave;nh c&ocirc;ng. T&ocirc;i kh&ocirc;ng muốn chỉ tr&iacute;ch Rangnick. Nhưng &ocirc;ng gia nhập đội b&oacute;ng giống như một cầu thủ dự bị v&agrave;o s&acirc;n đến cuối m&ugrave;a. Sau đ&oacute;, &ocirc;ng ấy c&oacute; thể được đề nghị l&agrave;m HLV ch&iacute;nh thức, hoặc đảm nhận vai tr&ograve; tư vấn. Điều n&agrave;y thật v&ocirc; nghĩa. Tư duy tập thể ở đ&acirc;u? Ai đưa ra những quyết định quan trọng? V&agrave; cầu thủ phản ứng thế n&agrave;o với những thay đổi n&agrave;y?</p>\r\n\r\n<p>Cầu thủ cần một sự đảm bảo. Cũng như mọi bước đường kh&aacute;c trong cuộc sống, cầu thủ muốn biết nhiệm vụ của họ l&agrave; g&igrave;. Họ muốn nh&igrave;n quanh ph&ograve;ng thay đồ v&agrave; nhận ra r&otilde; vai tr&ograve; của từng đồng đội. C&agrave;ng nhiều HLV xuất hiện, hệ thống v&agrave; chiến thuật c&agrave;ng thay đổi, c&ograve;n đội b&oacute;ng c&agrave;ng thiếu bền vững. Điều đ&oacute; kh&ocirc;ng cản trở đến việc cầu thủ tỏ ra chuy&ecirc;n nghiệp hay cật lực, nhưng ảnh hưởng tới t&acirc;m l&yacute; của họ.</p>\r\n\r\n<p>T&ocirc;i đ&atilde; c&oacute; trải nghiệm về vấn đề tương tự. Khi Ruud Gullit th&agrave;nh HLV Newcastle, &ocirc;ng ấy muốn loại bỏ những cầu thủ kỳ cựu, trong đ&oacute; c&oacute; t&ocirc;i. Đấy l&agrave; đặc quyền của Gullit, ngay cả khi t&ocirc;i kh&ocirc;ng bằng l&ograve;ng. Nhưng trước mắt &ocirc;ng ấy vẫn cần v&agrave;i cầu thủ kỳ cựu. Ph&ograve;ng thay đồ bị rạn nứt, c&ograve;n t&ocirc;i mất tự tin. Những điều từng l&agrave; bản năng của t&ocirc;i, bỗng dưng trở th&agrave;nh xa lạ. T&ocirc;i kh&ocirc;ng hề giảm đi sự nỗ lực, nhưng hiệu quả chơi b&oacute;ng của t&ocirc;i đ&atilde; tệ hơn.</p>\r\n\r\n<p>Phải nhờ tới khi Bobby Robson xuất hiện, &ocirc;ng mới đưa mọi thứ trở về căn bản. &Ocirc;ng nhắc nhở t&ocirc;i hiểu được t&ocirc;i l&agrave; ai, v&agrave; t&ocirc;i phải l&agrave;m g&igrave;. Khi đ&oacute;, lớp sương m&ugrave; bao quanh đội b&oacute;ng mới tan biến.</p>\r\n\r\n<p>T&ocirc;i thấy Man Utd đang gặp t&igrave;nh cảnh tương tự. HLV đến v&agrave; đi li&ecirc;n tục. Mọi người n&oacute;i thể lực của họ đ&atilde; được cải thiện. Nhưng sau mỗi thất bại, đ&ocirc;i ch&acirc;n cầu thủ thường cảm thấy bị chai l&igrave;, căng thẳng dồn l&ecirc;n n&atilde;o. Cầu thủ bắt đầu cảm thấy những cơn đau, khiến hiệu quả chơi b&oacute;ng giảm đi v&agrave;i phần trăm.</p>\r\n\r\n<p>Khi mới xuất hiện, Rangnick n&oacute;i rằng &ocirc;ng muốn d&ugrave;ng sơ đồ 4-2-2-2 ở Man Utd. Nhưng &ocirc;ng nhanh ch&oacute;ng nhận ra điều đ&oacute; l&agrave; kh&ocirc;ng thể. Man Utd đang muốn đi theo hướng n&agrave;o? Mọi người đều mơ hồ v&agrave; khiến đội b&oacute;ng mất c&acirc;n bằng.</p>\r\n\r\n<p><img alt=\"Ronaldo tỏ ra giận dữ trong trận hoà Chelsea hôm 28/11. Ảnh: Reuters\" src=\"https://i1-thethao.vnecdn.net/2022/02/14/Screenshot-2022-02-14-at-11-35-1990-6639-1644813365.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=8f7B3D9Ec7YIT1lYDweMlQ\" /></p>\r\n\r\n<p>Ronaldo tỏ ra giận dữ trong trận ho&agrave; Chelsea h&ocirc;m 28/11. Ảnh:&nbsp;<em>Reuters</em></p>\r\n\r\n<p>Thương vụ&nbsp;<a href=\"https://vnexpress.net/chu-de/cristiano-ronaldo-194\">Cristiano Ronaldo</a>&nbsp;cũng ảnh hưởng phần n&agrave;o tới Man Utd. C&acirc;u chuyện n&agrave;y rất cảm động, v&agrave; t&ocirc;i hiểu Man Utd kh&ocirc;ng cho ph&eacute;p cậu ấy gia nhập k&igrave;nh địch. Nhưng quyết định như thế dẫn tới hậu quả rất lớn.</p>\r\n\r\n<p>T&igrave;nh h&igrave;nh hiện tại cho thấy Paul Pogba v&agrave; Jesse Lingard đều sẽ ra đi v&agrave;o cuối m&ugrave;a, theo dạng tự do. Điều đ&oacute; c&oacute; nghĩa Man Utd sẽ đổ khoảng 176 triệu USD xuống bồn cầu. C&aacute;c vụ chuyển nhượng tự do kh&ocirc;ng hiếm, nhưng ở đ&acirc;y c&oacute; vẻ như Man Utd đ&atilde; sơ suất dẫn tới thiệt hại.</p>\r\n\r\n<p>Ronaldo hẳn đang nghĩ: &quot;M&igrave;nh đ&atilde; vấp phải c&aacute;i g&igrave; đ&acirc;y?&quot;. Cậu ấy l&agrave; một trong những cầu thủ vĩ đại nhất từng chơi b&oacute;ng tr&ecirc;n h&agrave;nh tinh n&agrave;y. Nhưng, cậu ấy cũng đ&atilde; 37 tuổi. Ronaldo kh&ocirc;ng muốn phải dự bị, hay bị thay ra s&acirc;n, v&igrave; cậu ấy c&oacute; &yacute; ch&iacute; chiến thắng v&agrave; quyết t&acirc;m kh&ocirc;ng bao giờ bị đ&aacute;nh gục. Cậu ấy muốn chơi từng ph&uacute;t tr&ecirc;n s&acirc;n. Dĩ nhi&ecirc;n điều n&agrave;y tạo ra &aacute;p lực cho HLV.</p>\r\n\r\n<p>T&ocirc;i kh&ocirc;ng đổ lỗi cho Ronaldo về bất cứ điều g&igrave; đang diễn ra ở Man Utd. Ronaldo c&oacute; quyền tin rằng Man Utd c&oacute; thể tệ hơn nhiều so với hiện tại nếu kh&ocirc;ng c&oacute; cậu. Ronaldo c&oacute; thể đ&uacute;ng. Một lần nữa, t&ocirc;i cũng từng rơi v&agrave;o ho&agrave;n cảnh giống cậu ấy. Ở cuối sự nghiệp, t&ocirc;i v&agrave;i lần bị gạt khỏi đội h&igrave;nh hoặc bị thay ra. T&ocirc;i kh&ocirc;ng giải th&iacute;ch nổi l&agrave; m&igrave;nh gh&eacute;t cảm gi&aacute;c đ&oacute; đến nhường n&agrave;o. T&ocirc;i gh&eacute;t từng gi&acirc;y ph&uacute;t kh&ocirc;ng được thi đấu. T&ocirc;i cảm thấy đ&aacute;ng xấu hổ, như bị sỉ nhục. Đến giờ t&ocirc;i vẫn cảm thấy thế.</p>\r\n\r\n<p>Ronaldo c&oacute; n&ecirc;n cư xử lịch thiệp hơn khi hết trận kh&ocirc;ng? Cẩn động vi&ecirc;n c&aacute;c đồng đội kh&ocirc;ng? C&aacute;c cầu thủ trẻ phải cảm thấy giấc mơ th&agrave;nh hiện thực, khi l&agrave;m đồng đội với Ronaldo. Đ&aacute;ng lẽ họ phải t&igrave;m đến Ronaldo v&agrave; xin lời khuy&ecirc;n từ một cầu thủ như cậu ấy mới đ&uacute;ng. Mọi người đ&atilde; nh&igrave;n nhận sai về th&aacute;i độ của Ronaldo. Vấn đề của Man Utd l&agrave; h&agrave;ng thủ tệ hại. Ronaldo kh&ocirc;ng b&agrave;o chữa, m&agrave; cậu ấy chỉ giận dữ với t&igrave;nh trạng của đội b&oacute;ng, v&agrave; đ&ograve;i hỏi mọi thứ phải tốt l&ecirc;n.</p>\r\n\r\n<p>Nhưng Ronaldo đ&ograve;i hỏi điều đ&oacute; từ ai? Ai sẽ đ&aacute;p ứng y&ecirc;u cầu của Ronaldo? Họ sẽ đ&aacute;p ứng khi n&agrave;o v&agrave; bằng c&aacute;ch n&agrave;o? Man Utd c&oacute; thể tiến bộ hơn thay v&igrave; tệ đi kh&ocirc;ng? T&ocirc;i kh&ocirc;ng thể trả lời những c&acirc;u hỏi n&agrave;y.</p>\r\n', 'uploads/1644852245-Man Utd trở nên tầm thường.jpg', '2022-02-14 15:24:05', '2022-02-14 15:24:05'),
(20, 1, 'Bão số 2 đang đổ bộ Thái Bình – Nghệ An, mưa to, gió giật nhiều nơi', 'Bão số 2 Koguma gió giật cấp 10 đang đi vào đất liền các tỉnh từ Thái Bình đến Nghệ An gây mưa to, gió giật nhiều nơi.', '<p><img alt=\"Bão số 2 đang đổ bộ Thái Bình – Nghệ An, mưa to, gió giật nhiều nơi - 1\" src=\"https://cdn.24h.com.vn/upload/2-2021/images/2021-06-13/Bao-so-2-dang-do-bo-Thai-Binh--Nghe-An-mua-to-gio-giat-nhieu-noi-bao--1--1623541563-19-width860height563.jpg\" style=\"width:660px\" /></p>\r\n\r\n<p>Vị tr&iacute; v&agrave; hướng di chuyển tiếp theo của b&atilde;o số 2 Koguma. Ảnh: Trung t&acirc;m Dự b&aacute;o KTTVQG.</p>\r\n\r\n<p>Theo Trung t&acirc;m Dự b&aacute;o kh&iacute; tượng thủy văn Quốc gia, l&uacute;c 6 giờ s&aacute;ng nay (13/6), b&atilde;o số 2 Koguma đang ở tr&ecirc;n đất liền ven biển khu vực c&aacute;c tỉnh từ Th&aacute;i B&igrave;nh đến ph&iacute;a bắc Nghệ An. Sức gi&oacute; mạnh nhất v&ugrave;ng gần t&acirc;m b&atilde;o cấp 8 (60-75km/h), giật cấp 10. B&aacute;n k&iacute;nh gi&oacute; mạnh từ cấp 6, giật từ cấp 8 trở l&ecirc;n khoảng 100km t&iacute;nh từ t&acirc;m b&atilde;o.</p>\r\n\r\n<p>Do&nbsp;<a href=\"https://www.24h.com.vn/tin-bao-so-2-c46e4970.html\">ảnh hưởng của b&atilde;o số 2</a>, huyện đảo Bạch Long Vĩ đ&atilde; c&oacute; gi&oacute; mạnh cấp 7, giật cấp 9; ở đảo H&ograve;n Ngư c&oacute; gi&oacute; giật cấp 9; ở đảo H&ograve;n Dấu c&oacute; gi&oacute; mạnh cấp 7, giật cấp 10.</p>\r\n\r\n<p>Tr&ecirc;n đất liền ven biển ở Văn L&yacute; (Nam Định) c&oacute; gi&oacute; mạnh cấp 8, giật cấp 10, T.P Th&aacute;i B&igrave;nh c&oacute; gi&oacute; mạnh cấp 6, giật cấp 10. Ở c&aacute;c tỉnh từ Thanh H&oacute;a đến Quảng B&igrave;nh đ&atilde; c&oacute; mưa to đến rất to với tổng lượng mưa từ 7h ng&agrave;y 12/6 đến 4h ng&agrave;y 13/6 phổ biến 120-250mm.</p>\r\n\r\n<p>Dự b&aacute;o, trong 6 giờ tới, b&atilde;o di chuyển theo hướng T&acirc;y T&acirc;y Bắc, mỗi giờ đi được 15-20km v&agrave; suy yếu dần th&agrave;nh&nbsp;<a href=\"https://www.24h.com.vn/ap-thap-nhiet-doi-c46e5052.html\">&aacute;p thấp nhiệt đới</a>.</p>\r\n\r\n<p>Đến 11 giờ ng&agrave;y 13/6, vị tr&iacute; t&acirc;m &aacute;p thấp nhiệt đới ở tr&ecirc;n đất liền khu vực Thanh H&oacute;a. Sức gi&oacute; mạnh nhất v&ugrave;ng gần t&acirc;m &aacute;p thấp nhiệt đới mạnh cấp 6 (40-50km/giờ), giật cấp 7.</p>\r\n\r\n<p>Trong 6 đến 12 giờ tiếp theo, &aacute;p thấp nhiệt đới di chuyển theo hướng T&acirc;y T&acirc;y Bắc, mỗi giờ đi được 15-20km v&agrave; suy yếu dần th&agrave;nh một v&ugrave;ng &aacute;p thấp.</p>\r\n\r\n<p>S&aacute;ng nay (13/6) ở Vịnh Bắc Bộ (bao gồm cả huyện đảo Bạch Long Vĩ) c&oacute; gi&oacute; mạnh cấp 6-7, v&ugrave;ng gần t&acirc;m b&atilde;o đi qua cấp 8, giật cấp 10, s&oacute;ng biển cao từ 3,0-5,0m; biển động rất mạnh.</p>\r\n\r\n<p>Tr&ecirc;n đất liền, trong ng&agrave;y 13/6, ở đồng bằng, trung du Bắc Bộ v&agrave; khu vực từ Thanh H&oacute;a đến H&agrave; Tĩnh tiếp tục c&oacute; mưa vừa, mưa to, c&oacute; nơi mưa rất to v&agrave; d&ocirc;ng với tổng lượng mưa phổ biến 50-120mm, c&oacute; nơi tr&ecirc;n 150mm.</p>\r\n\r\n<p>Từ chiều nay đến s&aacute;ng 14/6 ở khu vực T&acirc;y Bắc c&oacute; mưa to đến rất to với tổng lượng mưa 50-150mm, c&oacute; nơi tr&ecirc;n 150mm.</p>\r\n', 'uploads/1644898675-Bao.jpg', '2022-02-15 04:17:55', '2022-02-15 04:17:55'),
(22, 3, 'PSG - Real: Siêu sao đại chiến', 'Lionel Messi và đồng đội đón tiếp đối thủ nhiều duyên nợ Real ở lượt đi vòng 1/8 Champions League hôm nay.', '<p><a href=\"https://vnexpress.net/the-thao/du-lieu-bong-da/doi-bong/real-madrid-541\">Real</a>&nbsp;c&oacute; biệt danh &quot;Dải ng&acirc;n h&agrave;&quot;, &aacute;m chỉ sự quy tụ những ng&ocirc;i sao s&aacute;ng nhất tại CLB danh gi&aacute; nhất. Nhưng l&uacute;c n&agrave;y, nếu x&eacute;t từng c&aacute; nh&acirc;n trong đội,&nbsp;<a href=\"https://vnexpress.net/the-thao/du-lieu-bong-da/doi-bong/psg-85\">PSG&nbsp;</a>kh&ocirc;ng thua k&eacute;m, thậm ch&iacute; c&ograve;n nhỉnh hơn. B&ecirc;n cạnh&nbsp;<a href=\"https://vnexpress.net/chu-de/lionel-messi-300\">Messi</a>, một trong hai huyền thoại đương đại, đội b&oacute;ng Ph&aacute;p c&ograve;n c&oacute;&nbsp;<a href=\"https://vnexpress.net/chu-de/kylian-mbappe-287\">Kylian Mbappe</a>&nbsp;v&agrave;&nbsp;<a href=\"https://vnexpress.net/chu-de/neymar-335\">Neymar</a>.</p>\r\n\r\n<p><img alt=\"Tốc độ của Mbappe sẽ là thử thách với Marcelo khi anh cùng Real làm khách trên sân Công viên các hoàng tử. Ảnh: Shutterstock.\" src=\"https://i1-thethao.vnecdn.net/2022/02/15/Untitled-3720-1644917003.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=ewLSNDel514S8xjMmFcAMw\" /></p>\r\n\r\n<p>Tốc độ của Mbappe sẽ l&agrave; thử th&aacute;ch với Marcelo khi anh c&ugrave;ng Real l&agrave;m kh&aacute;ch tr&ecirc;n s&acirc;n C&ocirc;ng vi&ecirc;n c&aacute;c ho&agrave;ng tử. Ảnh:&nbsp;<em>Shutterstock</em>.</p>\r\n\r\n<p>Messi từng l&agrave; cầu thủ CĐV Real căm gh&eacute;t nhất, v&agrave; e sợ nhất. Tuy đ&atilde; rời Barca để đến PSG,&nbsp;<a href=\"https://vnexpress.net/messi-khong-con-dung-ronaldo-o-vong-1-8-champions-league-4402597-tong-thuat.html\">l&aacute; thăm v&ograve;ng knock-out</a>&nbsp;Champions League khiến tiền đạo người Argentina t&aacute;i ngộ Real. Messi đ&atilde; ghi 26 b&agrave;n, kiến tạo 14 lần qua 45 trận đấu Real. Anh l&agrave; cầu thủ ph&aacute; lưới &quot;Kền kền trắng&quot; nhiều lần nhất. Hat-trick đầu ti&ecirc;n trong sự nghiệp của Messi l&agrave; v&agrave;o lưới Real ở m&ugrave;a 2006-2007. V&agrave;o ng&agrave;y 24/3/2014, lần thứ hai anh ghi ba b&agrave;n v&agrave;o lưới k&igrave;nh địch. Khi ấy, Real cũng được Ancelotti dẫn dắt. D&ugrave; vậy, ph&eacute;p m&agrave;u dường như lẩn tr&aacute;nh Messi trong những lần chạm tr&aacute;n Real gần đ&acirc;y, khi anh tịt ng&ograve;i đ&atilde; năm trận.</p>\r\n\r\n<p>Messi được ch&uacute; &yacute; nhiều nhất, nhưng m&agrave;n tr&igrave;nh diễn của Mbappe cũng đ&aacute;ng chờ đợi, kh&ocirc;ng chỉ bởi anh l&agrave; cầu thủ trẻ hay nhất thế giới hiện nay. Ch&acirc;n s&uacute;t 23 tuổi bị đồn từ chối gia hạn với PSG để chuẩn bị gia nhập Real từ h&egrave; n&agrave;y. V&igrave; thế, kết quả cặp đấu sẽ t&aacute;c động lớn đến quyết định của Mbappe. Trong bối cảnh Neymar thường xuy&ecirc;n chấn thương, c&ograve;n Messi chưa thể hiện vai tr&ograve; như ở Barca, Mbappe nhiều phen gồng g&aacute;nh PSG m&ugrave;a n&agrave;y với 12 b&agrave;n tại Ligue 1 v&agrave; bốn tại Champions League. Khi PSG hạ Rennes 1-0 h&ocirc;m 12/2, ch&iacute;nh tuyển thủ Ph&aacute;p&nbsp;<a href=\"https://vnexpress.net/messi-mbappe-giup-psg-thang-phut-bu-gio-4426596.html\">ghi b&agrave;n duy nhất</a>&nbsp;ở ph&uacute;t b&ugrave; giờ thứ ba.</p>\r\n\r\n<p>Đ&acirc;y sẽ l&agrave; cơ hội để Mbappe&nbsp;<a href=\"https://vnexpress.net/benzema-mbappe-cuoc-dua-giua-hai-lan-dan-4427832.html\">thi t&agrave;i</a>&nbsp;với đ&agrave;n anh Karim Benzema - người m&agrave; anh được chờ đợi sẽ tiếp bước kh&ocirc;ng chỉ ở tuyển Ph&aacute;p m&agrave; c&ograve;n tại s&acirc;n Bernabeu.&nbsp;<a href=\"https://vnexpress.net/chu-de/karim-benzema-274\">Benzema</a>&nbsp;chưa đạt thể trạng tốt nhất nhưng anh đ&atilde; trở lại ở buổi tập h&ocirc;m 13/2 v&agrave; nhiều khả năng đ&aacute; ch&iacute;nh. Bản th&acirc;n Benzema cũng khao kh&aacute;t ra s&acirc;n. Kh&ocirc;ng c&oacute; anh, Real chỉ ghi một b&agrave;n sau 48 c&uacute; dứt điểm. H&ocirc;m 12/2, hết c&aacute;ch trong việc t&igrave;m người thay Benzema, Ancelotti phải xếp&nbsp;<a href=\"https://vnexpress.net/chu-de/gareth-bale-230\">Gareth Bale</a>&nbsp;đ&aacute; trung phong nhưng cũng chỉ&nbsp;<a href=\"https://vnexpress.net/bong-da/real-chia-diem-trong-ngay-bale-da-chinh-4426870.html\">h&ograve;a Villarreal 0-0</a>.</p>\r\n\r\n<p>&quot;Bạn b&egrave; l&agrave; chuyện sau trận đấu. Đ&acirc;y l&agrave; trận cầu lớn, v&agrave; đối đầu Kylian rất đặc biệt bởi ch&uacute;ng t&ocirc;i s&aacute;t c&aacute;nh c&ugrave;ng nhau ở tuyển Ph&aacute;p. Ai cũng biết, một ng&agrave;y n&agrave;o đ&oacute;, cậu ấy sẽ kho&aacute;c &aacute;o Real&quot;, Benzema n&oacute;i. Trong khi đ&oacute;, Ancelotti cố gắng tr&aacute;nh hướng tập trung đến c&aacute;c cầu thủ: &quot;Điều Mbappe nghĩ cũng l&agrave; điều Benzema nghĩ. Đ&oacute; cũng l&agrave; thứ tồn tại trong đầu Vinicius hay Messi. Nếu tập trung đến từng c&aacute;i t&ecirc;n, ch&uacute;ng t&ocirc;i sẽ mất tập trung. T&ocirc;i th&agrave; nghĩ xem Real sẽ chơi thế n&agrave;o. PSG hay ch&uacute;ng t&ocirc;i đều chỉ nghĩ đến một điều: L&agrave;m thế n&agrave;o để đi tiếp?&quot;.</p>\r\n\r\n<p>Pochettino từng v&agrave;o chung kết Champions League 2018-2019 c&ugrave;ng Tottenham. M&ugrave;a trước, &ocirc;ng gi&uacute;p PSG trả m&oacute;n nợ thua Bayern, nhưng lại thua Man City ở b&aacute;n kết. Pochettino, cũng như những người tiền nhiệm, bị đặt kỳ vọng sẽ chuyển h&oacute;a sự đầu tư của PSG th&agrave;nh chiếc Cup danh gi&aacute; nhất ch&acirc;u &Acirc;u. Mong muốn đ&oacute; c&agrave;ng r&otilde; r&agrave;ng khi đội b&oacute;ng Ph&aacute;p đưa về Messi. Nhưng d&ugrave; từng c&ugrave;ng Tottenham đ&aacute;nh bại Real ở m&ugrave;a 2017-2018, Pochettino hiểu Real v&agrave; Ancelotti l&agrave; &quot;c&aacute;o gi&agrave;&quot; tại Champions League. Đ&oacute; l&agrave; l&yacute; do khiến &ocirc;ng&nbsp;<a href=\"https://vnexpress.net/pochettino-khong-doi-nao-cua-tren-o-cap-psg-real-4427650.html\">thận trọng về đối thủ</a>.</p>\r\n\r\n<p>&quot;Theo t&ocirc;i, kh&ocirc;ng c&oacute; đội cửa tr&ecirc;n ở cặp đấu n&agrave;y. Dựa v&agrave;o c&aacute;c c&aacute; nh&acirc;n v&agrave; chất lượng đội h&igrave;nh của hai b&ecirc;n, đ&acirc;y c&oacute; thể xem l&agrave; một trận chung kết. Tại Paris, ch&uacute;ng t&ocirc;i khao kh&aacute;t chiến thắng. Ch&uacute;ng t&ocirc;i kh&ocirc;ng c&oacute; kinh nghiệm hay bề d&agrave;y lịch sử như Real nhưng sẽ kh&ocirc;ng nạn nh&acirc;n h&oacute;a bản th&acirc;n. T&ocirc;i tin tưởng c&aacute;c cầu thủ của m&igrave;nh&quot;, HLV PSG n&oacute;i ở họp b&aacute;o trước trận.</p>\r\n\r\n<p>Real từng loại PSG ở v&ograve;ng 1/8 rồi v&ocirc; địch Champions League 2017-2018. Nhưng ở m&ugrave;a 2019-2020, dưới sự dẫn dắt của Thomas Tuchel, đội b&oacute;ng Ph&aacute;p từng đ&egrave; bẹp Real của Zinedine Zidane 3-0 ở v&ograve;ng bảng rồi h&ograve;a 1-1 tại Bernabeu. Bốn trong 10 lần đối đầu gần nhất giữa hai đội c&oacute; kết quả thắng nghi&ecirc;ng về Real. PSG chỉ thắng ba, nhưng ghi nhiều b&agrave;n hơn, 14 so với 13.</p>\r\n\r\n<p>B&ecirc;n cạnh Benzema, Real đang chờ tin tức về sức khỏe của Ferland Mendy v&agrave; Mariano. Trong khi đ&oacute;, PSG sẽ vắng Sergio Ramos, do trung vệ n&agrave;y kh&ocirc;ng đủ thể lực để đối đầu Real - CLB anh từng phụng sự 16 năm. Keylor Navas hy vọng c&oacute; thể gặp lại đội b&oacute;ng cũ nếu anh được bắt ch&iacute;nh thay v&igrave; Gianluigi Donnarumma. PSG cũng kh&ocirc;ng c&oacute; Ander Herrera v&agrave; Juan Bernat, trong khi Neymar đ&atilde; trở lại nhưng chưa chắc đủ sức đ&aacute; ch&iacute;nh.</p>\r\n', 'uploads/1644946203-man-city-jpeg-1644917312-6885-1644917410.jpg', '2022-02-15 17:30:03', '2022-02-15 17:30:03'),
(23, 3, 'Messi hỏng phạt đền nhiều nhất Champions League', 'Pha bỏ lỡ trước Real tối 15/2 khiến Lionel Messi chạm mốc năm lần hỏng phạt đền của Thierry Henry ở Champions League.', '<p>Đ&acirc;y l&agrave; lần đ&aacute; phạt đền thứ 23 của&nbsp;<a href=\"https://vnexpress.net/chu-de/lionel-messi-300\">Messi&nbsp;</a>tại Champions League, vượt qua 22 lần của&nbsp;<a href=\"https://vnexpress.net/chu-de/cristiano-ronaldo-194\">Cristiano Ronaldo</a>. Nhưng số lần th&agrave;nh c&ocirc;ng của anh chỉ l&agrave; 18, &iacute;t hơn một so với Ronaldo. Đ&acirc;y cũng l&agrave; lần đầu ti&ecirc;n Messi hỏng phạt đền trước Real - đối thủ anh từng 26 lần ph&aacute; lưới thuở c&ograve;n kho&aacute;c &aacute;o Barca.</p>\r\n\r\n<p><img alt=\"Messi thất vọng khi hỏng phạt đền trong khi cầu thủ Real sung sướng. Ảnh: UEFA.\" src=\"https://i1-thethao.vnecdn.net/2022/02/16/Untitled-1978-1644971620.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=aXpaUiS9sF3IqzbUu9Q-4g\" /></p>\r\n\r\n<p>Messi (tr&aacute;i) thất vọng khi hỏng phạt đền, trong khi cầu thủ Real sung sướng &ocirc;m chầm lấy thủ th&agrave;nh Thibaut Courtois. Ảnh:&nbsp;<em>UEFA</em>.</p>\r\n\r\n<p>Một trong những k&yacute; ức cay đắng nhất với Messi l&agrave; khi hỏng phạt đền trước Chelsea ở b&aacute;n kết Champions League 2011-2012, khiến Barca bị loại. Trước đ&oacute;, tiền đạo người Argentina từng bỏ lỡ cơ hội ở trận gặp Panathinaikos năm 2010. Th&aacute;ng 2/2015, khi Barca thắng Man City 2-1 ở lượt đi v&ograve;ng 1/8, Messi kh&ocirc;ng thể thắng Joe Hart tr&ecirc;n chấm 11m. Pha bỏ lỡ gần nhất của Messi xảy ra khi anh bị Keylor Navas - khi đ&oacute; c&ograve;n kho&aacute;c &aacute;o Real - từ chối ở lượt về v&ograve;ng 1/8 Champions League 2020-2021.</p>\r\n\r\n<p>Trong lịch sử giải đấu, chỉ&nbsp;<a href=\"https://vnexpress.net/chu-de/thierry-henry-822\">Henry</a>&nbsp;đ&aacute; hỏng phạt đền nhiều như Messi. Cựu tiền đạo người Ph&aacute;p bỏ lỡ lần đầu ở trận Arsenal thắng Shakhtar Donetsk 3-2 năm 2000. Hai năm sau, anh đ&aacute; hỏng hai lần ở v&ograve;ng bảng, c&aacute;c trận gặp Juventus v&agrave; Deportivo La Coruna. Một năm sau, Henry tiếp tục bỏ lỡ ở trận thua Inter. Lần đ&aacute; hỏng cuối c&ugrave;ng của anh l&agrave; trận h&ograve;a Ajax 0-0 năm 2005.</p>\r\n\r\n<p>Messi v&agrave; đồng đội&nbsp;<a href=\"https://vnexpress.net/mbappe-thay-messi-danh-guc-real-4428020.html\">gặp nhiều kh&oacute; khăn khi tiếp Real</a>&nbsp;ở lượt đi v&ograve;ng 1/8 Champions League. V&igrave; thế, khi Kylian Mbappe mang về quả phạt đền ở ph&uacute;t 61, trọng tr&aacute;ch đ&egrave; nặng l&ecirc;n Messi. Tiền đạo 34 tuổi s&uacute;t về g&oacute;c phải nhưng kh&ocirc;ng đủ hiểm v&agrave; bị thủ th&agrave;nh Thibaut Courtois cản lại.</p>\r\n\r\n<p>Nhận x&eacute;t về pha bỏ lỡ của Messi, cựu danh thủ Gary Lineker cho rằng: &quot;Ch&uacute;ng ta c&oacute; lẽ n&ecirc;n hạ thấp sự kỳ vọng với Messi v&agrave; Ronaldo. Họ vẫn thi đấu tuyệt vời. Nhưng d&ugrave; l&agrave; những vị thần trong b&oacute;ng đ&aacute; cũng kh&ocirc;ng ngăn nổi thời gian&quot;.</p>\r\n\r\n<p>D&ugrave; vậy, Messi vẫn được hưởng niềm vui chiến thắng, khi Kylian Mbappe ghi b&agrave;n ở ph&uacute;t b&ugrave; giờ gi&uacute;p PSG hạ Real 1-0. Kết quả n&agrave;y gi&uacute;p đội b&oacute;ng Ph&aacute;p nắm lợi thế ở trận lượt về tr&ecirc;n s&acirc;n Bernabeu v&agrave;o ng&agrave;y 9/3.</p>\r\n', 'uploads/1645002326-Untitled-4621-1644965225.jpg', '2022-02-16 09:05:26', '2022-02-16 09:05:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` int(10) NOT NULL DEFAULT 2 COMMENT '1- admin/2- client',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `permission`, `created_at`, `updated_at`) VALUES
(1, 'admin', '220466675e31b9d20c051d5e57974150', 1, NULL, NULL),
(2, 'james', '220466675e31b9d20c051d5e57974150', 2, NULL, NULL),
(3, 'test', '220466675e31b9d20c051d5e57974150', 2, NULL, NULL),
(4, 'new', '220466675e31b9d20c051d5e57974150', 2, '2022-02-14 07:59:04', '2022-02-14 07:59:04'),
(5, 'new2', '220466675e31b9d20c051d5e57974150', 2, '2022-02-14 07:59:09', '2022-02-14 07:59:09'),
(14, 'a1', '4124bc0a9335c27f086f24ba207a4912', 2, '2022-02-14 22:18:09', '2022-02-14 22:18:09'),
(15, 'a', '0cc175b9c0f1b6a831c399e269772661', 2, '2022-02-14 22:19:27', '2022-02-14 22:19:27');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
