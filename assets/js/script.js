$(function(){
    $(".loadingbar").hide();
    // $(".toast").toast("show");


    function isloading(){

        $(".loadingbar").show();

    }


    function resp(data){

        $(".loadingbar").hide();

        console.log(data);
        var data = JSON.parse(data);

        if(data.status == 'error'){

            $.each(data.error, function(prefix, val){

                $("span."+prefix+"_error").text(val[0]);

            })

        }else{

            $(".toast").toast("show");

            $(".toast-body").text(data.msg);

            $(".bntsubmitchat")[0].reset();

            $(".msgdata").load('send.php?action=load');

        }

    }

    $(document).on("submit", ".bntsubmitchat", function(e){

        e.preventDefault();
        var opt = {
            url: 'send.php?action=sendmsg',
            type: 'POST',
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: isloading,
            success: resp,
            
            // dataType: ,
           
            
       
        };

        $.ajax(opt);

    })  
    
})