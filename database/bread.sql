SET GLOBAL FOREIGN_KEY_CHECKS=0;

TRUNCATE `api_keys`;
TRUNCATE `api_types`;
TRUNCATE `data_rows`;
TRUNCATE `data_types`;
TRUNCATE `menu_items`;
TRUNCATE `menus`;

TRUNCATE `notifications`;
TRUNCATE `roles`;
TRUNCATE `users`;
TRUNCATE `user_roles`;
TRUNCATE `permissions`;
TRUNCATE `permission_role`;
TRUNCATE `translations`;
TRUNCATE `settings`;

SET GLOBAL FOREIGN_KEY_CHECKS=1;


INSERT INTO `api_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `model_name`, `description`, `controller`, `paginate`, `created_at`, `updated_at`) VALUES
  (1, 'users', 'users', 'User', 'Users', 'App\\User', NULL, NULL, 1, '2018-06-28 04:36:27', '2018-06-28 04:36:27');



INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
  (1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', '', '', 1, 0, NULL, '2018-06-28 02:14:12', '2018-06-28 02:14:12'),
  (2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2018-06-28 02:14:13', '2018-06-28 02:14:13'),
  (3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, '', '', 1, 0, NULL, '2018-06-28 02:14:13', '2018-06-28 02:14:13'),
  (4, 'godowns', 'godowns', 'Godown', 'Godowns', 'icon-home-3', 'App\\Godown', NULL, 'GodownsController', NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null}', '2018-06-26 23:12:36', '2018-07-03 20:21:18'),
  (6, 'goods', 'goods', 'Good', 'Goods', 'voyager-puzzle', 'App\\Good', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null}', '2018-06-26 23:16:11', '2018-06-28 22:31:08'),
  (7, 'labours', 'labours', 'Labour', 'Labours', 'icon-users-3', 'App\\Labour', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null}', '2018-06-26 23:16:39', '2018-06-28 22:29:48'),
  (8, 'purchases', 'purchases', 'Purchase', 'Purchases', 'voyager-basket', 'App\\Purchase', NULL, 'PurchasesController', NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null}', '2018-06-26 23:17:46', '2018-07-02 00:36:23'),
  (9, 'sellers', 'sellers', 'Seller', 'Sellers', 'voyager-people', 'App\\Seller', NULL, 'SellersController', NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null}', '2018-06-26 23:18:30', '2018-06-29 06:15:21'),
  (11, 'site_transfers', 'site-transfers', 'Site Transfer', 'Site Transfers', 'icon-switch', 'App\\SiteTransfer', NULL, 'SiteTransfersController', NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null}', '2018-06-26 23:23:05', '2018-07-08 03:39:28'),
  (12, 'sites', 'sites', 'Site', 'Sites', 'voyager-milestone', 'App\\Site', NULL, 'SitesController', NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null}', '2018-06-26 23:28:45', '2018-07-05 04:32:08'),
  (13, 'statuses', 'statuses', 'Status', 'Statuses', 'icon-heartbeat', 'App\\Status', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null}', '2018-06-26 23:29:11', '2018-07-08 04:53:40');


INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
  (1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '', 1),
  (2, 1, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '', 2),
  (3, 1, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, '', 3),
  (4, 1, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 0, '', 4),
  (5, 1, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, '', 5),
  (6, 1, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '', 6),
  (7, 1, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '', 7),
  (8, 1, 'avatar', 'image', 'Avatar', 0, 1, 1, 1, 1, 1, '', 8),
  (9, 1, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":\"0\"}', 10),
  (10, 1, 'user_belongstomany_role_relationship', 'relationship', 'Roles', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', 11),
  (11, 1, 'locale', 'text', 'Locale', 0, 1, 1, 1, 1, 0, '', 12),
  (12, 1, 'settings', 'hidden', 'Settings', 0, 0, 0, 0, 0, 0, '', 12),
  (13, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '', 1),
  (14, 2, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '', 2),
  (15, 2, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '', 3),
  (16, 2, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '', 4),
  (17, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '', 1),
  (18, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '', 2),
  (19, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, '', 3),
  (20, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '', 4),
  (21, 3, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, '', 5),
  (22, 1, 'role_id', 'text', 'Role', 1, 1, 1, 1, 1, 1, '', 9),
  (23, 4, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
  (24, 4, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
  (25, 4, 'location', 'coordinates', 'Location', 1, 0, 1, 1, 1, 1, NULL, 3),
  (26, 4, 'address', 'text_area', 'Address', 1, 1, 1, 1, 1, 1, NULL, 4),
  (27, 4, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 5),
  (28, 4, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 6),
  (36, 6, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
  (37, 6, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
  (38, 6, 'details', 'text_area', 'Details', 1, 1, 1, 1, 1, 1, NULL, 3),
  (39, 6, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 4),
  (40, 6, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 5),
  (41, 7, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
  (42, 7, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
  (43, 7, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 1, NULL, 3),
  (44, 7, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 4),
  (45, 7, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 5),
  (46, 8, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
  (47, 8, 'seller_id', 'hidden', 'Seller Id', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required\"}}', 2),
  (49, 8, 'date', 'date', 'Date', 1, 1, 1, 1, 1, 1, NULL, 8),
  (52, 8, 'purchase_due', 'number', 'Purchase Due', 1, 1, 1, 1, 1, 1, NULL, 9),
  (53, 8, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 10),
  (54, 8, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 11),
  (55, 9, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
  (56, 9, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
  (57, 9, 'contact_no', 'number', 'Contact No', 1, 1, 1, 1, 1, 1, NULL, 3),
  (58, 9, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, NULL, 4),
  (59, 9, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 5),
  (60, 9, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 6),
  (67, 11, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
  (68, 11, 'site_id', 'hidden', 'Site Id', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required\"}}', 2),
  (70, 11, 'date', 'date', 'Date', 1, 1, 1, 1, 1, 1, NULL, 6),
  (72, 11, 'labour_id', 'hidden', 'Labour Id', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required\"}}', 4),
  (73, 11, 'status_id', 'hidden', 'Status Id', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required\"}}', 5),
  (74, 11, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 8),
  (75, 11, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 9),
  (76, 12, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
  (77, 12, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
  (78, 12, 'location', 'coordinates', 'Location', 1, 0, 1, 1, 1, 1, NULL, 3),
  (79, 12, 'address', 'text_area', 'Address', 1, 1, 1, 1, 1, 1, NULL, 4),
  (80, 12, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 5),
  (81, 12, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 6),
  (82, 13, 'id', 'hidden', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
  (83, 13, 'details', 'text_area', 'Details', 1, 1, 1, 1, 1, 1, NULL, 2),
  (84, 13, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
  (85, 13, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
  (86, 8, 'purchase_belongsto_seller_relationship', 'relationship', 'Seller', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Seller\",\"table\":\"sellers\",\"type\":\"belongsTo\",\"column\":\"seller_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"data_rows\",\"pivot\":\"0\",\"taggable\":\"0\"}', 6),
  (93, 11, 'radius', 'number', 'Radius', 1, 1, 1, 1, 1, 1, NULL, 6);




INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
  (1, 'admin', '2018-06-28 02:14:14', '2018-06-28 02:14:14');


INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
  (1, 1, 'Dashboard', '', '_self', 'voyager-boat', NULL, NULL, 1, '2018-06-28 02:14:14', '2018-06-28 02:14:14', 'voyager.dashboard', NULL),
  (2, 1, 'Media', '', '_self', 'voyager-images', NULL, 24, 2, '2018-06-28 02:14:14', '2018-07-05 07:21:21', 'voyager.media.index', NULL),
  (3, 1, 'Users', '', '_self', 'voyager-person', NULL, 24, 3, '2018-06-28 02:14:14', '2018-07-05 07:21:24', 'voyager.users.index', NULL),
  (4, 1, 'Roles', '', '_self', 'voyager-lock', NULL, 24, 1, '2018-06-28 02:14:14', '2018-07-05 07:21:19', 'voyager.roles.index', NULL),
  (5, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 3, '2018-06-28 02:14:15', '2018-07-05 07:21:24', NULL, NULL),
  (6, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 5, 1, '2018-06-28 02:14:15', '2018-06-28 22:21:50', 'voyager.menus.index', NULL),
  (7, 1, 'Database', '', '_self', 'voyager-data', NULL, 5, 2, '2018-06-28 02:14:15', '2018-06-28 22:21:50', 'voyager.database.index', NULL),
  (8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 3, '2018-06-28 02:14:15', '2018-06-28 22:21:50', 'voyager.compass.index', NULL),
  (9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 4, '2018-06-28 02:14:15', '2018-06-28 22:21:50', 'voyager.bread.index', NULL),
  (10, 1, 'Api Builder', '', '_self', 'fa fa-cloud', NULL, 5, 6, '2018-06-28 02:14:15', '2018-06-28 22:21:50', 'voyager.api.builder.index', NULL),
  (11, 1, 'Settings', '', '_self', 'voyager-settings', NULL, NULL, 5, '2018-06-28 02:14:15', '2018-07-05 07:22:21', 'voyager.settings.index', NULL),
  (12, 1, 'Hooks', '', '_self', 'voyager-hook', NULL, 5, 5, '2018-06-28 02:14:20', '2018-06-28 22:21:50', 'voyager.hooks', NULL),
  (13, 1, 'Godowns', '', '_self', 'icon-home-3', '#000000', 23, 3, '2018-06-26 23:12:36', '2018-07-08 04:54:09', 'voyager.godowns.index', 'null'),
  (15, 1, 'Goods', '', '_self', 'voyager-puzzle', '#000000', 23, 2, '2018-06-26 23:16:12', '2018-07-08 04:54:05', 'voyager.goods.index', 'null'),
  (16, 1, 'Labours', '', '_self', 'icon-users-3', '#000000', 23, 6, '2018-06-26 23:16:39', '2018-07-08 04:54:12', 'voyager.labours.index', 'null'),
  (17, 1, 'Purchases', '', '_self', 'voyager-basket', '#000000', 23, 4, '2018-06-26 23:17:46', '2018-07-08 04:54:09', 'voyager.purchases.index', 'null'),
  (18, 1, 'Sellers', '', '_self', 'voyager-people', '#000000', 23, 1, '2018-06-26 23:18:30', '2018-07-08 04:54:02', 'voyager.sellers.index', 'null'),
  (20, 1, 'Site Transfers', '', '_self', 'icon-switch', '#000000', 23, 7, '2018-06-26 23:23:05', '2018-07-08 04:54:06', 'voyager.site-transfers.index', 'null'),
  (21, 1, 'Sites', '', '_self', 'voyager-milestone', '#000000', 23, 5, '2018-06-26 23:28:46', '2018-07-08 04:54:12', 'voyager.sites.index', 'null'),
  (22, 1, 'Statuses', '', '_self', 'icon-heartbeat', '#000000', 23, 8, '2018-06-26 23:29:11', '2018-07-08 04:54:03', 'voyager.statuses.index', 'null'),
  (23, 1, 'Ignite', '', '_self', 'icon-fire-1', '#000000', NULL, 2, '2018-07-05 07:20:24', '2018-07-08 04:54:59', NULL, ''),
  (24, 1, 'Cabin', '', '_self', 'voyager-helm', '#000000', NULL, 4, '2018-07-05 07:21:12', '2018-07-05 07:22:21', NULL, '');


INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
  (1, 'admin', 'Administrator', '2018-06-28 02:14:15', '2018-06-28 02:14:15'),
  (2, 'user', 'Normal User', '2018-06-28 02:14:15', '2018-06-28 02:14:15');


INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `avatar`, `password`, `remember_token`, `settings`, `created_at`, `updated_at`) VALUES
  (1, 1, 'admin', 'admin@admin.com', 'users\\July2018\\C01gRUPcdWCdR9qxfwbq.png', '$2y$10$lRUkbwXdUpeSbzT5VIRC9.mYi3KBXZBCM1T6XxO3uPLSrp43TabrS', 'DhJacQ49YIfLLbNRBaUCHd7NPM4BiYJFozAzDEMI45t0wyfRZe4S4BQK0pgo', '{\"locale\":\"en\"}', '2018-06-28 02:15:05', '2018-07-05 07:19:29');


INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
  (1, 'browse_admin', NULL, '2018-06-28 02:14:15', '2018-06-28 02:14:15'),
  (2, 'browse_bread', NULL, '2018-06-28 02:14:15', '2018-06-28 02:14:15'),
  (3, 'browse_database', NULL, '2018-06-28 02:14:15', '2018-06-28 02:14:15'),
  (4, 'browse_media', NULL, '2018-06-28 02:14:15', '2018-06-28 02:14:15'),
  (5, 'browse_compass', NULL, '2018-06-28 02:14:15', '2018-06-28 02:14:15'),
  (6, 'browse_api', NULL, '2018-06-28 02:14:16', '2018-06-28 02:14:16'),
  (7, 'browse_menus', 'menus', '2018-06-28 02:14:16', '2018-06-28 02:14:16'),
  (8, 'read_menus', 'menus', '2018-06-28 02:14:16', '2018-06-28 02:14:16'),
  (9, 'edit_menus', 'menus', '2018-06-28 02:14:16', '2018-06-28 02:14:16'),
  (10, 'add_menus', 'menus', '2018-06-28 02:14:16', '2018-06-28 02:14:16'),
  (11, 'delete_menus', 'menus', '2018-06-28 02:14:16', '2018-06-28 02:14:16'),
  (12, 'browse_roles', 'roles', '2018-06-28 02:14:16', '2018-06-28 02:14:16'),
  (13, 'read_roles', 'roles', '2018-06-28 02:14:16', '2018-06-28 02:14:16'),
  (14, 'edit_roles', 'roles', '2018-06-28 02:14:16', '2018-06-28 02:14:16'),
  (15, 'add_roles', 'roles', '2018-06-28 02:14:16', '2018-06-28 02:14:16'),
  (16, 'delete_roles', 'roles', '2018-06-28 02:14:16', '2018-06-28 02:14:16'),
  (17, 'browse_users', 'users', '2018-06-28 02:14:17', '2018-06-28 02:14:17'),
  (18, 'read_users', 'users', '2018-06-28 02:14:17', '2018-06-28 02:14:17'),
  (19, 'edit_users', 'users', '2018-06-28 02:14:17', '2018-06-28 02:14:17'),
  (20, 'add_users', 'users', '2018-06-28 02:14:17', '2018-06-28 02:14:17'),
  (21, 'delete_users', 'users', '2018-06-28 02:14:17', '2018-06-28 02:14:17'),
  (22, 'browse_settings', 'settings', '2018-06-28 02:14:17', '2018-06-28 02:14:17'),
  (23, 'read_settings', 'settings', '2018-06-28 02:14:17', '2018-06-28 02:14:17'),
  (24, 'edit_settings', 'settings', '2018-06-28 02:14:17', '2018-06-28 02:14:17'),
  (25, 'add_settings', 'settings', '2018-06-28 02:14:17', '2018-06-28 02:14:17'),
  (26, 'delete_settings', 'settings', '2018-06-28 02:14:17', '2018-06-28 02:14:17'),
  (27, 'browse_hooks', NULL, '2018-06-28 02:14:20', '2018-06-28 02:14:20'),
  (28, 'read_godowns', 'godowns', '2018-06-26 23:12:36', '2018-06-26 23:12:36'),
  (29, 'edit_godowns', 'godowns', '2018-06-26 23:12:36', '2018-06-26 23:12:36'),
  (30, 'add_godowns', 'godowns', '2018-06-26 23:12:36', '2018-06-26 23:12:36'),
  (31, 'delete_godowns', 'godowns', '2018-06-26 23:12:36', '2018-06-26 23:12:36'),
  (37, 'browse_goods', 'goods', '2018-06-26 23:16:12', '2018-06-26 23:16:12'),
  (38, 'read_goods', 'goods', '2018-06-26 23:16:12', '2018-06-26 23:16:12'),
  (39, 'edit_goods', 'goods', '2018-06-26 23:16:12', '2018-06-26 23:16:12'),
  (40, 'add_goods', 'goods', '2018-06-26 23:16:12', '2018-06-26 23:16:12'),
  (41, 'delete_goods', 'goods', '2018-06-26 23:16:12', '2018-06-26 23:16:12'),
  (42, 'browse_labours', 'labours', '2018-06-26 23:16:39', '2018-06-26 23:16:39'),
  (43, 'read_labours', 'labours', '2018-06-26 23:16:39', '2018-06-26 23:16:39'),
  (44, 'edit_labours', 'labours', '2018-06-26 23:16:39', '2018-06-26 23:16:39'),
  (45, 'add_labours', 'labours', '2018-06-26 23:16:39', '2018-06-26 23:16:39'),
  (46, 'delete_labours', 'labours', '2018-06-26 23:16:39', '2018-06-26 23:16:39'),
  (47, 'browse_purchases', 'purchases', '2018-06-26 23:17:46', '2018-06-26 23:17:46'),
  (48, 'read_purchases', 'purchases', '2018-06-26 23:17:46', '2018-06-26 23:17:46'),
  (49, 'edit_purchases', 'purchases', '2018-06-26 23:17:46', '2018-06-26 23:17:46'),
  (50, 'add_purchases', 'purchases', '2018-06-26 23:17:46', '2018-06-26 23:17:46'),
  (51, 'delete_purchases', 'purchases', '2018-06-26 23:17:46', '2018-06-26 23:17:46'),
  (52, 'browse_sellers', 'sellers', '2018-06-26 23:18:30', '2018-06-26 23:18:30'),
  (53, 'read_sellers', 'sellers', '2018-06-26 23:18:30', '2018-06-26 23:18:30'),
  (54, 'edit_sellers', 'sellers', '2018-06-26 23:18:30', '2018-06-26 23:18:30'),
  (55, 'add_sellers', 'sellers', '2018-06-26 23:18:30', '2018-06-26 23:18:30'),
  (56, 'delete_sellers', 'sellers', '2018-06-26 23:18:30', '2018-06-26 23:18:30'),
  (62, 'browse_site_transfers', 'site_transfers', '2018-06-26 23:23:05', '2018-06-26 23:23:05'),
  (63, 'read_site_transfers', 'site_transfers', '2018-06-26 23:23:05', '2018-06-26 23:23:05'),
  (64, 'edit_site_transfers', 'site_transfers', '2018-06-26 23:23:05', '2018-06-26 23:23:05'),
  (65, 'add_site_transfers', 'site_transfers', '2018-06-26 23:23:05', '2018-06-26 23:23:05'),
  (66, 'delete_site_transfers', 'site_transfers', '2018-06-26 23:23:05', '2018-06-26 23:23:05'),
  (67, 'browse_sites', 'sites', '2018-06-26 23:28:46', '2018-06-26 23:28:46'),
  (68, 'read_sites', 'sites', '2018-06-26 23:28:46', '2018-06-26 23:28:46'),
  (69, 'edit_sites', 'sites', '2018-06-26 23:28:46', '2018-06-26 23:28:46'),
  (70, 'add_sites', 'sites', '2018-06-26 23:28:46', '2018-06-26 23:28:46'),
  (71, 'delete_sites', 'sites', '2018-06-26 23:28:46', '2018-06-26 23:28:46'),
  (72, 'browse_statuses', 'statuses', '2018-06-26 23:29:11', '2018-06-26 23:29:11'),
  (73, 'read_statuses', 'statuses', '2018-06-26 23:29:11', '2018-06-26 23:29:11'),
  (74, 'edit_statuses', 'statuses', '2018-06-26 23:29:11', '2018-06-26 23:29:11'),
  (75, 'add_statuses', 'statuses', '2018-06-26 23:29:11', '2018-06-26 23:29:11'),
  (76, 'delete_statuses', 'statuses', '2018-06-26 23:29:11', '2018-06-26 23:29:11'),
  (77, 'browse_godowns', 'godowns', '2018-06-26 23:12:36', '2018-06-26 23:12:36');


INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
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
  (17, 1),
  (18, 1),
  (19, 1),
  (20, 1),
  (21, 1),
  (22, 1),
  (23, 1),
  (24, 1),
  (25, 1),
  (26, 1),
  (27, 1),
  (28, 1),
  (29, 1),
  (30, 1),
  (31, 1),
  (37, 1),
  (38, 1),
  (39, 1),
  (40, 1),
  (41, 1),
  (42, 1),
  (43, 1),
  (44, 1),
  (45, 1),
  (46, 1),
  (47, 1),
  (48, 1),
  (49, 1),
  (50, 1),
  (51, 1),
  (52, 1),
  (53, 1),
  (54, 1),
  (55, 1),
  (56, 1),
  (62, 1),
  (63, 1),
  (64, 1),
  (65, 1),
  (66, 1),
  (67, 1),
  (68, 1),
  (69, 1),
  (70, 1),
  (71, 1),
  (72, 1),
  (73, 1),
  (74, 1),
  (75, 1),
  (76, 1),
  (77, 1);


INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
  (1, 'site.title', 'Site Title', 'Site Title', '', 'text', 1, 'Site'),
  (2, 'site.description', 'Site Description', 'Site Description', '', 'text', 2, 'Site'),
  (3, 'site.logo', 'Site Logo', '', '', 'image', 3, 'Site'),
  (4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', '', '', 'text', 4, 'Site'),
  (5, 'admin.bg_image', 'Admin Background Image', '', '', 'image', 5, 'Admin'),
  (6, 'admin.title', 'Admin Title', 'Voyager', '', 'text', 1, 'Admin'),
  (7, 'admin.description', 'Admin Description', 'Welcome to Voyager. The Missing Admin for Laravel', '', 'text', 2, 'Admin'),
  (8, 'admin.loader', 'Admin Loader', '', '', 'image', 3, 'Admin'),
  (9, 'admin.icon_image', 'Admin Icon Image', '', '', 'image', 4, 'Admin'),
  (10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', '', '', 'text', 1, 'Admin');
