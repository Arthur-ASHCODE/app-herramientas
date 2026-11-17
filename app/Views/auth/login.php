
<main class="login">

    <!-- ========================================
         PANEL IZQUIERDO / IDENTIDAD
    ========================================= -->
    <section class="login__brand">

        <div class="login__brand-content">

            <!-- Logo -->
            <div class="login__logo">

                <img
                    src="<?= htmlspecialchars(asset('img/logo/SSYPAZ02.png'), ENT_QUOTES, 'UTF-8') ?>"
                    alt="ASHCODE"
                >

                <span>www.ashcode.com.mx</span>

            </div>


            <!-- Bienvenida -->
            <div class="login__welcome">

                <h1>Bienvenido</h1>

                <p>
                    Inicia sesión para continuar<br>
                    en el Sistema de Documentación
                </p>

            </div>


            <!-- Características -->
            <div class="login__features">

                <article class="login__feature">

                    <div class="login__feature-icon">
                        🛡
                    </div>

                    <h3>Seguro</h3>

                    <p>
                        Protegemos tu<br>
                        información
                    </p>

                </article>


                <article class="login__feature">

                    <div class="login__feature-icon">
                        ⚡
                    </div>

                    <h3>Rápido</h3>

                    <p>
                        Accede de forma<br>
                        ágil y segura
                    </p>

                </article>


                <article class="login__feature">

                    <div class="login__feature-icon">
                        ☁
                    </div>

                    <h3>Confiable</h3>

                    <p>
                        Sistema estable<br>
                        24/7
                    </p>

                </article>

            </div>

        </div>


        <!-- Copyright -->
        <footer class="login__copyright">

            <p>
                &copy; <?= date('Y') ?> Arturo Silva.
                Todos los derechos reservados.
            </p>

        </footer>

    </section>



    <!-- ========================================
         PANEL DERECHO
    ========================================= -->
    <section class="login__content">

        <!-- Fondo -->
        <div class="login__background"></div>


        <!-- ====================================
             TARJETA LOGIN
        ===================================== -->
        <div class="login__card">

            <header class="login__header">

                <h2>Control de Herramientas</h2>

                <span class="login__header-line"></span>

            </header>


            <!-- ====================================
                 MENSAJES DE ERROR
            ===================================== -->

            <?php if (!empty($_SESSION['login_error'])): ?>

                <div
                    class="login__error"
                    role="alert"
                >

                    <?= htmlspecialchars(
                        (string) $_SESSION['login_error'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>

                </div>

                <?php
                    // Mostrar el mensaje una sola vez.
                    unset($_SESSION['login_error']);
                ?>

            <?php endif; ?>


            <!-- ====================================
                 FORMULARIO LOGIN
            ===================================== -->

            <form
                class="login__form"
                action="<?= htmlspecialchars(url('login'), ENT_QUOTES, 'UTF-8') ?>"
                method="POST"
            >

                <!-- ====================================
                     TOKEN DE SEGURIDAD CSRF
                ===================================== -->

                <input
                    type="hidden"
                    name="csrf_token"
                    value="<?= htmlspecialchars(
                        $_SESSION['csrf_token'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                >


                <!-- ====================================
                     USUARIO
                ===================================== -->

                <div class="login__field">

                    <label for="user">
                        Usuario
                    </label>

                    <div class="login__input">

                        <span class="login__input-icon">
                            ♙
                        </span>

                        <input
                            type="text"
                            id="user"
                            name="user"
                            placeholder="Ingresa tu usuario"
                            autocomplete="username"
                            maxlength="100"
                            required
                        >

                    </div>

                </div>


                <!-- ====================================
                     CONTRASEÑA
                ===================================== -->

                <div class="login__field">

                    <label for="password">
                        Contraseña
                    </label>

                    <div class="login__input">

                        <span class="login__input-icon">
                            🔒
                        </span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Ingresa tu contraseña"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            class="login__password-toggle"
                            type="button"
                            aria-label="Mostrar contraseña"
                        >
                            ◉
                        </button>

                    </div>

                </div>


                <!-- ====================================
                     OPCIONES
                ===================================== -->

                <div class="login__options">

                    <label class="login__remember">

                        <input
                            type="checkbox"
                            name="remember"
                        >

                        <span>Recordarme</span>

                    </label>


                    <a
                        class="login__forgot"
                        href="#"
                    >
                        ¿Olvidaste tu contraseña?
                    </a>

                </div>


                <!-- ====================================
                     BOTÓN INICIAR SESIÓN
                ===================================== -->

                <button
                    class="login__submit"
                    type="submit"
                >

                    <span>→</span>

                    Iniciar sesión

                </button>

            </form>


            <!-- ====================================
                 SEPARADOR
            ===================================== -->

            <div class="login__separator">

                <span></span>

                <p>o continúa con</p>

                <span></span>

            </div>


            <!-- ====================================
                 LOGIN SOCIAL
            ===================================== -->

            <div class="login__social">

                <button
                    class="login__social-button"
                    type="button"
                    aria-label="Continuar con Facebook"
                >
                    F
                </button>


                <button
                    class="login__social-button"
                    type="button"
                    aria-label="Continuar con Google"
                >
                    G
                </button>


                <button
                    class="login__social-button"
                    type="button"
                    aria-label="Continuar con Microsoft"
                >
                    M
                </button>

            </div>

        </div>

    </section>

</main>
