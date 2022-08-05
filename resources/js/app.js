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

//Getting comments using AJAX
$(document).ready(function () {
    $("#load_more_comments").click(function () {
        const profileId = (window.location.href.substring(window.location.href.lastIndexOf('/') + 1));

        $.ajax({
            url: "http://localhost:8000/load_comments/" + profileId,
            type: "GET",
            success: function (commentsJson){
                showComments(commentsJson);
            }
        });
    });
});

function getHtmlComment(comment) {
    const dateFromDB = new Date(comment['created_at']);
    const indexOffset = 5;

    return "<div class=\"py-6\">" +
        "<div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\">" +
        "<div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\">" +
        "<div class=\"p-6 bg-white border-b border-gray-200\">" +
        "<p hidden class=\"reply\">" + comment['id'] + "</p>" +
        "<h1><b>" + comment['authorName'] + "</b></h1>" +
        "<p>" + comment['title'] + "</p>" +
        "<p>" + comment['message'] + "</p>" +
        "<p class=\"comment_date\">" + dateFromDB.toLocaleDateString('ru-RU') + "</p>";
}

function showComments(commentsJson) {
    const commentsArray = JSON.parse(commentsJson);

    commentsArray.forEach(comment => {
        const htmlComment = getHtmlComment(comment);
        $(htmlComment).insertBefore("#load_more_container");
    });

    $("#load_more_comments").hide();
}
