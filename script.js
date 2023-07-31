
function checkAll() {
    
    const mainCheckbox = document.getElementById("mainCheckbox");
    
    
    const otherCheckboxes = document.getElementsByClassName("otherCheckbox");
    
    
    for (let i = 0; i < otherCheckboxes.length; i++) {
        otherCheckboxes[i].checked = mainCheckbox.checked;
    }
}






