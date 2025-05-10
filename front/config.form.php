<?php
include '../../../inc/includes.php';

Html::header(__('Configuração do inCyber TimeSheet', 'incyberts'), $_SERVER['PHP_SELF'], "plugins", "plugin");

$token = Session::getNewCSRFToken();

// Salvando dados
if (isset($_POST['update'])) {
   $api_url = $_POST['api_url'];
   $bearer  = $_POST['bearer'];

   $query = $DB->request([
      'FROM' => 'glpi_plugin_incyberts_config',
      'LIMIT' => 1
   ]);

   if ($query->count() > 0) {
      $data = $query->next();
      $DB->update('glpi_plugin_incyberts_config', [
         'api_url' => $api_url,
         'bearer'  => $bearer
      ], ['id' => $data['id']]);
   } else {
      $DB->insert('glpi_plugin_incyberts_config', [
         'api_url' => $api_url,
         'bearer'  => $bearer
      ]);
   }

   Session::addMessageAfterRedirect('Configuração salva com sucesso.', true, INFO);
   Html::redirect($_SERVER['PHP_SELF']);
}

// Recuperando configuração existente (com segurança)
$config = ['api_url' => '', 'bearer' => ''];

$query = $DB->request([
   'FROM' => 'glpi_plugin_incyberts_config',
   'LIMIT' => 1
]);

if ($query->count() > 0 && ($data = $query->next())) {
   $config['api_url'] = $data['api_url'] ?? '';
   $config['bearer']  = $data['bearer'] ?? '';
}
?>

<form method="post" action="">
   <table class="tab_cadre">
      <tr><th colspan="2">Configuração da API TimeSheet</th></tr>

      <input type="hidden" name="_glpi_csrf_token" value="<?= $token ?>">

      <tr class="tab_bg_1">
         <td><label for="api_url">API URL:</label></td>
         <td><input type="text" name="api_url" size="80"
                    value="<?= htmlentities($config['api_url'], ENT_QUOTES, 'UTF-8') ?>"></td>
      </tr>

      <tr class="tab_bg_1">
         <td><label for="bearer">Bearer Token:</label></td>
         <td><input type="text" name="bearer" size="80"
                    value="<?= htmlentities($config['bearer'], ENT_QUOTES, 'UTF-8') ?>"></td>
      </tr>

      <tr class="tab_bg_2 center">
         <td colspan="2">
            <button type="submit" name="update" class="submit">Salvar</button>
         </td>
      </tr>
   </table>
</form>

<?php Html::footer(); ?>
