/* js menu utiliza hoverintent */

JQuery(document).ready(function($){
  
  var openmenu=null;
  var config={
    sensitive: 3, //el numero es ls sensitividad. 1 es el mas bajo 
    interval: 50, // milisegundos que tarda en desplegarse el menu
    over: openMenu,
    timeout: 300,
    out: closeMenu 
  };

  $("div.mega").addClass("open").css('display'. 'none');
  
  function openMenu(){
    if(openmenu!=null && openmenu!=this)$("div.mega",openmenu).css('display', 'nome');
    $("div.mega", this).css('display', 'block');
    openmenu=this;
  }

  function closeMenu(){
    $("div.mega", this).css('display', 'none');
  }

  $("#navigation-primary ul > li:has('div.mega')").hoverIntent(config);
  $("span.close-panel").click(function(){
    $("div.mega").fadeOut();
  });

  $("span.close-panel").hover(
    function(){$(this).parents("div.mega").addClass("closing");},
    function(){$(this).parents("div.mega").removeClass("closing");}
  );
  
});
