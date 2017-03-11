ALTER TABLE cover ADD COLUMN image_uuid VARCHAR(36) ;

UPDATE cover SET image_uuid = (SELECT image_uuid FROM cover_image WHERE cover_id = cover.cover_id);

ALTER TABLE cover MODIFY COLUMN image_uuid VARCHAR(36) NOT NULL;

DROP TABLE cover_image;

CREATE TRIGGER before_insert_cover
BEFORE INSERT ON cover
FOR EACH ROW
  SET new.image_uuid = uuid();