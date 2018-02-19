
$('#employee').click(function() {
    $("#firstname").show();
    $("#firstnameinput").prop('required',true);
    $("#lastname").show();
    $("#lastnameinput").prop('required',true);

    $("#companyname").hide();
    $("#companynameinput").prop('required',false);
});

$('#company').click(function() {
    $("#firstname").hide();
    $("#firstname").show();
    $("#firstnameinput").prop('required',true);
    $("#lastname").show();
    $("#lastnameinput").prop('required',true);

    $("#companyname").show();
    $("#companynameinput").prop('required',true);
});
