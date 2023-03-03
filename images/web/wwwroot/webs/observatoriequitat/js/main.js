//Init materialize sidenav funcrion
$(document).ready(function () {
  $('.sidenav').sidenav();
  if (window.matchMedia('(max-width: 768px)').matches) {
    //Searchbar but the api is wrong
    $(".notMobile").appendTo(".moibleSearch");
  }
});

//Collapsible
$(".collapsibleIndicadors").hover(
  function () {
    $(".collapsibleItems").css("display", "flex");
    let id = this.id;
    $(".collapsibleItems").children().each(( index,element )=>{
        if($( element ).attr("id") != id){
          $( element ).css("display","none");
        }else{
          $( element ).css("display","inline");
        }
    });
    
    
  }, function () {
  }
);
$(".collapsibleItems").hover(
  function () {
  },
  function () {
    $(this).css("display", "none");
  }
);

//Anchors
$(".socioeAnchor").hover(
  function () {
    $(this).append($("<i class='material-icons'> chevron_right</i>"));
    $(this).children("i").css("display", "none");
    $(this).children("i").fadeIn();
  }, function () {
    $(this).find("i").last().remove();
  }
);

//Searchbar
$(".searchTrigger").click(
  () => {
    $(".searchContainer").css("display", "flex")
    $(".linksContainer").css("display", "none")
  }
);

//Collapsibles
$(".goBack").click(
  () => {
    $(".searchContainer").css("display", "none")
    $(".linksContainer").css("display", "flex")
  }
);

