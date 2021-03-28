$(document).ready(function(){
//define variables
var activenote = 0;
var editmode =false;
var mode = '';
//load notes on page load :AJAX call to loadnots.php

$.ajax({
    url:'loadnotes.php',
    success:function(data){
            if(data == "error"){
                $('#notes').html("<div class='alert alert-warning'>You have not created any notes yet!</div>");
                mode = 'hide';
                $("#edit").hide();
            }else{
                $('#notes').html(data);
                mode='show';
            }
            
            // if(data == 'error'){
            //     $('#notes').html("'<div class='alert alert-warning'>You have not created any notes yet!</div>'");
            // }
            clickOnNotes();
            clickOnEdit();
            clickOnDone()
            clickOnDelete();
    },
    error:function(){
        $('#notes').html('ERROR');
    }
});

//add a new note : AJAX call to createnotes.php
$('#addnote').click(function(){

    $.ajax({
        url:'createnotes.php',
        success:function(data){
            if(data == 'error'){
                $('#alertcontent').text("There was an issue inserting the new note in the database!");
                $("#alert").fadeIn();
            
            }else{
                //update activeNote to the id of the new note
                activenote = data;
                //empty new note
                $('textarea').val("");
                showhide(['#notepad','#allnote','#save'],['#Done','#edit','#notes','#addnote']);
                $("textarea").focus();
               
            }

        },
        error:function(){
            $('#alertcontent').text("There was an error with the Ajax Call. Please try again later.");
            $("#alert").fadeIn();
        }
    });

});
//type note : AJAX call to updatenote.php
$("textarea").keyup(function(){
    $.ajax({
        url:'updatenotes.php',
        type:'POST',
        data: {note:$(this).val(),id:activenote},
        success:function(data){
               if(data == 'error'){
                $('#alertcontent').text("There was an issue updating the note in the database!");
                $("#alert").fadeIn();
               }
        },
        error:function(){
            $('#alertcontent').text("There was an error with the Ajax Call. Please try again later.");
                        $("#alert").fadeIn();
        }
    });

});

// click on all notes button
$("#allnote").click(function(){
    $.ajax({
        url:'loadnotes.php',
        success:function(data){
            if(data == "error"){
                $('#notes').html("<div class='alert alert-warning'>You have not created any notes yet!</div>");
                showhide(['#notes','#addnote'],['#notepad','#allnote','#save']);
               // $("#edit").hide();
            }else{
                $('#notes').html(data);
                showhide(['#edit','#notes','#addnote'],['#notepad','#allnote','#save']);
                $('#Done').hide();
                clickOnNotes();
                clickOnEdit();
                clickOnDone();
                clickOnDelete();
            }
        },
        error:function(){
            $('#alertcontent').text("There was an error with the Ajax Call. Please try again later.");
                        $("#alert").fadeIn();
        }
    });
    
});

//click on save
$("#save").click(function(){
    $.ajax({
        url:'loadnotes.php',
        success:function(data){
            if(data == "error"){
                $('#notes').html("<div class='alert alert-warning'>You have not created any notes yet!</div>");
                showhide(['#notes','#addnote'],['#notepad','#allnote','#save']);
               // $("#edit").hide();
            }else{
                $('#notes').html(data);
                showhide(['#edit','#notes','#addnote'],['#notepad','#allnote','#save']);
                $('#Done').hide();
                clickOnNotes();
                clickOnEdit();
                clickOnDone();
                clickOnDelete();
            }
        },
        error:function(){
            $('#alertcontent').text("There was an error with the Ajax Call. Please try again later.");
                        $("#alert").fadeIn();
        }
    });
    
});

//click on done after editing:load notes again
function clickOnDone(){
    $(document).on('click', '#Done', function(){ 
        editmode = false;

        $.ajax({
            url:'loadnotes.php',
            success:function(data){
                    if(data == "error"){
                        $('#notes').html("<div class='alert alert-warning'>You have not created any notes yet!</div>");
                        showhide([''],['#Done','.delete']);
                    }else{
                        $('.noteheader').removeClass('col-7  col-sm-9 col-md-7');
                        $('.note').removeClass('row');
                        // // show hide elements
                        showhide(['#edit'],['#Done', '.delete']);
                    }                                 
            },
            error:function(){
                $('#notes').html('ERROR');
            }
        });
    });
}
//click on edit : go to edit node
function clickOnEdit(){
    $(document).on('click', '#edit', function(){ 
        editmode = true;
        //reduce the width of notes
        $('.noteheader').addClass('col-7  col-sm-9 col-md-7');
        $('.note').addClass('row');
        // // show hide elements
        showhide(['#Done','.delete'],[this]);
        $('#Done').show();
        // Your Code
    });
    
}

//(show delete buttos, ....)

// functions
//     click on a Note
function clickOnNotes(){
    $('.noteheader').click(function(){
        if(!editmode){
            activenote = $(this).attr('id');
            $('textarea').val($(this).find('.text').text());

            showhide(['#notepad','#allnote'],['#Done','#edit','#notes','#addnote']);
                $("textarea").focus();
        }
    });
}
//     click on delete
function clickOnDelete(){
    $(document).on('click', '.delete', function(){ 
        var deletebutton = $(this);
            $.ajax({
                url:'deletenote.php',
                type:'POST',
                data: { id:deletebutton.next().attr("id")},
                success:function(data){
                   if(data == 'error'){
                    $('#alertContent').text("There was an issue delete the note from the database!");
                    $("#alert").fadeIn();
                   }else{
                       deletebutton.parent().remove();
                   }
        
                },
                error:function(){
                    $('#alertcontent').text("There was an error with the Ajax Call. Please try again later.");
                    $("#alert").fadeIn();
                }
            });
        });
}
//     show hide function
function showhide(array1,array2){
    for(let i=0;i<array1.length;i++){
        $(array1[i]).show();
    }
    for(let i=0;i<array2.length;i++){
        $(array2[i]).hide();
    }
};


});