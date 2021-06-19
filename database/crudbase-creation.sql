--localhost/retail_crud/product/		http://localhost/phpmyadmin/index.php?route=/table/sql&db=retail_crud&table=product
--Your SQL query has been executed successfully.

--SHOW CREATE TABLE product;



product	CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product` varchar(150) NOT NULL,
  `price` decimal(13,4) DEFAULT NULL,
  `attribute` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attribute`)),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;	

insert into product 
values
(1, 'MSI Optix G24C4 236 LED FullHD 144Hz Freesync Curva', 199, '{"color":"negro","garantia":"2 años","descuento":"12%"}'),
(2, 'Trust GXT 860 Thura Teclado Semi-Mecánico LED RGB', 39.61, '{"color":["verde","naranja","morado"],"garantia":"2 años"}'),
(3, 'pencil', 0.35, '{"color":"blue"}'),
(4, 'cuaderno norma 100 hojas cuadro', 3.57, '{"type":"square"}'),
(5, 'camisa lino guayabera', 53.99, '{"size":"M"}');
