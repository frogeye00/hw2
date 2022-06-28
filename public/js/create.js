function onResponse(response) {

    if(!response.ok) {
        console.log("Errore nel caricamento del post sul DB");
        return null;
    }
    return response.json();
}

function onJson(json){
    if(json.ok===true)
        console.log("L'inserimento del post nel DB è andato a buon fine");
    else
        console.log("L'inserimento del post nel DB non è andato a buon fine");

}

const csrfToken=document.head.querySelector("[name=csrf-token][content]").content;

function createPost(event){

    const formData= new FormData(document.querySelector("form"));

    fetch(BASE_URL+"insert_post", {headers:{
        "X-CSRF-Token": csrfToken
    },method: 'post', body: formData}).then(onResponse).then(onJson);

    event.preventDefault();
}





document.querySelector("form").addEventListener("submit",createPost)