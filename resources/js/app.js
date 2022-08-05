import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


$(document).ready(function () {
    for (let i = 0; i < 10; i++) {
        $("button.reply" + i).click(function () {
            alert($("p.reply" + i).text());
        });
    }
});
