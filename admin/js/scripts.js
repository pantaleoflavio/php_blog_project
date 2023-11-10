$(document).ready(function() {
  $('#post-content').summernote({
    height: 300,                 // set editor height
    minHeight: null,             // set minimum height of editor
    maxHeight: null,             // set maximum height of editor
    focus: true                  // set focus to editable area after initializing summernote
  });
});

$(document).ready(function() {
  $('#selectAllBoxes').click(function (e) {
    if (this.checked) {
      $('.checkboxes').each(function () {
        this.checked = true;
      })
    } else {
      $('.checkboxes').each(function () {
        this.checked = false;
      })
    }
  });
});
  
  /*var div_box = "<div id='load-screen'><div id='loading'></div></div>";
  
  $("body").prepend(div_box);
  $('#load-screen').delay(700).fadeOut(600, function () {
    $(this).remove();
  });*/



  function loadUersOnline() {
    $.get("./includes/functions.php?onlineusers=result", function (data) {
      $(".usersonline").text(data);
    });
  }

setInterval(() => {
    loadUersOnline();
}, 3000);

