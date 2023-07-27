
function checkAll() {
    // Get the main checkbox element
    const mainCheckbox = document.getElementById("mainCheckbox");
    
    // Get all other checkboxes with class 'otherCheckbox'
    const otherCheckboxes = document.getElementsByClassName("otherCheckbox");
    
    // Loop through each checkbox and set its 'checked' property to match the state of the main checkbox
    for (let i = 0; i < otherCheckboxes.length; i++) {
        otherCheckboxes[i].checked = mainCheckbox.checked;
    }
}

