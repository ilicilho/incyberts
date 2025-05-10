<?php

file_put_contents("/tmp/incyberts-hook.log", "HOOK OK: " . date('c') . "\n", FILE_APPEND);

function plugin_incyberts_display_tab($link, $item) {
   if ($item instanceof Ticket) {
      file_put_contents("/tmp/incyberts-tab.log", "TAB FUNCIONANDO Ticket ID: {$item->getID()}\n", FILE_APPEND);
      return ['PluginIncybertsEntry$1' => __('TimeSheet', 'incyberts')];
   }
   return [];
}

function plugin_incyberts_display_tab_content($tab, $item, $tabname) {
   if ($tab === 'PluginIncybertsEntry$1' && $item instanceof Ticket) {
      include_once __DIR__ . '/front/incybertsentry.tab.php';
      return true;
   }
   return false;
}
