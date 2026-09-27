<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Papelería</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
      :root {
          --bg-body: #0c0a09;
          --bg-panel: #141210;
          --bg-card: #1c1917;
          --bg-input: #0c0a09;
          --border-subtle: #292524;
          --border-hover: #f59e0b;
          --primary-accent: #f59e0b;
          --primary-hover: #fbbf24;
          --gold-glow: rgba(245, 158, 11, 0.25);
          --text-main: #f5f5f4;
          --text-muted: #e5e7eb;
      }

      body {
        background-color: var(--bg-body);
        color: var(--primary-accent);
        font-family: 'Plus Jakarta Sans', sans-serif;
        min-height: 100vh;
        min-height: 100dvh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 1rem;
      }

      /* === TARJETA Y CONTENEDOR RESPONSIVO === */
      .card {
        --p: 1.75rem;
        width: 100%;
        max-width: 420px;
        min-height: auto;
        max-height: 90vh;
        max-height: 90dvh;
        border-radius: 16px;
        background: var(--bg-panel);
        border: 1px solid var(--border-subtle);
        box-shadow: 0 14px 35px 0 rgba(0, 0, 0, 0.7), 0 0 0 1px rgba(245, 158, 11, 0.1);
        position: relative;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-direction: column;
        overflow-y: auto;
        padding: var(--p);
        scrollbar-width: thin;
        scrollbar-color: var(--primary-accent) var(--bg-panel);
        -webkit-overflow-scrolling: touch;
        -webkit-font-smoothing: antialiased;
      }

      .card::-webkit-scrollbar {
        width: 6px;
      }
      .card::-webkit-scrollbar-thumb {
        background: var(--primary-accent);
        border-radius: 4px;
      }

      /* === AVATAR ROBOT CON PERSONALIDAD === */
      .avatar {
        --sz-avatar: 90px;
        order: 0;
        width: var(--sz-avatar);
        height: var(--sz-avatar);
        min-width: var(--sz-avatar);
        min-height: var(--sz-avatar);
        border: 2px solid var(--primary-accent);
        border-radius: 16px;
        background: var(--bg-input);
        overflow: hidden;
        cursor: pointer;
        z-index: 2;
        position: relative;
        margin: 0 0 1rem 0;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        box-shadow: inset 0 0 12px rgba(0,0,0,0.8), 0 0 10px var(--gold-glow);
        transition: transform 0.2s ease, border-color 0.2s ease;
      }

      @media (min-width: 768px) {
        .avatar {
          --sz-avatar: 100px;
        }
      }

      .avatar:hover {
        transform: scale(1.03) rotate(-1deg);
        border-color: var(--primary-hover);
      }

      .robot-face {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
      }

      .robot-antenna {
        width: 5px;
        height: 10px;
        background: var(--primary-accent);
        position: absolute;
        top: 6px;
        border-radius: 3px;
      }

      .robot-antenna::after {
        content: '';
        position: absolute;
        top: -5px;
        left: -4.5px;
        width: 14px;
        height: 14px;
        background: var(--primary-accent);
        border-radius: 50%;
        box-shadow: 0 0 8px var(--primary-accent);
        animation: pulseAntenna 1.8s infinite ease-in-out;
      }

      @keyframes pulseAntenna {
        0%, 100% { transform: scale(1); box-shadow: 0 0 6px var(--primary-accent); }
        50% { transform: scale(1.2); box-shadow: 0 0 14px var(--primary-accent); }
      }

      .robot-eyes {
        display: flex;
        gap: 18px;
        margin-top: 10px;
      }

      .robot-eye {
        width: 16px;
        height: 16px;
        background: var(--primary-accent);
        border-radius: 50%;
        box-shadow: 0 0 10px var(--primary-accent);
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        animation: blinkEye 4s infinite;
      }

      @keyframes blinkEye {
        0%, 96%, 100% { transform: scaleY(1); }
        98% { transform: scaleY(0.1); }
      }

      .robot-mouth {
        width: 22px;
        height: 4px;
        background: var(--primary-accent);
        border-radius: 2px;
        margin-top: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 0 5px var(--gold-glow);
      }

      .robot-visor {
        position: absolute;
        top: -100%;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--bg-input);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-accent);
        font-size: 1.8rem;
        transition: all 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        z-index: 5;
        border-bottom: 3px solid var(--primary-accent);
      }

      /* === EXPRESIONES DEL ROBOT AL INTERACTUAR === */
      .blind-check:checked ~ .avatar .robot-visor {
        top: 0;
      }

      .blind-check:checked ~ .avatar .robot-eye {
        height: 4px;
        margin-top: 6px;
        border-radius: 2px;
      }

      .blind-check:checked ~ .avatar .robot-mouth {
        height: 8px;
        width: 20px;
        border-radius: 0 0 8px 8px;
        background: var(--primary-accent);
      }

      /* === ICONO DE OJO EN EL INPUT === */
      .password-wrapper {
        position: relative;
        width: 100%;
      }

      .toggle-eye {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: var(--primary-accent);
        font-size: 1.1rem;
        z-index: 10;
        transition: color 0.2s ease, transform 0.2s ease;
      }

      .toggle-eye:hover {
        color: var(--text-main);
        transform: translateY(-50%) scale(1.1);
      }

      /* FORMULARIO */
      .form {
        order: 1;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        width: 100%;
      }

      .form .title {
        width: 100%;
        font-size: 1.3rem;
        font-weight: 700;
        margin-top: 0;
        margin-bottom: 0.2rem;
        color: var(--text-main);
      }

      .form .label_input {
        white-space: nowrap;
        font-size: 0.85rem;
        margin-top: 0.5rem;
        color: var(--text-muted);
        font-weight: 600;
        display: block;
        text-align: left;
        width: 100%;
      }

      .form .input {
        background: var(--bg-input) !important;
        border: 1px solid var(--border-subtle) !important;
        border-radius: 8px;
        outline: none;
        padding: 0.6rem 0.85rem;
        font-size: 16px; /* Evita zoom automático en iOS */
        width: 100%;
        color: var(--text-main) !important;
        margin: 0.35rem 0 0.5rem 0;
        transition: all 0.25s ease;
      }

      .form .input::placeholder {
        color: var(--text-muted);
        opacity: 0.6;
      }

      .form .input#password {
        padding-right: 40px;
      }

      .form .input:focus {
        border-color: var(--border-hover) !important;
        outline: 0;
        box-shadow: 0 0 0 3px var(--gold-glow);
        background: var(--bg-input) !important;
      }

      .brand-icon {
        font-size: 1.6rem;
        color: var(--primary-accent);
      }

      .text-muted-gold {
        color: var(--text-muted) !important;
        font-size: 0.85rem;
      }

      /* === BOTÓN PRINCIPAL ADAPTADO AL ESTILO GLOBAL === */
      .Btn {
        width: 100%;
        height: 45px;
        border: none;
        border-radius: 8px;
        background-color: var(--primary-accent);
        color: #0c0a09;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        margin-top: 1.2rem;
        font-weight: 700;
        font-size: 0.95rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
      }

      .Btn::before {
        position: absolute;
        content: "Ingresar al Sistema →";
        color: #0c0a09;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        border-radius: 8px;
        transition: all 0.2s ease;
        background-color: var(--primary-accent);
      }

      .Btn:hover {
        background-color: var(--primary-hover);
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.6), 0 0 12px var(--gold-glow);
      }

      .Btn:hover::before {
        background-color: var(--primary-hover);
      }

      .Btn:active {
        transform: scale(0.98);
      }
    </style>
