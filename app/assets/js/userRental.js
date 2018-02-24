$('.action').click(function() {
    // alert("you calicked me"+ this.value);
    $("#loader").show();
    $("#pass").hide();
    $("#fail").hide();
    console.log("calling ajax in action, renting");
    jQuery.ajax({
        type: "POST",
        url: 'utilities/rent.php',
        dataType: 'json',
        data: {rId: this.value},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                console.log(obj.result);
                yourVariable = obj.result;
                $("#loader").hide();
                $("#loader").hide();
                $("#pass").hide();
                $("#pass").fadeIn(1000);
                $("#fail").fadeOut(1000);
                location.reload();
            }
            else {
                $("#loader").hide();
                $("#pass").hide();
                $("#fail").hide();
                $("#pass").fadeOut(1000);
                $("#fail").fadeIn(1000);
                console.log(obj.error);
            }
        }
    });
});

$('.action-delete').click(function() {
    // alert("you calicked me"+ this.value);
    $("#loader").show();
    console.log("calling ajax in delete");
    jQuery.ajax({
        type: "POST",
        url: 'utilities/deleteResource.php',
        dataType: 'json',
        data: {rId: this.value},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                console.log(obj.result);
                yourVariable = obj.result;
                $("#loader").hide();
                $("#pass").hide();
                $("#pass").fadeIn(1000);
                $("#fail").fadeOut(1000);
                location.reload();
            }
            else {
                $("#loader").hide();
                $("#pass").hide();
                $("#fail").hide();
                $("#pass").fadeOut(1000);
                $("#fail").fadeIn(1000);
                console.log(obj.error);
            }
        }
    });
});
