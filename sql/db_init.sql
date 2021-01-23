/* Create database and insert starting datas*/

CREATE TABLE `barkoba`
(
    `id`     int,
    `data`   varchar(255),
    `left`   int,
    `right`  int,
    `parent` int
);

INSERT INTO `barkoba` (`id`, `data`, `left`, `right`, `parent`)
VALUES (0, 'Is it a living thing?', 1, 2, -1);
INSERT INTO `barkoba` (`id`, `data`, `left`, `right`, `parent`)
VALUES (1, 'Polar bear', -1, -1, 0);
INSERT INTO `barkoba` (`id`, `data`, `left`, `right`, `parent`)
VALUES (2, 'Shoe', -1, -1, 0);