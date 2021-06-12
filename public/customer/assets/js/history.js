const View = {

};
(() => {
    function getServiceData(){
        var service_data = $('.service_value');
        service_data.each(function( index ) {
            father = $(this)
            Api.ServicesProcedure.Get($(this).html())
                .done(res => {
                    // console.log(res);
                    $(this).html(res.name)
                })
                .fail(err => {
                    console.log(err);
                    View.helper.showToastError('Error', 'Something Wrong'); 
                })
                .always(() => {
                });
        });
       
    }
    getServiceData()
})();
