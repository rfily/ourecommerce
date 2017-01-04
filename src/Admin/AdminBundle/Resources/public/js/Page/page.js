/**
 * Created by Niaina on 03/01/2017.
 */
$(document).ready(function(){
    /*$(".link_ajouter").click(function(){
        alert("Go popup");
    });*/

    //$(".link_ajouter").modal({
      //  escapeClose: false,
       // clickClose: false,
        //showClose: true
    //});

    $('.link_ajouter').click(function(){
        var modal = $('#myModal');
        $.get(Routing.generate('admin_admin_ajoutpage'), null, function(data) {
            modal.html(data);
        });
        // create the modal and bind the button
        $('#myModal').dialog({
            buttons: {
                success: {
                    label: "Save",
                    className: "btn-success",
                    callback: function() {
                        that = this;
                        var data = {};
                        // get the data from your form
                        $(that).find('input, textarea').each(function(){
                            data[$(this).attr('name')] = $(this).val();
                        });
                        // Post the data
                        $.post( "yourURL", function(data , status) {
                            if ( "201" === status){
                                $modal.modal('hide');
                            }
                            else {
                                $modal.find('modal-body').html(data);
                            }
                        });
                    }
                }
            }});
    });
});
