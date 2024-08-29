const tooglePassword = document.querySelector('#tooglePassword');
const password = document.querySelector('#password');
tooglePassword.addEventListener('click', (e) => {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    // Mengganti ikon
    e.target.classList.toggle('fa-eye'); // Perbaikan penulisan di sini
    e.target.classList.toggle('fa-eye-slash'); // Mengganti ikon sesuai dengan kondisi
});
