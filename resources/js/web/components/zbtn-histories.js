var boton1 = document.getElementById("btn1");
var boton2 = document.getElementById("btn2");
var boton3 = document.getElementById("btn3");
var boton4 = document.getElementById("btn4");
var histories = document.getElementById("histories");
var cocreation = document.getElementById("cocreation");
var report = document.getElementById("report");

document.getElementById('btn1').addEventListener("click", function(){
  
   if(boton2.classList.contains("active")){
      boton2.classList.remove("active");
   }
   if(boton3.classList.contains("active")){
    boton3.classList.remove("active");
    }
   if(!boton1.classList.contains("active")){
      boton1.classList.toggle("active");
   }
  
});

document.getElementById('btn2').addEventListener("click", function(){
  
   if(boton1.classList.contains("active")){
      boton1.classList.remove("active");
   }
   if(boton3.classList.contains("active")){
    boton3.classList.remove("active");
 }
   
   if(!boton2.classList.contains("active")){
      boton2.classList.toggle("active");
   }
  
});

document.getElementById('btn3').addEventListener("click", function(){
  
    if(boton1.classList.contains("active")){
       boton1.classList.remove("active");
    }
    if(boton2.classList.contains("active")){
        boton2.classList.remove("active");
     }
    
    if(!boton3.classList.contains("active")){
       boton3.classList.toggle("active");
    }
   
 });

 $('#btn3').on('click',function(){
    $('#histories').toggle('slow');
    $('#cocreation').hide();
    $('#report').hide();
 });
 $('#btn2').on('click',function(){
    $('#report').toggle('slow');
    $('#histories').hide();
    $('#cocreation').hide();
 });
 $('#btn1').on('click',function(){
    $('#cocreation').toggle('slow');
    $('#report').hide();
    $('#histories').hide();
 });