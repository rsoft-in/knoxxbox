<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Customer Loyalty Management Services, Loyalty Program, Shopping, Gifts, Software as a Service SAAS, Loyalty Cards, Coupons, Point Redemptions">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>
        <?php echo $this->config->item('app_name') ?>
    </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>res/default.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>res/icon_classes.css">
    <link rel="stylesheet" href="https://assets.ubuntu.com/v1/vanilla-framework-version-2.36.0.min.css" />
    <script src="<?php echo base_url() ?>res/default.js"></script>

</head>

<body>
    <div class="l-application" role="presentation">
        <div class="l-navigation-bar">
            <div class="p-panel is-dark">
                <div class="p-panel__header">
                    <a class="p-panel__logo" href="#">
                        <img class="p-panel__logo-icon" src="<?php echo base_url() ?>res/knoxxbox.png" alt="<?php echo $this->config->item('app_name') ?>" height="24">
                        <img class="p-panel__logo-name is-fading-when-collapsed" src="<?php echo base_url() ?>res/knoxxbox-banner.png" alt="JAAS" style="height: 24px;">
                    </a>
                    <div class="p-panel__controls">
                        <span class="p-panel__toggle js-menu-toggle">Menu</span>
                    </div>
                </div>
            </div>
        </div>

        <header class="l-navigation is-collapsed">
            <div class="l-navigation__drawer">
                <div class="p-panel is-dark">
                    <div class="p-panel__header is-sticky">
                        <a class="p-panel__logo" href="#">
                            <img class="p-panel__logo-icon" src="<?php echo base_url() ?>res/knoxxbox.png" alt="<?php echo $this->config->item('app_name') ?>" height="24">
                            <img class="p-panel__logo-name is-fading-when-collapsed" src="<?php echo base_url() ?>res/knoxxbox-banner.png" alt="JAAS" style="height: 24px;">
                        </a>
                        <div class="p-panel__controls u-hide--large">
                            <button class="p-button--base has-icon u-no-margin u-hide--medium js-menu-close"><i class="p-icon--close"></i></button>
                            <button class="p-button--base has-icon u-no-margin u-hide--small js-menu-small-close"><i class="p-icon--close"></i></button>
                        </div>
                    </div>
                    <div class="p-panel__content">
                        <div class="p-side-navigation--icons is-dark" id="drawer-icons">
                            <nav aria-label="Main navigation">
                                <ul class="p-side-navigation__list">
                                    <?php if (isset($_SESSION["is_app_logged"])) { ?>
                                        <li class="p-side-navigation__item u-hide--large u-hide--medium">
                                            <a class="p-side-navigation__link" href="<?php echo base_url() ?>profile">
                                                <i class="p-icon--user p-side-navigation__icon"></i>
                                                <span class="p-side-navigation__label"><?php echo $_SESSION["kx_username"] ?></span>
                                            </a>
                                        </li>
                                        <hr class="u-hide--large u-hide--medium">
                                    <?php } ?>
                                    <li class="p-side-navigation__item">
                                        <a class="p-side-navigation__link" href="<?php echo base_url() ?>">
                                            <i class="rs-icon rs-icon__home p-side-navigation__icon"></i>
                                            <span class="p-side-navigation__label"><span class="p-side-navigation__label">Home</span></span></a>
                                    </li>
                                    <li class="p-side-navigation__item">
                                        <a class="p-side-navigation__link" href="<?php echo base_url() ?>pages/pricing">
                                            <i class="rs-icon rs-icon__attachmoney p-side-navigation__icon"></i>
                                            <span class="p-side-navigation__label">Pricing</span>
                                        </a>
                                    </li>
                                    <?php if (isset($_SESSION["is_app_logged"])) { ?>
                                        <li class="p-side-navigation__item">
                                            <a class="p-side-navigation__link" href="#">
                                                <i class="rs-icon rs-icon__dashboard p-side-navigation__icon"></i>
                                                <span class="p-side-navigation__label">Dashboard</span>
                                            </a>
                                        </li>
                                        <li class="p-side-navigation__item">
                                            <a class="p-side-navigation__link" href="#">
                                                <i class="rs-icon rs-icon__settings p-side-navigation__icon"></i>
                                                <span class="p-side-navigation__label">Settings</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="l-main">
            <div class="p-panel">
                <div class="p-panel__header">
                    <h4 class="p-panel__title"><?php echo $title ?></h4>
                    <div class="p-panel__controls">
                        <?php if (isset($_SESSION["is_app_logged"])) { ?>
                            <a href="<?php echo base_url() ?>profile" class="p-link--soft u-hide--small" style="margin-right: 10px;">
                                <i class="p-icon--user"></i>
                                <?php echo $_SESSION["kx_username"] ?></a>
                            <a class="u-no-margin--bottom p-link--soft" href="<?php echo base_url() ?>login/logout">Sign-Out</a>
                        <?php } else { ?>
                            <a class="u-no-margin--bottom p-link--soft" href="<?php echo base_url() ?>login">Sign-In</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="p-panel__content">
                    <div class="u-fixed-width">

                        <?php $this->load->view($content) ?>

                    </div>
                </div>
            </div>
        </main>

        <aside class="l-status">
            <div class="p-panel demo-status">
                <!-- <div class="u-fixed-width"> -->
                <div class="u-align--center"><small>&copy 2021 <a class='secondary' href='http://rennovationsoftware.com' target="_blank">Rennovation Software</a></small></div>
                <!-- </div> -->
            </div>
        </aside>
        <div id="app-notification" style="display: none; position: absolute; top: 5px; right: 5px;">
            <div class="p-notification--information">
                <div class="p-notification__content">
                    <h5 class="p-notification__title">Knoxxbox</h5>
                    <span class="p-notification__message"></span>
                </div>
            </div>
        </div>
    </div>
    <script>
        if (document.querySelector('.js-menu-toggle')) {
            document.querySelector('.js-menu-toggle').addEventListener('click', function() {
                document.querySelector('.l-navigation').classList.toggle('is-collapsed');
            });
        }

        if (document.querySelector('.js-menu-close')) {
            document.querySelector('.js-menu-close').addEventListener('click', function(e) {
                document.querySelector('.l-navigation').classList.add('is-collapsed');
                document.activeElement.blur();
            });
        }
        if (document.querySelector('.js-menu-small-close')) {
            document.querySelector('.js-menu-small-close').addEventListener('click', function(e) {
                document.querySelector('.l-navigation').classList.add('is-collapsed');
                document.activeElement.blur();
            });
        }


        // if (document.querySelector('.js-menu-pin')) {
        //     document.querySelector('.js-menu-pin').addEventListener('click', function() {
        //         document.querySelector('.l-navigation').classList.toggle('is-pinned');
        //         if (document.querySelector('.l-navigation').classList.contains('is-pinned')) {
        //             document.querySelector('.js-menu-pin').querySelector('i').classList.remove('p-icon--pin');
        //         } else {
        //             document.querySelector('.js-menu-pin').querySelector('i').classList.add('p-icon--pin');
        //         }
        //         document.activeElement.blur();
        //     });
        // }

        function showNotification(msg, type) {
            $('.p-notification__title').html(type);
            $('.p-notification__message').html(msg);
            $('#app-notification').show();
            console.log(msg);

            setTimeout(function() {
                $('#app-notification').hide();
            }, 2000);
        }
    </script>
</body>

</html>