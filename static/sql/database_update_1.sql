ALTER TABLE cover
  ADD COLUMN image_uuid VARCHAR(36);

UPDATE cover
SET image_uuid = (SELECT image_uuid
                  FROM cover_image
                  WHERE cover_id = cover.cover_id);

ALTER TABLE cover
  MODIFY COLUMN image_uuid VARCHAR(36) NOT NULL;

DROP TABLE cover_image;

ALTER TABLE tag
  ADD UNIQUE tag_name_and_type (tag, tag_type_id);

CREATE TRIGGER before_insert_cover
BEFORE INSERT ON cover
FOR EACH ROW
  SET new.image_uuid = uuid();

CREATE TABLE users (
  id       INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(25)  NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  question VARCHAR(255) NOT NULL,
  answer   VARCHAR(255) NOT NULL
);

CREATE TABLE cover_user (
  cover_id INT UNSIGNED NOT NULL,
  user_id  INT UNSIGNED NOT NULL,
  amount   INT UNSIGNED NOT NULL,
  PRIMARY KEY (cover_id, user_id),
  CONSTRAINT fk_cover FOREIGN KEY (cover_id)
  REFERENCES cover (cover_id),
  CONSTRAINT fk_user FOREIGN KEY (user_id)
  REFERENCES users (id)
);