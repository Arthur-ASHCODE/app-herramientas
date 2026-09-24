<main class="login">

    <!-- ========================================
         PANEL IZQUIERDO / IDENTIDAD
    ========================================= -->
    <section class="login__brand">

        <div class="login__brand-content">

            <!-- Logo -->
            <div class="login__logo">
                <img
                    src="/App/app-base/assets/img/logo/SSYPAZ02.png"
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
                        <!-- Icono -->
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
                        <!-- Icono -->
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
                        <!-- Icono -->
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


            <!-- Formulario -->
            <form
                class="login__form"
                action=""
                method="POST"
            >

                <!-- Usuario -->
                <div class="login__field">

                    <label for="user">
                        Usuario o correo
                    </label>

                    <div class="login__input">

                        <span class="login__input-icon">
                            <!-- Icono usuario -->
                            ♙
                        </span>

                        <input
                            type="text"
                            id="user"
                            name="user"
                            placeholder="Ingresa tu usuario o correo"
                            autocomplete="username"
                            required
                        >

                    </div>

                </div>


                <!-- Contraseña -->
                <div class="login__field">

                    <label for="password">
                        Contraseña
                    </label>

                    <div class="login__input">

                        <span class="login__input-icon">
                            <!-- Icono candado -->
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
                            <!-- Icono ojo -->
                            ◉
                        </button>

                    </div>

                </div>


                <!-- Opciones -->
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


                <!-- Botón iniciar sesión -->
                <button
                    class="login__submit"
                    type="submit"
                >

                    <span>
                        <!-- Icono -->
                        →
                    </span>

                    Iniciar sesión

                </button>

            </form>


            <!-- Separador -->
            <div class="login__separator">

                <span></span>

                <p>o continúa con</p>

                <span></span>

            </div>


            <!-- Login social -->
            <div class="login__social">

                <button
                    class="login__social-button"
                    type="button"
                    aria-label="Continuar con Facebook"
                >
                    <!-- Facebook -->
                    F
                </button>


                <button
                    class="login__social-button"
                    type="button"
                    aria-label="Continuar con Google"
                >
                    <!-- Google -->
                    G
                </button>


                <button
                    class="login__social-button"
                    type="button"
                    aria-label="Continuar con Microsoft"
                >
                    <!-- Microsoft -->
                    M
                </button>

            </div>

        </div>

    </section>

</main>