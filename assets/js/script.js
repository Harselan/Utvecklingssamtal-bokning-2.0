$("*").each( function () {
    var $this = $(this);
    if (parseInt($this.css("fontSize")) < 12) {
        $this.css({ "font-size": "12px" });
    }
});
