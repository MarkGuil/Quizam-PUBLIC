
const form2 = document.querySelector('#form2')
const generateMultipleChoice = document.querySelector('#multipleChoice')
const generateTrueOrFalse = document.querySelector('#trueOrFalse')
const generateIdentification = document.querySelector('#identification')
const generateEssay = document.querySelector('#essay')
const btnSave = document.querySelector('#btnSave')
const btnCancel = document.querySelector('#btnCancel')
const input = document.querySelector('#input')
const answers = document.querySelector('#answers')
const finalize = document.querySelector('#btnFinalize')


let index = 0;
let questionIndex = 0;
let radioIndex = 100;
let answerIndex = 100;
let questIndex = 0;
let buttonIndex = 0;
let optionIndex = 100;
let questHash = 100;
let hiddenIndex = 100;
let pointsIndex = 100;
let timerIndex = 100;
let array = new Array();
let questions = new Array();
let filteredArray = new Array();
let allProperties = new Array();
let newButtons = new Array();
let hiddenFields = new Array();
let filteredHiddenFields = new Array();
let correctAnswers = new Array();



let timerOptions = `
          
            <option value="0">Timer Off</option>
            <option value="1">1 Minute</option>
            <option value="2">2 Minutes</option>
            <option value="5">5 Minutes</option>
            <option value="10">10 Minutes</option>
            <option value="15">15 Minutes</option>
            <option value="20">20 Minutes</option>
            <option value="25">25 Minutes</option>
            <option value="30">30 Minutes</option>
         
`;

btnSave.addEventListener('click', (e) => {
    document.querySelector('#myModal').style.display = 'block';
    e.preventDefault()

})

btnCancel.addEventListener('click', (e) => {
    document.querySelector('#myModal').style.display = 'none';
    e.preventDefault()

})


finalize.addEventListener('click',(e)=>{

    const strt = document.querySelector('#strt').value
    const end = document.querySelector('#end').value
    if(strt >= end){
      alert("Invalid Time Start and Time End")
    e.preventDefault()
    }
})

array.filter((content)=>{

    return content;
})


generateEssay.addEventListener('click',(e) => {
    questionIndex++;
    let img = 'i'+questIndex;
    let path = 'm10'+questIndex;
    let property = new Array();
    const hidden = 'h' + hiddenIndex++;
    let timerName = 't'+(timerIndex++)
    let pointsName = 'p' + (pointsIndex++)
    let questId = 'q'+(questHash++);
    let div = document.createElement('div')
    div.setAttribute('id',questId);
    questions.push(questId);
    property.push('0004');
    property.push(questId);
    property.push(path);
    property.push(timerName);
    property.push(pointsName);
    btnSave.style.display = 'block'
  
    div.innerHTML=` 
                    <div class="form-group">
                        <div class="row my-3">
                            <div class="col text-start">
                                <label><h4 class="">Essay</h4></label>
                            </div>
                            <div class="col text-end">
                                <a onclick='removeQuestion(`+(questIndex)+`)' class=" btn btn-outline-danger">Remove</a>
                            </div>
                        </div>
                            
                        <input id='`+hidden+`' type='hidden' name='`+hidden+`' >
                        <input type="text" class="question form-control" name='`+questId+`' placeholder='Question' required>
                
                        <div id='`+img+`' class='text-center p-2'></div>
                        <div class="form-inline d-flex justify-content-center mt-2">
                            <input name='`+path+`' onchange='displayImg(this,`+questIndex+`)' id='m`+questIndex+`' type="file" accept="image/*" style='display:none'>
                            <a onclick='addImage(this,`+(questIndex++)+`)' class="btn btn-primary p-2 shadow">Add Image</a>
                        </div>
                        <div class="last row mt-4">
                            <div class="col">
                                <label class="ml-3">Points</label>
                                <input value='0' name='`+pointsName+`' class="form-control ml-3" type="number" min='0' required>
                            </div>
                            <div class="col">
                                <label class="ml-5">Set Timer</label>
                                <select name='`+timerName+`' class="form-control ml-3" name="" id="">
                                `+ timerOptions +`
                                </select>
                            </div>
                        </div>
                    </div>`
    form2.appendChild(div)
    e.preventDefault()
    
    hiddenFields.push(hidden);
    console.log(hiddenFields)
    const hiddenInput = document.querySelector('#' + hidden);
    hiddenInput.value = property;
    allProperties.push(property)
    input.value = hiddenFields;

})


