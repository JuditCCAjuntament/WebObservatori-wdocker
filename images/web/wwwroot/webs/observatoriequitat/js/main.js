//Init materialize sidenav funcrion
$(document).ready(function () {
  $('.sidenav').sidenav();
  console.log("Init");
  if (window.matchMedia('(max-width: 768px)').matches) {
    //Searchbar but the api is wrong
    $(".notMobile").appendTo(".moibleSearch");
    console.log("Moving");
  }
});

//Collapsible
$(".collapsibleIndicadors").hover(
  function () {
    $(".collapsibleItems").css("display", "flex");
    let id = this.id;
    console.log("Hovered In Menu"+id);
    $(".collapsibleItems").children().each(( index )=>{
        //console.log(index + " " +  $(this).attr("id"));
        if($(this).attr("id") == id){
          console.log("MATCH!: "+index);
        }
    });
    
    
  }, function () {
    console.log("Hovered Out Menu");
  }
);
$(".collapsibleItems").hover(
  function () {
    console.log("Hovered In Items");
  },
  function () {
    $(this).css("display", "none");
    console.log("Hovered out Items");
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
    console.log("Search trigger");
    $(".linksContainer").css("display", "none")
  }
);

$(".goBack").click(
  () => {
    $(".searchContainer").css("display", "none")
    console.log("Search trigger");
    $(".linksContainer").css("display", "flex")
  }
);

