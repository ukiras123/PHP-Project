// function toggleCompany() {
//     console.log("Inside Ajax")
//     var userType = document.querySelector('input[name = "usertype"]:checked').value;
//     console.log(userType)
// }


$('#employee').click(function() {
    $("#companyname").hide();
    $("#companynameinput").prop('required',false);
});

$('#company').click(function() {
    $("#companyname").show();
    $("#companynameinput").prop('required',true);
});