generateMultipleChoice.addEventListener('click', (e) => {
  
    let property = new Array();
    const radioName = 'r' + (radioIndex);
    let img = 'i'+questIndex;
    let path = 'm10'+questIndex;
    let divId = 'div'+index;
    let btnId = 'btn' + index;
    let timerName = 't'+(timerIndex++)
    let pointsName = 'p'+(pointsIndex++)
    let questId = 'q' + (questHash);
    const correct = 'a' + hiddenIndex;
    const hidden = 'h' + hiddenIndex++;
    btnSave.style.display = 'block'
    array.push(divId);
    let div = document.createElement('div')
    div.setAttribute('id', questId);
    questions.push(questId);
    property.push('0001');      
    property.push(questId);
    property.push(path);
    property.push(timerName);
    property.push(pointsName);
    property.push(radioName);
   
    div.innerHTML=` 
                    <div id='`+ divId +`' class="form-group">
                        <div class="row my-3">
                            <div class="col text-start">
                                <label><h4 class="">Multiple Choice</h4></label>
                            </div>
                            <div class="col text-end">
                                <a onclick='removeQuestion(`+(questIndex)+`)' class=" btn btn-outline-danger">Remove</a>
                            </div>
                        </div>
                        <input type="text" class="question form-control" name='`+ questId +`' placeholder='Question' required>
                        <div id='`+img+`' class='text-center p-2'></div>
                        <div class="form-inline d-flex justify-content-center my-2">
                            <input name='`+path+`' onchange='displayImg(this,`+questIndex+`)' id='m`+questIndex+`' type='file' accept='image/*' style='display:none'>
                            <a onclick='addImage(this,`+(questIndex++)+`)' class="btn btn-primary p-2 shadow">Add Image</a>
                        </div>
                        <input id='`+hidden+`' type='hidden' name='`+hidden+`' >
                        <div class="form-inline d-flex my-2">
                            <input name='o`+(optionIndex)+`' type="text" class="choices form-control me-3 " placeholder="Option 1" required>
                            <div class="my-2">
                                <input id='`+(optionIndex)+`' type="radio" name='`+radioName+`' onclick='checker(this,`+(questHash)+`)' class="ml-5 mr-2" style='width:20px;height:20px;' required>
                                <label class='text-secondary form-check-label'>Correct Answer</label>
                            </div>
                        </div>
                        <input id='' type='hidden' name='`+property.push('o'+optionIndex++)+`' >
                        <div class="form-inline d-flex my-2">
                            <input name='o`+(optionIndex)+`' type="text" class="choices form-control me-3" placeholder="Option 2" required>
                            <div class="my-2">
                                <input id='`+(optionIndex)+`' type="radio" name='`+radioName+`' onclick='checker(this,`+(questHash)+`)' class="ml-5 mr-2" style='width:20px;height:20px;'required>
                                <label class='text-secondary form-check-label'>Correct Answer</label>
                            </div>
                        </div>
                        <input id='' type='hidden' name='`+property.push('o'+optionIndex++)+`' >
                        <input id='a`+(questHash)+`' type='hidden' name='`+correct+`' >
                    </div>
                    <a  id='`+btnId+`' onclick="addOption(`+(index++)+`,`+hidden+`,`+(questionIndex++)+`,`+(questHash++)+`,`+(radioIndex++)+`)" class="btn btn-info ml-5">Add option</a>
                    
                    <div class="last row mt-4">
                        <div class="col">
                            <label class="ml-3">Points</label>
                            <input value='0' name='`+pointsName+`' class="form-control ml-3" type="number" min='0' required>
                        </div>
                        <div class="col">
                            <label class="ml-5">Set Timer</label>
                            <select name='`+timerName+`' class="form-control ml-3" name="" id="">
                            `+ timerOptions +`
                            </select>
                        </div>
                    </div>
                     `
    form2.appendChild(div)
    e.preventDefault()
    hiddenFields.push(hidden);
    console.log(hiddenFields)
    const hiddenInput = document.querySelector('#' + hidden);
    hiddenInput.value = property;
    allProperties.push(property)
    console.log(allProperties)
    input.value = hiddenFields;
   
})

