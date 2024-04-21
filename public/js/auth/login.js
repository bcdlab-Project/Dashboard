const keycloak = new Keycloak({
    url: 'https://auth.bcdlab.xyz',
    realm: 'bcdlab',
    clientId: 'dashboard'
});


keycloak.init({onLoad: 'check-sso',silentCheckSsoRedirectUri: `https://dash.bcdlab.xyz/login/silentCheck`}).then(authenticated => {
    if (authenticated) {
        fetch('https://dash.bcdlab.xyz/login/auto', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `token=${keycloak.token}`
        }).then(status => {
            if (status.status === 200) {
                window.location.href = 'https://dash.bcdlab.xyz';
            } else {
                fetch('https://dash.bcdlab.xyz/login/unauthorized');
                keycloak.login();
            }
        });
    } else {
        fetch('https://dash.bcdlab.xyz/login/unauthorized');
        keycloak.login();
    }
});