const form = document.querySelector(".typing-area"),
incoming_id = form.querySelector(".incoming_id").value,
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");
uploadImg = document.querySelector("#image");

form.onsubmit = (e)=>{
    e.preventDefault();
}

uploadImg.onchange = ()=>{
    let image = document.getElementById('image').files[0];
    let check = checkImage(image);
    
    if (!check) {
        document.getElementById('image').value = '';
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/insert-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = "";
                scrollToBottom();
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
    document.getElementById('image').value = '';
}

function checkImage(file) {
    var maxSize = document.getElementById('maxsize').value;

    const  fileType = file.type;
    const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    if (!validImageTypes.includes(fileType)) {
        alert('You can only upload JPG, PNG images.');
        return false;
    }

    var sizee = file.size; //file size in bytes
    sizee = sizee / 1024; //file size in Kb
    sizee = sizee / 1024; //file size in Mb

    if (sizee > maxSize) {
        alert('You can only upload files with a maximum size of '+maxSize +'MB');
        return false;
    }
    return true;
}

inputField.focus();
inputField.onkeyup = ()=>{
    if(inputField.value != ""){
        sendBtn.classList.add("active");
    }else{
        sendBtn.classList.remove("active");
    }
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/insert-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField.value = "";
              scrollToBottom();
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/get-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id);
}, 500);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
  }
