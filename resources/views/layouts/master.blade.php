<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <link rel="stylesheet" href="/css/app.css">


    <script nonce="d130c172-840e-4adb-9085-3d0b5fee7af6">
        (function(w, d) {
            ! function(a, e, t, r, z) {
                a.zarazData = a.zarazData || {}, a.zarazData.executed = [], a.zarazData.tracks = [], a.zaraz = {
                    deferred: []
                };
                var s = e.getElementsByTagName("title")[0];
                s && (a.zarazData.t = e.getElementsByTagName("title")[0].text), a.zarazData.w = a.screen.width, a
                    .zarazData.h = a.screen.height, a.zarazData.j = a.innerHeight, a.zarazData.e = a.innerWidth, a
                    .zarazData.l = a.location.href, a.zarazData.r = e.referrer, a.zarazData.k = a.screen.colorDepth, a
                    .zarazData.n = e.characterSet, a.zarazData.o = (new Date).getTimezoneOffset(), a.dataLayer = a
                    .dataLayer || [], a.zaraz.track = (e, t) => {
                        for (key in a.zarazData.tracks.push(e), t) a.zarazData["z_" + key] = t[key]
                    }, a.zaraz._preSet = [], a.zaraz.set = (e, t, r) => {
                        a.zarazData["z_" + e] = t, a.zaraz._preSet.push([e, t, r])
                    }, a.dataLayer.push({
                        "zaraz.start": (new Date).getTime()
                    }), a.addEventListener("DOMContentLoaded", (() => {
                        var t = e.getElementsByTagName(r)[0],
                            z = e.createElement(r);
                        z.defer = !0, z.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(
                            a.zarazData))), t.parentNode.insertBefore(z, t)
                    }))
            }(w, d, 0, "script");
        })(window, document);
    </script>
</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper" id="app">



        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="/" class="brand-link">
                
                <span class="brand-text font-weight-light">Practical</span>
            </a>

            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    
                    <div class="info">
                        <div class="d-block" style="font-size:20px;color:white">{{Auth::user()->name}}</div>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                         <li class="nav-item">
                            <router-link to="/dashboard" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/developer" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Developer
                                </p>
                            </router-link>
                        </li>
                       
                    </ul>
                </nav>

            </div>

        </aside>

        <div class="content-wrapper">

            <section class="content-header">
                <div class="container-fluid">
                    <router-view></router-view>
                </div>
            </section>

           

        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

       

    </div>



    <script src="/js/app.js"></script>
</body>

</html>
