function printDiv(){
    $(".payment-schedule").print({
        addGlobalStyles : true,
        stylesheet : "/css/custom.css",
        rejectWindow : true,
        noPrintSelector : ".no-print",
        iframe : true,
        append : null,
        prepend : null
    });
}

function printDiv1(){
    $("#DivIdToPrint").print({
        addGlobalStyles : true,
        stylesheet : "/css/custom.css",
        rejectWindow : true,
        noPrintSelector : ".no-print",
        iframe : true,
        append : null,
        prepend : null
    });
}