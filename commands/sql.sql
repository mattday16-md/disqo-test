CREATE TABLE `user`
(
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	email VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	create_time DATETIME DEFAULT NOW(),
	last_update_time DATETIME
);

CREATE TABLE note
(
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user` BIGINT UNSIGNED NOT NULL,
	title VARCHAR(50) NOT NULL,
	contents TEXT,
	create_time DATETIME DEFAULT NOW(),
	last_update_time DATETIME,
	
	FOREIGN KEY (`user`) REFERENCES `user`(id)
);

INSERT INTO `user` (email, password) VALUES ('mattday16@gmail.com', '$2y$10$AzegDz0US/O/bn8cZrjzsu1bk0BKS4FCZu2/yPQu3w6o5xyp39lmu');
INSERT INTO `user` (email, password) VALUES ('mattday17@gmail.com', '$2y$10$3BkDR0CRA.8LcMyiuoKNC.LBxueMh.ltTppTmfcDuOaF2K1angPc.');
INSERT INTO `user` (email, password) VALUES ('mattday18@gmail.com', '$2y$10$5eh5JJPzthtQX374mDfCT.rzZZcFmMW5pN2ncZWxwialaMcYBOST.');