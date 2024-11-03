drop database if exists `cake_shop`;
create database `cake_shop`;
use `cake_shop`;

create table `user` (
    `id` int not null primary key auto_increment,
    `full_name` varchar(255) not null,
    `username` varchar(255) not null,
    `password` varchar(255) not null
);

insert into `user` (`full_name`, `username`, `password`) values ('Hung ho', 'Hungho', '123456');

create table `product` (
    `id` int not null primary key auto_increment,
    `name` varchar(255) not null,
    `price` decimal(10, 2) not null,
    `count` int not null,
    `description` text not null,
    `image_url` varchar(255) not null
);

insert into `product` (`name`, `price`, `count`, `description`, `image_url`) values
('Cream Cake', 50.10, 20, 'Description of Cake 1', 'https://drive.google.com/file/d/1DYn7eitG7ME8sK3bKPtUuMjmmY516UWz/view?usp=sharing'),
('Choco Slice Cake', 60.50, 20, 'Description of Cake 2', 'https://drive.google.com/file/d/19TuwZRGKDNK0SHwwht3u45ACyaVLwO4z/view?usp=sharing'),
('White Slice Cake', 100.10, 20, 'Description of Cake 3', 'https://drive.google.com/file/d/1vlj3qFVgJo2Qoot06N6IwSC3vdptp5c5/view?usp=sharing'),
('Fruit Cake', 30.20, 20, 'Description of Cake 4', 'https://drive.google.com/file/d/1D80YAc1wAQAoGErIRIe7KvT6uAiRWS6H/view?usp=sharing'),
('Brown Cake', 10.50, 20, 'Description of Cake 5', 'https://drive.google.com/file/d/1F199Ob0mD_uZC5azmRw5KWSZirLjky98/view?usp=sharing'),
('Brown Slice Cake', 15.50, 20, 'Description of Cake 6', 'https://drive.google.com/file/d/1S7W67SCJz9d9EcIISy1RCPGVP0uW2jYv/view?usp=sharing'),
('Strawberry Cake', 200.10, 20, 'Description of Cake 7', 'https://drive.google.com/file/d/1BD_izk2nwLuy8F8yj05yPpROqh5cO2yH/view?usp=sharing'),
('Chocolate Cake', 30.20, 20, 'Description of Cake 8', 'https://drive.google.com/file/d/1OjBPaiQKtwBHsQNYF8QIrIrazfDhM6dz/view?usp=sharing'),
('Birthday Cake', 500.10, 20, 'Description of Cake 9', 'https://drive.google.com/file/d/1tIFZgjVV4oBXZmOtlNZvaHyryqwIVZL7/view?usp=sharing'),
('Bir Cup Cake', 300.20, 20, 'Description of Cake 10', 'https://drive.google.com/file/d/185cBYKBJ-8VJQ5auaWWeEt5b9uZu2F3N/view?usp=sharing'),
('Pink Birthday Cake', 100.50, 20, 'Description of Cake 11', 'https://drive.google.com/file/d/1GmuOq5zOtYXzDLDGXaItaDkDr8DpZirx/view?usp=sharing'),
('Cup Cake', 50.10, 20, 'Description of Cake 12', 'https://drive.google.com/file/d/1igoTQXYHpSQx9ALfNvOJ8y-B7O-NdsyG/view?usp=sharing');