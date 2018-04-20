create table hk_line (
  station_id int NOT NULL auto_increment PRIMARY KEY,
  line_name varchar(255),
  station_name varchar(255),
  x decimal(10,2),
  y decimal(10,2)

);

INSERT INTO hk_line (line_name, station_name, x, y)
VALUES ('line', 'none', 840, 623);
