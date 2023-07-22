var filter = "None";
var opt = "None";

function jsonParse(text){
    let json;
    try{
        json = JSON.parse(text);
    }
    catch(e){
        return false;
    }
    return json;
}

function get_filtered_by_horsepower(){
    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function(){
        if(this.readyState === 4 && this.status === 200){
            let table = document.getElementsByTagName("table")[0];
            let old_tbody = table.getElementsByTagName("tbody")[0];

            let new_tbody = document.createElement("tbody");
            let json = jsonParse(this.responseText);
            
            for(let i = 0; i < json.length; i++){
                let document1 = json[i];
                let row = new_tbody.insertRow();

                Object.keys(document1).forEach(function(key){
                    let text;
                    let cell = row.insertCell();
                    text = document1[key];
                    cell.appendChild(document.createTextNode(text));
            })
        }
        table.appendChild(new_tbody);
        old_tbody.parentNode.removeChild(old_tbody);
        }
    }
    ajax.open('POST', 'getAllCarsByHorsepower.php', true);
    let horsepower = document.getElementsByTagName("select")[0].value;
    let json = JSON.stringify({'horsepower': horsepower});
    ajax.send(json);
    //set_previous("Horsepower", horsepower);
}

function set_previous(filt, option){
    document.getElementById("previous-filter").innerHTML = "Previous Filter: " + filt + " " + option;
    //filter=filt;
    //opt=option;
}