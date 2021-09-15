# DB Config
``` 
CREATE TABLE `server` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` varchar(254) NOT NULL,
  `Internal_description` text DEFAULT NULL,
  `cost` int(11) DEFAULT 0,
  `type` varchar(45) DEFAULT NULL,
  `href` varchar(254) DEFAULT NULL,
  `dead` tinyint(1) DEFAULT NULL,
  `datetime` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

ALTER TABLE `server`
  ADD PRIMARY KEY (`id`);
COMMIT;
```
