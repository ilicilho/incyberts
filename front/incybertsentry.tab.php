<?php

use Glpi\Event;

global $DB, $CFG_GLPI;

$ticketID = $item->getID();
$userID = Session::getLoginUserID();

// Objeto principal da entrada
include_once __DIR__ . '/../inc/incybertsentry.class.php';

echo "<h2>Registro de Tempo</h2>";

// Botão para abrir formulário de nova entrada
echo '<div class="center" style="margin:10px 0">';
echo "<a class='vsubmit' href='index.php?redirect=plugin_incybertsentry_form&ticket_id=$ticketID'>" . __('Nova entrada de tempo', 'incyberts') . "</a>";
echo '</div>';

// Carregar registros
$entries = PluginIncybertsEntry::getEntriesByTicket($ticketID);
$totalMinutes = 0;

echo "<table class='tab_cadre_fixehov'>";
echo "<tr class='noHover'><th>Hora Inicial</th><th>Hora Final</th><th>Técnico</th><th>Tempo Gasto</th><th>Sincronizado</th></tr>";

foreach ($entries as $entry) {
   $totalMinutes += $entry['duration_min'];

   echo "<tr>";
   echo "<td>" . Html::convDateTime($entry['begin']) . "</td>";
   echo "<td>" . Html::convDateTime($entry['end']) . "</td>";
   echo "<td>" . getUserName($entry['users_id']) . "</td>";
   echo "<td>" . PluginIncybertsEntry::formatDuration($entry['duration_min']) . "</td>";
   echo "<td>" . ($entry['synced'] ? '✅' : '❌') . "</td>";
   echo "</tr>";
}

echo "<tr class='tab_bg_2'>";
echo "<td colspan='3' class='right'><strong>Tempo total deste chamado:</strong></td>";
echo "<td colspan='2'><strong>" . PluginIncybertsEntry::formatDuration($totalMinutes) . "</strong></td>";
echo "</tr>";

echo "</table>";
