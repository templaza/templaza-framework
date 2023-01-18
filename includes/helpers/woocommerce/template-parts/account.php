<?php
/**
 * Template part for modal account
 */

?>
<div class="modal-header">
    <h3 class="modal-title"><?php esc_html_e( 'Sign in', 'templaza-framework' ) ?></h3>
    <a href="#" class="close-account-panel button-close">
        <i class="fas fa-times"></i>
    </a>
</div>

<div class="modal-content">
    <form class="woocommerce woocommerce-account woocommerce-form woocommerce-form-login login" method="post">

		<?php do_action( 'woocommerce_login_form_start' ); ?>

        <p class="form-row form-row-wide">
            <input  placeholder="<?php  esc_attr_e( 'Username', 'templaza-framework' );?>" type="text" class="input-text" name="username" id="panel_username"/>
        </p>
        <p class="form-row form-row-wide">
            <span class="password-input">
                <input placeholder="<?php  esc_attr_e( 'Password', 'templaza-framework' );?>" class="input-text" type="password" name="password" id="panel_password"/>
            </span>
        </p>

		<?php do_action( 'woocommerce_login_form' ); ?>

        <p class="form-row form-row-wide form-row-remember">
            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme"
                       type="checkbox" value="forever"/>
                <span><?php esc_html_e( 'Remember me', 'templaza-framework' ); ?></span>
            </label>
            <label class="form-row form-row-wide lost_password">
                <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'templaza-framework' ); ?></a>
            </label>
        </p>

        <p class="form-row form-row-wide">
			<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
            <button type="submit" class="templaza-button" name="login"
                    value="<?php esc_attr_e( 'Sign in', 'templaza-framework' ); ?>"
                    data-signing="<?php esc_attr_e( 'Siging in...', 'templaza-framework' ); ?>"
                    data-signed="<?php esc_attr_e( 'Signed In', 'templaza-framework' ); ?>"><?php esc_html_e( 'Sign in', 'templaza-framework' ); ?></button>

			<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
                <span class="create-account templaza-button button-outline button-medium"><?php esc_html_e( 'Create An Account', 'templaza-framework' ); ?></span>
			<?php endif; ?>
        </p>

		<?php do_action( 'woocommerce_login_form_end' ); ?>

    </form>

	<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

        <form method="post" class="woocommerce-account woocommerce-form woocommerce-form-register register"
              style="display: none;">

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

                <p class="form-row form-row-wide">
                    <input placeholder="<?php  esc_attr_e( 'Username', 'templaza-framework' );?>" type="text" class="input-text" name="username" id="panel_reg_username"
                           value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
                </p>

			<?php endif; ?>

            <p class="form-row form-row-wide">
                <input placeholder="<?php  esc_attr_e( 'Email address', 'templaza-framework' );?>" type="email" class="input-text" name="email" id="panel_reg_email"
                       value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
            </p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                <p class="form-row form-row-wide">
                    <span class="password-input">
                        <input placeholder="<?php  esc_attr_e( 'Password', 'templaza-framework' );?>" type="password" class="input-text" name="password" id="panel_reg_password"/>
                    </span>
                </p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_register_form' ); ?>

            <p class="form-row form-row-wide">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                <button type="submit" class="templaza-button" name="register"
                        value="<?php esc_attr_e( 'Sign up', 'templaza-framework' ); ?>"><?php esc_html_e( 'Sign up', 'templaza-framework' ); ?></button>
            </p>

            <p class="form-row form-row-wide already_registered">
                <a href="#"
                   class="login templaza-button button-outline button-medium"><?php esc_html_e( 'Already has an account', 'templaza-framework' ); ?></a>
            </p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

        </form>

	<?php endif; ?>
</div>