const checker = (c, i) => {
    let q = 'q' + i;
    // let ai = 'a' + i;
    let a = 'o' + c.id;
    c.value = a;
    // if (c.checked) {
    //     let pair = {
    //         'questionId': q,
    //         'answerId': a
    //     }
    //     correctAnswers.push(pair)
    //     stringCollector(i)
        
    // } else {
    //     correctAnswers = correctAnswers.filter((object) => { return object.answerId != a; })
    //     stringCollector(i)
    // }
}

const stringCollector = (args) => {
    let str = '';
    let location = 'q' + args;
    let current = 'a' + args;
    correctAnswers.forEach((item) => {
        if(item.questionId == location)
             str += item.answerId;
    })

    document.querySelector('#'+current).value = str;

}



const addOption = (id, hidden, qIndex, hash, radioIndex) => {
    let radioName = 'r' + radioIndex;
    let checkName = '' + (optionIndex);
    let name = 'o' + (optionIndex++);
    newButtons.push(name);
    allProperties[qIndex].push(name)
    console.log(hidden)
    hidden.value =  allProperties[qIndex];
       let div = document.createElement('div')
       div.setAttribute('id','button'+(buttonIndex))
       let current = array[id];
       const form = document.querySelector('#'+current)
       div.innerHTML=`
                      <div class="form-inline d-flex my-2">
                        <div class="d-flex flex-fill">
                            <input name='`+name+`' type="text" class="choices form-control me-3" placeholder="New Option" required> 
                            <div class="my-2">
                                <input name='`+radioName+`' id='`+checkName+`' type="radio" onclick='checker(this,`+hash+`)' class="ml-5 mr-2" style='width:20px;height:20px;' required>
                                <label class='text-secondary form-check-label'>Correct Answer</label>
                            </div>
                        </div>
                        <a onclick="removeButton(`+(buttonIndex++)+`,`+id+`,`+qIndex+`,`+checkName+`,`+hash+`)" class="btn btn-outline-danger ml-5">Remove option</a>
                      </div>
                    `
    form.appendChild(div)
    console.log(allProperties[qIndex])

}


const removeButton = (i, id, qIndex,checkName,hash) => {
    
    let a = 'o' + checkName;
    correctAnswers = correctAnswers.filter((object) => { return object.answerId != a; })
    stringCollector(hash)
  
    allProperties[qIndex] = allProperties[qIndex].filter((item) => {
        return item != newButtons[i];
    })


    console.log(allProperties[qIndex]);
    document.querySelector(`#${hiddenFields[qIndex]}`).value = allProperties[qIndex];
    document.querySelector(`#button${i}`).remove()
   
}


