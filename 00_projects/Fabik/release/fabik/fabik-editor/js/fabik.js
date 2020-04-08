var fabik;
fabik_init = function(g, h, d, f) {
    var e = (new Date).valueOf(),
        a = jQuery;
    a.when(a("<link/>", {
        rel: "stylesheet",
        type: "text/css",
        href: d + "css/fabik.css?" + e
    }).appendTo("head"), a.getScript(d + "lib/camanjs/dist/caman.full.js"), a.getScript(d + "js/fabik_core.js?" + e), a.getScript(d + "js/jquery.nouislider.min.js"), a.get(d + "main_form.html?" + e, function(d) {
        a(h).html(d)
    }), a.Deferred(function(d) {
        a(d.resolve)
    })).done(function() {
        fabik = new fabik_core;
        "undefined" != typeof f && a.each(f, function(a, c) {
            fabik.setCallback(a, c)
        });
        a = jQuery;
        Caman.remoteProxy =
            Caman.IO.useProxy("php");
        Caman.remoteProxy = d + "lib/camanjs/proxies/caman_proxy.php";
        fabik.setCallback("afterRender", function() {});
        fabik.setCallback("beforeImageLoad", function() {
            a("#fabik-overlay").show()
        });
        fabik.setCallback("afterImageLoad", function() {
            a("#fabik-overlay").fadeOut()
        });
        //fabik.init("#fabik-canvas", g);
		fabik.init("#c", g);
        var e = fabik.getTools();
        a.each(e, function(b, c) {
            "filter" === c.type && a("#" + b + "_slider").noUiSlider({
                range: [c.from, c.to],
                handles: 1,
                step: 1,
                start: 0,
                slide: function() {
                    fabik.setFilter(b, parseInt(a(this).val()))
                }
            })
        });
        a("#fabik-container").on("click", "#fabik-reset", function() {
            confirm("Do you really want reset all changes?") && fabik.resetFilters()
        });
        a("#fabik-container").on("click", ".fabik-tool", function() {
            var b = a(this).data("tool"),
                c = 1 === a(this).data("value") ? 0 : 1;
            a(this).data("value", c);
            fabik.setFilter(b, c)
        });
        a("#fabik-container").on("click", ".fabik-tool.greyscale, .fabik-tool.invert", function() {
            a(this).toggleClass("switched")
        });
        a("#fabik-container").on("click", ".fabik-rotate", function() {
            var b = fabik.getToolValue("rotate"),
                b = b + (a(this).hasClass("right") ? 90 : -90);
            270 < b ? b = 0 : 0 > b && (b = 270);
            fabik.setFilter("rotate", b)
        });
        a("#fabik-container").on("click", ".fabik-filter-pm", function() {
            var b = a(this).data("tool"),
                c = parseInt(a("#" + b + "_slider").val()),
                d = a(this).data("direction"),
                e = fabik.getTools(),
                c = c + 5 * ("minus" === d ? -1 : 1),
                c = c > e[b].to ? e[b].to : c,
                c = c < e[b].from ? e[b].from : c;
            a("#" + b + "_slider").val(c);
            fabik.setFilter(b, c);
            return !1
        });
        a("#fabik-container").on("click", "#fabik-save", function() {
            fabik.save();
            return !1
        });
        a("#fabik-container").on("mouseover",
            ".fabik-filter-edit",
            function() {
                a(this).parent().find(".fabik-slider-noui").slideDown("fast")
            });
        a("#fabik-container").on("mouseleave", ".fabik-filter", function() {
            a(this).find(".fabik-slider-noui").slideUp("fast")
        })
    })
};