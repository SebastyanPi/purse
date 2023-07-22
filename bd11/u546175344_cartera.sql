-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 11-08-2022 a las 15:33:23
-- Versión del servidor: 10.5.12-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u546175344_cartera`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conceptos`
--

CREATE TABLE `conceptos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `orderTable` tinyint(1) NOT NULL,
  `consecutivo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `conceptos`
--

INSERT INTO `conceptos` (`id`, `nombre`, `estado`, `orderTable`, `consecutivo`, `created_at`, `updated_at`) VALUES
(1, 'Abono Cuota', 1, 0, 1, '2022-08-01 16:12:18', '2022-08-01 16:12:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consecutives`
--

CREATE TABLE `consecutives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `num_start` bigint(20) NOT NULL,
  `num_current` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `consecutives`
--

INSERT INTO `consecutives` (`id`, `num_start`, `num_current`, `created_at`, `updated_at`) VALUES
(1, 10000, 10028, '2022-08-01 16:12:18', '2022-08-01 16:12:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costs`
--

CREATE TABLE `costs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cod_alumno` bigint(20) NOT NULL,
  `valor_semestre` bigint(20) NOT NULL,
  `numero_semestre` int(11) NOT NULL,
  `valor_total_semestre` bigint(20) NOT NULL,
  `descuento` bigint(20) NOT NULL,
  `valor_neto` bigint(20) NOT NULL,
  `saldo_financiar` bigint(20) NOT NULL,
  `periodo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_cuotas` int(11) NOT NULL,
  `valor_cuotas` bigint(20) NOT NULL,
  `fecha_pago` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `costs`
--

INSERT INTO `costs` (`id`, `cod_alumno`, `valor_semestre`, `numero_semestre`, `valor_total_semestre`, `descuento`, `valor_neto`, `saldo_financiar`, `periodo`, `numero_cuotas`, `valor_cuotas`, `fecha_pago`, `created_at`, `updated_at`) VALUES
(1, 223, 750000, 2, 1500000, 200000, 1300000, 1300000, 'Mensual', 10, 130000, '2022-08-01', '2022-08-01 16:26:39', '2022-08-01 16:26:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `debes`
--

CREATE TABLE `debes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cuenta` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `debes`
--

INSERT INTO `debes` (`id`, `cuenta`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 1105, 'Caja', '2022-08-01 16:12:18', '2022-08-01 16:12:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elaborados`
--

CREATE TABLE `elaborados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `elaborados`
--

INSERT INTO `elaborados` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Keyla Pineda', 1, '2022-08-01 16:12:19', '2022-08-01 16:12:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entries`
--

CREATE TABLE `entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cost` bigint(20) UNSIGNED NOT NULL,
  `concepto` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_recibo` bigint(20) NOT NULL,
  `fecha_recibo` date NOT NULL,
  `valor` bigint(20) NOT NULL,
  `elaborado_por` bigint(20) UNSIGNED NOT NULL,
  `debe` bigint(20) UNSIGNED NOT NULL,
  `haber` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `entries`
--

INSERT INTO `entries` (`id`, `id_cost`, `concepto`, `descripcion`, `no_recibo`, `fecha_recibo`, `valor`, `elaborado_por`, `debe`, `haber`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 'EFECTIVO', 10001, '2022-08-19', 180000, 1, 1, 1, '2022-08-03 20:12:53', '2022-08-05 01:46:51'),
(3, 1, 1, 'efectivo', 10002, '2022-08-04', 120000, 1, 1, 1, '2022-08-03 20:17:17', '2022-08-03 20:17:17'),
(4, 1, 1, 'efectivo', 10003, '2022-08-04', 100000, 1, 1, 1, '2022-08-04 01:26:38', '2022-08-04 01:26:38'),
(5, 1, 1, 'efectivo', 10004, '2022-08-04', 20000, 1, 1, 1, '2022-08-04 01:35:01', '2022-08-04 01:35:01'),
(6, 1, 1, 'efectivo', 10005, '2022-08-04', 40000, 1, 1, 1, '2022-08-04 01:35:39', '2022-08-04 01:35:39'),
(7, 1, 1, 'efectivo', 10006, '2022-08-04', 20000, 1, 1, 1, '2022-08-04 01:44:27', '2022-08-04 01:44:27'),
(8, 1, 1, 'efectivo', 10007, '2022-08-04', 130000, 1, 1, 1, '2022-08-04 01:45:22', '2022-08-04 01:45:22'),
(9, 1, 1, 'Efectivo', 10008, '2022-08-03', 50000, 1, 1, 1, '2022-08-04 01:47:32', '2022-08-04 01:47:32'),
(11, 1, 1, 'efectivo', 10010, '2022-08-26', 50000, 1, 1, 1, '2022-08-04 21:51:19', '2022-08-04 21:51:19'),
(12, 1, 1, 'efectivo', 10011, '2022-08-04', 50000, 1, 1, 1, '2022-08-04 21:53:27', '2022-08-04 21:53:27'),
(13, 1, 1, 'efectivo', 10012, '2022-08-04', 12000, 1, 1, 1, '2022-08-04 22:11:26', '2022-08-04 22:11:26'),
(14, 1, 1, 'efectivo', 10013, '2022-08-04', 13000, 1, 1, 1, '2022-08-04 22:16:49', '2022-08-04 22:16:49'),
(15, 1, 1, 'efectivo', 10014, '2022-08-04', 14000, 1, 1, 1, '2022-08-04 22:22:25', '2022-08-04 22:22:25'),
(16, 1, 1, 'efectivo', 10015, '2022-08-04', 23000, 1, 1, 1, '2022-08-04 22:23:03', '2022-08-04 22:23:03'),
(17, 1, 1, 'efectivo', 10016, '2022-08-04', 45000, 1, 1, 1, '2022-08-04 22:23:28', '2022-08-04 22:23:28'),
(18, 1, 1, 'efectivo', 10017, '2022-08-19', 11000, 1, 1, 1, '2022-08-04 22:27:12', '2022-08-04 22:27:12'),
(19, 1, 1, 'efectivo', 10018, '2022-08-19', 9000, 1, 1, 1, '2022-08-04 22:27:34', '2022-08-04 22:27:34'),
(20, 1, 1, 'efectivo', 10019, '2022-08-19', 2000, 1, 1, 1, '2022-08-04 22:28:06', '2022-08-04 22:28:06'),
(21, 1, 1, 'efectivo', 10020, '2022-08-19', 1000, 1, 1, 1, '2022-08-04 22:28:30', '2022-08-04 22:28:30'),
(22, 1, 1, 'efectivo', 10021, '2022-08-19', 1800, 1, 1, 1, '2022-08-04 22:29:00', '2022-08-04 22:29:00'),
(23, 1, 1, 'efectivo', 10022, '2022-08-04', 4000, 1, 1, 1, '2022-08-04 22:31:17', '2022-08-04 22:31:17'),
(24, 1, 1, 'Abono de una alumna.', 10023, '2022-08-04', 19900, 1, 1, 1, '2022-08-05 01:04:03', '2022-08-05 01:04:03'),
(25, 1, 1, 'efectivo', 10024, '2022-08-04', 20000, 1, 1, 1, '2022-08-05 01:09:02', '2022-08-05 01:09:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habers`
--

CREATE TABLE `habers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cuenta` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `habers`
--

INSERT INTO `habers` (`id`, `cuenta`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 4206, 'Enseñanza', '2022-08-01 16:12:19', '2022-08-01 16:12:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `history_purses`
--

CREATE TABLE `history_purses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_purse` bigint(20) UNSIGNED NOT NULL,
  `fecha_pago` date NOT NULL,
  `estado` enum('Al dia','Pendiente','En mora','Pago Extraordinario') COLLATE utf8mb4_unicode_ci NOT NULL,
  `cuota` bigint(20) NOT NULL,
  `abonado` bigint(20) NOT NULL,
  `comentario` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `history_purses`
--

INSERT INTO `history_purses` (`id`, `id_purse`, `fecha_pago`, `estado`, `cuota`, `abonado`, `comentario`, `created_at`, `updated_at`) VALUES
(94, 22, '2022-09-01', 'Pendiente', 130000, 0, 'Fecha de pago establecidas con sus cuotas iniciales.', '2022-08-03 20:17:19', '2022-08-03 20:17:19'),
(95, 23, '2022-10-01', 'Pendiente', 130000, 0, 'Fecha de pago establecidas con sus cuotas iniciales.', '2022-08-03 20:17:19', '2022-08-03 20:17:19'),
(96, 24, '2022-11-01', 'Pendiente', 130000, 0, 'Fecha de pago establecidas con sus cuotas iniciales.', '2022-08-03 20:17:20', '2022-08-03 20:17:20'),
(97, 25, '2023-12-01', 'Pendiente', 130000, 0, 'Fecha de pago establecidas con sus cuotas iniciales.', '2022-08-03 20:17:20', '2022-08-03 20:17:20'),
(98, 26, '2023-01-01', 'Pendiente', 130000, 0, 'Fecha de pago establecidas con sus cuotas iniciales.', '2022-08-03 20:17:20', '2022-08-03 20:17:20'),
(99, 27, '2023-02-01', 'Pendiente', 130000, 0, 'Fecha de pago establecidas con sus cuotas iniciales.', '2022-08-03 20:17:21', '2022-08-03 20:17:21'),
(100, 28, '2023-03-01', 'Pendiente', 130000, 0, 'Fecha de pago establecidas con sus cuotas iniciales.', '2022-08-03 20:17:22', '2022-08-03 20:17:22'),
(103, 27, '2023-02-01', 'Pendiente', 140000, 0, 'Aumento de valor por mora', '2022-08-03 20:18:05', '2022-08-03 20:18:05'),
(104, 28, '2023-03-01', 'Pendiente', 140000, 0, 'Aumento de valor por mora', '2022-08-03 20:18:05', '2022-08-03 20:18:05'),
(106, 30, '2023-05-01', 'Pendiente', 140000, 0, 'Aumento de valor por mora', '2022-08-03 20:18:06', '2022-08-03 20:18:06'),
(108, 28, '2023-03-01', 'Pendiente', 160000, 0, 'modificacion 2', '2022-08-03 20:19:45', '2022-08-03 20:19:45'),
(109, 29, '2023-04-01', 'Pendiente', 160000, 0, 'modificacion 2', '2022-08-03 20:19:45', '2022-08-03 20:19:45'),
(110, 30, '2023-05-01', 'Pendiente', 160000, 0, 'modificacion 2', '2022-08-03 20:19:45', '2022-08-03 20:19:45'),
(112, 28, '2023-03-01', 'Pendiente', 190000, 0, 'Cambios2', '2022-08-03 20:26:56', '2022-08-03 20:26:56'),
(116, 28, '2023-03-01', 'Pendiente', 194000, 0, 'cambiossss', '2022-08-03 20:30:44', '2022-08-03 20:30:44'),
(129, 26, '2023-01-01', 'Pendiente', 189000, 0, 'Saldo por Mora.', '2022-08-03 22:58:30', '2022-08-03 22:58:30'),
(130, 29, '2023-04-01', 'Pendiente', 280000, 0, 'Actualizando', '2022-08-03 23:02:14', '2022-08-03 23:02:14'),
(131, 21, '2023-01-20', 'Pendiente', 180000, 0, 'Cuotas Iniciales Año 2023.', '2022-08-03 23:05:18', '2022-08-03 23:05:18'),
(132, 22, '2023-02-20', 'Pendiente', 180000, 0, 'Cuotas Iniciales Año 2023.', '2022-08-03 23:05:19', '2022-08-03 23:05:19'),
(133, 23, '2023-03-20', 'Pendiente', 180000, 0, 'Cuotas Iniciales Año 2023.', '2022-08-03 23:05:19', '2022-08-03 23:05:19'),
(134, 24, '2023-04-20', 'Pendiente', 180000, 0, 'Cuotas Iniciales Año 2023.', '2022-08-03 23:05:19', '2022-08-03 23:05:19'),
(136, 26, '2023-06-20', 'Pendiente', 180000, 0, 'Cuotas Iniciales Año 2023.', '2022-08-03 23:05:20', '2022-08-03 23:05:20'),
(137, 27, '2023-07-20', 'Pendiente', 180000, 0, 'Cuotas Iniciales Año 2023.', '2022-08-03 23:05:20', '2022-08-03 23:05:20'),
(138, 28, '2023-08-20', 'Pendiente', 180000, 0, 'Cuotas Iniciales Año 2023.', '2022-08-03 23:05:21', '2022-08-03 23:05:21'),
(139, 29, '2023-09-20', 'Pendiente', 180000, 0, 'Cuotas Iniciales Año 2023.', '2022-08-03 23:05:21', '2022-08-03 23:05:21'),
(140, 30, '2023-10-20', 'Pendiente', 180000, 0, 'Cuotas Iniciales Año 2023.', '2022-08-03 23:05:21', '2022-08-03 23:05:21'),
(141, 26, '2023-10-20', 'Pendiente', 200000, 0, 'Reintegro', '2022-08-03 23:06:48', '2022-08-03 23:06:48'),
(143, 28, '2024-12-20', 'Pendiente', 200000, 0, 'Reintegro', '2022-08-03 23:06:49', '2022-08-03 23:06:49'),
(144, 29, '2024-01-20', 'Pendiente', 200000, 0, 'Reintegro', '2022-08-03 23:06:49', '2022-08-03 23:06:49'),
(145, 30, '2024-02-20', 'Pendiente', 200000, 0, 'Reintegro', '2022-08-03 23:06:49', '2022-08-03 23:06:49'),
(146, 26, '2022-08-02', 'Pendiente', 200000, 0, 'modificando', '2022-08-05 02:56:33', '2022-08-05 02:56:33'),
(147, 27, '2022-08-03', 'Pendiente', 180000, 0, 'nuevooo', '2022-08-05 02:57:04', '2022-08-05 02:57:04'),
(148, 28, '2022-08-04', 'Pendiente', 200000, 0, 'Actualizacion de fecha', '2022-08-05 03:10:56', '2022-08-05 03:10:56'),
(149, 26, '2022-08-06', 'Pendiente', 200000, 0, 'new', '2022-08-05 03:44:04', '2022-08-05 03:44:04'),
(150, 26, '2022-08-03', 'Pendiente', 200000, 0, 'new', '2022-08-05 03:46:49', '2022-08-05 03:46:49'),
(151, 26, '2022-08-06', 'Pendiente', 200000, 0, 'cambioo', '2022-08-05 20:36:02', '2022-08-05 20:36:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_07_14_161110_create_costs_table', 1),
(6, '2022_07_15_003458_create_consecutives_table', 1),
(7, '2022_07_18_032601_password_privileges', 1),
(8, '2022_07_18_201138_create_conceptos_table', 1),
(9, '2022_07_18_201209_create_elaborados_table', 1),
(10, '2022_07_18_201233_create_debes_table', 1),
(11, '2022_07_18_201248_create_habers_table', 1),
(12, '2022_07_19_174204_create_entries_table', 1),
(13, '2022_07_22_185301_create_otros_conceptos_table', 1),
(14, '2022_07_22_204818_create_other_entries_table', 1),
(15, '2022_07_29_215418_create_purses_table', 1),
(16, '2022_08_01_160919_create_history_purses_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `other_entries`
--

CREATE TABLE `other_entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cost` bigint(20) UNSIGNED NOT NULL,
  `concepto` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_recibo` bigint(20) NOT NULL,
  `fecha_recibo` date NOT NULL,
  `valor` bigint(20) NOT NULL,
  `elaborado_por` bigint(20) UNSIGNED NOT NULL,
  `debe` bigint(20) UNSIGNED NOT NULL,
  `haber` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `other_entries`
--

INSERT INTO `other_entries` (`id`, `id_cost`, `concepto`, `descripcion`, `no_recibo`, `fecha_recibo`, `valor`, `elaborado_por`, `debe`, `haber`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'uniforme efectivo', 10025, '2022-08-04', 20000, 1, 1, 1, '2022-08-05 01:29:18', '2022-08-05 01:29:18'),
(2, 1, 1, 'efectivo2', 10026, '2022-08-04', 50000, 1, 1, 1, '2022-08-05 01:33:24', '2022-08-05 01:33:24'),
(3, 1, 1, 'Efectivo', 10027, '2022-08-04', 50000, 1, 1, 1, '2022-08-05 01:48:32', '2022-08-05 01:48:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `otros_conceptos`
--

CREATE TABLE `otros_conceptos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `otros_conceptos`
--

INSERT INTO `otros_conceptos` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Uniforme', 1, '2022-08-01 16:12:19', '2022-08-01 16:12:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_privileges`
--

CREATE TABLE `password_privileges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_privileges`
--

INSERT INTO `password_privileges` (`id`, `password`, `created_at`, `updated_at`) VALUES
(1, '*admin*', '2022-08-01 16:12:19', '2022-08-01 16:12:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purses`
--

CREATE TABLE `purses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cost` bigint(20) UNSIGNED NOT NULL,
  `fecha_pago` date NOT NULL,
  `estado` enum('Al dia','Pendiente','En mora','Pago Extraordinario') COLLATE utf8mb4_unicode_ci NOT NULL,
  `cuota` bigint(20) NOT NULL,
  `abonado` bigint(20) NOT NULL,
  `comentario` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `purses`
--

INSERT INTO `purses` (`id`, `id_cost`, `fecha_pago`, `estado`, `cuota`, `abonado`, `comentario`, `created_at`, `updated_at`) VALUES
(21, 1, '2023-01-20', 'Pendiente', 180000, 0, 'Cuotas Iniciales Año 2023.', '2022-08-03 20:17:18', '2022-08-03 23:05:18'),
(22, 1, '2023-02-20', 'Pendiente', 180000, 0, 'Cuotas Iniciales Año 2023.', '2022-08-03 20:17:18', '2022-08-03 23:05:19'),
(23, 1, '2023-03-20', 'Pendiente', 180000, 0, 'Cuotas Iniciales Año 2023.', '2022-08-03 20:17:19', '2022-08-03 23:05:19'),
(24, 1, '2023-04-20', 'Pendiente', 180000, 0, 'Cuotas Iniciales Año 2023.', '2022-08-03 20:17:20', '2022-08-03 23:05:19'),
(25, 1, '2023-12-01', 'Pendiente', 130000, 0, 'Fecha de pago establecidas con sus cuotas iniciales.', '2022-08-03 20:17:20', '2022-08-04 00:21:04'),
(26, 1, '2022-08-06', 'Pendiente', 200000, 0, 'cambioo', '2022-08-03 20:17:20', '2022-08-05 20:36:02'),
(27, 1, '2022-08-03', 'Pendiente', 180000, 0, 'nuevooo', '2022-08-03 20:17:21', '2022-08-05 02:57:04'),
(28, 1, '2022-08-04', 'Pendiente', 200000, 0, 'Actualizacion de fecha', '2022-08-03 20:17:21', '2022-08-05 03:10:56'),
(29, 1, '2024-01-20', 'Pendiente', 200000, 0, 'Reintegro', '2022-08-03 20:17:22', '2022-08-03 23:06:49'),
(30, 1, '2024-02-20', 'Pendiente', 200000, 0, 'Reintegro', '2022-08-03 20:17:22', '2022-08-03 23:06:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Sebastyan Enrique Pineda Aguilera', 'sepipiag@gmail.com', NULL, '$2y$10$asxUWqbUHUEx5q8QskLd4Ozvh9O6zFdlIdO2IzjuECGXeN6LHjRga', NULL, '2022-08-01 16:12:18', '2022-08-01 16:12:18');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `conceptos`
--
ALTER TABLE `conceptos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consecutives`
--
ALTER TABLE `consecutives`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `costs`
--
ALTER TABLE `costs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `costs_cod_alumno_unique` (`cod_alumno`);

--
-- Indices de la tabla `debes`
--
ALTER TABLE `debes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `elaborados`
--
ALTER TABLE `elaborados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entries_id_cost_foreign` (`id_cost`),
  ADD KEY `entries_concepto_foreign` (`concepto`),
  ADD KEY `entries_elaborado_por_foreign` (`elaborado_por`),
  ADD KEY `entries_debe_foreign` (`debe`),
  ADD KEY `entries_haber_foreign` (`haber`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `habers`
--
ALTER TABLE `habers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `history_purses`
--
ALTER TABLE `history_purses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `history_purses_id_purse_foreign` (`id_purse`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `other_entries`
--
ALTER TABLE `other_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `other_entries_id_cost_foreign` (`id_cost`),
  ADD KEY `other_entries_concepto_foreign` (`concepto`),
  ADD KEY `other_entries_elaborado_por_foreign` (`elaborado_por`),
  ADD KEY `other_entries_debe_foreign` (`debe`),
  ADD KEY `other_entries_haber_foreign` (`haber`);

--
-- Indices de la tabla `otros_conceptos`
--
ALTER TABLE `otros_conceptos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_privileges`
--
ALTER TABLE `password_privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `purses`
--
ALTER TABLE `purses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purses_id_cost_foreign` (`id_cost`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `conceptos`
--
ALTER TABLE `conceptos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `consecutives`
--
ALTER TABLE `consecutives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `costs`
--
ALTER TABLE `costs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `debes`
--
ALTER TABLE `debes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `elaborados`
--
ALTER TABLE `elaborados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `entries`
--
ALTER TABLE `entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `habers`
--
ALTER TABLE `habers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `history_purses`
--
ALTER TABLE `history_purses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `other_entries`
--
ALTER TABLE `other_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `otros_conceptos`
--
ALTER TABLE `otros_conceptos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `password_privileges`
--
ALTER TABLE `password_privileges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `purses`
--
ALTER TABLE `purses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `entries_concepto_foreign` FOREIGN KEY (`concepto`) REFERENCES `conceptos` (`id`),
  ADD CONSTRAINT `entries_debe_foreign` FOREIGN KEY (`debe`) REFERENCES `debes` (`id`),
  ADD CONSTRAINT `entries_elaborado_por_foreign` FOREIGN KEY (`elaborado_por`) REFERENCES `elaborados` (`id`),
  ADD CONSTRAINT `entries_haber_foreign` FOREIGN KEY (`haber`) REFERENCES `habers` (`id`),
  ADD CONSTRAINT `entries_id_cost_foreign` FOREIGN KEY (`id_cost`) REFERENCES `costs` (`id`);

--
-- Filtros para la tabla `history_purses`
--
ALTER TABLE `history_purses`
  ADD CONSTRAINT `history_purses_id_purse_foreign` FOREIGN KEY (`id_purse`) REFERENCES `purses` (`id`);

--
-- Filtros para la tabla `other_entries`
--
ALTER TABLE `other_entries`
  ADD CONSTRAINT `other_entries_concepto_foreign` FOREIGN KEY (`concepto`) REFERENCES `otros_conceptos` (`id`),
  ADD CONSTRAINT `other_entries_debe_foreign` FOREIGN KEY (`debe`) REFERENCES `debes` (`id`),
  ADD CONSTRAINT `other_entries_elaborado_por_foreign` FOREIGN KEY (`elaborado_por`) REFERENCES `elaborados` (`id`),
  ADD CONSTRAINT `other_entries_haber_foreign` FOREIGN KEY (`haber`) REFERENCES `habers` (`id`),
  ADD CONSTRAINT `other_entries_id_cost_foreign` FOREIGN KEY (`id_cost`) REFERENCES `costs` (`id`);

--
-- Filtros para la tabla `purses`
--
ALTER TABLE `purses`
  ADD CONSTRAINT `purses_id_cost_foreign` FOREIGN KEY (`id_cost`) REFERENCES `costs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
