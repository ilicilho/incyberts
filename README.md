# inCyber TimeSheet - GLPI Plugin

Plugin oficial para integração de registros de tempo com sistemas externos via API, utilizando a plataforma GLPI.

## ✅ Funcionalidades

- Aba personalizada **TimeSheet** dentro de cada chamado
- Registro de múltiplas entradas de tempo com:
  - Hora Inicial
  - Hora Final
  - Cálculo automático de duração
- Tabela com todos os registros por chamado
- Cálculo do **tempo total acumulado**
- Tela de configuração com:
  - URL da API
  - Token Bearer
- Pronto para integração futura via CURL/JSON

## 🧠 Requisitos

- GLPI >= 10.0.0
- Permissão de escrita no diretório `/plugins/`

## 📁 Estrutura de Tabelas

- `glpi_plugin_incyberts_config`: armazena URL da API + token
- `glpi_plugin_incyberts_entries`: entradas de tempo associadas a tickets

## 🚀 Instalação

1. Copie o diretório `incyberts/` para `.../glpi/plugins/`
2. Acesse o GLPI > Configurar > Plugins
3. Instale e ative o plugin
4. Configure a API em `Configuração`
5. Acesse um chamado e vá na aba `TimeSheet`

## 📞 Suporte

Desenvolvido por inCyber + Jake 🥷  
https://incyber.com.br

---

Powered by Jake 🤖 - seu assistente de código GLPI 🧑‍💻
