// tinymce.init({ selector: 'textarea' });



$(document).ready(function() {
    // summernote add_post_index.php
    $('#summernote').summernote({
        height: 200
    });







});

$(document).ready(function() {
    //emoji sidebar
    $('#e_comments').emojioneArea({
        pickerPosition: "top"
    });


    //emoji post
    $('#p_comments').emojioneArea({
        pickerPosition: "top"
    });
})







// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}




/*
Social Share Links:
WhatsApp:
https://api.whatsapp.com/send?text=[post-title] [post-url]

Social Share Links:
Facebook:
https://www.facebook.com/sharer.php?u=[post-url]

Social Share Links:
Twitter:
https://twitter.com/share?url=[post-url]&text=[post-title]&via=[via]&hashtags=[hashtags]


Social Share Links:
Pinterest:
https://pinterest.com/pin/create/bookmarklet/?media=[post-img]&url=[post-url]&is_video=[is_video]&description=[post-title]


Social Share Links:
Linkedin:
https://www.linkedin.com/shareArticle?url=[post-url]&title=[post-title]
*/

const facebookBtn = document.querySelector(".facebook-btn");
const twitterBtn = document.querySelector(".twitter-btn");
const linkedinBtn = document.querySelector(".linkedin-btn");
const pinterestBtn = document.querySelector(".pinterest-btn");
const whatsappBtn = document.querySelector(".whatsapp-btn");

function init() {
    const pinterestImg = document.querySelector(".img-responsive");

    let postUrl = encodeURI(document.location.href);
    let postTitle = encodeURI("pl check this out: ");
    let postImg = encodeURI(pinterestImg.scr);

    facebookBtn.setAttribute("href", `https://www.facebook.com/sharer.php?u=${postUrl}`);
    twitterBtn.setAttribute("href", `https://twitter.com/share?url=${postUrl}&text=${postTitle}`);
    linkedinBtn.setAttribute("href", `https://www.linkedin.com/shareArticle?url=${postUrl}&title=${postTitle}`);
    pinterestBtn.setAttribute("href", `https://pinterest.com/pin/create/bookmarklet/?media=${postImg}&url=${postUrl}&description=${postTitle}`);
    whatsappBtn.setAttribute("href", `https://api.whatsapp.com/send?text=${postTitle} ${postUrl}`);
}

init();




const userAgentData = navigator.userAgentData;
const { platform } = userAgentData;