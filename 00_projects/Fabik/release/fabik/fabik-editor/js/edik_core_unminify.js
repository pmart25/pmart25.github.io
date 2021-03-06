var edik_core = function() {
    var e = document.getElementById("edik-canvas"),
	//var e = document.getElementById("c"),
        c = {
            rotate: {
                type: "switch",
                value: 0
            },
            flip_hor: {
                type: "switch",
                value: 0
            },
            flip_ver: {
                type: "switch",
                value: 0
            },
            greyscale: {
                type: "switch",
                value: 0
            },
            invert: {
                type: "switch",
                value: 0
            },
            brightness: {
                type: "filter",
                value: 0,
                from: -100,
                to: 100
            },
            contrast: {
                type: "filter",
                value: 0,
                from: -100,
                to: 100
            },
            saturation: {
                type: "filter",
                value: 0,
                from: -100,
                to: 100
            },
            vibrance: {
                type: "filter",
                value: 0,
                from: -100,
                to: 100
            },
            exposure: {
                type: "filter",
                value: 0,
                from: -100,
                to: 100
            },
            hue: {
                type: "filter",
                value: 0,
                from: 0,
                to: 100
            },
            sepia: {
                type: "filter",
                value: 0,
                from: 0,
                to: 100
            },
            noise: {
                type: "filter",
                value: 0,
                from: 0,
                to: 100
            },
            clip: {
                type: "filter",
                value: 0,
                from: 0,
                to: 100
            }
        },
        l = !1,
        h = document.createElement("canvas"),
        g = this,
        d = jQuery,
        f, n, p, k = {
            afterRender: function() {},
            beforeImageLoad: function() {},
            afterImageLoad: function() {},
            afterReset: function() {},
            save: function(a, b) {}
        },
        s = function(a) {
            var b = "image/jpeg";
            switch (a.substring(a.lastIndexOf(".") + 1).toLowerCase().replace(/\?.*/, "")) {
                case "gif":
                    b = "image/gif";
                    break;
                case "png":
                    b = "image/png"
            }
            return b
        };
    edik_core.prototype.init = function(a, b) {
        k.beforeImageLoad();
        e = Caman(a, b, function() {
            p = s(b);
            h.width = this.width;
            h.height = this.height;
            h.getContext("2d").drawImage(this.canvas, 0, 0);
            this.render(function() {
                d(a).after('<canvas id="edik-canvas-preview"></canvas>');
                f = document.getElementById("edik-canvas-preview");
                n = f.getContext("2d");
                f.width = 650;
                f.height = 500;
                q();
                k.afterImageLoad()
            })
        })
    };
    edik_core.prototype.fit_size = function(a, b, c, d) {
        c /= a;
        var e = d / b;
        d = 1;
        if (1 > c || 1 > e) d = Math.min(c, e);
        a = Math.round(a * d);
        b = Math.round(b *
            d);
        return {
            width: a,
            height: b
        }
    };
    var q = function() {
            e = document.getElementById("edik-canvas");
			//e = document.getElementById("c");
            var a = g.fit_size(e.width, e.height, 650, 500),
                b = Math.round((650 - a.width) / 2),
                c = Math.round((500 - a.height) / 2);
            f.width = f.width;
            n.drawImage(e, 0, 0, e.width, e.height, b, c, a.width, a.height)
        },
        r = function() {
            if (!l) {
                d("#edik-busy").fadeIn("fast");
                l = !0;
                var a = document.createElement("canvas"),
                    b = document.createElement("canvas");
                a.width = h.width;
                a.height = h.height;
                a.getContext("2d").drawImage(h, 0, 0);
                ctx = a.getContext("2d");
                0 !== c.flip_hor.value &&
                    0 !== c.flip_ver.value ? (ctx.scale(-1, -1), ctx.drawImage(a, -a.width, -a.height)) : 0 !== c.flip_hor.value ? (ctx.translate(a.width, 0), ctx.scale(-1, 1), ctx.drawImage(a, 0, 0)) : 0 !== c.flip_ver.value && (ctx.scale(1, -1), ctx.drawImage(a, 0, -a.height));
                if (0 !== c.rotate.value) {
                    var e = a.width,
                        f = a.height,
                        g = 0,
                        m = 0;
                    switch (c.rotate.value) {
                        case 90:
                            e = a.height;
                            f = a.width;
                            m = -1 * a.height;
                            break;
                        case 180:
                            g = -1 * a.width;
                            m = -1 * a.height;
                            break;
                        case 270:
                            e = a.height, f = a.width, g = -1 * a.width
                    }
                    b.width = e;
                    b.height = f;
                    ctx2 = b.getContext("2d");
                    ctx2.rotate(parseInt(c.rotate.value) *
                        Math.PI / 180);
                    ctx2.drawImage(a, g, m);
                    a = b;
                    ctx = a.getContext("2d")
                }
                Caman(a, function() {
                    var b = this;
                    d.each(c, function(a, c) {
                        if ("filter" === c.type && 0 != parseInt(c.value)) b[a](parseInt(c.value))
                    });
                    0 !== parseInt(c.greyscale.value) && this.greyscale();
                    0 !== parseInt(c.invert.value) && this.invert();
                    this.render(function() {
                        var b = document.getElementById("edik-canvas");
                        //var b = document.getElementById("c");
						b.width = b.width;
                        var c = b.getContext("2d");
                        b.width = a.width;
                        b.height = a.height;
                        c.drawImage(a, 0, 0);
                        l = !1;
                        q();
                        d("#edik-busy").fadeOut("fast");
                        k.afterRender()
                    })
                })
            }
        };
    edik_core.prototype.setFilter = function(a, b) {
        g.setToolValue(a, b);
        d("#" + a + "Value").html(b);
        r()
    };
    edik_core.prototype.save = function() {
        Caman("#edik-canvas", function() {
		//Caman("#c", function() {
            var a = this.canvas.toDataURL(p);
            k.save(a, c)
        })
    };
    edik_core.prototype.resetFilters = function() {
        d.each(c, function(a, b) {
            g.setToolValue(a, 0)
        });
        d.each(c, function(a, b) {
            "filter" === c[a].type && (g.setFilter(a, 0), d("#" + a + "_slider").val(0))
        });
        d(".edik-tool").data("value", 0).removeClass("switched");
        k.afterReset();
        r()
    };
    edik_core.prototype.setCallback = function(a,
        b) {
        k[a] = b
    };
    edik_core.prototype.getTools = function() {
        return c
    };
    edik_core.prototype.getToolValue = function(a) {
        return c[a].value
    };
    edik_core.prototype.setToolValue = function(a, b) {
        return c[a].value = b
    }
};