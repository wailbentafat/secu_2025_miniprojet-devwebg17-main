document.addEventListener('DOMContentLoaded', () => {

    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    if (toggle && password) {
        toggle.addEventListener('click', () => {
            const type = password.type === 'password' ? 'text' : 'password';
            password.type = type;
            toggle.textContent = type === 'password' ? '👁' : '🙈';
        });
    }

    const form = document.getElementById('login-form');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const username = document.getElementById('username').value;
        const pwd = document.getElementById('password').value;
        const message = document.getElementById('login-message');

        message.textContent = 'Logging in...';
        message.style.color = 'black';

        fetch('api/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ username, password: pwd })
        })
            .then(res => res.json())
            .then(data => {
                message.textContent = data.message;
                message.style.color = data.success ? '#10b981' : '#ef4444';

                if (data.success) {
                    setTimeout(() => {
                        if (data.role === 'admin') {
                            window.location.href = 'admin/index.php';
                        } else {
                            window.location.href = 'index.php';
                        }
                    }, 800);
                }
            })
            .catch(() => {
                message.textContent = 'Server error';
                message.style.color = 'red';
            });
    });
});
