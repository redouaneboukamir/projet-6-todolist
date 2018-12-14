
let archive = [], j =0;
xhr = new XMLHttpRequest;
xhr.open('POST','todo.json',true);

xhr.onreadystatechange = function(){

    if(xhr.readyState == 4 && xhr.status == 200){
        const objResp = JSON.parse(xhr.response);

        for (let i = 0; i < Object.keys(objResp).length; i++) {
            if(objResp[i].archived == true){

                j++;
            }
        }
        
        for (const key in objResp) {
            
            
            if(objResp[key].archived == true){

                document.getElementById('archive').innerHTML +=  `<p>${objResp[key].text}   FAIT</p>`;
                
                
            }else{

                $('#formulaire').append(`

                <div class = "contentNewTache">
                <input type="checkbox" name="test[]" value="${key}" id="check">
                <p>${objResp[key].text}</p>
                </div>`);
            }
        } 
            
        
        if(j == Object.keys(objResp).length){
            $('#enregistrer').hide();
        }
        
    }
}

xhr.send();
