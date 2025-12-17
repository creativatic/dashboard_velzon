-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.4.3 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla ventas_seven.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.cache: ~0 rows (aproximadamente)
INSERT IGNORE INTO `cache` (`key`, `value`, `expiration`) VALUES
	('laravel-cache-spatie.permission.cache', 'a:3:{s:5:"alias";a:4:{s:1:"a";s:2:"id";s:1:"b";s:4:"name";s:1:"c";s:10:"guard_name";s:1:"r";s:5:"roles";}s:11:"permissions";a:16:{i:0;a:4:{s:1:"a";i:1;s:1:"b";s:13:"ver dashboard";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:1;a:4:{s:1:"a";i:2;s:1:"b";s:12:"ver usuarios";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:"a";i:3;s:1:"b";s:13:"crear usuario";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:3;a:4:{s:1:"a";i:4;s:1:"b";s:14:"editar usuario";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:4;a:4:{s:1:"a";i:5;s:1:"b";s:16:"eliminar usuario";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:5;a:4:{s:1:"a";i:6;s:1:"b";s:9:"ver roles";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:6;a:4:{s:1:"a";i:7;s:1:"b";s:9:"crear rol";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:7;a:4:{s:1:"a";i:8;s:1:"b";s:10:"editar rol";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:8;a:4:{s:1:"a";i:9;s:1:"b";s:12:"eliminar rol";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:9;a:4:{s:1:"a";i:10;s:1:"b";s:12:"ver permisos";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:10;a:4:{s:1:"a";i:11;s:1:"b";s:13:"crear permiso";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:11;a:4:{s:1:"a";i:12;s:1:"b";s:14:"editar permiso";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:12;a:4:{s:1:"a";i:13;s:1:"b";s:16:"eliminar permiso";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:13;a:4:{s:1:"a";i:14;s:1:"b";s:18:"gestionar usuarios";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:14;a:4:{s:1:"a";i:15;s:1:"b";s:15:"gestionar roles";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:15;a:4:{s:1:"a";i:16;s:1:"b";s:18:"gestionar permisos";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}}s:5:"roles";a:2:{i:0;a:3:{s:1:"a";i:1;s:1:"b";s:13:"Administrador";s:1:"c";s:3:"web";}i:1;a:3:{s:1:"a";i:2;s:1:"b";s:8:"Contador";s:1:"c";s:3:"web";}}}', 1764703235);

-- Volcando estructura para tabla ventas_seven.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.cache_locks: ~0 rows (aproximadamente)

-- Volcando estructura para tabla ventas_seven.conductores
CREATE TABLE IF NOT EXISTS `conductores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `dni` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `licencia` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombres` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.conductores: ~3 rows (aproximadamente)
INSERT IGNORE INTO `conductores` (`id`, `dni`, `licencia`, `nombres`, `apellidos`, `telefono`, `created_at`, `updated_at`) VALUES
	(1, '61420602', 'AIIIB-578094', 'Oscar 16', 'Perez 58', '967338042', '2025-12-01 23:02:31', '2025-12-01 23:02:31'),
	(2, '86185016', 'AIIIB-852622', 'Pedro 21', 'Perez 56', '926624771', '2025-12-01 23:02:31', '2025-12-01 23:02:31'),
	(3, '49727512', 'AIIIB-541199', 'Juan 41', 'Perez 72', '921680185', '2025-12-01 23:02:31', '2025-12-01 23:02:31');

-- Volcando estructura para tabla ventas_seven.conductor_unidad
CREATE TABLE IF NOT EXISTS `conductor_unidad` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `conductor_id` bigint unsigned NOT NULL,
  `unidad_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `conductor_unidad_conductor_id_unidad_id_unique` (`conductor_id`,`unidad_id`),
  KEY `conductor_unidad_unidad_id_foreign` (`unidad_id`),
  CONSTRAINT `conductor_unidad_conductor_id_foreign` FOREIGN KEY (`conductor_id`) REFERENCES `conductores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `conductor_unidad_unidad_id_foreign` FOREIGN KEY (`unidad_id`) REFERENCES `unidades` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.conductor_unidad: ~5 rows (aproximadamente)
