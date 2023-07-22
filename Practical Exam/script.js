$(document).ready(function(){
    //display superhero_name html class first and after hitting submit, display the "index" class
    $("#index").hide();
    $("#superhero_name").show();
    $("#superhero_name").submit(function(event){
        event.preventDefault();
        $("#superhero_name").hide();
        $("#index").show();
    });
});
