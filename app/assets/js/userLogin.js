// function toggleCompany() {
//     console.log("Inside Ajax")
//     var userType = document.querySelector('input[name = "usertype"]:checked').value;
//     console.log(userType)
// }


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
    $("#firstnameinput").prop('required',false);
    $("#lastname").hide();
    $("#lastnameinput").prop('required',false);

    $("#companyname").show();
    $("#companynameinput").prop('required',true);
});