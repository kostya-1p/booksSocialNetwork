import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$(document).ready(function () {
    $("button.reply").click(function () {
        const commentAuthorName = $(this).parent().children("h1").text();
        const commentId = $(this).parent().children("h2").text();

        $("#comment_form_container").prepend("<p> Answer to comment by: " + commentAuthorName + "</p>");
        $("#comment_form_container").prepend(`<input type=\"hidden\" name=\"answered_comment_id\" value=${commentId}>`);

        $("button.reply").hide();
    });
});

//Getting comments using AJAX
$(document).ready(function () {
    $("#load_more_comments").click(function () {
        const profileId = (window.location.href.substring(window.location.href.lastIndexOf('/') + 1));

        $.ajax({
            url: "http://localhost:8000/load_comments/" + profileId,
            type: "GET",
            success: function (commentsJson) {
                showComments(commentsJson);
            }
        });
    });
});

function getHtmlComment(comment) {
    const dateFromDB = new Date(comment['created_at']);

    return "<div class=\"py-6\">" +
        "<div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\">" +
        "<div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\">" +
        "<div class=\"p-6 bg-white border-b border-gray-200\">" +
        "<p hidden" + comment['id'] + "</p>" +
        "<h1><b>" + comment['authorName'] + "</b></h1>" +
        "<p>" + comment['title'] + "</p>" +
        "<p>" + comment['message'] + "</p>" +
        "<p class=\"comment_date\">" + dateFromDB.toLocaleDateString('ru-RU') + "</p>" +
        "<button class=\"reply\">Reply</button>";
}

function showComments(commentsJson) {
    const commentsArray = JSON.parse(commentsJson);

    commentsArray.forEach(comment => {
        const htmlComment = getHtmlComment(comment);
        $(htmlComment).insertBefore("#load_more_container");
    });

    $("#load_more_comments").hide();
}
