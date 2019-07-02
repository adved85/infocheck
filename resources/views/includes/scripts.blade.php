<script src="/js/jquery.js"></script>
<script src="/js/plugins.js"></script>
<script type="text/javascript" src="/js/wow.min.js"></script>
<script src="/js/functions.js"></script>
<script src="/js/greedyNav.js"></script>
<script src="/js/jquery.jscroll.min.js"></script>
<script>
//$('ul.pagination').hide();
    $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<img class="center-block" src="/images/loading.gif" alt="Loading..." />',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });

</script>
<script src='/js/lib/moment.min.js'></script>
<script src='/js/fullcalendar.min.js'></script>
<script src='/js/locale-all.js'></script>
<script src="/js/calen.js"></script>
<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5cf2d7807feea60012093f9e&product=social-ab' async='async'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.0.5/flickity.pkgd.min.js" type="text/javascript" charset="utf-8"></script>

<script src="/js/jquery.morelines.min.js"></script>

<script src="/js/lightbox.js"></script>
{!!  $data['event']->script() !!}

<script>

    window.onload = function() {
        loading.style.display = 'none'
        document.body.style.overflowY = 'auto'
        // loaded.style.visibility = 'visible'
        // loaded.style.display = 'block'
        // header.style.display = 'block'
        // footer.style.display = 'block'
        // content.style.display = 'block'

        /* hide last divider of large-lang-menu */
        let largeLangMenu = document.getElementsByClassName('large-lang-menu')[0];
        let spanDividers = largeLangMenu.getElementsByClassName('lang-divider');
        let lastDivider = spanDividers[spanDividers.length - 1].style.display = 'none';
    }




    $(function() {
      $('#post-list-footer .entry-title').moreLines({
        linecount: 2,
        baseclass: 'entry-title',
        // basejsclass: 'js-text',
        // classspecific: '_rm',
        buttontxtmore: "read more",
        buttontxtless: "read less",
        animationspeed: 250
      });

      $('#post-list-footer1 .entry-title').moreLines({
        linecount: 2,
        baseclass: 'entry-title',
        // basejsclass: 'js-text',
        // classspecific: '_rm',
        buttontxtmore: "read more",
        buttontxtless: "read less",
        animationspeed: 250
      });

    });
</script>

