var userLineTemplate = "";

function refreshUsers(callback){
    $.ajax("/api/users")
        .then(function(data){
            $("#list-users-body").html("");
            for(var i = 0; i<data.length; i++){
                var user = data[i];
                $("#list-users-body").append(Mustache.render(userLineTemplate,user));
            }
            if(callback)
                callback();
        }).catch(function(err){
            console.error(err)
        })
}

function onClickDeleteButton(e){
    e.preventDefault();
    lockBody();
    $("#loading").removeClass("is-hidden");
    var id = $(this).data("user-id");
    $.ajax("/api/users/"+id,{method:"DELETE"})
    .then(function(data){
        refreshUsers(function(){
            $("#loading").addClass("is-hidden");
            unlockBody();
        })
    }).catch(function(){
        $("#loading").addClass("is-hidden");
        unlockBody();
    });
}

function onSubmitAddUser(e){
    e.preventDefault();
    var username = $("#user-input-username").val();
    var email = $("#user-input-email").val();
    var role = $("#user-input-role").val();
    var status = $("#user-input-active").val();
    $("#user-input-username").val("");
    $("#user-input-email").val("");
    $("#user-input-role").val("");
    $("#user-input-active").val("");

    lockBody();
    $("#loading").removeClass("is-hidden");
    $.ajax("/api/users",{
        method:"POST",
        "data":"username="+username+"&email="+email+"&role="+role+"&status="+status,
        "contentType": "application/x-www-form-urlencoded"})
        .then(function(data){
            refreshUsers(function(){
                $("#loading").addClass("is-hidden");
                unlockBody();
            })
        }).catch(function(){
        $("#loading").addClass("is-hidden");
        unlockBody();
    });
}

function onClickEditButton(e){
    e.preventDefault();
    var id = $(this).data("user-id");
    lockBody();
    $("#loading").removeClass("is-hidden");

    $.ajax("/api/users/"+id)
    .then(function(data){
        $("#edit-user-id").val(data.id);
        $("#edit-user-username").val(data.username);
        $("#edit-user-email").val(data.email);
        $("#edit-user-role").val(data.role);
        $("#edit-user-status").val(data.status);

        $("#loading").addClass("is-hidden");
        $("#edit-lightbox").removeClass("is-hidden");
    }).catch(function(err){
        console.error(err);
        $("#loading").addClass("is-hidden");
        unlockBody();
    });
}

function onSubmitEditUser(e){
    e.preventDefault();
    var id = $("#edit-user-id").val();
    var username = $("#edit-user-username").val();
    var email = $("#edit-user-email").val();
    var role = $("#edit-user-role").val();
    var status = $("#edit-user-status").val();
    $.ajax("/api/users/"+id,{
        method:"PUT",
        data:"username="+username+"&email="+email+"&role="+role+"&status="+status,
        contentType: "application/x-www-form-urlencoded"})
    .then(function(data){
        refreshUsers(function(){
            $("#loading").addClass("is-hidden");
            unlockBody();
        })
    }).catch(function(err){
        console.error(err);
        $("#loading").addClass("is-hidden");
        unlockBody();
    });
    $("#edit-lightbox").addClass("is-hidden");
    $("#loading").removeClass("is-hidden");
}

function lockBody(){
    $("body").css("overflow","hidden");
}

function unlockBody(){
    $("body").css("overflow","auto");
}

$(function(){
    userLineTemplate = $("#user-line-template").html();
    $("#list-users").on("click",".list-users--delete-button",onClickDeleteButton);
    $("#list-users").on("click",".list-users--edit-button",onClickEditButton);
    $("#new-user-form").on("submit",onSubmitAddUser);
    $("#edit-user-submit").on("submit",onSubmitEditUser);
    refreshUsers(function(){
        $("#loading").addClass("is-hidden")
    });
});