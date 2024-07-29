CREATE TABLE room_reservation
(
    id                   INT AUTO_INCREMENT NOT NULL,
    user_account_id      INT      NOT NULL,
    room_availability_id INT      NOT NULL,
    date_created         DATETIME NOT NULL,
    date_updated         DATETIME NOT NULL,
    INDEX                IDX_56FDE76A3C0C9956 (user_account_id),
    INDEX                IDX_56FDE76AA2320A30 (room_availability_id),
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;

CREATE TABLE user_account
(
    id           INT AUTO_INCREMENT NOT NULL,
    email        VARCHAR(255) NOT NULL,
    password     VARCHAR(255) NOT NULL,
    date_created DATETIME     NOT NULL,
    date_updated DATETIME     NOT NULL,
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;

CREATE TABLE room
(
    id           INT AUTO_INCREMENT NOT NULL,
    name         VARCHAR(255) NOT NULL,
    date_created DATETIME     NOT NULL,
    date_updated DATETIME     NOT NULL,
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;

CREATE TABLE room_availability
(
    id              INT AUTO_INCREMENT NOT NULL,
    room_id         INT      NOT NULL,
    available_since DATETIME NOT NULL,
    available_till  DATETIME NOT NULL,
    date_created    DATETIME NOT NULL,
    date_updated    DATETIME NOT NULL,
    INDEX           IDX_89C5BA2C54177093 (room_id),
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;
ALTER TABLE room_reservation
    ADD CONSTRAINT FK_56FDE76A3C0C9956 FOREIGN KEY (user_account_id) REFERENCES user_account (id);
ALTER TABLE room_reservation
    ADD CONSTRAINT FK_56FDE76AA2320A30 FOREIGN KEY (room_availability_id) REFERENCES room_availability (id);
ALTER TABLE room_availability
    ADD CONSTRAINT FK_89C5BA2C54177093 FOREIGN KEY (room_id) REFERENCES room (id);
