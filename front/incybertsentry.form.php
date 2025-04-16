<?php
include '../../../inc/includes.php';
include_once __DIR__ . '/../inc/incybertsentry.class.php';

$ticketID = isset($_GET['ticket_id']) ? intval($_GET['ticket_id']) : 0;
$userID = Session::getLoginUserID();

Html::header(__('Nova entrada de tempo', 'incyberts'), $_SERVER["PHP_SELF"], "plugins", "plugin");

// Se o formulário foi submetido
if (isset($_POST['add_entry'])) {
   $begin = $_POST['begin'];
   $end = $_POST['end'];

   if (!empty($begin) && !empty($end)) {
      PluginIncybertsEntry::createEntry($ticketID, $userID, $begin, $end);
      Html::back();
      exit;
   } else {
      echo Html::displayErrorMessage('Todos os campos são obrigatórios.');
   }
}

// Formulário
echo "<form method='post' action=''>";

echo "<table class='tab_cadre'>";
echo "<tr><th colspan='2'>" . __('Nova Entrada de Tempo', 'incyberts') . "</th></tr>";

echo "<tr class='tab_bg_1'>";
echo "<td>" . __('Hora Inicial', 'incyberts') . "</td><td>";
Html::showGenericDateTimeField("begin", [
   'value' => '',
   'maybeempty' => false
]);
echo "</td></tr>";

echo "<tr class='tab_bg_1'>";
echo "<td>" . __('Hora Final', 'incyberts') . "</td><td>";
Html::showGenericDateTimeField("end", [
   'value' => '',
   'maybeempty' => false
]);
echo "</td></tr>";

echo "<tr class='tab_bg_2 center'>";
echo "<td colspan='2'>";
echo "<button type='submit' name='add_entry' class='submit'>" . __('Salvar', 'incyberts') . "</button> ";
echo "<a class='vsubmit' href='javascript:history.back()'>" . __('Cancelar') . "</a>";
echo "</td></tr>";

echo "</table>";
echo "</form>";

Html::footer();
