/*Table creation*/

CREATE TABLE shelf (
  shelf_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  shelf CHAR(2) NOT NULL);

CREATE TABLE cover (
  cover_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  author VARCHAR(255),
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
  image_file_type VARCHAR(10) NOT NULL,
  CONSTRAINT fk_cover_2 FOREIGN KEY (cover_id)
  REFERENCES cover(cover_id));

/*Default tags*/

INSERT INTO tag_type (tag_type_id, tag_type) VALUES
  (1, "Colors"),
  (2, "Languages"),
  (3, "Products"),
  (4, "Materials"),
  (5, "Measures"),
  (6, "Themes");

INSERT INTO tag (tag, tag_type_id) VALUES
  /*Colors*/
  ("Blue", 1), ("Red", 1), ("Yellow", 1), ("Green", 1), ("Orange", 1), ("Pink", 1),
  ("Grey", 1), ("Black", 1), ("White", 1), ("Brown", 1), ("Purple", 1), ("Beige", 1),
  /*Languages*/
  ("Estonian", 2), ("Russian", 2), ("German", 2), ("English", 2), ("Scandinavian", 2),
  ("Others", 2), ("Blanks", 2),
  /*Products*/
  ("Collage", 3), ("Classic", 3), ("Artisan", 3), ("Sherlock", 3),
  /*Materials*/
  ("Textile", 4), ("Leather", 4), ("Paper", 4), ("Plastic", 4),
  /*Measures*/
  ("Small", 5), ("Standard", 5), ("Big", 5),
  /*Themes*/
  ("Science", 6), ("Space", 6), ("Sea", 6), ("Food", 6), ("Animals", 6), ("Plants", 6), ("Nature", 6),
  ("Travel", 6), ("War", 6), ("Children", 6), ("Vintage", 6), ("Famous Writers", 6), ("Pattern", 6),
  ("Symbol", 6), ("Blank", 6), ("Sport", 6), ("Business, Law and Economics", 6), ("Psychology", 6), ("Heart", 6);

INSERT INTO shelf (shelf) VALUES
  ("A1"), ("A2"), ("A3"), ("A4"),
  ("B1"), ("B2"), ("B3"), ("B4"),
  ("C1"), ("C2"), ("C3"), ("C4"),
  ("D1"), ("D2"), ("D3"), ("D4"),
  ("E1"), ("E2"), ("E3"), ("E4");