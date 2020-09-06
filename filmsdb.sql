-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-09-2020 a las 23:05:24
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `filmsdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `films`
--

CREATE TABLE `films` (
  `filmId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `year` int(4) NOT NULL,
  `imdbNote` varchar(5) NOT NULL,
  `imdbLink` varchar(100) NOT NULL,
  `img` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `director` varchar(100) NOT NULL,
  `duration` varchar(10) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `stars` varchar(200) NOT NULL,
  `scoreAverage` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `films`
--

INSERT INTO `films` (`filmId`, `name`, `year`, `imdbNote`, `imdbLink`, `img`, `description`, `director`, `duration`, `genre`, `stars`, `scoreAverage`) VALUES
(1, 'el pianista', 2002, '8.5', 'https://www.imdb.com/title/tt0253474/', 'https://m.media-amazon.com/images/M/MV5BOWRiZDIxZjktMTA1NC00MDQ2LWEzMjUtMTliZmY3NjQ3ODJiXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_UY268_CR6,0,182,268_AL_.jpg', 'Un músico judío polaco lucha por sobrevivir a la destrucción del gueto de Varsovia durante la Segunda Guerra Mundial.', 'Roman Polanski', '2h 30min', 'Biografía  Drama  Música  ', 'Adrien Brody</br> Thomas Kretschmann</br> Frank Finlay</br> ', 8),
(2, 'pulp fiction', 1994, '8.9', 'https://www.imdb.com/title/tt0110912/', 'https://m.media-amazon.com/images/M/MV5BNGNhMDIzZTUtNTBlZi00MTRlLWFjM2ItYzViMjE3YzI5MjljXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_UY268_CR1,0,182,268_AL_.jpg', 'Las vidas de dos sicarios de la mafia, un boxeador, un gángster y su esposa, y un par de bandidos comensales se entrelazan en cuatro historias de violencia y redención.', 'Quentin Tarantino', '2h 34min', 'Crimen  Drama  ', 'John Travolta</br> Uma Thurman</br> Samuel L. Jackson</br> ', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `score`
--

CREATE TABLE `score` (
  `filmId` int(10) NOT NULL,
  `scoreFilm` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `score`
--

INSERT INTO `score` (`filmId`, `scoreFilm`) VALUES
(1, 9),
(1, 8),
(1, 8),
(1, 7),
(1, 8),
(1, 8);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`filmId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `films`
--
ALTER TABLE `films`
  MODIFY `filmId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
