-- INSERT INTO `horticultureproducebrand` (`name`, `createTmstp`, `updtTmstp`) VALUES
-- ('EAST AFRICA SEED', '2017-03-06 15:45:36', NULL),
-- ('SIMLAWS', '2017-03-06 15:45:36', NULL),
-- ('START AYRES', '2017-03-06 15:46:02', NULL);


INSERT INTO `horticultureproduceparent` (`oid`, `name`, `createTmstp`, `updtTmstp`) VALUES
(1, 'BEETROOT', '2017-03-09 20:55:51', NULL),
(2, 'BROCCOLI', '2017-03-09 20:55:51', NULL),
(3, 'CABBAGE', '2017-03-09 20:55:51', NULL),
(4, 'CARROTT', '2017-03-09 20:55:51', NULL),
(5, 'CAULIFLOWER', '2017-03-09 20:55:51', NULL),
(6, 'LEEK', '2017-03-09 20:55:51', NULL),
(7, 'LETTUCE', '2017-03-09 20:55:51', NULL),
(8, 'WHITE ONION', '2017-03-09 20:55:51', NULL),
(9, 'RED ONION', '2017-03-09 20:55:51', NULL),
(10, 'SPINACH', '2017-03-09 20:55:51', NULL),
(11, 'SQUASH BUTTERNUT', '2017-03-09 20:55:51', NULL),
(12, 'SWISS_CHARD', '2017-03-09 20:55:51', NULL),
(13, 'KALE', '2017-03-09 20:55:51', NULL),
(14, 'ZUCHINI', '2017-03-09 20:55:51', NULL),
(15, 'CORN', '2017-03-09 20:55:51', NULL);

INSERT INTO `horticultureproducetype` (`oid`, `parent_oid`, `brand`, `variety`, `directPlanting`, `nurseryDuration`, `avgMaturityDays`, `harvestDurationDays`, `createTmstp`, `updtTmstp`) VALUES
(19, 1, 'EAST AFRICA SEED', 'Crimson Globe', 1, 0, 90, 14, '2017-03-06 15:11:24', NULL),
(20, 1, 'EAST AFRICA SEED', 'Crimson Globe', 1, 0, 90, 14, '2017-03-06 15:12:11', NULL),
(21, 1, 'EAST AFRICA SEED', 'Detroit Dark Red', 1, 0, 90, 14, '2017-03-06 15:12:11', NULL),
(22, 2, 'EAST AFRICA SEED', 'Diamond', 0, 30, 90, 14, '2017-03-06 15:12:11', NULL),
(23, 3, 'EAST AFRICA SEED', 'Kilimo 1085 ', 0, 30, 90, 21, '2017-03-06 15:12:11', NULL),
(24, 4, 'EAST AFRICA SEED', 'Ideal Red', 1, 0, 90, 14, '2017-03-06 15:12:11', NULL),
(25, 5, 'EAST AFRICA SEED', 'Coral', 0, 10, 90, 14, '2017-03-06 15:12:11', NULL),
(26, 6, 'EAST AFRICA SEED', 'Leek', 0, 30, 90, 21, '2017-03-06 15:12:11', NULL),
(27, 7, 'EAST AFRICA SEED', 'Esky (iceberg)', 1, 0, 60, 14, '2017-03-06 15:12:11', NULL),
(28, 8, 'EAST AFRICA SEED', '', 1, 0, 0, 0, '2017-03-06 15:12:11', NULL),
(29, 9, 'EAST AFRICA SEED', '', 1, 0, 0, 0, '2017-03-06 15:12:11', NULL),
(30, 10, 'EAST AFRICA SEED', 'Baby Spinach', 0, 14, 45, 14, '2017-03-06 15:12:11', NULL),
(31, 10, 'EAST AFRICA SEED', 'Spinach1', 0, 30, 90, 21, '2017-03-06 15:12:11', NULL),
(32, 11, 'EAST AFRICA SEED', 'Gilda', 0, 30, 110, 60, '2017-03-06 15:12:11', NULL),
(33, 12, 'EAST AFRICA SEED', 'Swiss Chard', 0, 14, 60, 90, '2017-03-06 15:12:11', NULL),
(34, 13, 'EAST AFRICA SEED', 'Kale', 0, 14, 60, 90, '2017-03-06 15:12:12', NULL),
(35, 14, 'EAST AFRICA SEED', 'Courgettes', 1, 0, 90, 30, '2017-03-06 15:12:12', NULL),
(36, 15, 'EAST AFRICA SEED', 'Corn', 1, 0, 90, 30, '2017-03-06 15:12:12', NULL);

