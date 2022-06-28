function fetchPostsJson(json){
    console.log("Fetching...");
    console.log(json);

    const feed = document.getElementById('feed');

    for(let i in json){
        const post = document.getElementById('post_template').content.cloneNode(true).querySelector(".post");
        post.dataset.id = post.querySelector("input[type=hidden]").value = json[i].postid;
        post.querySelector(".username").textContent = "Posted by: "+json[i].username;
        post.querySelector(".time").textContent ="Postato " +json[i].time;
        
        post.querySelector(".content").textContent = json[i].content;
        post.querySelector(".title").textContent = json[i].title;

        
        const like = post.querySelector(".like");
        const img1=document.createElement('img');
        img1.src="./images/iconalike.png";
        like.appendChild(img1);
        // Controllo se l'utente ha messo like al post corrente
        if (json[i].liked == 0) {
            // Aggiungo l'event listener per mettere like
           like.addEventListener('click', likePost);
        } else {
            // Aggiungo l'event listener per togliere like
            
            like.addEventListener('click', unlikePost);
        }
        const nlike = like.querySelector("span");
        nlike.textContent = json[i].nlikes;
        
        const img=document.createElement('img');
        img.src="./images/iconacommenti.png";
        
        post.querySelector(".comment span").textContent = json[i].ncomments;
        
        const comment=post.querySelector(".comment");
        post.querySelector(".comment").addEventListener('click', commentPost);
        post.querySelector("form").addEventListener('submit', sendNewComment);
        if(json[i].posted==1){
            const div_button=post.querySelector(".remove_button");
            const button=document.createElement("button");
            button.classList.add("delete_post");
            button.textContent="Rimuovi post";
            div_button.appendChild(button);
            post.querySelector(".delete_post").addEventListener("click",delete_post);
        }
        comment.appendChild(img);
        feed.appendChild(post);
    }


}


function fetchResponse(response) {
    if (!response.ok) {
        console.log("Response error");
        return null};
    return response.json();
}

const csrfToken=document.head.querySelector("[name=csrf-token][content]").content;

function fetchPosts() {
    
    fetch(BASE_URL+"fetch_posts").then(fetchResponse).then(fetchPostsJson);
   
}
function likePost(event) {
    const button = event.currentTarget;

    const formData = new FormData();
    // Prendo l'ID del post
    formData.append('postid', button.parentNode.parentNode.dataset.id);
    // Mando l'ID alla pagina PHP tramite fetch
    fetch(BASE_URL+"like_post", {headers:{
        "X-CSRF-Token": csrfToken
    },method: 'post', body: formData}).then(fetchResponse)
    .then(function (json){ return updateLikes(json, button); });


    // Aggiorno i listener
    button.removeEventListener('click', likePost);
    button.addEventListener('click', unlikePost);
}

function unlikePost(event) {

    const button = event.currentTarget;

    const formData = new FormData();
    formData.append('postid', button.parentNode.parentNode.dataset.id);
    fetch(BASE_URL+"unlike_post", {headers:{
        "X-CSRF-Token": csrfToken
    },method: 'post', body: formData}).then(fetchResponse)
    .then(function (json){ return updateLikes(json, button); });

    

    button.removeEventListener('click', unlikePost);
    button.addEventListener('click', likePost);
}


function updateLikes(json, button) {
    console.log(json.ok);
    if (!json.ok) return null;
    button.querySelector('span').textContent = json.nlikes;
    console.log("UPDATE" + json.nlikes);
}


function commentPost(event) {
    const post =  event.currentTarget.parentNode.parentNode;

    const formData = new FormData();
    formData.append('postid', post.dataset.id);
    fetch(BASE_URL+"fetch_send_comments", {headers:{
        "X-CSRF-Token": csrfToken
    },method: 'post', body: formData}).then(fetchResponse)
    .then(function (json){ return updateComments(json, post); });
    
}

function sendNewComment(event) {
    const post =  event.currentTarget.parentNode.parentNode.parentNode;
    const formData = new FormData(event.currentTarget);
    formData.append('postid', post.dataset.id);
    fetch(BASE_URL+"fetch_send_comments", {headers:{
        "X-CSRF-Token": csrfToken
    },method: 'post', body: formData}).then(fetchResponse).then(function (json){ return updateComments(json, post); });
    const t = event.currentTarget.querySelector('input[type=text]');
    t.blur();
    t.value = "";
    event.preventDefault();
}

function updateComments(json, post) {
    const container = post.querySelector(".past_messages");
    const ncomms=post.querySelector(".comment span");
    
    container.innerHTML = '';
    let i;
    // Scorro l'array dal commento più recente al più vecchio
    for (i = Object.keys(json).length-1; i >= 0; i--) {
        // Creo gli oggetti che contengono i commenti
        ncomms.textContent=json[i].ncomments; 
        const message = document.createElement('div');
        const userinfo = document.createElement('div');
        userinfo.classList.add('userinfo');
        message.appendChild(userinfo);
        const username = document.createElement('span');
        username.classList.add('username');
        username.textContent = "Inviato da: "+json[i].username;
        userinfo.appendChild(username);
        const time = document.createElement('div');
        time.classList.add('time');
        time.textContent = "Inviato " +json[i].time;
        userinfo.appendChild(time);
        const text = document.createElement('div');
        text.classList.add('text');
        text.textContent=json[i].text;

        message.appendChild(text);

        container.appendChild(message);
    } 
    
}

function onJsonDelete(json){
    if(json.ok===true)
        console.log("La cancellazione del post nel DB è andato a buon fine");
    else
        console.log("La cancellazione del post nel DB non è andato a buon fine");
}

function delete_post(event){
   
    const post=event.currentTarget.parentNode.parentNode;
    console.log("sono in rimuovi"+post.dataset.id);
    const formData = new FormData();
    formData.append('postid', post.dataset.id);
    fetch(BASE_URL+"delete_post", {headers:{
        "X-CSRF-Token": csrfToken
    },method: 'post', body: formData}).then(fetchResponse).then(onJsonDelete);
    post.parentNode.removeChild(post);
}


fetchPosts();