<!DOCTYPE html>
<html>
  <head>
    <title>Simida</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF8" /> 
    <meta http-equiv="Content-Language" content="zh-CN" /> 
    {include file="header.tpl"}
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 400px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

     </style>
   <script type="text/javascript">
   var current_id;
   var score = 0;
   var count = 0;
    var qNo   = 0;
    var ChallengeCounter;
    var timerCount;
   $(document).ready(function() {  

    updateData();
   $('#answerA').click(function (){
    $.post(
      'http://localhost/ArtkPHP/index.php/matchAction/submitanswer',
      {
        uid:{$user_id},
        id: $('#qid').val(),
        order:qNo,
        answer:1
      },
      function (data) //回传函数
      {
      	  //alert(data);
         if(data==1){
          alert('right answer!'); 
          score+=20;  

          }else{
             alert('wrong answer!');   
          }
          updateData();
      }
    );
   });
   $('#answerB').click(function (){
    $.post(
      'http://localhost/ArtkPHP/index.php/matchAction/submitanswer',
      {
        uid:{$user_id},
        id:$('#qid').val(),
        order:qNo,
        answer:2
      },
      function (data) //回传函数
      {
          //alert(data);
          if(data==1){
             alert('right answer!');   
             score+=20;
          }else{
             alert('wrong answer!');   
          }
         updateData();
      }
    );
   });
   $('#answerC').click(function (){
    $.post(
      'http://localhost/ArtkPHP/index.php/matchAction/submitanswer',
      {
        uid:{$user_id},
        id:$('#qid').val(),
        order:qNo,
        answer:3
      },
      function (data) //回传函数
      {
           //alert(data);
          if(data.indexOf('1')>=1){
             alert('right answer!');   
             score+=20;
          }else{
             alert('wrong answer!');   
          }
         updateData();
      }
    );
   });
   $('#answerD').click(function (){
    $.post(
      'http://localhost/ArtkPHP/index.php/matchAction/submitanswer',
      {
        uid:{$user_id},
        id:$('#qid').val(),
        order:qNo,
        answer:4
      },
      function (data) //回传函数
      {
           //alert(data);
          if(data.indexOf('1')>=1){
             alert('right answer!');   
             score+=20;
          }else{
             alert('wrong answer!');   
          }
         updateData();
      }
    );
   });


    $('#challenge').click(function (){
    $.post(
      'http://localhost/ArtkPHP/index.php/matchAction/launchmatch',
      {
        uid:{$user_id}, //current_id
        aid:$('#aid').val()
      },
      function (data) //回传函数
      {
          alert('挑战完毕'+$('#aid').val());
      }
    );
   });

  
     ChallengeCounter = setInterval(checkChallenge,1000);

    });  
    
  

     function countDown() {  
      
      $("#tips").html("倒计时:"+(10-(count++))+"  第"+(qNo)+"题"+" 总得分:"+score);
      if(qNo>=10){
          qNo=10;
          endMatch();
          clearInterval(timerCount);
      }
      if(count==10){
        updateData();
        //count = 0;
        //qNo++;
      }

      }  

      function endMatch(){
      	alert('比赛结束');

      }
      function checkChallenge(){

      $.post(
      'http://localhost/ArtkPHP/index.php/matchAction/checkmatch',
      {
        uid:{$user_id}
      },
      function (data) //回传函数
      {
      	//alert(data);
      if(data==1){
       if(confirm("是否接受挑战")){
          acceptMatch();
          timerCount = setInterval(countDown, 1000); 
       }
      }
      else if(data==2){
      	alert('match start !');
 		//var timerCount = 
 		timerCount =setInterval(countDown, 1000); 
 		clearInterval(ChallengeCounter);
      	//TODO
      }
      }
     );
      }


      function acceptMatch(){
      $.post(
      'http://localhost/ArtkPHP/index.php/matchAction/acceptmatch',
      {
        uid:{$user_id}
       },
      function (data) //回传函数
      {
      }
      
     );

      }
     function updateData(){

     $.post("http://localhost/ArtkPHP/index.php/questionAction/getdata", function(data) { 
        $('#title').html("题目: "+ data.split('||')[1]);
        $('#answerA').html(data.split('||')[2].split('<>')[0]);
        $('#answerB').html(data.split('||')[2].split('<>')[1]);
        $('#answerC').html(data.split('||')[2].split('<>')[2]);
        $('#answerD').html(data.split('||')[2].split('<>')[3]);
        current_id= data.split('||')[0];
       
        $('#qid').val(current_id);
       });  
       count = 0;
       qNo++;
       //current_id= data.split('||')[0];
     }
   </script>
   
    </head>
    <body>
<h3>Simida</h3>
   <div id='container' > 

<span  id='tips' class="input-xlarge uneditable-input"></span><br><br>
<input type='hidden' id='qid'>
<div id='title'>Question</div><br><br>
<div id='choices'>

   <button id="answerA"class="btn btn-large btn-primary" type="button">Option A</button><br><br>
    <button id="answerB" class="btn btn-large btn-primary" type="button">Option B</button><br><br>
     <button id="answerC" class="btn btn-large btn-primary" type="button">Option C</button><br><br>
      <button  id="answerD" class="btn btn-large btn-primary" type="button">Option D</button><br><br>

</div>
 
   </div>

    <div class="controls">
      <input type="text" id="aid" placeholder="">
      <button  id="challenge" class="btn  btn-primary" type="button">挑战</button><br><br>
    </div>



  </body>
</html>