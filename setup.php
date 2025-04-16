<?php

function plugin_init_incyberts() {
   global $PLUGIN_HOOKS;

   include_once(__DIR__ . '/hook.php');

   $PLUGIN_HOOKS['csrf_compliant']['incyberts'] = true;

   $PLUGIN_HOOKS['config_page']['incyberts'] = 'front/config.form.php';

   // Aba custom no ticket
   $PLUGIN_HOOKS['item_add']['incyberts'] = ['Ticket'];
   $PLUGIN_HOOKS['item_update']['incyberts'] = ['Ticket'];
   $PLUGIN_HOOKS['item_form']['incyberts'] = ['Ticket'];
   $PLUGIN_HOOKS['use_tab']['incyberts'] = ['Ticket' => true];
   $PLUGIN_HOOKS['display_tab_content']['incyberts'] = 'plugin_incyberts_display_tab';
}

function plugin_version_incyberts() {
   return [
      'name'           => "inCyber TimeSheet",
      'version'        => '1.1.0',
      'author'         => 'Você e Jake 😎',
      'license'        => 'MIT',
      'homepage'       => 'https://incyber.com.br',
      'minGlpiVersion' => '10.0.0'
   ];
}

function plugin_incyberts_check_prerequisites() {
   return true;
}

function plugin_incyberts_check_config($verbose = false) {
   return true;
}

function plugin_incyberts_install() {
   global $DB;

   // Tabela de registros de tempo
   $DB->queryOrDie("
      CREATE TABLE IF NOT EXISTS `glpi_plugin_incyberts_entries` (
         `id` INT AUTO_INCREMENT PRIMARY KEY,
         `tickets_id` INT NOT NULL,
         `users_id` INT NOT NULL,
         `begin` DATETIME NOT NULL,
         `end` DATETIME NOT NULL,
         `duration_min` INT NOT NULL,
         `synced` TINYINT(1) DEFAULT 0,
         `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
   ", "Falha ao criar tabela glpi_plugin_incyberts_entries");

   // Tabela de configuração do plugin
   $DB->queryOrDie("
      CREATE TABLE IF NOT EXISTS `glpi_plugin_incyberts_config` (
         `id` INT AUTO_INCREMENT PRIMARY KEY,
         `api_url` VARCHAR(255) NOT NULL,
         `bearer` TEXT NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
   ", "Falha ao criar tabela glpi_plugin_incyberts_config");

   return true;
}

function plugin_incyberts_uninstall() {
   global $DB;

   $DB->query("DROP TABLE IF EXISTS `glpi_plugin_incyberts_entries`;");
   $DB->query("DROP TABLE IF EXISTS `glpi_plugin_incyberts_config`;");

   return true;
}
