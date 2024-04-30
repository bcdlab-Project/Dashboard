const keycloak = new Keycloak({
    url: 'https://auth.bcdlab.xyz',
    realm: 'bcdlab',
    clientId: 'dashboard',
});


keycloak.init({onLoad: 'check-sso',silentCheckSsoRedirectUri: `https://dash.bcdlab.xyz/login/silentCheck`}).then(authenticated => {
    if (authenticated) {        
        fetch('https://dash.bcdlab.xyz/login/auto', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `token=${keycloak.token}`
        })
    } else {
        fetch('https://dash.bcdlab.xyz/login/unauthorized');
        keycloak.login({redirectUri: 'https://dash.bcdlab.xyz/'});
    }
}).catch(error => {
    fetch('https://dash.bcdlab.xyz/login/unauthorized').then(() => {
        window.location.href = 'https://dash.bcdlab.xyz/login';
    });
});