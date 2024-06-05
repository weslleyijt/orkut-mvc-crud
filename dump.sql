SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_status` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `user_profile` text,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8  COLLATE=utf8_general_ci;

INSERT INTO `users` (`id`, `email`, `user_name`, `user_status`, `country`, `user_profile`, `password`) VALUES
(1, 'orkut@test.com', 'Test tet', 'Hello world!', 'Spain', NULL, '$2y$10$w3uY1VfYjG.0u1eLRnwlYeCVMRUePdRG0OluIBc3e2lEYRkSY.VYO');


CREATE TABLE `user_fans` (
  `id` int NOT NULL,
  `subject` int DEFAULT NULL,
  `fan_id` int DEFAULT NULL,
  `fan_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8  COLLATE=utf8_general_ci;


CREATE TABLE `user_message` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `message_content` text,
  `message_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8  COLLATE=utf8_general_ci;


CREATE TABLE `user_photos` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `upload_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8  COLLATE=utf8_general_ci;

CREATE TABLE `user_scraps` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `scrap_content` text,
  `scrap_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8  COLLATE=utf8_general_ci;


CREATE TABLE `user_videos` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `upload_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8  COLLATE=utf8_general_ci;


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_fans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject`);

ALTER TABLE `user_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `user_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `user_scraps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `user_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `user_fans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_photos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_scraps`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_videos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_fans`
  ADD CONSTRAINT `user_fans_ibfk_1` FOREIGN KEY (`subject`) REFERENCES `users` (`id`);

ALTER TABLE `user_message`
  ADD CONSTRAINT `user_message_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `user_photos`
  ADD CONSTRAINT `user_photos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `user_scraps`
  ADD CONSTRAINT `user_scraps_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `user_videos`
  ADD CONSTRAINT `user_videos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;