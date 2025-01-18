-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2025 at 03:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sales`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `orderFname` varchar(50) NOT NULL,
  `orderTotal` float NOT NULL,
  `orderStatus` int(11) NOT NULL,
  `orderUid` int(11) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `slip` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `orderFname`, `orderTotal`, `orderStatus`, `orderUid`, `orderDate`, `slip`) VALUES
(60, 'ผู้ใช้งาน', 1481, 2, 2, '2025-01-11 00:09:17', ''),
(61, 'ผู้ใช้งาน', 2262, 2, 2, '2025-01-12 02:36:07', ''),
(62, 'ผู้ใช้งาน', 736, 2, 2, '2025-01-13 03:36:25', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `detailID` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `productPrice` varchar(50) NOT NULL,
  `productQty` varchar(50) NOT NULL,
  `orderID` int(11) NOT NULL,
  `proID` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`detailID`, `productName`, `productPrice`, `productQty`, `orderID`, `proID`) VALUES
(44, 'สควิชแมลโลว์', '368', '2', 60, '88000000000'),
(45, 'Squishmallows 12 Inch Morton', '745', '1', 60, '88000000001'),
(46, 'Squishmallows 12 Inch Morton', '745', '1', 61, '88000000001'),
(47, 'สควิชแมลโลว์', '368', '1', 61, '88000000000'),
(48, 'Wearable Unicorn Bag', '699', '1', 61, '88000000002'),
(49, 'Squishmallows 7.5 Cordea', '450', '1', 61, '88000000003'),
(50, 'สควิชแมลโลว์', '368', '2', 62, '88000000000');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `proID` varchar(11) NOT NULL,
  `proName` varchar(80) DEFAULT NULL,
  `proDetail` text DEFAULT NULL,
  `proType` int(11) NOT NULL,
  `proPrice` float DEFAULT 0,
  `pro_img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`proID`, `proName`, `proDetail`, `proType`, `proPrice`, `pro_img`) VALUES