generateTrueOrFalse.addEventListener('click', (e) => {
    questionIndex++;
    let img = 'i'+ questIndex;
    let property = new Array();
    let path = 'm10'+questIndex;
    const hidden = 'h' + hiddenIndex++;
    const radioName = 'r' + (radioIndex++);
    let timerName = 't'+(timerIndex++)
    let pointsName = 'p'+(pointsIndex++)
    let questId = 'q'+(questHash++);
    let div = document.createElement('div');
    div.setAttribute('id', questId);
    btnSave.style.display = 'block'
    questions.push(questId);
    property.push('0002');
    property.push(questId);
    property.push(path);
    property.push(timerName);
    property.push(pointsName);
    property.push(radioName);
   
   
 
    div.innerHTML=` 
                    <div class="form-group">
                        <div class="row my-3">
                            <div class="col text-start">
                                <label for=""><h4>True or False</h4></label>
                            </div>
                            <div class="col text-end">
                                <a onclick='removeQuestion(`+(questIndex)+`)' class=" btn btn-outline-danger">Remove</a>
                            </div>
                        </div>
                        <input id='`+hidden+`' type='hidden' name='`+hidden+`' >
                        <input type="text" class="question form-control" name='`+questId+`' placeholder='Question' required>
                        <div id='`+img+`' class='text-center p-2'></div>
                        <div class="form-inline d-flex justify-content-center mt-2">
                            <input name='`+path+`' onchange='displayImg(this,`+questIndex+`)' id='m`+questIndex+`' type='file' accept='image/*' style='display:none'>
                            <a onclick='addImage(this,`+(questIndex++)+`)' class="btn btn-primary p-2 shadow">Add Image</a>
                        </div>
                    <div class="form-inline mt-5 ml-5">
                        <h5 class="mr-5 font-weight-bold">Answer</h5>
                        <input style='width:20px;height:20px;' type="radio" class=" ms-3 me-1" name="`+radioName+`" value='true' required>
                        <label for="">
                            <h5>True</h5>
                        </label>

                        <input style='width:20px;height:20px;' type="radio" class=" ms-3 me-1" name="`+radioName+`" value='false' required>
                        <label for="">
                            <h5>False</h5>
                        </label>
                    </div>
                    <div class="last row mt-4">
                        <div class="col">
                            <label class="ml-3">Points</label>
                            <input value='0' name='`+pointsName+`' class="form-control ml-3" type="number" min='0' required>
                        </div>
                        <div class="col">
                            <label class="ml-5">Set Timer</label>
                            <select name='`+timerName+`' class="form-control ml-3" name="" id="">
                            `+ timerOptions +`
                            </select>
                        </div>
                    </div>
            </div>`
    form2.appendChild(div)
    e.preventDefault()

    hiddenFields.push(hidden);
    console.log(hiddenFields)
    const hiddenInput = document.querySelector('#' + hidden);
    hiddenInput.value = property;
    allProperties.push(property)
    input.value = hiddenFields;
})

generateIdentification.addEventListener('click', (e) => {
    questionIndex++;
    let property = new Array();
    const hidden = 'h' + hiddenIndex++;
    let img = 'i'+questIndex;
    let path = 'm10'+questIndex;
    let timerName = 't'+(timerIndex++)
    let pointsName = 'p' + (pointsIndex++)
    let answerName = 'a' + (answerIndex++);
    let questId = 'q'+(questHash++);
    let div = document.createElement('div')
    div.setAttribute('id',questId);
    questions.push(questId);
    property.push('0003');
    property.push(questId);
    property.push(path);
    property.push(timerName);
    property.push(pointsName);
    property.push(answerName);
    btnSave.style.display = 'block'
    
  
    div.innerHTML=` <div class="form-inline justify-content-end">
                    </div>
                    <div class="form-group">
                        <div class="row my-3">
                            <div class="col text-start">
                                <label for=""><h4>Identification</h4></label>
                            </div>
                            <div class="col text-end">
                                <a onclick='removeQuestion(`+(questIndex)+`)' class=" btn btn-outline-danger">Remove</a>
                            </div>
                        </div>
                        <input id='`+hidden+`' type='hidden' name='`+hidden+`' >
                        <input type="text" class="question form-control" name='`+questId+`' placeholder='Question' required>
                        <div id='`+img+`' class='text-center p-2'></div>
                        <div class="form-inline d-flex justify-content-center mt-2">
                            <input name='`+path+`' onchange='displayImg(this,`+questIndex+`)' id='m`+questIndex+`' type='file' accept='image/*' style='display:none'>
                            <a onclick='addImage(this,`+(questIndex++)+`)' class="btn btn-primary p-2 shadow">Add Image</a>
                        </div>
                    <div class="form-inline col mt-2">
                        <input name='`+answerName+`' type="text" class="choices form-control" placeholder="Correct Answer" required>
                    </div>
                    <div class="last row mt-4">
                        <div class="col">
                            <label class="ml-3">Points</label>
                            <input value='0' name='`+pointsName+`' class="form-control ml-3" type="number" min='0' required>
                        </div>
                        <div class="col">
                            <label class="ml-5">Set Timer</label>
                            <select name='`+timerName+`' class="form-control ml-3" name="" id="">
                            `+ timerOptions +`
                            </select>
                        </div>
                    </div>
            </div>`
    form2.appendChild(div)
    e.preventDefault()
    
    hiddenFields.push(hidden);
    console.log(hiddenFields)
    const hiddenInput = document.querySelector('#' + hidden);
    hiddenInput.value = property;
    allProperties.push(property)
    input.value = hiddenFields;
   
})

