function generatePDF(){
    const element =document.getElementById("exampleModal3");
    html2pfd()
    .from(element)
    .save();
}