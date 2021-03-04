function printDiv() 
    {

    var divToPrint=document.getElementById('DivIdToPrint');

    var newWin=window.open('','Print-Window');

    newWin.document.open();

    newWin.document.write('<html><style>table{border: 1px solid; border-collapse: collapse; text-align: center; padding: 8px 10px 8px 10px} tr td {border: 1px solid; border-collapse: collapse;  padding: 8px} th {border: 1px solid; border-collapse: collapse; padding:8px}</style><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

    newWin.document.close();

    setTimeout(function(){newWin.close();},10);
    }