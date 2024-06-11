$(".btn-primary, .btn-success").on("click", function (e) {
    var $button = $(this);
    if ($button.data("brother") == undefined) {
        var $brother = $(document.createElement($button[0].tagName));
        $brother.html("Please wait...");
        $brother.attr("disabled", true);
        $brother.addClass("disabled");
        $brother.addClass($button.attr("class"));
        $brother.hide();
        $brother.insertAfter($button);
        $button.data("brother", $brother)
    } else {
        var $brother = $button.data("brother");
    }

    if ($button.css("display") !== "none") {
        $brother.show();
        $button.hide();
        setTimeout(function () {
            $brother.hide();
            $button.show();
        }, 1000);
    }
});