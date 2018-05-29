<div id="comment_box">
    <div id="comm_header">KOMMENTAR</div>
    <hr class="comm_hr_notes">
    <div class="comm_avatar">
        <img src="{{asset('images/user_avatar.JPG')}}" alt="user_avatar" class="comm_img" align="left">
        <span id="user_name">Giulietta</span>
    </div>
    <div class="contenteditable" contenteditable="true" id="user_comment" placeholder="Type here..."></div>
    <br>
    <div class="user_note">
        <div id="note_header">PRIVATE NOTE <i class="fa fa-lock" id="lock_icon"></i>
            <span class="privacy" data-toggle="tooltip"
                  title="Private notes are visible to you and to the author of the article only.">
                                Who can see this?</span>
        </div>
    </div>

    <hr class="comm_hr">

    <div class="contenteditable" contenteditable="true" id="user_note" placeholder="Type here...">
    </div>
    <br>
    <a href="" class="comment_links" id="save_comment" onclick="sendCommentsAndNotes()">Save</a>
    <a href="" class="comment_links" id="clear_comment" onclick="clearCommentsBox(this)">Cancel</a>
</div>