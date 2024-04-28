function check_pass_match(){

     var first_password = document.getElementById("firstpass").value;
     var second_password = document.getElementById("secondpass").value;
     let matchResult = document.getElementById("second_pass_message");
                    
         if(first_password != second_password) {
             matchResult.style.color="red";
             matchResult.innerHTML=" Passwords don't match !"; 						
               return false;
              }
              
          else {
             matchResult.innerHTML=" Passwords match successfully!"
             matchResult.style.color="green";
              return true;  }         
              
}

              
function check_pass_strength(){
                
    var first_password = document.getElementById("firstpass").value;
    var matchResult = document.getElementById("shortpassmessage");
    var l =first_password.length;
    
        if (l<=5) {    
        //matchResult.innerHTML="Password too short!"; 
        matchResult.innerHTML=" Please enter at least 6 characters"; 
        matchResult.style.color="red";
        return false;
        }
        else { return true; }                  
}


function emptySecondpass(){

document.getElementById("second_pass_message").innerHTML = " ";	

}

function emptyFirstpass(){

document.getElementById("shortpassmessage").innerHTML = " ";	

}

function emptyMessages(){

emptyFirstpass();
emptySecondpass();

}
    
/*
function resetForm(){
emptyMessages();
document.getElementById("newForm").reset();

}	

function Formsubmit() {
        ageCount();
        document.getElementById("newForm").reset();
        
     }	 

*/

function displayWarningMessage(message){
    alert('displayWarningMessage called');
 let modalDialog = `
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">`
        + message +
      `</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>`

    document.getElementById('modalContainer').innerHTML = modalDialog;
    // Show the modal
    $('#exampleModal').modal('show');
    // return true;
}