</head>

<body>

  <div class="card">
    <!-- CHECKBOX OCULTO QUE CONTROLA EL ESTADO DEL ROBOT Y LA CONTRASEÑA -->
    <input
      class="blind-check"
      type="checkbox"
      id="blind-input"
      name="blindcheck"
      hidden
    />

    <!-- AVATAR ROBOT -->
    <label for="blind-input" class="avatar" title="¡Haz clic para interactuar!">
      <div class="robot-face">
        <div class="robot-antenna"></div>
        <div class="robot-eyes">
          <div class="robot-eye"></div>
          <div class="robot-eye"></div>
        </div>
        <div class="robot-mouth"></div>
      </div>
      <div class="robot-visor">
        <i class="bi bi-shield-lock-fill"></i>
      </div>
    </label>

    <!-- FORMULARIO LARAVEL BLADE -->
    <form class="form" action="{{ route('login') }}" method="POST">
      @csrf

      <div class="brand-icon text-center mb-1">
        <i class="bi bi-box-seam-fill"></i>
      </div>

      <h3 class="title text-center">Acceso al Sistema</h3>
      <p class="text-center text-muted-gold mb-3">Ingresa tus credenciales para continuar</p>

      <!-- ALERTAS DE ERRORES LARAVEL -->
      @if ($errors->any())
        <div class="alert alert-danger p-2 rounded-3 text-center fs-7 mb-3 w-100" style="background-color: rgba(239, 68, 68, 0.15); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3);">
          <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $errors->first() }}
        </div>
      @endif

      <!-- EMAIL -->
      <label class="label_input" for="email">Correo Electrónico</label>
      <input
        spellcheck="false"
        class="input"
        type="email"
        name="email"
        id="email"
        placeholder="usuario@papeleria.com"
        value="{{ old('email') }}"
        required
        autofocus
      />

      <!-- PASSWORD -->
      <label class="label_input" for="password">Contraseña</label>
      <div class="password-wrapper">
        <input
          spellcheck="false"
          class="input"
          type="password"
          name="password"
          id="password"
          placeholder="••••••••"
          required
        />
        <!-- ICONO DE OJO PARA ALTERNAR -->
        <label for="blind-input" class="toggle-eye" id="eyeIcon">
          <i class="bi bi-eye-slash-fill"></i>
        </label>
      </div>

      <!-- SUBMIT CON ESTILO CUSTOM -->
      <button type="submit" class="Btn"></button>

    </form>
  </div>

  <!-- SCRIPT PARA INTERCAMBIAR TIPO DE INPUT E ICONO DEL OJO -->
  <script>
    const blindCheck = document.getElementById('blind-input');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon').querySelector('i');

    blindCheck.addEventListener('change', function() {
      if (this.checked) {
        passwordInput.type = 'text';
        eyeIcon.className = 'bi bi-eye-fill';
      } else {
        passwordInput.type = 'password';
        eyeIcon.className = 'bi bi-eye-slash-fill';
      }
    });
  </script>
</body>
</html>