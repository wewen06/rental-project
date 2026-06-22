CREATE TABLE IF NOT EXISTS products (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price_per_day INT(11) NOT NULL,
    image_url VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS orders (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    product_id INT(11) NOT NULL,
    customer_name VARCHAR(100) NOT NULL,
    customer_email VARCHAR(100) DEFAULT NULL,
    customer_phone VARCHAR(20) DEFAULT NULL,
    days INT(11) NOT NULL,
    start_date DATE DEFAULT NULL,
    total_price INT(11) NOT NULL,
    status VARCHAR(20) DEFAULT 'pending',
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO products (id, name, price_per_day, image_url) VALUES
(17, 'Sony A7IV', 200000, 'uploads/1781890577_csn34921.png'),
(18, 'iPhone 16', 150000, 'uploads/1781890646_0788-APPMYEC3ID-A-1.webp'),
(20, 'iPhone 14', 100000, 'uploads/1781890781_iPhone_14_Midnight_PDP_Image_Position-1A__WWEN_17b539d9-5103-4df2-98bb-af29dd6fb3bd.webp'),
(21, 'Sony A6400', 200000, 'uploads/1781890907_csn27923-sony-alpha-a6400-body-_black__d1.png'),
(22, 'Nikon Z6 III', 500000, 'uploads/1781891071_1602636707_15971671.webp'),
(23, 'Canon R6 II', 400000, 'uploads/1781891160_Canon_EOS_R6_MkII_RF_24-105_F4.0-7.1_IS_STM_Kit_1__40041.jpg'),
(24, 'Monopod Benro S4', 100000, 'uploads/1781891241_Jual-Benro-A48FDS4Pro-Aluminium-Video-Monopod-Harga-Terbaik-dan-Spesifikasi-a1.webp'),
(26, 'Yongnuo YN-320', 150000, 'uploads/1781891435_YN600LII_01-510x510.jpg');

INSERT INTO orders (id, product_id, customer_name, customer_email, customer_phone, days, start_date, total_price, status, order_date) VALUES
(1, 21, 'Wendy Virtus', 'wendy.virtus@mhs.unsoed.ac.id', '089530431166', 2, '2026-06-20', 400000, 'completed', '2026-06-19 19:51:33');

ALTER TABLE products AUTO_INCREMENT = 27;
ALTER TABLE orders AUTO_INCREMENT = 2;
