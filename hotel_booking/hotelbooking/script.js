function handleCredentialResponse(response) {
    fetch('google_login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'credential=' + response.credential
    })
    .then(res => {
        if (res.redirected) {
            window.location.href = res.url; // Redirect to dashboard.php
        } else {
            return res.text();
        }
    })
    .then(data => console.log(data));
}

