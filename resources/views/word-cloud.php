<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 <script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js"></script>
  <script src="https://cdn.anychart.com/releases/v8/js/anychart-tag-cloud.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <title>Hello, Edurio!</title>
    <style>
     #container,#questions {
         height: 500px
      }
    </style>
  </head>
  <body class="bg-light">
    <div  class="container">
        <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Word Cloud</h3>
  </div>
  <div id="container" class="panel-body">
  </div>
</div>
 <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Answer Counts/Question</h3>
  </div>
  <div id="questions" class="panel-body">
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Question Counts/Answer</h3>
  </div>
  <div id="answeres" class="panel-body">
  </div>
</div>
</div>
<script type="text/javascript">
  const BASE_URL ='http://localhost/blog/index.php/';
   const xhttp = new XMLHttpRequest();
    anychart.onDocumentReady(function() {
      let data = [];
    // Word Cloud
    xhttp.onload = function() {
    let obj = JSON.parse(this.responseText);
    if(obj.open_question_count>0){
    for (const [lang, count] of Object.entries(obj.words_count)){
    data.push({'x':lang,'value':count})
    }
    }
    let chart = anychart.tagCloud(data);
    chart.title(data.length+' most spoken languages')
    chart.angles([15])
    chart.colorRange(true);
    chart.colorRange().length('80%');
    chart.container("container");
    chart.draw();
    }
    xhttp.open("GET", BASE_URL +"api/v0/open_data", true);
    xhttp.send();

      // q/a
    let q_p_a_data = [];let a_p_q_data = [];
    const phttp = new XMLHttpRequest();
    phttp.onload = function() {
    let obj = JSON.parse(this.responseText);
    if(obj.question_avg>0){
    for (const questn of (obj.answer_count_per_question)){
    q_p_a_data.push([questn.question,questn.answer_count_per_question])
    }

    for (const ans of (obj.question_count_per_answer)){
    a_p_q_data.push([ans.answer,ans.question_count_per_answer])
    }
    }
    // q/a
    let chartQA = anychart.pie(q_p_a_data);
    chartQA
    .title('Answer Counts/Question')
    .group(function (value) {
    return value >= 0;
    });
    chartQA.container('questions');
    chartQA.draw();
    // a/q
    let chartAQ = anychart.pie(a_p_q_data);
    chartAQ
    .title('Question Counts/Answer')
    .group(function (value) {
    return value >= 0;
    });
    chartAQ.container('answeres');
     chartAQ.draw();
 }
 phttp.open("GET", BASE_URL +"api/v0/return_data", true);
 phttp.send();

});
</script>

  </body>
</html>