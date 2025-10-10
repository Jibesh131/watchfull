$(document).ready(function () {
    const $siteLogo = $('.site-logo');
    const $sidebar = $('#sidebar');
    const $toggleBtnBox = $('.toggleBtnBox');
    const $toggleBtn = $('#sidebarToggle');
    const $sidebarTitle = $('.sidebar-title');
    const $iconOpen = $('#icon-open');
    const $iconFolded = $('#icon-folded');
    const $mainContent = $('#mainContent');
    const $mobileMenu = $('#mobileMenu');

    let folded = false;
    let hoverActive = false;

    function foldSidebar() {
        folded = true;
        $sidebar.addClass('sidebar-folded');
        $siteLogo.hide();
        $iconOpen.hide();
        $iconFolded.show();
        $mainContent.css('margin-left', '4rem');
        $toggleBtnBox.css('justify-content', 'center');
        $sidebarTitle.hide();
    }

    function unfoldSidebar() {
        folded = false;
        $sidebar.removeClass('sidebar-folded');
        $siteLogo.show();
        $iconOpen.show();
        $iconFolded.hide();
        $mainContent.css('margin-left', '15rem');
        $toggleBtnBox.css('justify-content', 'space-between');
        $sidebarTitle.show();
    }

    // Hover behavior for desktop
    function tempUnfold() {
        if (folded && !hoverActive && $(window).width() > 768) {
            hoverActive = true;
            $sidebar.removeClass('sidebar-folded');
            $siteLogo.show();
            $toggleBtnBox.css('justify-content', 'space-between');
            $sidebarTitle.show();
        }
    }

    function tempFold() {
        if (folded && hoverActive && $(window).width() > 768) {
            hoverActive = false;
            $sidebar.addClass('sidebar-folded');
            $siteLogo.hide();
            $toggleBtnBox.css('justify-content', 'center');
            $sidebarTitle.hide();
        }
    }

    // Toggle button click
    $toggleBtn.on('click', function () {
        if (folded) {
            unfoldSidebar();
        } else {
            foldSidebar();
        }
    });

    // Hover only on large screens
    $sidebar.on('mouseenter', tempUnfold);
    $sidebar.on('mouseleave', tempFold);

    // Mobile menu
    $mobileMenu.on('click', function () {
        $sidebar.toggleClass('-translate-x-full');
    });

    // Reset on resize
    $(window).on('resize', function () {
        if ($(window).width() > 768) {
            $sidebar.removeClass('-translate-x-full');
        }
    });
});