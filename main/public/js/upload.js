
let files1 = [],
    input1 = $('file1'),
    files_count_max1 = 1,
    button1 = document.querySelector('.card button1'),
    select1 = document.querySelector('#image-area-select1'),
    container1 = document.querySelector('#container1');

let files2 = [],
    input2 = $('file2'),
    files_count_max2 = 1,
    button2 = document.querySelector('.card button2'),
    select2 = document.querySelector('#image-area-select2'),
    container2 = document.querySelector('#container2');

    let files3 = [],
    input3 = $('file3'),
    files_count_max3 = 1,
    button3 = document.querySelector('.card button3'),
    select3 = document.querySelector('#image-area-select3'),
    container3 = document.querySelector('#container3');

    let files4 = [],
    input4 = $('file4'),
    files_count_max4 = 1,
    button4 = document.querySelector('.card button4'),
    select4 = document.querySelector('#image-area-select4'),
    container4 = document.querySelector('#container4');

    let files5 = [],
    input5 = $('file5'),
    files_count_max5 = 1,
    button5 = document.querySelector('.card button5'),
    select5 = document.querySelector('#image-area-select5'),
    container5 = document.querySelector('#container5');

$('#image-area-select1').on('click', function() {
    if( files1.length < files_count_max1 ){
        $('#file1').trigger('click');
    }
});

$('#image-area-select2').on('click', function() {
    if( files2.length < files_count_max2 ){
        $('#file2').trigger('click');
    }
});

$('#image-area-select3').on('click', function() {
  if( files3.length < files_count_max3 ){
      $('#file3').trigger('click');
  }
});

$('#image-area-select4').on('click', function() {
  if( files4.length < files_count_max4 ){
      $('#file4').trigger('click');
  }
});

$('#image-area-select5').on('click', function() {
if( files5.length < files_count_max5 ){
    $('#file5').trigger('click');
}
});

$('#file1').change(function(){
    if (!files1.some(e => e.name === this.files[0].name && e.size === this.files[0].size)) files1.push(this.files[0])
    showImages1();
});

$('#file2').change(function(){
    if (!files2.some(e => e.name === this.files[0].name && e.size === this.files[0].size)) files2.push(this.files[0])
    showImages2();
});

$('#file3').change(function(){
  if (!files3.some(e => e.name === this.files[0].name && e.size === this.files[0].size)) files3.push(this.files[0])
  showImages3();
});

$('#file4').change(function(){
  if (!files4.some(e => e.name === this.files[0].name && e.size === this.files[0].size)) files4.push(this.files[0])
  showImages4();
});

$('#file5').change(function(){
if (!files5.some(e => e.name === this.files[0].name && e.size === this.files[0].size)) files5.push(this.files[0])
showImages5();
});


function showImages1() {
  if (files1.length > 0) {

    container1.innerHTML = files1.reduce((prev, curr, index) => {
        return `${prev}
<div class="image-uploaded">
<img src="${URL.createObjectURL(curr)}" alt="" class="image-uploaded">
<svg  onclick="delImage1(${index})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
 stroke-width="1.5" stroke="currentColor" class="trash"><path stroke-linecap="round" stroke-linejoin="round"
  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
</svg></div>`
    }, '');
  } else {

    container1.innerHTML = '<div class="image-uploaded"><img src="./img/prw-empty.svg"" alt="" class="image-uploaded"></div>';

}

}

function showImages2() {
  if (files2.length > 0) {
    container2.innerHTML = files2.reduce((prev, curr, index) => {
        return `${prev}
<div class="image-uploaded">
<img src="${URL.createObjectURL(curr)}" alt="" class="image-uploaded">
<svg  onclick="delImage2(${index})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
 stroke-width="1.5" stroke="currentColor" class="trash"><path stroke-linecap="round" stroke-linejoin="round"
  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
</svg></div>`
    }, '');
  } else {

    container2.innerHTML = '<div class="image-uploaded"><img src="./img/prw-empty.svg"" alt="" class="image-uploaded"></div>';

}
}

function showImages3() {
  if (files3.length > 0) {
  container3.innerHTML = files3.reduce((prev, curr, index) => {
      return `${prev}
<div class="image-uploaded">
<img src="${URL.createObjectURL(curr)}" alt="" class="image-uploaded">
<svg  onclick="delImage3(${index})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
stroke-width="1.5" stroke="currentColor" class="trash"><path stroke-linecap="round" stroke-linejoin="round"
d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
</svg></div>`
  }, '');
} else {

  container3.innerHTML = '<div class="image-uploaded"><img src="./img/prw-empty.svg"" alt="" class="image-uploaded"></div>';

}
}


function showImages4() {
  if (files4.length > 0) {
  container4.innerHTML = files4.reduce((prev, curr, index) => {
      return `${prev}
<div class="image-uploaded">
<img src="${URL.createObjectURL(curr)}" alt="" class="image-uploaded">
<svg  onclick="delImage4(${index})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
stroke-width="1.5" stroke="currentColor" class="trash"><path stroke-linecap="round" stroke-linejoin="round"
d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
</svg></div>`
  }, '');
} else {

  container4.innerHTML = '<div class="image-uploaded"><img src="./img/prw-empty.svg"" alt="" class="image-uploaded"></div>';

}
}

function showImages5() {
  if (files5.length > 0) {
container5.innerHTML = files5.reduce((prev, curr, index) => {
    return `${prev}
<div class="image-uploaded">
<img src="${URL.createObjectURL(curr)}" alt="" class="image-uploaded">
<svg  onclick="delImage5(${index})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
stroke-width="1.5" stroke="currentColor" class="trash"><path stroke-linecap="round" stroke-linejoin="round"
d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
</svg></div>`
}, '');
} else {

  container5.innerHTML = '<div class="image-uploaded"><img src="./img/prw-empty.svg"" alt="" class="image-uploaded"></div>';

}
}


function delImage1(index) {
    files1.splice(index, 1);
    showImages1();
}


function delImage2(index) {
    files2.splice(index, 1);
    showImages2();
}


function delImage3(index) {
  files3.splice(index, 1);
  showImages3();
}

function delImage4(index) {
  files4.splice(index, 1);
  showImages4();
}


function delImage5(index) {
files5.splice(index, 1);
showImages5();
}