(function(){
    var e = document.querySelector('.post'),
        thumbImage = document.querySelector('.featured-image'),
        t = document.querySelector("#pieWrapper"),
        n = document.querySelector(".entry-header"),
        o = true,
        r = t.querySelector(".pie--left"),
        i = t.querySelector(".pie--right"),
        c = t.querySelector(".mask--left"),
        s = 0,
        l = 0,
        f = !1,
        d = void 0,

        h = function(e, t) {
            "hide" === t ? e.classList.add("hide") : e.classList.remove("hide")
        },
        
        p = function(e, t, n, o) {
            r.style.transform = "rotate(" + e + "deg)", i.style.transform = "rotate(" + t + "deg)", h(c, o), h(i, n)
        },
        v = function(e, n) {
            t.classList.add("show"), s = n, s / e <= 1 ? (l = s / e * 360, s / e < .5 ? p(l, 0, "hide", "show") : p(180, l, "show", "hide")) : p(180, 360, "show", "hide")
        },
        g = function() {
            return document.querySelector('.post').getBoundingClientRect().bottom + window.pageYOffset - window.innerHeight;
        },
        m = function e(t) {
            v(t, window.pageYOffset), f === !0 && window.requestAnimationFrame(function() {
                e(t)
            })
        },
        y = function() {
          	if(!document.querySelector('.post')) {
              return; 
            } 
          	var e = g();
            f === !1 && (f = !0, m(e)), d && clearTimeout(d), d = setTimeout(function() {
                f = !1, setTimeout(function() {
                    t.classList.remove("show")
                }, 1500)
            }, 100)
        },
        w = function() {
            // console.log('event is fired!!')
            window.addEventListener("scroll", function() {
                y()
            })
        }; 

        // n.addEventListener("load", w);
        window.addEventListener("resize", w)
        w();
})();