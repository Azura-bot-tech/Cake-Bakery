drop database if exists `cake`;
create database `cake`;
use `cake`;

-- Tạo bảng admin nếu chưa tồn tại
drop table if exists `admin`;
create table `admin` (
    `id` int not null primary key auto_increment,
    `full_name` varchar(255) not null,
    `username` varchar(255) not null unique,
    `password` varchar(255) not null,
    `email` varchar(255) not null unique
);

-- Thêm tài khoản admin mẫu
insert into `admin` (`full_name`, `username`, `password`, `email`) 
values ('Admin', 'admin', 'Admin', 'admin01@example.com');

drop table if exists `user`;
create table `user` (
    `id` int not null primary key auto_increment,
    `full_name` varchar(255) not null,
    `username` varchar(255) not null,
    `password` varchar(255) not null,
    `email` varchar(255) not null
);

insert into `user` (`full_name`, `username`, `password`, `email`) values ('Hung Ho', 'hungho02', 'Hungho02', 'hungho02@gmail.com');

drop table if exists `product`;
create table `product` (
    `id` int not null primary key auto_increment,
    `name` varchar(255) not null,
    `price` decimal(10, 2) not null,
    `description` text not null,
    `image_url` varchar(255) not null,
    `distribution` text not null
);

insert into `product` (`id`, `name`, `price`, `description`, `image_url`, `distribution`) values 
('1', 'Cream Cake', '50.10', 'Description of Cake 1', 'https://res.cloudinary.com/dukdqd5ao/image/upload/v1730684108/c1_sj6he7.png', 'Cakes'),
('2', 'Chocolate Slice Cake', '60.50', 'Description of Cake 2', 'https://res.cloudinary.com/dukdqd5ao/image/upload/v1730684109/c2_fw0sgd.png', 'Cakes'),
('3', 'White Slice Cake', '100.10', 'Description of Cake 3', 'https://res.cloudinary.com/dukdqd5ao/image/upload/v1730684109/c3_bgoueh.png', 'Cakes'),
('4', 'Fruit Cake', '30.20', 'Description of Cake 4', 'https://res.cloudinary.com/dukdqd5ao/image/upload/v1730684106/c4_ebye7a.png', 'Cakes'),
('5', 'Brown Cake', '10.50', 'Description of Cake 5', 'https://res.cloudinary.com/dukdqd5ao/image/upload/v1730684106/c5_uvbin3.png', 'Cakes'),
('6', 'Brown Slice Cake', '15.50', 'Description of Cake 6', 'https://res.cloudinary.com/dukdqd5ao/image/upload/v1730684106/c6_lkjka0.png', 'Cakes'),
('7', 'Strawberry Cake', '200.10', 'Description of Cake 7', 'https://res.cloudinary.com/dukdqd5ao/image/upload/v1730684107/c7_unakf3.png', 'Cakes'),
('8', 'Chocolate Cake', '30.20', 'Description of Cake 8', 'https://res.cloudinary.com/dukdqd5ao/image/upload/v1730684107/c8_v42egg.png', 'Cakes'),
('9', 'Birthday Cake', '500.10', 'Description of Cake 9', 'https://res.cloudinary.com/dukdqd5ao/image/upload/v1730684108/c9_bnnycs.png', 'Birthday Cakes'),
('10', 'Bir Cup Cake', '300.20', 'Description of Cake 10', 'https://res.cloudinary.com/dukdqd5ao/image/upload/v1730684108/c10_jbshlv.png', 'Birthday Cakes'),
('11', 'Pink Birthday Cake', '100.50', 'Description of Cake 11', 'https://res.cloudinary.com/dukdqd5ao/image/upload/v1730684108/c11_ex9zqh.png', 'Birthday Cakes'),
('12', 'Cup Cake', '50.10', 'Description of Cake 12', 'https://res.cloudinary.com/dukdqd5ao/image/upload/v1730684109/c12_c7k2se.png', 'Birthday Cakes');