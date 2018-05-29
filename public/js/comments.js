// var paragraphs = document.getElementById("article").querySelectorAll("p");
// var len = paragraphs.lenght;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var box = document.getElementById("comment_box");
var editBar = document.getElementById("editBar");
var user_comment = $("#user_comment");
var private_note = $("#user_note");
var mouseUpTarget = null;
var selected_text = null;
var comment = null;
var note = null;
var article = document.getElementById("article");
var article_id = article.dataset.id;
var highlight = 0;
var selection_pos_top_plusScroll = null;
var accordion = $("#article_accordion");
var user_id_div = document.getElementById("user_id");
var user_id = user_id_div.dataset.user_id;
var hidden_div = document.getElementById("selected_text");
var comments = document.getElementById("comments");
var notes = document.getElementById("notes");
var selection_pos_top_noScroll = null;
var userSelectionComment = null;
var comment_sm_box = $("#comment_sm_box");







var getselected_text = function () {
    if (window.getSelection()) {
        selected_text = window.getSelection();
    } else if (document.getSelection()) {
        selected_text = document.getSelection();
    } else if (document.selection) {
        selected_text = document.selection.createRange().text;
    }

    return selected_text;
};


window.addEventListener('mouseup', openToolbar, false);

// SHOW AND POSITION TOOLBAR if there is a text selection
function openToolbar(e) {

    if ((e.target.id == 'user_comment') || (e.target.id == 'user_note') || (e.target.id == 'save_comment')
        || (e.target.id == 'show_accordion') || (e.target.id == 'show_comm') || (e.target.id == 'article_accordion')
        || (e.target.class == 'comments_fromDB')) {

        return;
    }

    //save selection to hidden div
    selected_text = getselected_text();
    hidden_div.dataset.selected_text = selected_text;


    //on click outside comment box and toolbar, hide toolbar and clear input area
    if ((selected_text == '') && (!e.target.closest('#comment_box')) && (e.target.id != 'editBar')) {
        user_comment.html('');
        private_note.html('');
        editBar.style.visibility = "hidden";
        box.style.visibility = "hidden";

        if (accordion.is(':hidden')) {
            accordion.show();
        }
        event.stopPropagation();
    }

    if (selected_text != '') {

        editBar.style.visibility = "visible";

        selection_pos = selected_text.getRangeAt(0).getBoundingClientRect();

        selection_pos_top_plusScroll = Math.round(selection_pos.top + window.scrollY);
        selection_pos_top_noScroll = Math.round(selection_pos.top);

        hidden_div.dataset.selection_pos_top_plusScroll = selection_pos_top_plusScroll;
        hidden_div.dataset.selection_pos_top_noScroll = selection_pos_top_noScroll;


        var articleDiv_pos = article.getBoundingClientRect();
        var articleDiv_x = articleDiv_pos.x;


        editBar.style.position = "absolute";

        editBar.style.top = (Math.round(selection_pos_top_plusScroll) - 390 ) + "px";
        editBar.style.left = 240 + "px";

    }
}


function placeCommentBox(event) {

    userSelectionComment = window.getSelection().getRangeAt(0);

    var editBarPos = editBar.getBoundingClientRect();
    var editBarTop = editBarPos.top + window.scrollY;

    if (accordion.is(':visible')) {
        accordion.hide();
    }

    box.style.position = "absolute";
    box.style.visibility = "visible";
    box.style.top = Math.round(editBarTop) - 540 + "px";
    box.style.left = Math.round(editBarPos.x) - 220 + "px";
    event.preventDefault();
}


//Ajax call to CommentsController for text highlight only
function highlightSelection() {

    event.preventDefault();

    var userSelection = window.getSelection().getRangeAt(0);

    highlightRange(userSelection);
    console.log(userSelection);

    note = private_note.html();
    comment = user_comment.html();

    $.ajax({
        url: '/comment',
        dataType: 'json',
        traditional: true,
        contentType: false,
        type: 'get',
        data: {
            user_id: user_id,
            article_id: article_id,
            userSelection: selected_text,
            highlight: 1,
            comment: comment,
            note: note

        },
        success: function (data) {
            // console.log(selection_offset);
            user_comment.html('');
            private_note.html('');

        },
        error: function (response) {
            console.log(response.responseText);
        }
    });

    event.preventDefault();
}


