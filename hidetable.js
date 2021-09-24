function toggleColumn(n) {
    var currentClass = document.getElementById("mytable").className;
    if (currentClass.indexOf("show"+n) != -1) {
        document.getElementById("mytable").className = currentClass.replace("show"+n, "");
    }
    else {
        document.getElementById("mytable").className += " " + "show"+n;
    }
}
