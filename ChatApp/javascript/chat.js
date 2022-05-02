const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box"),
usersPage = document.querySelector(".users");

form.onsubmit = (e)=>{
    e.preventDefault();
}

sendBtn.onclick = ()=>{
    // ajax
    let xhr = new XMLHttpRequest(); // creating XML object
    xhr.open("POST","php/insert-chat.php",true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = "" // after send the message clear the input
                scrollToBottom();
            }
        }
    }
    // we have to send the form data from ajax to php
    let formData = new FormData(form); // create new form data object
    xhr.send(formData); // sending form data to php
}

firstTimeScroll = true;

setInterval(()=>{
    let xhr = new XMLHttpRequest(); // creating XML object
    xhr.open("POST","php/get-chat.php",true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;

                if(firstTimeScroll){ //for the first time the page is loading go to bottom
                    scrollToBottom();
                    firstTimeScroll = false;
                }

            }
        }
    }
    // we have to send the form data from ajax to php
    let formData = new FormData(form); // create new form data object
    xhr.send(formData); // sending form data to php
}, 500);


function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}
