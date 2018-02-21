$('.action').click(function() {
    // alert("you calicked me"+ this.value);
    $("#todo").hide();
    $("#todo").fadeIn(1000);

    // todo
    // $("#loader").show();
    // $("#pass").hide();
    // $("#fail").hide();
    // jQuery.ajax({
    //     type: "POST",
    //     url: 'utilities/book.php',
    //     dataType: 'json',
    //     data: {rId: this.value},
    //
    //     success: function (obj, textstatus) {
    //         if( !('error' in obj) ) {
    //             console.log(obj.result);
    //             yourVariable = obj.result;
    //             $("#loader").hide();
    //             $("#loader").hide();
    //             $("#pass").hide();
    //             $("#pass").fadeIn(1000);
    //             $("#fail").fadeOut(1000);
    //         }
    //         else {
    //             $("#loader").hide();
    //             $("#pass").hide();
    //             $("#fail").hide();
    //             $("#pass").fadeOut(1000);
    //             $("#fail").fadeIn(1000);
    //             console.log(obj.error);
    //         }
    //     }
    // });
});
