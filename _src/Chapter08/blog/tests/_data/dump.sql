
--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_06_23_211732_create_users_table', 0),
(2, '2017_06_23_211732_create_posts_table', 0),
(3, '2017_06_23_211732_create_comments_table', 0),
(4, '2017_06_23_211733_add_foreign_keys_to_posts_table', 0),
(5, '2017_06_23_211733_add_foreign_keys_to_comments_table', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `status`, `content`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'test', 'draft', 'test post', 2, NULL, '2017-06-28 00:47:50'),
(3, 'test', 'published', 'test post', 2, '2017-06-28 00:00:44', '2017-06-28 00:00:44'),
(4, 'test', 'published', 'test post', 2, '2017-06-28 03:21:36', '2017-06-28 03:21:36'),
(5, 'test post', 'draft', 'This is yet another post for testing purpose', 8, '2017-07-15 00:45:29', '2017-07-15 00:45:29'),
(6, 'test post', 'draft', 'This is yet another post for testing purpose', 8, '2017-07-15 23:53:23', '2017-07-15 23:53:23'),
(7, 'test post', 'draft', 'This is yet another post for testing purpose', 8, '2017-07-23 02:19:09', '2017-07-23 02:19:09'),
(8, 'test post', 'draft', 'This is yet another post for testing purpose', 8, '2017-07-23 02:39:54', '2017-07-23 02:39:54'),
(9, 'test post', 'draft', 'This is yet another post for testing purpose', 8, '2017-07-23 02:40:16', '2017-07-23 02:40:16'),
(10, 'test post', 'draft', 'This is yet another post for testing purpose', 8, '2017-07-23 02:40:17', '2017-07-23 02:40:17'),
(11, 'test post', 'draft', 'This is yet another post for testing purpose', 8, '2017-07-23 02:40:57', '2017-07-23 02:40:57'),
(12, 'test post', 'draft', 'This is yet another post for testing purpose', 8, '2017-07-23 02:40:58', '2017-07-23 02:40:58'),
(13, 'test post', 'draft', 'This is yet another post for testing purpose', 8, '2017-07-23 02:40:58', '2017-07-23 02:40:58'),
(14, 'test post', 'draft', 'This is yet another post for testing purpose', 8, '2017-07-23 02:40:58', '2017-07-23 02:40:58'),
(15, 'test post', 'draft', 'This is yet another post for testing purpose', 8, '2017-07-23 02:41:50', '2017-07-23 02:41:50'),
(16, 'test post', 'draft', 'This is yet another post for testing purpose', 8, '2017-07-23 02:42:13', '2017-07-23 02:42:13'),
(17, 'test post', 'draft', 'This is yet another post for testing purpose', 8, '2017-07-23 02:43:27', '2017-07-23 02:43:27'),
(18, 'test post', 'draft', 'This is yet another post for testing purpose', 8, '2017-07-23 02:43:32', '2017-07-23 02:43:32'),
(19, 'test post', 'draft', 'This is yet another post for testing purpose', 8, '2017-07-23 02:43:39', '2017-07-23 02:43:39'),
(20, 'test post', 'draft', 'This is yet another post for testing purpose', 8, '2017-07-23 02:44:48', '2017-07-23 02:44:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(2, 'Ali1', 'abc@email.com', '$2y$10$aComplexStringOfAtleaeeeoYTF1Nrkf8VohijM26vuoPJxTwbSK', NULL, NULL),
(8, 'Haafiz', 'kaasib@gmail.com', '$2y$10$IqXBCwab2Ck1bZqFUcl5guugvZjr/Yxs2ZwhDlzCzHy.OTql6XmDi', '2017-07-07 00:29:42', '2017-07-07 00:29:42'),
(9, 'Ahmad', 'xyz@email.com', '$2y$10$2z4WMmMUiN4904u1tV12Qu5vi2.CIi0oIpDHFb0WbEg.Bes3SJun.', '2017-07-07 00:29:42', '2017-07-07 00:29:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `post_id_comment_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `user_id_comment_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);


