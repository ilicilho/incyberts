<?php

function plugin_incyberts_display_tab($link, $item) {
   if (is_a($item, 'Ticket')) {
      return [
         'plugin_incyberts' => __('TimeSheet', 'incyberts')
      ];
   }
   return [];
}

function plugin_incyberts_display_tab_content($tab, $item, $tabname) {
   if ($tab == 'plugin_incyberts' && is_a($item, 'Ticket')) {
      include_once __DIR__ . '/front/incybertsentry.tab.php';
      return true;
   }
   return false;
}
