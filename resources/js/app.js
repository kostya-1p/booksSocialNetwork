import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$(document).ready(function () {
    $('main').on('click', "button.reply", function () {
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

function getHtmlComment(comment, repliedMessage) {
    const dateFromDB = new Date(comment['created_at']);

    const replyButton = (authUserId === '') ? '' : "<button class=\"reply\">Reply</button>";
    const deleteForm = getDeleteCommentForm(comment);
    let repliedMessageDIV = "";

    if (repliedMessage !== "") {
        repliedMessageDIV = "<div class=\"reply_message\">" +
            "<p>" + repliedMessage + "</p>" +
            "</div>";
    }

    return "<div class=\"py-6\">" +
        "<div class=\"max-w-7xl mx-auto sm:px-6 lg:px-8\">" +
        "<div class=\"bg-white overflow-hidden shadow-sm sm:rounded-lg\">" +
        "<div class=\"p-6 bg-white border-b border-gray-200\">" +
        deleteForm +
        "<h2 hidden>" + comment['id'] + "</h2>" +
        "<h1><b>" + comment['authorName'] + "</b></h1>" +
        repliedMessageDIV +
        "<p>" + comment['title'] + "</p>" +
        "<p>" + comment['message'] + "</p>" +
        "<p class=\"comment_date\">" + dateFromDB.toLocaleDateString('ru-RU') + "</p>" +
        replyButton;
}

function getDeleteCommentForm(comment) {
    if (authUserId == comment['profileId'] || authUserId == comment['authorId']) {
        return `<form method="post" action="/delete">
                   <input type="hidden" name="_token" value=${$('input[name="_token"]').first()[0].value}>
                   <input type="hidden" name="id" value=${comment['id']}>
                   <input type="hidden" name="author_id" value=${comment['authorId']}>
                   <button class="close">X</button>
                </form>`;
    }

    return '';
}

function getRepliedMessage(comments, comment) {
    if (comment['answeredCommentId'] != null) {
        const answeredComment = comments.findIndex(c => c['id'] === comment['answeredCommentId']);
        if (answeredComment !== -1) {
            return comments[answeredComment]['message'];
        }
    } else if (comment['isReply']) {
        return "Message Deleted";
    }

    return '';
}

function showComments(commentsJson) {
    const commentsArray = JSON.parse(commentsJson);

    commentsArray.slice(5, commentsArray.length).forEach(comment => {
        const repliedMessage = getRepliedMessage(commentsArray, comment);
        const htmlComment = getHtmlComment(comment, repliedMessage);
        $(htmlComment).insertBefore("#load_more_container");
    });

    $("#load_more_comments").hide();
}
