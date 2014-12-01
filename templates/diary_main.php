<?php include('header.php'); ?>

<div class="container">

<div class="contents">

<div id="write_diary_form">


<form method="post" action="/diary/write/" role="form" class="form-horizontal">
  <h2>書き込み</h2>

  <div class="form-group">
    <label for="inputSelectDate" class="col-sm-1 control-label">日付</label>
    <div class="col-sm-3">
      <input type="date" class="form-control" id="inputSelectDate" placeholder="2014-03-11" value="<?=date('Y-m-d');?>">
    </div>
  </div>

  <div class="form-group">
    <label for="inputFact" class="col-sm-1 control-label">事実</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputFact" placeholder="事実">
    </div>
  </div>
  <div class="form-group">
    <label for="inputDiscover" class="col-sm-1 control-label">発見</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputDiscover" placeholder="発見">
    </div>
  </div>
  <div class="form-group">
    <label for="inputLesson" class="col-sm-1 control-label">教訓</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputLesson" placeholder="教訓">
    </div>
  </div>
  <div class="form-group">
    <label for="inputDeclaration" class="col-sm-1 control-label">宣言</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputDeclaration" placeholder="宣言">
    </div>
  </div>
  <div class="col-sm-offset-1 col-sm-10">
    <button type="submit" class="btn btn-default">Submit</button>
  </div>
</form>

</div>

</div>


<div class="contents">

<h2><?=date('Y年m月', strtotime($month));?></h2>

<? foreach ( $contents as $cont ) : ?>
  <h3><?=date('j', strtotime($cont->target_date));?>日 (<?=$day[(int)date('w', strtotime($cont->target_date))];?>)</h3>

  <table class="table">
    <tr>
      <th>事実</th><td><?=$cont->cnt_fact;?></td>
    </tr>
    <tr>
      <th>発見</th><td><?=$cont->cnt_discover;?></td>
    </tr>
    <tr>
      <th>教訓</th><td><?=$cont->cnt_lesson;?></td>
    </tr>
    <tr>
      <th>宣言</th><td><?=$cont->cnt_declaration;?></td>
    </tr>
  </table>
<? endforeach; ?>

</div><!-- /contents -->

</div><!-- /container -->

<?php include('footer.php'); ?>


