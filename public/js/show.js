window.onload= function() {

    document.getElementById('enter').onclick = function() {
        openbox('mask_enter');
        return false;
    };

    document.getElementById('registration').onclick = function() {
        openbox('mask_reg');
        return false;
    };

    document.getElementById('close_enter').onclick = function () {
        openbox('mask_enter');
        return false;
    }

    document.getElementById('close_reg').onclick = function () {
        openbox('mask_reg');
        return false;
    }

};
function openbox(id) {
    var div = document.getElementById(id);

    if(div.style.display === 'block') {
        div.style.display = 'none';
    } else {
        div.style.display = 'block';
    }
}
