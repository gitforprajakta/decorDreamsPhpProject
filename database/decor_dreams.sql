CREATE TABLE IF NOT EXISTS users (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(60) NOT NULL,
  last_name VARCHAR(60) NOT NULL,
  email VARCHAR(120) NOT NULL,
  home_address VARCHAR(255) NOT NULL,
  home_phone VARCHAR(25) NOT NULL,
  cell_phone VARCHAR(25) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY users_email_unique (email),
  KEY users_name_index (last_name, first_name),
  KEY users_home_phone_index (home_phone),
  KEY users_cell_phone_index (cell_phone)
);

INSERT INTO users (first_name, last_name, email, home_address, home_phone, cell_phone) VALUES
('Aarav', 'Patel', 'aarav.patel@example.com', '1287 Willow Creek Lane, San Jose, CA 95112', '(408) 555-0101', '(408) 555-2101'),
('Maya', 'Shah', 'maya.shah@example.com', '442 Garden View Drive, Santa Clara, CA 95050', '(408) 555-0102', '(408) 555-2102'),
('Liam', 'Nguyen', 'liam.nguyen@example.com', '903 Cedar Hollow Court, Cupertino, CA 95014', '(408) 555-0103', '(408) 555-2103'),
('Sophia', 'Garcia', 'sophia.garcia@example.com', '2158 Blossom Hill Road, San Jose, CA 95124', '(408) 555-0104', '(408) 555-2104'),
('Noah', 'Kim', 'noah.kim@example.com', '670 Maple Ridge Avenue, Sunnyvale, CA 94086', '(408) 555-0105', '(408) 555-2105'),
('Priya', 'Rao', 'priya.rao@example.com', '1199 Baywood Terrace, Milpitas, CA 95035', '(408) 555-0106', '(408) 555-2106'),
('Ethan', 'Brown', 'ethan.brown@example.com', '84 Oak Meadow Place, Campbell, CA 95008', '(408) 555-0107', '(408) 555-2107'),
('Olivia', 'Martinez', 'olivia.martinez@example.com', '731 Rosewood Street, Los Gatos, CA 95032', '(408) 555-0108', '(408) 555-2108'),
('Arjun', 'Mehta', 'arjun.mehta@example.com', '5029 Silver Pine Way, Fremont, CA 94538', '(510) 555-0109', '(510) 555-2109'),
('Emma', 'Wilson', 'emma.wilson@example.com', '1776 Magnolia Lane, Mountain View, CA 94040', '(650) 555-0110', '(650) 555-2110'),
('Daniel', 'Lee', 'daniel.lee@example.com', '331 Orchard Park Drive, Palo Alto, CA 94303', '(650) 555-0111', '(650) 555-2111'),
('Isabella', 'Lopez', 'isabella.lopez@example.com', '2648 Sunset Terrace, Redwood City, CA 94063', '(650) 555-0112', '(650) 555-2112'),
('Kabir', 'Singh', 'kabir.singh@example.com', '940 Cypress Grove Circle, San Mateo, CA 94402', '(650) 555-0113', '(650) 555-2113'),
('Ava', 'Johnson', 'ava.johnson@example.com', '1881 Laurel Avenue, Burlingame, CA 94010', '(650) 555-0114', '(650) 555-2114'),
('Riya', 'Desai', 'riya.desai@example.com', '713 Valencia Street, San Francisco, CA 94110', '(415) 555-0115', '(415) 555-2115'),
('Mason', 'Clark', 'mason.clark@example.com', '4206 Mission Bay Boulevard, San Francisco, CA 94158', '(415) 555-0116', '(415) 555-2116'),
('Anika', 'Iyer', 'anika.iyer@example.com', '366 Lakeview Avenue, Oakland, CA 94610', '(510) 555-0117', '(510) 555-2117'),
('Lucas', 'Davis', 'lucas.davis@example.com', '590 Elmwood Road, Berkeley, CA 94705', '(510) 555-0118', '(510) 555-2118'),
('Zara', 'Khan', 'zara.khan@example.com', '2424 Creekside Drive, Pleasanton, CA 94588', '(925) 555-0119', '(925) 555-2119'),
('Henry', 'Miller', 'henry.miller@example.com', '810 Vineyard Loop, Livermore, CA 94550', '(925) 555-0120', '(925) 555-2120')
ON DUPLICATE KEY UPDATE
  first_name = VALUES(first_name),
  last_name = VALUES(last_name),
  home_address = VALUES(home_address),
  home_phone = VALUES(home_phone),
  cell_phone = VALUES(cell_phone);
