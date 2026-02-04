# 🚀 P360 | Quality Assurance System

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)
![Python](https://img.shields.io/badge/Python-3.10-3776AB?style=for-the-badge&logo=python)
![OpenAI Whisper](https://img.shields.io/badge/AI-OpenAI%20Whisper-00A67E?style=for-the-badge&logo=openai)

> **Nota:** Este projeto serviu como o **principal protótipo** e base arquitetural para a solução de Controle de Qualidade atualmente em produção na **GlobalHitss**.

## 📖 Sobre

O **P360** é uma plataforma robusta de gestão de qualidade para Call Centers. Ele automatiza o processo de auditoria de chamadas utilizando **Inteligência Artificial** para transcrever áudios e auxiliar na categorização e avaliação de atendimentos.

O diferencial técnico deste projeto é a integração assíncrona entre o ecossistema PHP (Laravel) e scripts Python para processamento pesado de IA (Speech-to-Text).

---

## ✨ Funcionalidades Principais

- **🎧 Transcrição Automática (Speech-to-Text):** Upload de áudios de chamadas que são processados em background pelo OpenAI Whisper (via Python).
- **📊 Dashboards Interativos:** Visualização de KPIs e ranking de atendentes utilizando Highcharts.
- **👥 Gestão de Perfis (RBAC):**
  - **QA (Qualidade):** Upload e auditoria.
  - **Coordenador:** Gestão total (usuários, clientes, formulários de avaliação).
  - **Atendente:** Feedback e acompanhamento de performance.
- **📝 Avaliação Dinâmica:** Criação de formulários de auditoria personalizados por cliente.
- **🔔 Sistema de Notificações:** Alertas em tempo real sobre conclusões de transcrições.

---

## 🛠️ Tech Stack

### Backend & Frontend
- **Framework:** Laravel 11
- **Template Engine:** Blade
- **Estilização:** Tailwind CSS / Bootstrap
- **Interatividade:** Alpine.js
- **Gráficos:** Highcharts

### AI & Processamento
- **Linguagem:** Python 3.10+
- **Modelo:** OpenAI Whisper (Local)
- **Fila/Jobs:** Laravel Queue Worker

---

## 🚀 Como Executar Localmente

### Pré-requisitos
- PHP 8.2+
- Composer
- Node.js & NPM
- Python 3.10+
- FFmpeg (necessário para o Whisper)

### Passo a Passo

1. **Clone o repositório**
   ```bash
   git clone https://github.com/seu-usuario/seu-repo.git
   cd facilitahitss
   ```

2. **Instale as dependências do Back-end**
   ```bash
   composer install
   ```

3. **Configure o Ambiente**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Configure seu banco de dados no arquivo `.env`.*

4. **Prepare o Database**
   ```bash
   php artisan migrate --seed
   ```

5. **Instale as dependências do Front-end**
   ```bash
   npm install && npm run build
   ```

6. **Configuração da IA (Python)**
   ```bash
   # Crie o ambiente virtual
   python -m venv venv

   # Ative o ambiente (Windows)
   venv\Scripts\activate

   # Instale as dependências
   pip install openai-whisper
   ```

7. **Inicie o Servidor**
   ```bash
   php artisan serve
   ```

---

## 📄 Licença

Este projeto está sob a licença [MIT](./LICENSE).