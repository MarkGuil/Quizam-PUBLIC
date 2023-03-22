
<?php

$id="id".rand(1,100);
?>


<div class="row justify-content-start" id="top" style="z-index: 1;">
    <div id="<?=$id;?>1"></div>
    <div id="<?=$id;?>2"></div>
    <div id="<?=$id;?>3"></div>
</div>
<script>
  let <?=$id;?> = 1;
    setInterval(function() {
      if (<?=$id;?> < 4)
        document.querySelector("#<?=$id;?>" + <?=$id;?>++).setAttribute("style", "background:yellow;");
      else {
        for (let i = 1; i < 4; i++) {
          document.querySelector("#<?=$id;?>" + i).setAttribute("style", "background:white");
        }
        <?=$id;?> = 1;
      }
    }, 300);
</script>