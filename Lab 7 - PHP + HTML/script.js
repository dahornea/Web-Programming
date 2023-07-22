$(document).ready(function(){
    $('.DeleteBtn').click(function() {
        //alert("Delete button clicked");
        let id = $(this).closest('tr')[0].cells[0].innerText;
        let ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function(){
            if(this.readyState === 4 && this.status === 200){
                alert("Car deleted");
                location.reload();
            }
        }
        ajax.open('POST', 'deleteCar.php', true);
        let json = JSON.stringify({'id': id});
        ajax.send(json);
        
      });

    $("table").on('click', '.btnUpdate', function(){
        let id = $(this).closest('tr')[0].cells[0].innerText;
        let model = $(this).closest('tr')[0].cells[1].innerText;
        let horsepower = $(this).closest('tr')[0].cells[2].innerText;
        let fuel_consumption = $(this).closest('tr')[0].cells[3].innerText;
        let price = $(this).closest('tr')[0].cells[4].innerText;
        let color = $(this).closest('tr')[0].cells[5].innerText;
        let age = $(this).closest('tr')[0].cells[6].innerText;
        let mileage = $(this).closest('tr')[0].cells[7].innerText;
        $(".update_form #id").val(id);
        $(".update_form #model").val(model);
        $(".update_form #horsepower").val(horsepower);
        $(".update_form #fuel_consumption").val(fuel_consumption);
        $(".update_form #price").val(price);
        $(".update_form #color").val(color);
        $(".update_form #age").val(age);
        $(".update_form #mileage").val(mileage);
        if($(".update_form").css("display")==="none")
            $(".update_form").css("display","inline");
        else
            $(".update_form").css("display","none");
    });

});