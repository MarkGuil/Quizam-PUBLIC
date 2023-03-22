

const call = (val) =>{
    let j = JSON.parse(val)
    console.log(j.length)

    const div = document.createElement('p');
    div.innerHTML = `${j[0].type}`
    // document.querySelector('#q').appendChild(div)
}


const timer = document.querySelector('#timer')

// btnNxt.addEventListener('click',(e)=>{
//     startTime(2)
//     alert()
  
   

// })
const startTime = (minutes)=>{
 
    if(minutes > 0){
    const start = minutes;
    let time = start*60;

    setInterval(turnOn,1000);
    function turnOn(){
        if(time>=0){
                    let minutes = Math.floor(time/60);
                    let seconds = time % 60;
                    minutes = minutes <10? '0'+minutes : minutes;
                    seconds = seconds <10? '0'+seconds:seconds; 
                    document.querySelector('#timer').innerHTML=minutes+':'+seconds;
                    time--;
        }
        else{
            const btnNxt = document.querySelector('#btnN')
                   btnNxt.click()
                  
        
        }
   }
}
else
    document.querySelector('#timer').innerHTML=`<p style='letter-spacing:0px;font-size:20px;'>Timer Off</p>`;
}