//Ajax call to CommentsController to persist comments and/or private notes
function sendCommentsAndNotes() {

    selected_text = hidden_div.dataset.selected_text;

    note = private_note.html();
    comment = user_comment.html();

    $.ajax({
        url: '/comment',
        dataType: 'json',
        traditional: true,
        type: 'get',
        data: {
            comment: comment,
            article_id: article_id,
            note: note,
            par_id: mouseUpTarget,
            user_id: user_id,
            highlight: 0,
            userSelection: selected_text
        },
        success: function (data) {
            user_comment.html('');
            private_note.html('');
            comment_box.style.visibility = "hidden";
            editBar.style.visibility = "hidden";

            var selection_top =  hidden_div.dataset.selection_pos_top_plusScroll - 360;

            //highlight selected text and create a feedback div and position it on comment creation
            highlightRange(userSelectionComment);

            var el = document.createElement('div');
            el.style.top = selection_top + "px";
            el.style.position = 'absolute';
            var message = "Comment saved. Refresh to view.";
            el.innerHTML =  message;

            comments.appendChild(el);

            if (accordion.is(':hidden')) {
                accordion.show();
            }

        },
        error: function (response) {
            console.log(response.responseText);
        }
    });

    event.preventDefault();
}


// Show/hide Tooltip on comment box
$(document).ready(function () {

    $('[data-toggle="tooltip"]').tooltip();
});


function clearCommentsBox() {
    $(".contenteditable").html('');
    editBar.style.visibility = "hidden";
    box.style.visibility = "hidden";

    if (accordion.is(':hidden')) {
        accordion.show();
    }

    event.preventDefault();
}


function highlightRange(range) {
    var newNode = document.createElement("div");
    newNode.setAttribute(
        "style",
        "background-color: rgba(249, 233, 169, 0.40); " +
        "display: inline;" +
        "text-shadow:none;"
    );
    range.surroundContents(newNode);
}


window.addEventListener("load", loadComments);

function loadComments() {

    var comm_array = document.getElementsByClassName('highlight_blue');

    for (var i = 0, len = comm_array.length; i < len; i++) {

        var comment_id = comm_array[i].dataset.comment_id;
        comment_id = comment_id.trim();
        var pen_icon = $("#pen_icon").html();
        var div = document.createElement('div');

        div.style.top = comm_array[i].offsetTop + "px";
        div.style.left = comm_array[i].offsetLeft + comm_array[i].offsetWidth;
        div.style.textDecoration = 'none';
        div.setAttribute('class', 'comments_fromDB col-md-3');
        div.setAttribute('id', 'anchor_' +comment_id);
        div.setAttribute('href', '#comm_' + comment_id);
        div.setAttribute('onclick','openCommentSmBox(this.id);');
        div.innerHTML = '<img class="pen_icon" src=" ' + pen_icon +  ' " alt="Comment Icon" height="25" width="32"> ';


        var comment_sm_box = document.createElement('div');
        comment_sm_box.setAttribute('class', 'comment_sm_box');
        comment_sm_box.setAttribute('id', 'comm_' + comment_id);
        comment_sm_box.innerHTML = '<div class="comm_text"> '+ comm_array[i].dataset.comment_text + '</div>' +
            '<div class="cancel_link">' +
            '<hr class="mt-2 mb-0"><a href="#" class="delete_comment pl-2" onclick="cancelComment(' + comment_id + ')">cancel</a>' +
            '</div>';

        div.appendChild(comment_sm_box);
        comments.appendChild(div);

    }

    var comm_array_notes = document.getElementsByClassName('highlight_purple');

    for (var i = 0, len = comm_array_notes.length; i < len; i++) {

        var div = document.createElement('div');

        div.style.top = comm_array_notes[i].offsetTop + "px";
        div.style.left = comm_array_notes[i].offsetLeft + comm_array_notes[i].offsetWidth;
        div.setAttribute('class', 'comments_fromDB');
        div.setAttribute('id', comment_id);
        div.innerHTML = comm_array_notes[i].dataset.comment_text;

        notes.appendChild(div);

    }
}

function toggleAccordion(e) {
    var accordion = $("#article_accordion");
    accordion.toggle();
    event.preventDefault();

}

function toggleComments(e) {
    var comments = $("#comments");
    comments.toggle();
    event.preventDefault();
}


function cancelComment(comment_id) {

    $.ajax({
        url: '/comment/' + comment_id,
        dataType: 'json',
        traditional: true,
        type: 'delete',
        data: {
            user_id: user_id,
            article_id: article_id,
            comment_id: comment_id,
        },
        success: function (data) {
            //remove text highlighting and pen icon
            var comment_deleted = document.getElementById(comment_id);
            comment_deleted.style.backgroundColor = '#ffffff';
            var selector = '#anchor_' + comment_id;
            var div_to_hide = document.querySelector(selector);
            div_to_hide.style.display = "none";
        },
        error: function (response) {
            console.log(response.responseText);
        }
    });

    event.preventDefault();
}

function openCommentSmBox(id) {
   var id_trimmed = id.slice(7);

   var comment_box_id = 'comm_' + id_trimmed;

   // var comment_box = document.getElementById(comment_box_id);
   var comment_box = $('#' + comment_box_id);
   // console.log(comment_box);

    comment_box.toggle()
}


$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});

