--
-- Estructura de tabla para la tabla `dgn_app_config`
--

CREATE TABLE `dgn_app_config` (
  `key` varchar(50) NOT NULL,
  `value` varchar(500) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dgn_app_config`
--

INSERT INTO `dgn_app_config` (`key`, `value`) VALUES
('address', '123 Nowhere street'),
('company', 'Your company\'s name'),
('company_logo', ''),
('email', 'changeme@example.com'),
('fax', ''),
('language', 'spanish'),
('language_code', 'es'),
('lines_per_page', '25'),
('phone', '555-555-5555'),
('timezone', 'America/Mexico_City'),
('website', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dgn_contacts`
--

CREATE TABLE `dgn_contacts` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` int(1) DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `comments` text NOT NULL,
  `read` int(1) DEFAULT '0',
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dgn_contacts`
--

INSERT INTO `dgn_contacts` (`contact_id`, `first_name`, `last_name`, `gender`, `phone_number`, `email`, `title`, `comments`, `read`, `deleted`) VALUES
(1, 'digyna', 'cms', 1, '555-555-55-55', 'mail@example.com', 'Hola!, Esto es un correo desde contacto', 'Para poder administrar, todos los correos, por favor visita la pantalla de contacto en el escritorio.', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dgn_customers`
--

CREATE TABLE `dgn_customers` (
  `person_id` int(10) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `rfc` varchar(15) DEFAULT NULL,
  `taxable` int(1) NOT NULL DEFAULT '1',
  `discount_percent` decimal(15,2) NOT NULL DEFAULT '0.00',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hash_version` int(1) NOT NULL DEFAULT '1',
  `deleted` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `rfc` (`rfc`),
  UNIQUE KEY `username` (`username`),
  KEY `person_id` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dgn_grants`
--

CREATE TABLE `dgn_grants` (
  `permission_id` varchar(255) NOT NULL,
  `person_id` int(10) NOT NULL,
  PRIMARY KEY (`permission_id`,`person_id`),
  KEY `dgn_grants_ibfk_2` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dgn_grants`
--

INSERT INTO `dgn_grants` (`permission_id`, `person_id`) VALUES
('home', 1),
('adverts', 1),
('adverts_banners', 1),
('adverts_sliders', 1),
('post', 1),
('media', 1),
('pages', 1),
('products', 1),
('sales', 1),
('customers', 1),
('customers_add', 1),
('customers_customers', 1),
('profile', 1),
('users', 1),
('users_add', 1),
('users_users', 1),
('contact', 1),
('events', 1),
('themes', 1),
('plugins', 1),
('config', 1),
('changelogs', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dgn_modules`
--

CREATE TABLE `dgn_modules` (
  `name_lang_key` VARCHAR(255) NOT NULL,
  `desc_lang_key` VARCHAR(255) NOT NULL,
  `sort` INT(10) NOT NULL,
  `module_id` VARCHAR(255) NOT NULL,
  `module_icon` VARCHAR(255) NOT NULL DEFAULT '',
  `status` INT(10) NULL DEFAULT '0',
  PRIMARY KEY (`module_id`),
  UNIQUE INDEX `name_lang_key` (`name_lang_key`),
  UNIQUE INDEX `desc_lang_key` (`desc_lang_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dgn_modules`
--

INSERT INTO `dgn_modules` (`name_lang_key`, `desc_lang_key`, `sort`, `module_id`, `module_icon`, `status`) VALUES
('module_home', 'module_home_desc', 1, 'home', 'home', 0),
('module_adverts', 'module_adverts_desc', 2, 'adverts', 'cast', 1),
('module_post', 'module_post_desc', 3, 'post', 'book', 1),
('module_media', 'module_media_desc', 4, 'media', 'perm_media', 1),
('module_pages', 'module_pages_desc', 5, 'pages', 'content_copy', 1),
('module_products', 'module_products_desc', 6, 'products', 'shopping_basket', 1),
('module_sales', 'module_sales_desc', 7, 'sales', 'shopping_cart', 1),
('module_customers', 'module_customers_desc', 8, 'customers', 'people', 1),
('module_users', 'module_users_desc', 9, 'users', 'supervisor_account', 1),
('module_profile', 'module_profile_desc', 10, 'profile', 'person', 1),
('module_contact', 'module_contact_desc', 11, 'contact', 'mail', 1),
('module_events', 'module_events_desc', 12, 'events', 'event', 1),
('module_themes', 'module_themes_desc', 13, 'themes', 'brush', 1),
('module_plugins', 'module_plugins_desc', 14, 'plugins', 'extension', 1),
('module_config', 'module_config_desc', 15, 'config', 'settings', 1),
('module_changelogs', 'module_changelogs_desc', 16, 'changelogs', 'update', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dgn_people`
--

CREATE TABLE `dgn_people` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` int(1) DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `person_id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`person_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dgn_people`
--

INSERT INTO `dgn_people` (`first_name`, `last_name`, `phone_number`, `email`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `person_id`) VALUES
('admin', '.', '555-555-5555', 'demo@demo.com', 'Address 1', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dgn_permissions`
--

CREATE TABLE `dgn_permissions` (
  `permission_id` VARCHAR(255) NOT NULL,
  `module_id` VARCHAR(255) NOT NULL,
  `item_sort` INT(10) NOT NULL DEFAULT '0',
  `show_menu` INT(10) NULL DEFAULT '0',
  PRIMARY KEY (`permission_id`),
  INDEX `module_id` (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dgn_permissions`
--

INSERT INTO `dgn_permissions` (`permission_id`, `module_id`, `item_sort`, `show_menu`) VALUES
('home', 'home', 0, 0),
('adverts', 'adverts', 0, 0),
('adverts_banners', 'adverts', 1, 1),
('adverts_sliders', 'adverts', 2, 1),
('post', 'post', 0, 0),
('media', 'media', 0, 0),
('pages', 'pages', 0, 0),
('products', 'products', 0, 0),
('sales', 'sales', 0, 0),
('customers', 'customers', 0, 0),
('customers_customers', 'customers', 1, 1),
('customers_add', 'customers', 2, 1),
('profile', 'profile', 3, 0),
('users', 'users', 0, 0),
('users_users', 'users', 1, 1),
('users_add', 'users', 2, 1),
('contact', 'contact', 0, 0),
('events', 'events', 0, 0),
('themes', 'themes', 0, 0),
('plugins', 'plugins', 0, 0),
('config', 'config', 0, 0),
('changelogs', 'changelogs', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dgn_sessions`
--

CREATE TABLE `dgn_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dgn_users`
--

CREATE TABLE `dgn_users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `person_id` int(10) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `hash_version` int(1) NOT NULL DEFAULT '2',
  UNIQUE KEY `username` (`username`),
  KEY `person_id` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dgn_users`
--

INSERT INTO `dgn_users` (`username`, `password`, `person_id`, `deleted`, `hash_version`) VALUES
('admin', '$2y$10$dqrXH5ERqHNSs9KAxW8Cu.aiFLPEstw4tBER08L71NOCURWgiBoq.', 1, 0, 2);