const addImage = (c,id) =>{
    const current = document.querySelector(`#m${id}`)
    current.click()
    let img = document.createElement('div')
        img.innerHTML = `<img id='d`+id+`' onclick='test(`+id+`)' class='img-fluid' style="height:350px;">
                            <div id='section`+id+`' class='form-inline text-center justify-content-center'>
                                <a onclick='removeImg(`+id+`)' class='btn btn-danger m-3 '>Remove</a>
                                <a onclick='test(`+id+`)' class='btn btn-warning m-3 '>Change</a>
                            </div>
                        </img>`
        document.querySelector(`#i${id}`).appendChild(img)
    
    c.remove()

    // current.addEventListener('change',()=>{
    //     alert()
    //     let img = document.createElement('div')
    //     img.innerHTML = `<img id='d`+id+`' onclick='test(`+id+`)' class='border' style="height:400px;">
    //     <div id='section`+id+`' class='form-inline text-center justify-content-center'>
    //         <a onclick='removeImg(`+id+`)' class='btn-sm btn-dark m-3 '>Remove Image</a>
    //         <a onclick='test(`+id+`)' class='btn-sm btn-dark m-3 '>Change Image</a>
    //     </div>
    //     </img>
    //     `
    //     document.querySelector(`#i${id}`).appendChild(img)
    
    //     c.remove()
    // })

}
const test = (id) =>{
    document.querySelector(`#m${id}`).click()
  
}
const displayImg = (e,id) => {
  
    if (e.files[0]) {
        let reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector(`#d${id}`).setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
    }
}


const removeImg = (id) => {
    document.querySelector(`#d${id}`).remove()
    document.querySelector(`#section${id}`).remove()
  
     
}
const removeQuestion = (i) => {
    document.querySelector(`#${questions[i]}`).remove()
    console.log(questions[i]);
    console.log(hiddenFields[i]);
    console.log(allProperties[i]);
    delete questions[i];
    delete hiddenFields[i];
    delete allProperties[i]
    console.log(hiddenFields);
    filteredArray = hiddenFields.filter((item) => {
        return item;
    })
    if (filteredArray.length == 0)
        btnSave.style.display = 'none'
    
    input.value = filteredArray
  
}


// let q = new Object();
// q.question = "what";
// q.option1 = "1";
// q.option2 = "2";
// q.option3 = "3";
// q.answer = '1';

// let p = new Object();
// p.question = "where";
// p.answer = 'true';

// let list = new Array();

// list.push(q)
// list.push(p)

// console.log(list)

{/* <img class='border' style="height:400px;" src='../img/add.png'></img> */}