INSERT INTO `horticulturebed` (`oid`, `identifier`, `type`, `length`, `width`, `updtTmstp`, `createTmstp`) VALUES
(1, 1, 'P', 0, 0, NULL, '2017-03-06 15:15:24'),
(2, 2, 'P', 0, 0, NULL, '2017-03-06 15:15:24'),
(3, 3, 'P', 0, 0, NULL, '2017-03-06 15:18:02'),
(4, 4, 'P', 0, 0, NULL, '2017-03-06 15:18:03'),
(5, 5, 'P', 0, 0, NULL, '2017-03-06 15:18:03'),
(6, 6, 'P', 0, 0, NULL, '2017-03-06 15:18:03'),
(7, 7, 'P', 0, 0, NULL, '2017-03-06 15:18:03'),
(8, 8, 'P', 0, 0, NULL, '2017-03-06 15:18:03'),
(9, 9, 'P', 0, 0, NULL, '2017-03-06 15:18:03'),
(10, 10, 'P', 0, 0, NULL, '2017-03-06 15:18:03'),
(11, 11, 'P', 0, 0, NULL, '2017-03-06 15:18:03'),
(12, 12, 'P', 0, 0, NULL, '2017-03-06 15:18:03'),
(13, 13, 'P', 0, 0, NULL, '2017-03-06 15:18:03'),
(14, 14, 'P', 0, 0, NULL, '2017-03-06 15:18:03'),
(15, 15, 'P', 0, 0, NULL, '2017-03-06 15:18:03'),
(16, 16, 'P', 0, 0, NULL, '2017-03-06 15:18:03'),
(17, 17, 'P', 0, 0, NULL, '2017-03-06 15:18:03'),
(18, 18, 'P', 0, 0, NULL, '2017-03-06 15:18:03'),
(19, 19, 'P', 0, 0, NULL, '2017-03-06 15:18:03'),
(20, 20, 'P', 0, 0, NULL, '2017-03-06 15:18:03'),
(21, 21, 'P', 0, 0, NULL, '2017-03-06 15:18:03'),
(22, 22, 'P', 0, 0, NULL, '2017-03-06 15:18:03'),
(23, 23, 'P', 0, 0, NULL, '2017-03-06 15:18:03'),
(24, 24, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(25, 25, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(26, 26, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(27, 27, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(28, 28, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(29, 29, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(30, 30, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(31, 31, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(32, 32, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(33, 33, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(34, 34, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(35, 35, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(36, 36, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(37, 37, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(38, 38, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(39, 39, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(40, 40, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(41, 41, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(42, 42, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(43, 43, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(44, 44, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(45, 45, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(46, 46, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(47, 47, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(48, 48, 'P', 0, 0, NULL, '2017-03-06 15:18:04'),
(49, 49, 'P', 0, 0, NULL, '2017-03-06 15:18:05'),
(50, 50, 'P', 0, 0, NULL, '2017-03-06 15:18:05'),
(51, 51, 'P', 0, 0, NULL, '2017-03-06 15:18:05'),
(52, 52, 'P', 0, 0, NULL, '2017-03-06 15:18:05'),
(53, 53, 'P', 0, 0, NULL, '2017-03-06 15:18:05'),
(54, 54, 'P', 0, 0, NULL, '2017-03-06 15:18:05'),
(55, 55, 'P', 0, 0, NULL, '2017-03-06 15:18:05'),
(56, 56, 'P', 0, 0, NULL, '2017-03-06 15:18:05'),
(57, 57, 'P', 0, 0, NULL, '2017-03-06 15:18:05'),
(58, 58, 'P', 0, 0, NULL, '2017-03-06 15:18:05'),
(59, 59, 'P', 0, 0, NULL, '2017-03-06 15:18:05'),
(60, 60, 'P', 0, 0, NULL, '2017-03-06 15:18:05'),
(61, 61, 'P', 0, 0, NULL, '2017-03-06 15:18:05'),
(62, 62, 'P', 0, 0, NULL, '2017-03-06 15:18:05'),
(63, 63, 'P', 0, 0, NULL, '2017-03-06 15:18:05'),
(64, 64, 'P', 0, 0, NULL, '2017-03-06 15:18:05'),
(65, 65, 'P', 0, 0, NULL, '2017-03-06 15:18:05'),
(66, 66, 'P', 0, 0, NULL, '2017-03-06 15:18:05'),
(67, 67, 'P', 0, 0, NULL, '2017-03-06 15:18:05'),
(68, 68, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(69, 69, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(70, 70, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(71, 71, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(72, 72, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(73, 73, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(74, 74, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(75, 75, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(76, 76, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(77, 77, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(78, 78, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(79, 79, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(80, 80, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(81, 81, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(82, 82, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(83, 83, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(84, 84, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(85, 85, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(86, 86, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(87, 87, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(88, 88, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(89, 89, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(90, 90, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(91, 91, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(92, 92, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(93, 93, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(94, 94, 'P', 0, 0, NULL, '2017-03-06 15:18:06'),
(95, 95, 'P', 0, 0, NULL, '2017-03-06 15:18:07'),
(96, 96, 'P', 0, 0, NULL, '2017-03-06 15:18:07'),
(97, 97, 'P', 0, 0, NULL, '2017-03-06 15:18:07'),
(98, 98, 'P', 0, 0, NULL, '2017-03-06 15:18:07'),
(99, 99, 'P', 0, 0, NULL, '2017-03-06 15:18:07'),
(100, 100, 'P', 0, 0, NULL, '2017-03-06 15:18:07'),
(101, 1, 'N', 0, 0, NULL, '2017-03-06 15:23:00'),
(102, 2, 'N', 0, 0, NULL, '2017-03-06 15:23:00'),
(103, 3, 'N', 0, 0, NULL, '2017-03-06 15:23:00'),
(104, 4, 'N', 0, 0, NULL, '2017-03-06 15:23:00'),
(105, 5, 'N', 0, 0, NULL, '2017-03-06 15:23:00'),
(106, 6, 'N', 0, 0, NULL, '2017-03-06 15:23:00'),
(107, 7, 'N', 0, 0, NULL, '2017-03-06 15:23:00'),
(108, 8, 'N', 0, 0, NULL, '2017-03-06 15:23:00'),
(109, 9, 'N', 0, 0, NULL, '2017-03-06 15:23:00'),
(110, 10, 'N', 0, 0, NULL, '2017-03-06 15:23:00'),
(111, 11, 'N', 0, 0, NULL, '2017-03-06 15:23:00'),
(112, 12, 'N', 0, 0, NULL, '2017-03-06 15:23:00'),
(113, 13, 'N', 0, 0, NULL, '2017-03-06 15:23:00'),
(114, 14, 'N', 0, 0, NULL, '2017-03-06 15:23:00'),
(115, 15, 'N', 0, 0, NULL, '2017-03-06 15:23:00'),
(116, 16, 'N', 0, 0, NULL, '2017-03-06 15:23:00'),
(117, 17, 'N', 0, 0, NULL, '2017-03-06 15:23:00'),
(118, 18, 'N', 0, 0, NULL, '2017-03-06 15:23:01'),
(119, 19, 'N', 0, 0, NULL, '2017-03-06 15:23:01'),
(120, 20, 'N', 0, 0, NULL, '2017-03-06 15:23:01'),
(121, 0, 'N', 0, 0, NULL, '2017-03-06 15:15:24');

INSERT INTO `horticultureproducebed` (`oid`, `produceTypeOid`, `bedOid`, `plantedDt`, `harvestDt`, `endDt`, `ganttParentOid`, `notes`, `createTmstp`, `updtTmstp`) VALUES
(3, 19, 1, '2017-02-01', '2017-05-10', '2017-05-16', 0, 'Test notes', '2017-03-09 21:35:57', NULL),
(4, 19, 2, '2017-02-15', '2017-05-24', '2017-05-30', 3, 'Test notes 2', '2017-03-09 21:35:57', NULL),
(5, 22, 3, '2017-01-10', '2017-04-30', '2017-08-31', 0, 'Test notes 3', '2017-03-09 21:35:57', NULL),
(6, 19, 2, '2017-06-01', '2017-08-07', '2017-08-21', 4, 'Test notes Test notes Test notes', '2017-03-09 21:35:57', NULL);