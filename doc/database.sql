/*Table creation*/

CREATE TABLE shelf (
  shelf_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  shelf VARCHAR(255) NOT NULL,
  shelf_size INT UNSIGNED NOT NULL);

CREATE TABLE cover (
  cover_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  transliterated_title VARCHAR(255),
  translated_title VARCHAR(255),
  author VARCHAR(255),
  transliterated_author VARCHAR(255),
  comment TEXT,
  amount INT UNSIGNED NOT NULL,
  shelf_id INT UNSIGNED NOT NULL,
  CONSTRAINT fk_shelf FOREIGN KEY (shelf_id)
  REFERENCES shelf(shelf_id));

CREATE TABLE tag_type (
  tag_type_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  tag_type VARCHAR(255) NOT NULL);

CREATE TABLE tag (
  tag_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  tag VARCHAR(255) NOT NULL,
  tag_type_id INT UNSIGNED NOT NULL,
  CONSTRAINT fk_tag_type FOREIGN KEY (tag_type_id)
  REFERENCES tag_type(tag_type_id));

CREATE TABLE cover_tag (
  cover_id INT UNSIGNED NOT NULL,
  tag_id INT UNSIGNED NOT NULL,
  PRIMARY KEY (cover_id, tag_id),
  CONSTRAINT fk_cover FOREIGN KEY (cover_id)
  REFERENCES cover(cover_id),
  CONSTRAINT fk_tag FOREIGN KEY (tag_id)
  REFERENCES tag(tag_id));

CREATE TABLE cover_image (
  image_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  cover_id INT UNSIGNED NOT NULL,
  image_uuid VARCHAR(36) NOT NULL,
  CONSTRAINT fk_cover_2 FOREIGN KEY (cover_id)
  REFERENCES cover(cover_id));

/*Default tags*/

INSERT INTO tag_type (tag_type_id, tag_type) VALUES
  (1, "Colors"),
  (2, "Languages"),
  (3, "Products"),
  (4, "Materials"),
  (5, "Themes"),
  (6, "Width"),
  (7, "Height"),
  (8, "Thickness"),
  (9, "Reserved"),
  (10, "Collection");

INSERT INTO tag (tag, tag_type_id) VALUES
  /*Colors*/
  ("Blue", 1), ("Red", 1), ("Yellow", 1), ("Green", 1), ("Orange", 1), ("Pink", 1),
  ("Grey", 1), ("Black", 1), ("White", 1), ("Brown", 1), ("Purple", 1), ("Beige", 1),
  /*Languages*/
  ("Estonian", 2), ("Russian", 2), ("German", 2), ("English", 2), ("Scandinavian", 2),
  ("Others", 2), ("Blanks", 2),
  /*Products*/
  ("College", 3), ("Classic", 3), ("Artisan", 3), ("Sherlock", 3),
  /*Materials*/
  ("Textile", 4), ("Leather", 4), ("Paper", 4), ("Plastic", 4),
  /*Themes*/
  ("Science", 5), ("Space", 5), ("Sea", 5), ("Food", 5), ("Animals", 5), ("Plants", 5), ("Nature", 5),
  ("Travel", 5), ("War", 5), ("Children", 5), ("Vintage", 5), ("Famous Writers", 5), ("Pattern", 5),
  ("Symbol", 5), ("Blank", 5), ("Sport", 5), ("Business, Law and Economics", 5), ("Psychology", 5), ("Heart", 5),
  /*Width*/
  ("Less than 2 cm", 6), ("2 to 3 cm", 6), ("More than 3 cm", 6),
  /*Height*/
  ("Less than 20 cm", 7), ("20 to 21 cm", 7), ("More than 21 cm", 7),
  /*Thickness*/
  ("Less than 12 cm", 8), ("12 to 14 cm", 8), ("More than 14 cm", 8),
  /*Reserved by*/
  ("Reserved by Agnieszka", 9), ("Reserved by Mana", 9), ("Reserved by Tiina", 9);

INSERT INTO shelf (shelf, shelf_size) VALUES
  ("A1", 100), ("A2", 100), ("A3", 100), ("A4", 100),
  ("B1", 100), ("B2", 100), ("B3", 100), ("B4", 100),
  ("C1", 100), ("C2", 100), ("C3", 100), ("C4", 100),
  ("D1", 100), ("D2", 100), ("D3", 100), ("D4", 100),
  ("E1", 100), ("E2", 100), ("E3", 100), ("E4", 100);

/* Shelf view */
CREATE VIEW shelf_space (shelf_id, cover_amount, percentage_filled) AS
  SELECT shelf_id, IFNULL(SUM(amount),0), IFNULL((SUM(amount)/shelf_size)*100,0)
  FROM shelf LEFT JOIN cover USING (shelf_id)
  GROUP BY shelf_id;

CREATE VIEW shelf_type_amount (shelf_id, tag, tag_amount) AS
  SELECT shelf_id, tag, count(*)
  FROM shelf
    LEFT JOIN cover USING (shelf_id)
    LEFT JOIN cover_tag USING (cover_id)
    LEFT JOIN tag USING (tag_id)
  WHERE tag_type_id IS NULL OR tag_type_id = 3
  GROUP BY shelf_id, tag;

CREATE VIEW shelf_type (shelf_id, tag) AS
  SELECT a.shelf_id, a.tag
  FROM shelf_type_amount a
    LEFT JOIN shelf_type_amount b
      ON a.shelf_id = b.shelf_id AND a.tag_amount < b.tag_amount
  WHERE b.shelf_id IS NULL;
