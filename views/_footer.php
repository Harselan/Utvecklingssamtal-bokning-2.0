            </div>
        </div>
        <script src="<?= assets('/js/jquery.min.js') ?>"></script>
        <script src="<?= assets('/js/bootstrap.min.js') ?>"></script>
    </body>
    <script>
    $('[data-toggle="popover"]').popover();

    $('body').on('click', function (e) {
        $('[data-toggle="popover"]').each(function () {
            //the 'is' for buttons that trigger popups
            //the 'has' for icons within a button that triggers a popup
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });
    </script>
</html>
