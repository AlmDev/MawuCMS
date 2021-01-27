DROP TABLE IF EXISTS `cms_news_form`;
CREATE TABLE `cms_news_form` (
  `id` int(11) NOT NULL,
  `newsid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `urlresultado` varchar(555) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
ALTER TABLE `cms_news_form`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `cms_news_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;