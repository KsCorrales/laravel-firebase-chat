// Detectar si el usuario esta en la pestaña
window.windowFocus=true;

function onBlur() {
    windowFocus=false;
};
function onFocus(){
    windowFocus=true;
};
 
if (/*@cc_on!@*/false) { // check for Internet Explorer
    document.onfocusin = onFocus;
    document.onfocusout = onBlur;
} else {
    window.onfocus = onFocus;
    window.onblur = onBlur;
}