(function () {
    var currentScript = document.currentScript;
    var endpoint = currentScript && currentScript.dataset.endpoint
        ? currentScript.dataset.endpoint
        : new URL('/api/v1/visits', currentScript ? currentScript.src : window.location.origin).toString();

    function visitorKey() {
        var key = localStorage.getItem('visitor_key');

        if (!key) {
            key = (crypto.randomUUID ? crypto.randomUUID() : String(Date.now()) + Math.random().toString(16).slice(2));
            localStorage.setItem('visitor_key', key);
        }

        return key;
    }

    function deviceType() {
        var ua = navigator.userAgent;

        if (/tablet|ipad|playbook|silk/i.test(ua)) {
            return 'tablet';
        }

        if (/mobile|android|iphone|ipod|blackberry|opera mini|iemobile/i.test(ua)) {
            return 'mobile';
        }

        return 'desktop';
    }

    function send(payload) {
        var body = JSON.stringify(payload);

        if (navigator.sendBeacon) {
            var blob = new Blob([body], {type: 'application/json'});
            if (navigator.sendBeacon(endpoint, blob)) {
                return;
            }
        }

        fetch(endpoint, {
            method: 'POST',
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            body: body,
            keepalive: true,
            mode: 'cors'
        }).catch(function () {});
    }

    function collectGeo() {
        return fetch('https://ipapi.co/json/', {mode: 'cors'})
            .then(function (response) {
                return response.ok ? response.json() : {};
            })
            .catch(function () {
                return {};
            });
    }

    collectGeo().then(function (geo) {
        send({
            visitor_key: visitorKey(),
            ip: geo.ip || null,
            city: geo.city || null,
            device: deviceType(),
            user_agent: navigator.userAgent,
            page_url: window.location.href
        });
    });
})();
