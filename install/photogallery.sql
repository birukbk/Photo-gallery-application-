CREATE TABLE photographgallery (
id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
filename varchar (255) NOT null,
type varchar(100) not null,
size int (11) not null,
description text not null,
title varchar(255) not null
);


-- example of the query
INSERT INTO photographgallery (filename,type,size,description,title)
VALUES ('flower','jpg','12','beautiful flower','blue flower');
