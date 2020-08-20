# DB Config
``` 
CREATE TABLE `server` ( 
`id` int(11) NOT NULL, 
`name` varchar(256) COLLATE utf8_swedish_ci NOT NULL, 
`description` varchar(254) COLLATE utf8_swedish_ci NOT NULL, 
`cost` int(11) DEFAULT 0, 
`type` varchar(45) COLLATE utf8_swedish_ci DEFAULT NULL, 
`href` varchar(254) COLLATE utf8_swedish_ci DEFAULT NULL, 
`dead` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
```
