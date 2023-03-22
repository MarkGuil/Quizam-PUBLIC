
var btn = document.getElementById('bttn')
const regBtn = document.querySelector('#regBtn');


function leftClick() {
    btn.style.left = '0'
    document.getElementById("tc").style.color = 'white';
    document.getElementById("tc1").style.color = '#3D48C9';
    regBtn.value = 2;
}

function rightClick() {
    btn.style.left = '110px'
    document.getElementById("tc").style.color = '#3D48C9';
    document.getElementById("tc1").style.color = 'white';
    regBtn.value = 1;
}

regBtn.addEventListener('click',(event)=>{
  const pswrd1 = document.querySelector('#pswrd1').value
  const pswrd2 = document.querySelector('#pswrd2').value

  if(pswrd1 !== pswrd2){
     $('#myModal').modal('show')
      event.preventDefault()
  }
  
});