INSERT IGNORE INTO `conductor_unidad` (`id`, `conductor_id`, `unidad_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2025-12-01 23:02:31', '2025-12-01 23:02:31'),
	(2, 2, 2, '2025-12-01 23:02:31', '2025-12-01 23:02:31'),
	(3, 3, 3, '2025-12-01 23:02:31', '2025-12-01 23:02:31');

-- Volcando estructura para tabla ventas_seven.detalle_programacions
CREATE TABLE IF NOT EXISTS `detalle_programacions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `frente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio_frente` decimal(10,2) NOT NULL,
  `precio_tn` decimal(10,4) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.detalle_programacions: ~3 rows (aproximadamente)
INSERT IGNORE INTO `detalle_programacions` (`id`, `frente`, `precio_frente`, `precio_tn`, `activo`, `descripcion`, `created_at`, `updated_at`) VALUES
	(1, 'Huanaco', 4500.00, 0.1240, 1, 'Frente Huanaco: zona con mayor carga y mejor acceso, precio estándar establecido según contrato 2025.', '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(2, 'Intikal', 3500.00, 0.1220, 1, 'Frente Intikal: área de menor tonelaje, precio ajustado para rutas de menor productividad.', '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(3, 'Intikal 0.095', 3500.00, 0.0950, 1, 'Frente Intikal: área de menor tonelaje, precio ajustado para rutas de menor productividad.', '2025-12-01 23:02:30', '2025-12-01 23:02:30');

-- Volcando estructura para tabla ventas_seven.expedientes
CREATE TABLE IF NOT EXISTS `expedientes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tisur_id` bigint unsigned DEFAULT NULL,
  `programacion_id` bigint unsigned DEFAULT NULL,
  `numero_factura_exped` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `detraccion` decimal(10,2) DEFAULT NULL,
  `estado_pago_detraccion` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_con_detraccion` decimal(10,2) DEFAULT NULL,
  `deposito_a_proveer` decimal(10,2) DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `fecha_carga` date DEFAULT NULL,
  `conformidad_exped` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comentarios` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expedientes_tisur_id_foreign` (`tisur_id`),
  KEY `expedientes_programacion_id_foreign` (`programacion_id`),
  CONSTRAINT `expedientes_programacion_id_foreign` FOREIGN KEY (`programacion_id`) REFERENCES `programacions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `expedientes_tisur_id_foreign` FOREIGN KEY (`tisur_id`) REFERENCES `tisurs` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.expedientes: ~2 rows (aproximadamente)
INSERT IGNORE INTO `expedientes` (`id`, `tisur_id`, `programacion_id`, `numero_factura_exped`, `total`, `detraccion`, `estado_pago_detraccion`, `total_con_detraccion`, `deposito_a_proveer`, `fecha_pago`, `fecha_carga`, `conformidad_exped`, `archivo`, `comentarios`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 'E001-181', 4526.23, 123.23, NULL, NULL, NULL, '2025-10-17', '2025-10-16', NULL, NULL, 'test test test', '2025-10-17 02:05:16', '2025-10-17 02:05:16');

-- Volcando estructura para tabla ventas_seven.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.failed_jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla ventas_seven.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla ventas_seven.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.job_batches: ~0 rows (aproximadamente)

-- Volcando estructura para tabla ventas_seven.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.migrations: ~0 rows (aproximadamente)
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_09_30_170647_create_permission_tables', 1),
	(5, '2025_10_09_211332_create_detalle_programacions_table', 1),
	(6, '2025_10_09_211334_create_proveedores_table', 1),
	(7, '2025_10_09_211335_create_unidades_table', 1),
	(8, '2025_10_09_211337_create_conductores_table', 1),
	(9, '2025_10_09_211338_create_tisurs_table', 1),
	(10, '2025_10_09_211339_create_programacions_table', 1),
	(11, '2025_10_09_211340_create_expedientes_table', 1),
	(12, '2025_10_11_143216_create_seguimientos_table', 1),
	(13, '2025_11_28_125305_create_conductor_unidad_table', 1);

-- Volcando estructura para tabla ventas_seven.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.model_has_permissions: ~0 rows (aproximadamente)

-- Volcando estructura para tabla ventas_seven.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.model_has_roles: ~2 rows (aproximadamente)
INSERT IGNORE INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(2, 'App\\Models\\User', 2);

-- Volcando estructura para tabla ventas_seven.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.password_reset_tokens: ~0 rows (aproximadamente)

-- Volcando estructura para tabla ventas_seven.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.permissions: ~2 rows (aproximadamente)
INSERT IGNORE INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'ver dashboard', 'web', '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(2, 'ver usuarios', 'web', '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(3, 'crear usuario', 'web', '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(4, 'editar usuario', 'web', '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(5, 'eliminar usuario', 'web', '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(6, 'ver roles', 'web', '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(7, 'crear rol', 'web', '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(8, 'editar rol', 'web', '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(9, 'eliminar rol', 'web', '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(10, 'ver permisos', 'web', '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(11, 'crear permiso', 'web', '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(12, 'editar permiso', 'web', '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(13, 'eliminar permiso', 'web', '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(14, 'gestionar usuarios', 'web', '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(15, 'gestionar roles', 'web', '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(16, 'gestionar permisos', 'web', '2025-12-01 23:02:30', '2025-12-01 23:02:30');

-- Volcando estructura para tabla ventas_seven.programacions
CREATE TABLE IF NOT EXISTS `programacions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fecha_programacion` datetime NOT NULL,
  `guia_remision` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_mineral` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_operacion` enum('nacional','internacional') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conformidad_adelanto` enum('Ok','Pendiente') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guia_transportista` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grupo_cargio` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monto_adelanto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `fecha_pago_adelantos` date DEFAULT NULL,
  `glosa_banco` text COLLATE utf8mb4_unicode_ci,
  `notas` text COLLATE utf8mb4_unicode_ci,
  `detalle_programacion_id` bigint unsigned DEFAULT NULL,
  `proveedor_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `programacions_detalle_programacion_id_foreign` (`detalle_programacion_id`),
  KEY `programacions_proveedor_id_foreign` (`proveedor_id`),
  CONSTRAINT `programacions_detalle_programacion_id_foreign` FOREIGN KEY (`detalle_programacion_id`) REFERENCES `detalle_programacions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `programacions_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.programacions: ~2 rows (aproximadamente)
INSERT IGNORE INTO `programacions` (`id`, `fecha_programacion`, `guia_remision`, `tipo_mineral`, `tipo_operacion`, `conformidad_adelanto`, `guia_transportista`, `grupo_cargio`, `monto_adelanto`, `fecha_pago_adelantos`, `glosa_banco`, `notas`, `detalle_programacion_id`, `proveedor_id`, `created_at`, `updated_at`) VALUES
	(1, '2025-12-01 18:02:00', 'EG07 - 00003332', 'HIERRO GRANULADO', 'nacional', 'Pendiente', 'EG03 - 00000170', 'Carguio 01,12', 1200.50, '2025-12-01', 'Transferencia registrada', 'Adelanto procesado correctamente', 1, 1, '2025-12-01 23:02:30', '2025-12-02 00:21:56'),
	(2, '2025-12-01 18:02:00', 'FG09 - 00006662', 'HIERRO GRANULADO', 'nacional', 'Ok', 'EG03 - 00000170', 'Carguio 13,09', 0.00, NULL, 'Pendiente', 'Pendiente de transferencia bancaria', 1, 2, '2025-12-01 23:02:30', '2025-12-02 00:24:49');

-- Volcando estructura para tabla ventas_seven.proveedores
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruc_transporte` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cuenta_banco` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cci_banco` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banco` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.proveedores: ~5 rows (aproximadamente)
INSERT IGNORE INTO `proveedores` (`id`, `razon_social`, `ruc_transporte`, `cuenta_banco`, `cci_banco`, `banco`, `created_at`, `updated_at`) VALUES
	(1, 'TRANSPORTES EL AGUILA S.A.C.', '20601234567', '123-45678901', '00212345678901234567', 'BCP', '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(2, 'LOGISTICA MINERA PERU S.R.L.', '20599876543', '456-98765432', '00298765432109876543', 'Interbank', '2025-12-01 23:02:31', '2025-12-01 23:02:31'),
	(3, 'TRANSPORTES VIRGEN DEL CARMEN E.I.R.L.', '20456789321', '789-12345678', '00245678912345678901', 'BBVA', '2025-12-01 23:02:31', '2025-12-01 23:02:31');

-- Volcando estructura para tabla ventas_seven.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.roles: ~2 rows (aproximadamente)
INSERT IGNORE INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador', 'web', '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(2, 'Contador', 'web', '2025-12-01 23:02:30', '2025-12-01 23:02:30');

-- Volcando estructura para tabla ventas_seven.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.role_has_permissions: ~18 rows (aproximadamente)
INSERT IGNORE INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(1, 2),
	(2, 2);

-- Volcando estructura para tabla ventas_seven.seguimientos
CREATE TABLE IF NOT EXISTS `seguimientos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `programacion_id` bigint unsigned NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notas` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seguimientos_programacion_id_foreign` (`programacion_id`),
  CONSTRAINT `seguimientos_programacion_id_foreign` FOREIGN KEY (`programacion_id`) REFERENCES `programacions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.seguimientos: ~0 rows (aproximadamente)

-- Volcando estructura para tabla ventas_seven.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.sessions: ~3 rows (aproximadamente)
INSERT IGNORE INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('HQtslVkJmCgDdUvCWJOTweyI7NbkKmvU0WyuyOVg', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWkdzZ2xyMW1JZWgxc3hXYmtzZ0VZUHdGeGliUUUyMXlnZmZLWWdIdSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcHJvZ3JhbWFjaW9ucyI7czo1OiJyb3V0ZSI7czoxOToicHJvZ3JhbWFjaW9ucy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1764617127);

-- Volcando estructura para tabla ventas_seven.tisurs
CREATE TABLE IF NOT EXISTS `tisurs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `numero_ticket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proveedor_id` bigint unsigned DEFAULT NULL,
  `fecha_hora_ingreso` datetime DEFAULT NULL,
  `placa_tracto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_hora_salida` datetime DEFAULT NULL,
  `primer_peso` decimal(20,5) DEFAULT NULL,
  `segundo_peso` decimal(20,5) DEFAULT NULL,
  `razon_social` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transportista` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_carga_tisur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_bultos` decimal(8,2) DEFAULT NULL,
  `peso_neto` decimal(20,5) DEFAULT NULL,
  `tipo_plataforma` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documento_origen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio_tisur` decimal(20,5) DEFAULT NULL,
  `total_tisur` decimal(20,5) DEFAULT NULL,
  `retencion_tisur` decimal(20,5) DEFAULT NULL,
  `pago_tisur` decimal(20,5) DEFAULT NULL,
  `factura_tisur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pendiente',
  `fecha_pago` date DEFAULT NULL,
  `orden_tisur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tisurs_numero_ticket_unique` (`numero_ticket`),
  KEY `tisurs_proveedor_id_foreign` (`proveedor_id`),
  CONSTRAINT `tisurs_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.tisurs: ~4 rows (aproximadamente)
INSERT IGNORE INTO `tisurs` (`id`, `numero_ticket`, `proveedor_id`, `fecha_hora_ingreso`, `placa_tracto`, `fecha_hora_salida`, `primer_peso`, `segundo_peso`, `razon_social`, `transportista`, `tipo_carga_tisur`, `numero_bultos`, `peso_neto`, `tipo_plataforma`, `documento_origen`, `precio_tisur`, `total_tisur`, `retencion_tisur`, `pago_tisur`, `factura_tisur`, `estado`, `fecha_pago`, `orden_tisur`, `created_at`, `updated_at`) VALUES
	(1, 'MB01883333', NULL, '2025-10-16 16:36:00', 'V9C-705', '2025-10-17 16:36:00', 40380.00000, 40380.00000, 'SEVEN SEAS PERU MINERAL S.A.C.', 'TRANS. JULICES C & H R.R.L.', 'MINERAL DE HIERRO', 40380.00, 40380.00000, 'METALERO', 'SSPM 05.25 - B&H', 0.07195, 2501.54000, 125.08000, 2376.46000, 'E001-835', 'Pendiente', '2025-10-30', 'P0015-006', NULL, NULL),
	(2, 'MB00002222', NULL, '2025-10-16 16:36:00', 'BVN-781', '2025-10-16 08:14:00', 46310.00000, 46310.00000, 'SEVEN SEAS PERU MINERAL S.A.C.', 'TRANS. JULICES C & H R.R.L.', 'MINERAL DE HIERRO', 40380.00, 46310.00000, 'AUTODESCARGABLE', 'SSPM 05.25 - B&H', 0.06195, 2501.54000, 125.08000, 2376.46000, '-', 'Pendiente', '2025-10-30', 'P0015-006', NULL, NULL);

-- Volcando estructura para tabla ventas_seven.unidades
CREATE TABLE IF NOT EXISTS `unidades` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `placa_tracto` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `placa_carreta` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marca_vehiculo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_plataforma` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `constancia_mtc_tracto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `constancia_mtc_carreta` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `proveedor_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `unidades_proveedor_id_foreign` (`proveedor_id`),
  CONSTRAINT `unidades_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.unidades: ~3 rows (aproximadamente)
INSERT IGNORE INTO `unidades` (`id`, `placa_tracto`, `placa_carreta`, `marca_vehiculo`, `tipo_plataforma`, `constancia_mtc_tracto`, `constancia_mtc_carreta`, `deleted_at`, `proveedor_id`, `created_at`, `updated_at`) VALUES
	(1, 'ABC-532', 'XYZ-579', 'Volvo', 'FURGÓN', 'MTC-74446', 'MTC-28603', NULL, 1, '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(2, 'ABC-941', 'XYZ-282', 'Volvo', 'FURGÓN', 'MTC-26039', 'MTC-27744', NULL, 2, '2025-12-01 23:02:31', '2025-12-01 23:02:31'),
	(3, 'ABC-392', 'XYZ-757', 'Volvo', 'FURGÓN', 'MTC-58655', 'MTC-44977', NULL, 3, '2025-12-01 23:02:31', '2025-12-01 23:02:31');

-- Volcando estructura para tabla ventas_seven.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas_seven.users: ~2 rows (aproximadamente)
INSERT IGNORE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador General', 'admin@gmail.com', NULL, '$2y$12$QzHsUuFWJ9Ao48MMqQl3.e27tKC1/gSwmLsFxcx9mzl8Cau9maEf2', NULL, '2025-12-01 23:02:30', '2025-12-01 23:02:30'),
	(2, 'Usuario Contador', 'contador@gmail.com', NULL, '$2y$12$oqmFXEI5XXLGwAIAqKEB.OX2aWzizrSTle5OHq99oEhPfCJu9gUFG', NULL, '2025-12-01 23:02:30', '2025-12-01 23:02:30');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;


DELETE FROM conductores;
ALTER TABLE conductores AUTO_INCREMENT = 1;

DELETE FROM proveedores;
ALTER TABLE proveedores AUTO_INCREMENT = 1;