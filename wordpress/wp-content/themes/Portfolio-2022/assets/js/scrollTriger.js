$(document).on('scroll', function(){
  $('#univers-txt__wrap').css("left", Math.max(1 - 0.1*window.scrollY, -115) + "vw");
  if (window.scrollY >= 2722){
    const realText = $("#real-txt")
    calcMath = Math.max(-200 + 2*(window.scrollY/27), -115);
    $(realText).css("transform","translateX(-" + calcMath + "vw)");
  }

})