('88000000000', 'สควิชแมลโลว์', 'ผ้าพลัฌที่บีบได้เป็นพิเศษนี้ผลิตจากวัสดุคุณภาพสูงและนุ่มเป็นพิเศษ เพิ่มตุ๊กตาน่ารักนี้ให้กับคอลเลกชันสควิชแมลโลว์ของคุณ', 15, 368, 'img_6781619a442ab.png'),
('88000000001', 'Squishmallows 12 Inch Morton', 'ตุ๊กตา Squishmallows ขนาด 12 นิ้ว ชื่อ MORTON น่ากอดแสนอบอุ่นและมีขนาดที่พอเหมาะที่จะพกติดตัวไปได้ทุกที่ และไม่อมฝุ่น', 15, 745, 'img_6781625a66314.png'),
('88000000002', 'Wearable Unicorn Bag', 'Wherever you go, take everything you need in the Unicorn Bag. Soothing and soft in fur, with adjustable straps in strong webbing, this unicorn\'s a travel essential.', 15, 699, 'img_678163af5d634.png'),
('88000000003', 'Squishmallows 7.5 Cordea', 'Squishmallows ชื่อ CORDEA น่ารัก น่ากอด และพร้อมที่จะเข้าร่วมทีมของคุณ Squishmallows ผลิตจากวัสดุที่อ่อนนุ่มเหมือนมาร์ชเมลโลว์', 15, 450, 'img_678163cacfcac.png'),
('88000000004', 'Squishmallows 3.5 Clip On Weaver', 'ตุ๊กตา Squishmallows ขนาด 3.5 นิ้ว มาพร้อมคลิปแขวน สามารถใช้ติดกับพวกกุญแจ กระเป๋า มีขนาดพอเหมาะที่จะพกติดตัวไปได้ทุกที่ และไม่อมฝุ่น', 15, 295, 'img_6781640dc8391.png'),
('88000000005', 'My Story My Furry Fantasy Homey Kitty Soft Toy', 'Step out for a stroll with the My Story Mini Walking Pet. This fun-filled toy is battery-powered for active, on-the-move fun. Just turn on switch and go for a walk!', 15, 368, 'img_678164699feb9.png'),
('88000000006', 'Friends for Life Sit me down Unicorn', 'I am here to sit & chat with you all day long', 15, 649, 'img_67816484c5663.png'),
('88000000007', 'Squishmallows 7.5 Elle ', 'Squishmallows ชื่อ ELLE น่ารัก น่ากอด และพร้อมที่จะเข้าร่วมทีมของคุณ Squishmallows ผลิตจากวัสดุที่อ่อนนุ่มเหมือนมาร์ชเมลโลว์ ให้ความสบาย การพยุง และความอบอุ่นเหมือนเพื่อน', 15, 450, 'img_6781649ead012.png'),
('88000000008', 'Squishmallows 12 Inch Miracle', 'ตุ๊กตา Squishmallows ขนาด 12 นิ้ว ชื่อ MIRACLE น่ากอดแสนอบอุ่นและมีขนาดที่พอเหมาะที่จะพกติดตัวไปได้ทุกที่ และไม่อมฝุ่น', 15, 745, 'img_678164b706ce4.png'),
('88000000009', 'Squishmallows 7.5 Bodie', 'Squishmallows ชื่อ BODIE น่ารัก น่ากอด และพร้อมที่จะเข้าร่วมทีมของคุณ Squishmallows ผลิตจากวัสดุที่อ่อนนุ่มเหมือนมาร์ชเมลโลว์ ให้ความสบาย การพยุง และความอบอุ่นเหมือนเพื่อน', 15, 450, 'img_678164d3a8c52.png'),
('88000000010', 'Friends for Life Light up Snowy', 'ringing cuddles to light up your Christmas', 15, 479, 'img_678164e76d85c.png'),
('88000000011', 'Kimmon กล่องสุ่มพวงกุญแจ', 'ตุ๊กตากล่องสุ่ม จากแบรนด์ KIMMON ผลิตจากวัสดุผ้าขนคุณภาพดี ดีไซน์น่ารักที่ไม่ว่าใครเห็นก็ต้องตกหลุมรัก เป็นกระแสที่กำลังได้รับความนิยมเป็นอย่างมาก เหมาะแก่การวางตกแต่งในห้อง หรือเก็บสะสมก็เป็นที่นิยมไม่แพ้กัน มี 8 แบบให้เลือกสุ่ม', 14, 685, 'img_678166c471fd3.png'),
('88000000012', 'Kimmon กล่องสุ่ม Regain Myself', 'KIMMON: REGAIN MYSELF กล่องสุ่มที่รวบรวมความมหัศจรรย์และการค้นหาตนเองไว้ในที่เดียว แต่ละกล่องบรรจุตุ๊กตาที่ถูกสร้างสรรค์อย่างพิถีพิถัน รอคอยให้คุณค้นพบ ด้วยสีสันสดใส', 14, 780, 'img_678166e0c01f6.png'),
('88000000013', 'Cup Rabbits Dunhuang คละแบบ', 'กล่องสุ่ม Kimmon Dreams Of The Wilderness คละแบบ', 14, 780, 'img_678166fa3f9f8.png'),
('88000000014', 'Kimmon V.4 Fruit Plush It You Series Single Box', 'Kimmon V.4 Fruit Plush It\'s You Series\r\nขนาดประมาณ 12 - 15 cm', 14, 585, 'img_6781671d9274e.png'),
('88000000015', 'Funism Butterbear', 'Discover the delightful charm of the Funism Butterbear Operating Day Series with this blind box figure. Each box contains one random figure out of the 8 unique styles available.', 14, 450, 'img_67816731e90d1.png'),
('88000000016', 'Cup Rabbits กล่องสุ่มชุดเฟสยัวร์เซลฟ์ คละแบบ', 'หากคุณกำลังมองหาของขวัญสุดพิเศษ ที่ไม่เหมือนใครให้ กล่องสุ่มฟิกเกอร์ จากแบรนด์ CUP RABBITS คือคำตอบของคุณ ให้คุณได้ตื่นเต้นไปกับของขวัญสุดเซอร์ไพรส์ ที่คุณไม่สามารถคาดเดาได้ ภายในกล่องสุ่ม', 14, 585, 'img_6781674393c01.png'),
('88000000017', 'Re-Ment คอลเลกชันสวนขวด Pikmin', 'Re-Ment นำเสนอผลิตภัณฑ์ตู้โชว์ Terrarium \"Pikmin\" ชุดใหม่ โดยแต่ละภาพสามมิติจะทำให้เราได้เห็นโลกของ Pikmin! มีสิ่งของที่แตกต่างกันหกชิ้นให้รวบรวมและแลกเปลี่ยน และคุณจะได้รับอย่างละหนึ่งชิ้น สั่งซื้อได้แล้ววันนี้!', 14, 370, 'img_678167576849c.png'),
('88000000018', 'Blokees Transformers Model Kits Bumblebee', 'ขอแนะนำของเล่น DIY Model Kit จาก BLOKEES ประสบการณ์ขั้นสูงสุดสำหรับผู้สร้างรุ่นเยาว์และแฟน ๆ ของซีรีส์ Transformer (อายุ 12 ปีขึ้นไป)', 14, 695, 'img_6781676eee82e.png'),
('88000000019', 'Blokees Figure Transformers', ' Model Kit ที่มีข้อต่อที่ขยับได้ 20 ข้อเพื่อง่ายต่อการปรับวางท่าทางแอคชั่นต่างๆได้ตามที่ต้องการเหมือนออกมาจากฉากในเรื่องราวของ Transformers ที่สำคัญชุดอุปกรณ์นี้ประกอบง่ายและสะดวก', 14, 695, 'img_6781678700176.png'),
('88000000020', 'Optimus Primal', 'ชุดอุปกรณ์เหล่านี้ไม่เพียงแต่มอบความตื่นเต้นในการสร้างเท่านั้น แต่ยังเป็นวิธีที่ดีเยี่ยมในการเริ่มต้นหรือขยายคอลเลกชันหุ่นยนต์ Transformers ของคุณ แต่ละชิ้นได้รับการประดิษฐ์อย่างพิถีพิถันเพื่อให้แน่ใจว่าประกอบได้ง่าย', 14, 695, 'img_678167a8c5c39.png'),
('88000000021', 'LEGO Technic Porsche', 'This LEGO Technic Porsche GT4 e-Performance Race Car toy makes a great gift for kids who love luxury cars and driving toys.', 17, 5033, 'img_678169106df8f.png'),
('88000000022', 'LEGO Speed Champions BMW M4', 'BMW M4 GT3 และ BMW M Hybrid V8 ทั้งสองรุ่นมีรายละเอียดการออกแบบที่แท้จริงจากเวอร์ชันจริง เช่น ท่อไอเสีย ดิฟฟิวเซอร์ ปีกหลัง ชุดตกแต่ง BMW M Motorsport และการตกแต่งภายใน', 17, 1200, 'img_6781692d01c00.png'),
('88000000023', 'LEGO Harry Potter Expecto', 'Give Harry Potter fans a spellbinding creative experience with this 2-in-1 stag Patronus/wolf Patronus build-rebuild-and-display set.', 17, 1953, 'img_6781694b46f48.png'),
('88000000024', 'LEGO เลโก้ มาเวล ซุปเปอร์ ฮีโร่', 'ประกอบและเล่นกับ Royal Sea Leopard – เรือสุดเจ๋งจากภาพยนตร์ Marvel Studios Black Panther: Wakanda Forever', 17, 2562, 'img_6781696315f81.png'),
('88000000025', 'LEGO City Police Mobile Crime', 'Investigating clues left by crooks on the run is a job for the officers of the toy LEGO City Police Mobile Crime Lab Truck (60418). This cool playset for kids aged 7 and up features a toy truck that opens to reveal a 2-level', 17, 1533, 'img_67816977506c0.png');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `typeID` int(11) NOT NULL,
  `typeName` varchar(55) NOT NULL,
  `type_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`typeID`, `typeName`, `type_img`) VALUES
(14, 'กล่องสุ่ม', 'img_677689e21347f.png'),
(15, 'ของเล่นนุ่มนิ่ม', 'img_677689f1b3a25.png'),
(17, 'Lego', 'img_678168021a43a.png'),
(18, 'การ์ดเกม', 'img_67816826dbcba.png'),
(19, 'Nerf', 'img_6781687164bee.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_account`
--

CREATE TABLE `tb_account` (
  `id` int(2) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `level` int(2) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_account`
--

INSERT INTO `tb_account` (`id`, `username`, `password`, `fullname`, `level`, `image`) VALUES
(2, 'userx', '123', 'ผู้ใช้งาน', 1, 'img_678bb7da88909.png'),
(3, 'sellerx', '1234', 'พนักงานขาย', 50, 'img_678bbbd54ccf9.png'),
(7, 'admin', '123', 'ผู้ดูแลระบบ', 99, 'img_678bbc1b394de.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `tb_orders` (`orderUid`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`detailID`),
  ADD KEY `tb_order` (`orderID`),
  ADD KEY `tb_product` (`proID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`proID`),
  ADD KEY `product_type` (`proType`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`typeID`);

--
-- Indexes for table `tb_account`
--
ALTER TABLE `tb_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `detailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `typeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_account`
--
ALTER TABLE `tb_account`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `tb_order` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `tb_product` FOREIGN KEY (`proID`) REFERENCES `product` (`proID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_type` FOREIGN KEY (`proType`) REFERENCES `product_type` (`typeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
