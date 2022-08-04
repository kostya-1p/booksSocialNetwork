import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const btns = document.querySelectorAll('.reply');
for (let i = 0; i < btns.length; i++) {
    btns[i].addEventListener('click', function (e) {
        alert(e.target.innerHTML);
    });
}
