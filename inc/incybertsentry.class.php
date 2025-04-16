<?php

class PluginIncybertsEntry extends CommonDBTM {

   public static $rightname = 'plugin_incyberts';

   public static function getTypeName($nb = 0) {
      return __('Registro de Tempo', 'incyberts');
   }

   public function canCreate() {
      return Session::haveRight(self::$rightname, CREATE);
   }

   public function canView() {
      return Session::haveRight(self::$rightname, READ);
   }

   public function canUpdate() {
      return Session::haveRight(self::$rightname, UPDATE);
   }

   public function canDelete() {
      return Session::haveRight(self::$rightname, DELETE);
   }

   /**
    * Retorna os registros de tempo de um chamado
    */
   public static function getEntriesByTicket($ticketID) {
      global $DB;

      $entries = [];

      $query = $DB->request([
         'FROM'   => 'glpi_plugin_incyberts_entries',
         'WHERE'  => ['tickets_id' => $ticketID],
         'ORDER'  => ['begin']
      ]);

      foreach ($query as $data) {
         $entries[] = $data;
      }

      return $entries;
   }

   /**
    * Calcula e retorna string do tipo "1h 30min"
    */
   public static function formatDuration($minutes) {
      $h = floor($minutes / 60);
      $m = $minutes % 60;

      if ($h > 0 && $m > 0) return "{$h}h {$m}min";
      if ($h > 0) return "{$h}h";
      return "{$m}min";
   }

   /**
    * Calcula duração entre dois datetimes em minutos
    */
   public static function calculateDuration($begin, $end) {
      $start = strtotime($begin);
      $finish = strtotime($end);
      return max(0, round(($finish - $start) / 60));
   }

   /**
    * Cria uma nova entrada no banco
    */
   public static function createEntry($ticketID, $userID, $begin, $end) {
      global $DB;

      $duration = self::calculateDuration($begin, $end);

      $DB->insert('glpi_plugin_incyberts_entries', [
         'tickets_id'   => $ticketID,
         'users_id'     => $userID,
         'begin'        => $begin,
         'end'          => $end,
         'duration_min' => $duration,
         'synced'       => 0
      ]);
   }
}
