
function choosepic() {
    document.querySelector('#profileImage').click();
}

function displayimg(e) {
    if (e.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            document.querySelector('#profileimg').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
    }
}


const changePass = document.querySelector('#btnChangePass')
const updatePass = document.querySelector('#updatePass')
// const changePic = document.querySelector('#changePic')

changePass.addEventListener('click',(event1)=>{
    $('#myModal').modal('show')
    event1.preventDefault()
})

updatePass.addEventListener('click',(e)=>{
    const newPass1 = document.querySelector('#newPass1').value
    const newPass2 = document.querySelector('#newPass2').value

    if(newPass1 !== newPass2){
        alert("Password Not Match!")
        e.preventDefault()
    }
})

changePic.addEventListener('click',(event2)=>{
    $('#myModal3').modal('show')
    event2.preventDefault()
})